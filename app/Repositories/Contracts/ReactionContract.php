<?php

namespace App\Repositories\Contracts;
use App\Models\Reaction;

interface ReactionContract extends BaseContract
{
    public function relatedData(Reaction $model);
}

