<?php

namespace App\Repositories\SQL;

use App\Models\FileCenter;
use App\Repositories\Contracts\FileCenterContract;

class FileCenterRepository extends BaseRepository implements FileCenterContract
{
    /**
     * FileCenterRepository constructor.
     * @param FileCenter $model
     */
    public function __construct(FileCenter $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param FileCenter $model
     * @return int
     */
     public function relatedData(FileCenter $model)
     {
        return 0;
     }
}
