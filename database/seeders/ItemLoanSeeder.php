<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemLoan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemLoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $loans = [
            [
                'item_id' => Item::first()->id,
                'user_id' => User::where('username', '!=', 'superadmin')->first()->id,
                'qty' => 1,
                'loan_date' => date('Y-m-d')
            ],
        ];

        foreach ($loans as $loan) {
            ItemLoan::create($loan);
        }
    }
}
