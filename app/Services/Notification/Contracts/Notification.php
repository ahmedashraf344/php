<?php

namespace App\Services\Notification\Contracts;

interface Notification
{
    /**
     * Send Push Notification
     *
     * @param array $data
     * @param $message
     * @return bool
     */
    public function send(array $data,$message): bool;
}
