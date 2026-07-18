<?php

namespace App\Repositories\SQL;

use App\Models\Favourite;
use App\Repositories\Contracts\FavouriteContract;

class FavouriteRepository extends BaseRepository implements FavouriteContract
{
    /**
     * FavouriteRepository constructor.
     * @param Favourite $model
     */
    public function __construct(Favourite $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Favourite $model
     * @return int
     */
     public function relatedData(Favourite $model)
     {
        return 0;
     }
}
