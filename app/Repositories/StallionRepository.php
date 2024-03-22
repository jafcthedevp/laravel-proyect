<?php

namespace App\Repositories;

use App\Models\Stallion;

class StallionRepository  extends BaseRepository
{
    public function __construct(Stallion $modelo)
    {
        parent::__construct($modelo);
    }
}
