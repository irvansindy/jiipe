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
        Schema::create('sub_resource_energy_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sub_resource_energy_id');
            $table->string('locale', 10);
            $table->string('name')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->text('specifications')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_resource_energy_translations');
    }
};
