<?php

namespace App\Repositories\Contracts;
use App\Models\Comment;

interface CommentContract extends BaseContract
{
    public function relatedData(Comment $model);
}

