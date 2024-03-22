<?php

namespace App\Repositories;

use App\Models\Disability;

class DisabilityRepository extends BaseRepository
{
    public function __construct(Disability $modelo)
    {
        parent::__construct($modelo);
    }
}
