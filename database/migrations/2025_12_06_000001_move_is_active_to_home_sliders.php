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
        // Add is_active to home_sliders
        Schema::table('home_sliders', function (Blueprint $table) {
            if (!Schema::hasColumn('home_sliders', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('file');
            }
        });

        // Drop is_active from translations table if exists
        Schema::table('home_slider_translations', function (Blueprint $table) {
            if (Schema::hasColumn('home_slider_translations', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove is_active from home_sliders
        Schema::table('home_sliders', function (Blueprint $table) {
            if (Schema::hasColumn('home_sliders', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });

        // Add is_active back to translations
        Schema::table('home_slider_translations', function (Blueprint $table) {
            if (!Schema::hasColumn('home_slider_translations', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('description');
            }
        });
    }
};
