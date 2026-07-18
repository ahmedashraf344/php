<?php

namespace App\Repositories\SQL;

use App\Models\User;
use App\Repositories\Contracts\UserContract;

class UserRepository extends BaseRepository implements UserContract
{
    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param User $model
     * @return int
     */
     public function relatedData(User $model)
     {
        return 0;
     }
}
