<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayData = [
            'Pequeño',
            'Mediano',
            'Grande',
        ];

        foreach ($arrayData as $key => $value) {
            $data = new Size();
            $data->name = $value;
            $data->save();
        }
    }
}
