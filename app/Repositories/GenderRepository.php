<?php

namespace App\Repositories;

use App\Models\Gender;

class GenderRepository extends BaseRepository
{
    public function __construct(Gender $modelo)
    {
        parent::__construct($modelo);
    }
}
