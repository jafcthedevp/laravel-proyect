<?php

namespace Database\Seeders;

use App\Models\Madrilla;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MadrillaSeeder extends Seeder
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
            $data = new Madrilla();
            $data->name = $value;
            $data->save();
        }
    }
}
