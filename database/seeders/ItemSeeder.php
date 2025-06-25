<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'Lampu',
                'qty' => 5
            ],
            [
                'name' => 'Solder',
                'qty' => 5
            ],
            [
                'name' => 'Monitor',
                'qty' => 14
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
