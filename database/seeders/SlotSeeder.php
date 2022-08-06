<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slot;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slot = [
            'name' => 'Common',
            "capasity" => 40
        ];

        Slot::create($slot);
    }
}
