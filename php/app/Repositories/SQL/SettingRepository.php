<?php

namespace App\Repositories\SQL;

use App\Models\Setting;
use App\Repositories\Contracts\SettingContract;

class SettingRepository extends BaseRepository implements SettingContract
{
    /**
     * SettingRepository constructor.
     * @param Setting $model
     */
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Setting $model
     * @return int
     */
     public function relatedData(Setting $model)
     {
        return 0;
     }
}
