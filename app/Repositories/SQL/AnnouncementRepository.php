<?php

namespace App\Repositories\SQL;

use App\Models\Announcement;
use App\Repositories\Contracts\AnnouncementContract;

class AnnouncementRepository extends BaseRepository implements AnnouncementContract
{
    /**
     * AnnouncementRepository constructor.
     * @param Announcement $model
     */
    public function __construct(Announcement $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Announcement $model
     * @return int
     */
     public function relatedData(Announcement $model)
     {
        return 0;
     }
}
