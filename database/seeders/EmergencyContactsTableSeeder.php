<?php

namespace Database\Seeders;

use App\Models\EmergencyContact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmergencyContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $e = new EmergencyContact;
        $e->type = 'Max';
        $e->animal_id = 1;
        $e->save();
    }
}
