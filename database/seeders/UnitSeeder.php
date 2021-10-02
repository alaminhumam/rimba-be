<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit = Unit::firstOrNew(['name' => 'kg']);
        if (!$unit->exists) {
            $unit->save();
        }

        $unit = Unit::firstOrNew(['name' => 'pcs']);
        if (!$unit->exists) {
            $unit->save();
        }
    }
}
