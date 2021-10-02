<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit = Unit::first();

        $item = Item::firstOrNew(['name' => 'Baju Anak', 'unit_id' => $unit->id, 'stock' => 100, 'price' => 20000]);
        if (!$item->exists) {
            $item->save();
        }

        $item = Item::firstOrNew(['name' => 'Baju Anak 2', 'unit_id' => $unit->id, 'stock' => 10, 'price' => 22000]);
        if (!$item->exists) {
            $item->save();
        }

        $item = Item::firstOrNew(['name' => 'Baju Anak 4', 'unit_id' => $unit->id, 'stock' => 50, 'price' => 30000]);
        if (!$item->exists) {
            $item->save();
        }

        $item = Item::firstOrNew(['name' => 'Baju Anak 5', 'unit_id' => $unit->id, 'stock' => 40, 'price' => 40000]);
        if (!$item->exists) {
            $item->save();
        }

        $item = Item::firstOrNew(['name' => 'Baju Anak 6', 'unit_id' => $unit->id, 'stock' => 30, 'price' => 50000]);
        if (!$item->exists) {
            $item->save();
        }
    }
}
