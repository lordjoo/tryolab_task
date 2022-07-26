<?php

namespace App\Services;

use App\Models\School;

class SchoolService
{

    public function getAll()
    {
        return School::all();
    }

}
