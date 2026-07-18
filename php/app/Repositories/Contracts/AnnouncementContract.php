<?php

namespace App\Repositories\Contracts;
use App\Models\Announcement;

interface AnnouncementContract extends BaseContract
{
    public function relatedData(Announcement $model);
}

