<?php

namespace App\Repositories\Contracts;
use App\Models\Favourite;

interface FavouriteContract extends BaseContract
{
    public function relatedData(Favourite $model);
}

