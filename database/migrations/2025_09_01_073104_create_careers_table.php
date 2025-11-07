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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->unsignedInteger('factory_id')->nullable();
            $table->unsignedInteger('location_id')->nullable();
            $table->unsignedInteger('education_id')->nullable();
            $table->unsignedInteger('job_level_id')->nullable();
            $table->string('min_experience')->nullable();
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
