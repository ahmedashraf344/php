<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnnouncementResource;
use App\Http\Resources\CategoryResource;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Resources\ShopResource;
use App\Models\Shop;

class HomeController extends Controller
{
    public function home()
    {
        $announcementsQuery = Announcement::enabledAnnouncements();
        $randomAnnouncements = $announcementsQuery->inRandomOrder()->limit(10)->get();

        $categories =Category::whereNull('category_id')->orderByDesc('id')->limit(10)->get();

        $recentlyAdded = $announcementsQuery->orderByDesc('id')->limit(10)->get();
        $shopsWithMostViews = Shop::orderBy('views' , 'desc')->limit(25)->with('reviews')->get();
        return json_response([
            'random_announcements_slider' => AnnouncementResource::collection($randomAnnouncements),
            'categories' => CategoryResource::collection($categories),
            'recently_added' => AnnouncementResource::collection($recentlyAdded),
            'notifications_count' => Notification::count(),
            'most_viewed_shops' => ShopResource::collection($shopsWithMostViews)
        ]);
    }


    public function getTerms(Request $request)
    {
        $lang = 'en';
        if ($request->header('Accept-Language') != null):
            ( $request->header('Accept-Language') == 'en') ? $lang = 'en' : $lang = 'ar';
        endif;
        $terms = [
            'title' => Setting::where('key', 'terms_title_'.$lang)->first()->value,
            'content' => Setting::where('key', 'terms_content_'.$lang)->first()->value,
        ];
        return json_response($terms);

    }

    public function getAboutUs(Request $request)
    {
        $lang = 'en';
        if ($request->header('Accept-Language') != null) :          
            ($request->header('Accept-Language') == 'en') ? $lang = 'en' : $lang = 'ar';
        endif;
        $about = [
            'title' => Setting::where('key', 'about_title_'.$lang)->first()->value,
            'content' => Setting::where('key', 'about_content_'.$lang)->first()->value,
        ];
        return json_response($about);
    }

    public function getNotificationsCount()
    {
        $data = ['count' => Notification::count()];
        return json_response($data);
    }

    public function getNotifications(Request $request)
    {
        $lang = 'en';
        if ($request->header('Accept-Language') != null) : 
            ($request->header('Accept-Language') == 'en') ? $lang = 'en' : $lang = 'ar';
        endif;

        $notifications = Notification::all();
        
        $data = [];
        foreach($notifications as $notification){
            $data[] = [
                'title' => $notification['title_'.$lang],
                'content' => $notification['content_'.$lang],
                'date' => $notification['date']
            ];
        }
        
        return json_response($data);
    }

}
