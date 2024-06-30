<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taxis = [
            ['plate' => 'AB-C1-23', 'kmStart' => 1000, 'kmActual' => 1000, 'status' => '1'],
            ['plate' => 'DE-F4-56', 'kmStart' => 2000, 'kmActual' => 2000, 'status' => '1'],
            ['plate' => 'GH-I7-89', 'kmStart' => 3000, 'kmActual' => 3000, 'status' => '1'],
        ];

        foreach ($taxis as $taxi) {
            \App\Models\Taxi::create($taxi);
        }
    }
}
