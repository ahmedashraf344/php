<?php

use App\Services\Notification\NotificationData;

if (!function_exists('translate_notification')) {
    function translate_notification($data)
    {
        if (array_key_exists('key', $data)) {
            $key = $data['key'];
            $case = $data['case'];
            $concatenationAr = json_decode($data['concatenation_ar']) ?? [];
            $concatenationEn = json_decode($data['concatenation_en']) ?? [];

            $notificationData = new NotificationData($key, $case, $concatenationAr, $concatenationEn);
            return $notificationData->messageKeys()[$key][$case][app()->getLocale()];
        } else {
            return ['subject' => null, 'data' => $data['data']];
        }
    }
}
