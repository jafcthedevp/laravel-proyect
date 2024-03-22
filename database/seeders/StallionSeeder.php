<?php

namespace Database\Seeders;

use App\Models\Stallion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StallionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayData = [
            'Osmo',
            'Nero',
            'Fido',
        ];

        foreach ($arrayData as $key => $value) {
            $data = new Stallion();
            $data->name = $value;
            $data->save();
        }
    }
}
