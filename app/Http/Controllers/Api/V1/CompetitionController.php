<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CompetitionController extends Controller
{


    public function show()
    {
        // DB::connection()->enableQueryLog();

        $competition = Competition::where('active' , 1)->first();
        if(!$competition){
            return json_response(null , 'No active competition available now');
        }
        $usersCompetitionData = $competition->users()->get();
        
        $numbersTaken = [];
        foreach($usersCompetitionData as $data){
            $numbersTaken[] = $data->pivot->number;
        }
        $currentUserNumber = null;

        if( DB::table('competitions_users')->where('user_id', Auth::user()->id)->where('competition_id', $competition->id)->exists()) {
            $currentUserNumber = DB::table('competitions_users')->where('user_id', Auth::user()->id)->where('competition_id', $competition->id)->first()->number;
        }
        
        // $queries = DB::getQueryLog();

        return json_response([
            'competition' => $competition,
            'numbers_taken' => $numbersTaken,
            'current_user_selection' => $currentUserNumber,
            // 'queries' => $queries
        ]);
    }

    public function guestShow()
    {

        $competition = Competition::where('active', 1)->first();
        if (!$competition) {
            return json_response(null, 'No active competition available now');
        }
        $usersCompetitionData = $competition->users()->get();

        $numbersTaken = [];
        foreach ($usersCompetitionData as $data) {
            $numbersTaken[] = $data->pivot->number;
        }

        return json_response([
            'competition' => $competition,
            'numbers_taken' => $numbersTaken
        ]);
    }


    public function testFillPivot()
    {
        // DB::connection()->enableQueryLog();

        $numbers = range(1 , 1000 , 1);
        $data = [];
        foreach($numbers as $n)
        {
            $data[] = ['number' => $n , 'user_id' => Auth::user()->id , 'competition_id' => 1];
        }
        Competition::findOrFail(1)->users()->sync($data);
        // $queries = DB::getQueryLog();

        return ajax_response(null , 'filled with data' , 200);
    }


    public function registerNumber(Request $request) {
        $validator = Validator::make($request->all() , [
            'number' => 'required|integer',
            'competition_id' => 'required|integer'
        ]);
        if($validator->fails()) {
            return ajax_response(['errors' => $validator->errors()], 'Validation error', 400);
        }
        if(!Competition::where('id' , $request->input('competition_id'))->exists()){
            return ajax_response(null , 'Competition does not exist' , 404);
        }
        if (!Competition::where('active', 1)->where('id', $request->competition_id)->exists()) {
            return ajax_response(null, 'Competition not active', 400);
        }
        
        $competition = Competition::where('id', $request->competition_id)->first();
        // $usersCompetitionData = $competition->users()->get();

        if($request->number > $competition->max_number || $request->number < $competition->min_number){
            return ajax_response(null, 'Competition number not in range', 400);
        }

        if(DB::table('competitions_users')->where('user_id', '<>' ,Auth::user()->id )->where('competition_id' , $request->competition_id )->where('number' , $request->number)->exists()){
            return ajax_response(null, "Number '$request->number' is taken, please select another.", 400);
        }
        
        if(DB::table('competitions_users')->where('user_id', Auth::user()->id)->where('competition_id', $request->competition_id)->exists()) {
            DB::table('competitions_users')->where('user_id', Auth::user()->id)->where('competition_id', $request->competition_id)->update([
                'number' => $request->number
            ]);
        } else {
            DB::table('competitions_users')->insert([
                'number' => $request->number,
                'user_id' => Auth::user()->id,
                'competition_id' => $request->competition_id
            ]);
        }
     
        return ajax_response(null , 'Saved number' , 200);
    }

}
