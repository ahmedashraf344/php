<?php

namespace App\Repositories\Contracts;
use App\Models\ContactUs;

interface ContactUsContract extends BaseContract
{
    public function relatedData(ContactUs $model);
}

