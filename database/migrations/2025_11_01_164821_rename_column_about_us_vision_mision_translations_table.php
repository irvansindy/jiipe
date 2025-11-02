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
        Schema::table('about_us_vision_mision_translations', function (Blueprint $table) {
            $table->renameColumn('mision', 'mission');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_us_vision_mision_translations', function (Blueprint $table) {
            $table->renameColumn('mission', 'mision');
        });
    }
};
