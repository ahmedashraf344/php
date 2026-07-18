<?php

namespace App\Repositories\Contracts;
use App\Models\Shop;

interface ShopContract extends BaseContract
{
    public function relatedData(Shop $model);
}

