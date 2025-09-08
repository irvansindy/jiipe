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
        Schema::create('about_us_vision_mision_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('about_us_vision_mision_id');
            $table->string('locale', 10);
            $table->string('title');
            $table->text('vision');
            $table->text('mision');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us_vision_mision_translations');
    }
};
