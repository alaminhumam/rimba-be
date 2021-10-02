<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Discount;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discount = Discount::first();

        $customer = Customer::firstOrNew(['name' => 'cust 1', 'address' => 'jalan panjang', 'contact' => '0877771211', 'email' => 'cust1@mailinator.com']);
        if (!$customer->exists) {
            $customer->save();
        }

        $discounts = [
            'discount_id' => $discount->id
        ];

        $customer->discounts()->attach($discounts);
    }
}
