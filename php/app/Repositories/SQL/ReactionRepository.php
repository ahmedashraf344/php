<?php

namespace App\Repositories\SQL;

use App\Models\Reaction;
use App\Repositories\Contracts\ReactionContract;

class ReactionRepository extends BaseRepository implements ReactionContract
{
    /**
     * ReactionRepository constructor.
     * @param Reaction $model
     */
    public function __construct(Reaction $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param Reaction $model
     * @return int
     */
     public function relatedData(Reaction $model)
     {
        return 0;
     }
}
