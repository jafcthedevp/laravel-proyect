<?php

namespace App\Repositories;

use App\Models\Size;

class SizeRepository extends BaseRepository
{
    public function __construct(Size $modelo)
    {
        parent::__construct($modelo);
    }
}
