<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();  // id dengan auto-increment
            $table->string('name', 50)->nullable();  // Kolom name varchar(50) yang boleh null
            $table->string('address', 50)->nullable();  // Kolom address varchar(50) yang boleh null
            $table->double('lat')->nullable();  // Kolom latitude double yang boleh null
            $table->double('lng')->nullable();  // Kolom longitude double yang boleh null
            $table->timestamps(); // 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
