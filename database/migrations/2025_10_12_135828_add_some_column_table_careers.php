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
        Schema::table('careers', function (Blueprint $table) {
            $table->unsignedInteger('location_id')->nullable()->after('factory_id');
            $table->unsignedInteger('education_id')->nullable()->after('location_id');
            $table->unsignedInteger('job_level_id')->nullable()->after('education_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('careers', function (Blueprint $table) {
            $table->dropColumn(['location_id', 'education_id', 'job_level_id']);
        });
    }
};
