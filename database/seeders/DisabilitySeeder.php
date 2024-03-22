<?php

namespace Database\Seeders;

use App\Models\Disability;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayData = [
            'No',
            'Visual',
            'Física',
            'Otro',
        ];

        foreach ($arrayData as $key => $value) {
            $data = new Disability();
            $data->name = $value;
            $data->save();
        }
    }
}
