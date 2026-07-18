<?php

namespace App\Repositories\Contracts;
use App\Models\Post;

interface PostContract extends BaseContract
{
    public function relatedData(Post $model);
}

