<?php

namespace App\Repositories\SQL;

use App\Models\ContactUs;
use App\Repositories\Contracts\ContactUsContract;

class ContactUsRepository extends BaseRepository implements ContactUsContract
{
    /**
     * ContactUsRepository constructor.
     * @param ContactUs $model
     */
    public function __construct(ContactUs $model)
    {
        parent::__construct($model);
    }

    /**
     * Check if model has relations with any other tables
     * @param ContactUs $model
     * @return int
     */
     public function relatedData(ContactUs $model)
     {
        return 0;
     }
}
