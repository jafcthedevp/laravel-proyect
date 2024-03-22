<?php

namespace App\Repositories;

use App\Models\TrainingType;

class TrainingTypeRepository   extends BaseRepository
{
    public function __construct(TrainingType $modelo)
    {
        parent::__construct($modelo);
    }
}
