<?php

namespace App\Repositories\Contracts;
use App\Models\FileCenter;

interface FileCenterContract extends BaseContract
{
    public function relatedData(FileCenter $model);
}

