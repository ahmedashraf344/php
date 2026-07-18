<?php

namespace App\Repositories\SQL;

use App\Models\Post;
use App\Repositories\Contracts\PostContract;

class PostRepository extends BaseRepository implements PostContract
{
    /**
     * PostRepository constructor.
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Post $model
     * @return int
     */
     public function relatedData(Post $model)
     {
        return 0;
     }
}
