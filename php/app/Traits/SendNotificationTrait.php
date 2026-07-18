<?php

namespace App\Traits;

use App\Jobs\SendGuestNotificationJob;
use App\Jobs\SendMultiThirdPartiesNotificationJob;
use App\Jobs\SendMultiUserNotificationsJob;
use App\Jobs\SendSingleUserNotificationJob;
use App\Models\ThirdPartyMember;
use App\Models\User;
use App\Models\UserDeviceToken;
use App\Notifications\SendEmailNotification;
use App\Notifications\SendPushNotification;
use App\Notifications\SendSMSNotification;
use App\Services\Notification\NotificationData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

trait SendNotificationTrait
{
    /**
     * Send Notification for multi users in queue
     *
     * @param $targetUsers
     * @param string $notificationKey
     * @param string $notificationCase
     * @param array $concatenationAR
     * @param array $concatenationEN
     * @param string|null $redirectRoute
     * @param bool $fromUserEmail
     * @param bool $fromUserName
     * @param array $sendVia
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    private function sendMultiUserNotificationsInQueue($targetUsers, string $notificationKey, string $notificationCase,
                                                       array $concatenationAR = [], array $concatenationEN = [],
                                                       string $redirectRoute = null,
                                                       bool $fromUserEmail = false, bool $fromUserName = false,
                                                       array $sendVia = ['email', 'sms', 'push'])
    {
        $when = now()->addSeconds(10);
        return dispatch(new SendMultiUserNotificationsJob($targetUsers, $notificationKey, $notificationCase, $concatenationAR,
            $concatenationEN, $redirectRoute, $fromUserEmail, $fromUserName, $sendVia))->delay($when);
    }

    /**
     * Send Notification for multi users
     *
     * @param  $targetUsers
     * @param string $notificationKey
     * @param string $notificationCase
     * @param array $concatenationAR
     * @param array $concatenationEN
     * @param string $redirectRoute
     * @param bool $fromUserEmail
     * @param bool $fromUserName
     * @param array $sendVia
     */
    private function sendMultiUserNotifications($targetUsers, string $notificationKey, string $notificationCase,
                                                array $concatenationAR = [], array $concatenationEN = [],
                                                string $redirectRoute = null,
                                                bool $fromUserEmail = false, bool $fromUserName = false,
                                                array $sendVia = ['email', 'sms', 'push']): void
    {
        if (is_array($targetUsers)) {
            $targetUsers = User::whereIn('id', $targetUsers)->get();
        }

        foreach ($targetUsers as $targetUser) {
            // call function by queue
            $this->sendSingleUserNotificationInQueue($targetUser, $notificationKey, $notificationCase,
                $concatenationAR, $concatenationEN, $redirectRoute, $fromUserEmail, $fromUserName, $sendVia);

            // call with no queue
//            $notification=(new NotificationData($notificationKey,$notificationCase,$concatenationAR,$concatenationEN))
//                ->notification();
//            $this->sendSingleUserNotification($targetUser, $notification,$fromUserEmail, $fromUserName, $sendVia);
        }
    }


    /**
     * Send User Notification in Queue
     *
     * @param $targetUser
     * @param string $notificationKey
     * @param string $notificationCase
     * @param array $concatenationAR
     * @param array $concatenationEN
     * @param string $redirectRoute
     * @param bool $fromUserEmail
     * @param bool $fromUserName
     * @param array $sendVia
     * @param array $ccArray
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    private function sendSingleUserNotificationInQueue($targetUser, string $notificationKey, string $notificationCase,
                                                       array $concatenationAR = [], array $concatenationEN = [],
                                                       string $redirectRoute = null,
                                                       bool $fromUserEmail = false,
                                                       bool $fromUserName = false,
                                                       array $sendVia = ['email', 'sms', 'push'], array $ccArray = [])
    {
        $when = now()->addSeconds(10);
        $notification = (new NotificationData($notificationKey, $notificationCase, $concatenationAR, $concatenationEN, $redirectRoute))
            ->notification();
        return dispatch(new SendSingleUserNotificationJob($targetUser, $notification, $fromUserEmail, $fromUserName, $sendVia, $ccArray))
            ->delay($when);
    }

    /**
     * Send notification for only one user
     *
     * @param $targetUser
     * @param array $notification
     * @param bool $fromUserEmail
     * @param bool $fromUserName
     * @param array $sendVia
     * @param array $ccArray
     */
    private function sendSingleUserNotification($targetUser, array $notification,
                                                bool $fromUserEmail = false,
                                                bool $fromUserName = false,
                                                array $sendVia = ['email', 'sms', 'push'], $ccArray = []): void
    {
        if (is_numeric($targetUser)) $targetUser = User::find($targetUser);

        $notification = $this->handleNotificationArray($targetUser, $notification, $fromUserEmail, $fromUserName);

        $this->checkSendEmail($targetUser, $notification, $sendVia, $ccArray);
        $this->checkSendSMS($targetUser, $notification, $sendVia);
        $this->checkSendPushNotification($targetUser, $notification, $sendVia);
    }

    /**
     * Customize Notification array sent for user
     *
     * @param User $targetUser
     * @param array $notification
     * @param bool $fromUserEmail
     * @param bool $fromUserName
     * @return array
     */
    private function handleNotificationArray(User $targetUser, array $notification, bool $fromUserEmail = false,
                                             bool $fromUserName = false)
    {
        $notification['username'] = $targetUser['name'];
        $notification['email'] = $targetUser['email'];

        if (!in_array('from_email', $notification)) {
            $notification['from_email'] = 'no-reply@board.roqay.solutions';
            $notification['from_name'] = __('Board-G System');
        }

//        $senderData = $this->AttachSenderData($fromUserName, $fromUserEmail);
//        $notification = array_merge($notification, $senderData);

        $notification['salutation'] = null;

        return $notification;
    }


    /**
     * Add sender keys to be attached with Notification array
     * @param bool $fromUserEmail
     * @param bool $fromUserName
     * @return array
     */
    private function AttachSenderData(bool $fromUserEmail = false,
                                      bool $fromUserName = false)
    {

//        dump(Auth::check(), auth()->user());
        $auth = auth()->user();
//        dd( auth()->user(),$auth);
//        dump( auth()->user());
//        dump($auth);
//        dump($auth['name']);
//        dump($auth['email']);
        $role = ($auth->getRoleNames()->count() != 0) ? ' "' . __($auth->getRoleNames()->first()) . '"' : null;


        $auth = auth()->user();
//        dd($auth);
        $role = $auth['role_name'] != null ? ' "' . __($auth['role_name']) . '"' : null;
        $senderData = [
            'salutation' => $fromUserName != false ? $auth['name'] . $role : null,
        ];

        if ($fromUserEmail) $senderData['from_email'] = $auth['email'];
        if ($fromUserName) $senderData['from_name'] = $auth['name'];

        return $senderData;
    }


    /**
     * Check if send via email enabled and user has email stored in db
     *
     * @param User $targetUser
     * @param array $notification
     * @param array $sendVia
     * @param array $ccArray
     */
    private function checkSendEmail(User $targetUser, array $notification, array $sendVia, array $ccArray)
    {
        if (in_array('email', $sendVia) && ($targetUser['email'] != null)) {
            $when = now()->addSeconds(10);
            $targetUser->notify((new SendEmailNotification($notification, $ccArray))->delay($when));
        }
    }


    /**
     * Check if send via sms enabled and user has mobile stored in db
     *
     * @param User $targetUser
     * @param array $notification
     * @param array $sendVia
     */
    private function checkSendSMS(User $targetUser, array $notification, array $sendVia): void
    {
        if (in_array('sms', $sendVia) && ($targetUser['mobile'] != null)) {
            $targetUser->notify(new SendSMSNotification($notification));
        }
    }


    /**
     * Check if send via push notification enabled and user has devices stored in db
     *
     * @param User $targetUser
     * @param array $notification
     * @param array $sendVia
     */
    private function checkSendPushNotification(User $targetUser, array $notification, array $sendVia): void
    {
        $targetDeviceTokens = $targetUser->deviceTokens;
        if (in_array('push', $sendVia) && $targetDeviceTokens) {
            $this->sendMultiDevicePushNotifications($targetDeviceTokens, $notification);
        }
    }


    /**
     * Send push notification to multiple devices belongs to the target user
     *
     * @param Collection $devices
     * @param array $notification
     */
    private function sendMultiDevicePushNotifications(Collection $devices, array $notification): void
    {
        foreach ($devices as $device) {
            $this->sendSingleDevicePushNotification($device, $notification);
        }
    }


    /**
     * Send notification for single device of target user
     *
     * @param UserDeviceToken $device
     * @param array $notification
     */
    private function sendSingleDevicePushNotification(UserDeviceToken $device, array $notification): void
    {
        $device->notify(new SendPushNotification($notification));
    }

    //------------------------------- third parties notifications -----------------------------

    /**
     * Send Notification for multi third parties in queue
     *
     * @param $targetThirdParties
     * @param string $notificationKey
     * @param string $notificationCase
     * @param array $concatenationAR
     * @param array $concatenationEN
     * @param string|null $redirectRoute
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    private function sendMultiThirdPartiesNotificationsInQueue($targetThirdParties, string $notificationKey, string $notificationCase,
                                                               array $concatenationAR = [], array $concatenationEN = [],
                                                               string $redirectRoute = null)
    {
        $when = now()->addSeconds(10);
        return dispatch(new SendMultiThirdPartiesNotificationJob($targetThirdParties, $notificationKey, $notificationCase, $concatenationAR,
            $concatenationEN, $redirectRoute))->delay($when);
    }

    /**
     * Send Multi third parties notifications
     *
     * @param $targetThirdParties
     * @param string $notificationKey
     * @param string $notificationCase
     * @param array $concatenationAR
     * @param array $concatenationEN
     * @param string|null $redirectRoute
     */
    private function sendMultiThirdPartiesNotifications($targetThirdParties, string $notificationKey, string $notificationCase,
                                                        array $concatenationAR = [], array $concatenationEN = [],
                                                        string $redirectRoute = null): void
    {
        if (is_array($targetThirdParties)) {
            $targetThirdParties = ThirdPartyMember::whereIn('id', $targetThirdParties)->get();
        }

        foreach ($targetThirdParties as $targetThirdParty) {
            // call function by queue
            $this->sendSingleThirdPartyNotificationInQueue($targetThirdParty, $notificationKey, $notificationCase,
                $concatenationAR, $concatenationEN, $redirectRoute);
        }
    }

    /**
     * Send third party Notification in Queue
     *
     * @param $targetThirdParty
     * @param string $notificationKey
     * @param string $notificationCase
     * @param array $concatenationAR
     * @param array $concatenationEN
     * @param string $redirectRoute
     * @param bool $fromUserEmail
     * @param bool $fromUserName
     * @param array $sendVia
     * @param array $ccArray
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    private function sendSingleThirdPartyNotificationInQueue($targetThirdParty, string $notificationKey, string $notificationCase,
                                                             array $concatenationAR = [], array $concatenationEN = [],
                                                             string $redirectRoute = null, array $ccArray = [])
    {
        $when = now()->addSeconds(10);
        $notification = (new NotificationData($notificationKey, $notificationCase, $concatenationAR, $concatenationEN, $redirectRoute))
            ->notification();
        return dispatch(new SendGuestNotificationJob($notification, $targetThirdParty, $ccArray))
            ->delay($when);
    }
}
