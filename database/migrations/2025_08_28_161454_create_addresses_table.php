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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id');
            $table->string('name', 255)->nullable();
            $table->string('address_1', 255);
            $table->string('address_2', 255)->nullable();
            $table->string('telp', 100);
            $table->string('fax', 100);
            $table->string('email');
            $table->string('image');
            $table->string('city');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
