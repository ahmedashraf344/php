<?php

namespace App\Repositories\SQL;

use App\Models\Shop;
use App\Repositories\Contracts\ShopContract;

class ShopRepository extends BaseRepository implements ShopContract
{
    /**
     * ShopRepository constructor.
     * @param Shop $model
     */
    public function __construct(Shop $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Shop $model
     * @return int
     */
     public function relatedData(Shop $model)
     {
        return 0;
     }
}
