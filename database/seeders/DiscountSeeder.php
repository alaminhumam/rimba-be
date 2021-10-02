<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discount = Discount::firstOrNew(['amount' => 20000, 'type' => 'fix', 'is_active' => true]);
        if (!$discount->exists) {
            $discount->save();
        }
    }
}
