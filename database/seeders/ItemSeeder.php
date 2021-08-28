<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name' => 'Potato',
                'quantity' => 20,
                'warning_quantity' => 10,
                'unit' => 'peices'
            ],
            [
                'name' => 'F2',
                'quantity' => 20,
                'warning_quantity' => 10,
                'unit' => 'peices'
            ],
            [
                'name' => 'Forks',
                'quantity' => 20,
                'warning_quantity' => 10,
                'unit' => 'peices'
            ],
            [
                'name' => 'Shashlik Sticks',
                'quantity' => 20,
                'warning_quantity' => 10,
                'unit' => 'peices'
            ],
            [
                'name' => 'Ketchup',
                'quantity' => 20,
                'warning_quantity' => 10,
                'unit' => 'peices'
            ]

            ];

        foreach ($items as $i) {
            DB::table('items')->insert($i);
        }

    }
}
