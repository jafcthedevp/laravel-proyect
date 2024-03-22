<?php

namespace App\Repositories;

use App\Models\Madrilla;

class MadrillaRepository extends BaseRepository
{
    public function __construct(Madrilla $modelo)
    {
        parent::__construct($modelo);
    }
}
