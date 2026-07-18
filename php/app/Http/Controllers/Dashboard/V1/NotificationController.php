<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Http\Controllers\BaseResourceController;
use App\Http\Requests\Dashboard\V1\NotificationRequest;
use App\Models\Notification;
use App\Repositories\Contracts\NotificationContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Messaging\CloudMessage;

class NotificationController extends BaseResourceController
{


    /**
     * PostController constructor.
     * @param NotificationContract $repository
     */
    public function __construct(NotificationContract $repository)
    {
        parent::__construct($repository, 'dashboard.v1.notification', 'dashboard.v1.notification', 'notification');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notificationList = Notification::orderByDesc('id')->get();

        if (request()->ajax()) {
            return $this->loadPageAjax(['notificationList' => $notificationList]);
        }

        return $this->indexBlade(['notificationList' => $notificationList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return $this->createBlade();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NotificationRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NotificationRequest $request)
    {
        $requestWithUser = $request->all();
        $requestWithUser['user_id'] = Auth::id();
        $notificationModel = Notification::create($requestWithUser);
        $topicAr = env('TOPIC_AR' , 'all_ar');
        $topicEn = env('TOPIC_EN', 'all_en');
        $this->SendFirebaseNotification($notificationModel, $topicEn, 'en');
        $this->SendFirebaseNotification($notificationModel, $topicAr, 'ar');
        // for testing topic all 
        // $this->SendFirebaseNotification($notificationModel, 'all', 'en');
        // for testing topic all


        alert()->success(__('Notification added successfully'));
        return $this->redirectBack();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);

        if ($notification['related_data'] == 0) {

            $notification->delete();
            return ajax_response(null, __('Notification deleted successfully'));
        } else {
            return ajax_response(null, __('Can not delete this Notification'), 400);
        }
    }


    protected function SendFirebaseNotification($notificationModel , $topic , $lang = 'en')
    {
        // $imageUrl = url(env('NAWAYA_ICON' , 'images/nawaya.png'));
        if($lang == 'en'){

            $notification =  [
                "body" => $notificationModel['content_en'],
                "title" => $notificationModel['title_en'],
                // 'image' => $imageUrl,
                "sound" => "default"
            ];
            
                
        }else{
            $notification =  [
                "body" => $notificationModel['content_ar'],
                "title" => $notificationModel['title_ar'],
                // 'image' => $imageUrl,
                "sound" => "default"
            ];

        }

        $apnsExpiration = time() + 86400;
        $message = CloudMessage::fromArray([
            'topic' => $topic,
            'notification' => $notification,
            // "data" => [
            //     "urlImageString" => $imageUrl
            // ],
            "android" => [
                "ttl" => "86400s"
            ],
            "apns" => [
                "headers" => [
                    "apns-expiration" => "$apnsExpiration"
                ],
                "payload" => [

                    "aps" => [
                        // "alert" => "alert",
                        "sound" => "default",
                        "badge" => 1,
                        "category" => "CustomSamplePush",
                        "mutable-content" => 1,
                    ],
                    // "data" => [

                    //     "urlImageString" => $imageUrl
                    // ],
                    // "urlImageString" => $imageUrl,

                ],

            ],
        ]);
        $messaging = app('firebase.messaging');
        $messaging->send($message);
        // if ($report->hasFailures()) {
        //     foreach ($report->failures()->getItems() as $failure) {
        //         Log::error('error at firebase send message in helper.php , message = '. $failure->error()->getMessage());
        //     }
        // }
        return true;
    }

}
