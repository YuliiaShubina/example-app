<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use App\Models\Animal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AnimalTableSeeder extends Seeder
{
    public function run()
    {
      $a = new Animal;
      $a->type = "Leo";
      $a->covering = "covering";
      $a->legs =351.6;
      $a->save();

      //$a = DB::table('animals')->where('type', 'lizard')->first();

      //echo 'Animal: ' . $a;
      Animal::factory()->count(5)->create();
    }
}