<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;

class SalesSeeder extends Seeder
{
    public function run()
    {
        Sale::create(['item' => 'Item 1', 'revenue' => 100.00]);
        Sale::create(['item' => 'Item 2', 'revenue' => 150.00]);
        Sale::create(['item' => 'Item 3', 'revenue' => 200.00]);
    }
}
