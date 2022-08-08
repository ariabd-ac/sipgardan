<?php

namespace Database\Seeders;

use App\Models\Infraction;
use Illuminate\Database\Seeder;

class InfractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Infraction::create([
            'nama' => 'tester',
            'alamat' => 'tester',
            'phone' => 'tester',
            'di' => 'tester',
            'kordinat' => 'tester',
            'jp' => 'tester',
            'foto' => 'tester',
            'status' => 'tester'
        ]);
    }
}
