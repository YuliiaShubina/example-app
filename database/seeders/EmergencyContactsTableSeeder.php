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
    public function run(): void
    {
        $e = new EmergencyContact;
        $e->name = 'Max';
        $e->animal_id = 1;
        $e->save();
    }
}
