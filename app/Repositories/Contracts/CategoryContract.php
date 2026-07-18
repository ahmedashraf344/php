<?php

namespace App\Repositories\Contracts;
use App\Models\Category;

interface CategoryContract extends BaseContract
{
    public function relatedData(Category $model);
}

