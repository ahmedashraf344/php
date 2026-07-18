<?php

namespace App\Repositories\SQL;

use App\Models\Review;
use App\Repositories\Contracts\ReviewContract;

class ReviewRepository extends BaseRepository implements ReviewContract
{
    /**
     * ReviewRepository constructor.
     * @param Review $model
     */
    public function __construct(Review $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Review $model
     * @return int
     */
     public function relatedData(Review $model)
     {
        return 0;
     }
}
