<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\V1\CompetitionRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CompetitionController extends Controller
{

    
    public function index()
    {
        $competitionList = Competition::orderByDesc('id')->get();

        if (request()->ajax()) {
            return $this->loadPageAjax(['competitionList' => $competitionList]);
        }

        return view('dashboard.v1.competition.index' , ['competitionList' => $competitionList]);
    }

    
    public function create()
    {
        return view('dashboard.v1.competition.create');
    }

  
    public function store(CompetitionRequest $request)
    {
        $request = $request->all();
        // $request['active'] = (!isset($request['active']) || $request['active'] == null) ? Competition::STATUS_DISABLED : $request['active'];
        $request['active'] = 0;
        $request['user_id'] = Auth::id();
        try{
            Competition::create($request);
        }catch(\Exception $e){
            Log::error("error occured saving competition, " . $e->getMessage());
            alert()->error("error occured saving competition, ".$e->getMessage());
            return redirect()->back();
        }

        alert()->success(__('Competition added successfully'));
        return redirect(route('dashboard.v1.competition.index'));
    }

    
    public function show( $competitionId )
    {
        $competition = Competition::findOrFail($competitionId);
        $competitionUsers = $competition->users()->get();
        $competitionUsers->map(function ($item){
            $user = User::find($item->pivot->user_id);
            $item->setAttribute('user_name' , $user->name);
            $item->setAttribute('user_email', $user->email);
            $item->setAttribute('user_mobile', $user->mobile);
        });
        return view('dashboard.v1.competition.show' , ['competitionUsers' => $competitionUsers ,'competition' => $competition]);
    }

   
    public function edit($competitionId)
    {
        $competition = Competition::findOrFail($competitionId);

        return view('dashboard.v1.competition.edit', ['competition' => $competition]);
    }

    
    public function update(CompetitionRequest $request, $competitionId)
    {
        $request = $request->all();

        // $request['active'] = (!isset($request['active']) || $request['active'] == null) ? Competition::STATUS_DISABLED : $request['active'];
        $request['user_id'] = Auth::id();
        $competition = Competition::findOrFail($competitionId);
        try{
            $competition->update($request);
        }catch(\Exception $e){
            Log::error("error occured saving competition, " . $e->getMessage());
            alert()->error("error occured saving competition, " . $e->getMessage());
            return redirect()->back();
        }

        alert()->success(__('Competition updated successfully'));
        return redirect()->back();
    }


    public function destroy($competitionID)
    {
        $competition = Competition::findOrFail($competitionID);
        $competition->delete();
        return ajax_response(null, __('Competition deleted successfully'));
    }

    public function status($competitionID)
    {
        $competition = Competition::findOrFail($competitionID);
        if($competition->active) {
            $statusChangeText = "disabled";
            $competition->active = 0;
            $competition->save();
        }else{
            $statusChangeText = "enabled";
            Competition::where('active' , 1)->update(['active' => 0]);
            $competition->active = 1;
            $competition->save();
        }

        alert()->success(__('Competition '.$statusChangeText.' successfully'));
        return redirect()->back();
    }

    public function clearData(Request $request) {

        $validator = Validator::make($request->all() , [
            'competition_id' => 'required|integer',
            'password' => 'required|string'
        ]);
        if($validator->fails()){
            alert()->error(__('Cannot clear data, Validation error.'));

            return redirect()->back()->withErrors($validator);
        }
        if(!Hash::check($request->input('password') , Auth::user()->password)){
            alert()->error(__('Cannot clear data, Wrong password.'));
            return redirect()->back();
        }
        $competition = Competition::findOrFail($request->input('competition_id'));
        if ($competition->active) {
            alert()->error(__('Please disable the comptition first to be able to clear data'));
            return redirect()->back();
        }
        $competition->users()->detach();
        alert()->success(__('Competition Data Cleared.'));
        return redirect()->back();

    }
}
