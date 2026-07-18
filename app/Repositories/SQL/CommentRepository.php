<?php

namespace App\Repositories\SQL;

use App\Models\Comment;
use App\Repositories\Contracts\CommentContract;

class CommentRepository extends BaseRepository implements CommentContract
{
    /**
     * CommentRepository constructor.
     * @param Comment $model
     */
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Comment $model
     * @return int
     */
     public function relatedData(Comment $model)
     {
        return 0;
     }
}
