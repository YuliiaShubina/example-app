<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    // Run migrations
    public function up(){
        Schema::create ('animals', function (Blueprint $table){
            $table->id();
            $table->string('type');
            $table->string('covering');
            $table->double('legs');
            $table->timestamps();
        });

    }

    // Reverse the migrations
    public function down()
    {
        Schema::dropIfExists ('animals');
    }
}