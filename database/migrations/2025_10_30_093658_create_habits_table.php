<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('habits', function (Blueprint $table) {
            $table->id();               
            $table->string('goal')->nullable();      
            $table->string('frequency');           
            $table->boolean('archived')->default(false);
            $table->timestamps();
            
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void {
        Schema::dropIfExists('habits');
    }
};
