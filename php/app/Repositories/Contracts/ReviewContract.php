<?php

namespace App\Repositories\Contracts;
use App\Models\Review;

interface ReviewContract extends BaseContract
{
    public function relatedData(Review $model);
}

