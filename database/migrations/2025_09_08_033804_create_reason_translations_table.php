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
        Schema::create('reason_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('reason_id');
            $table->string('locale', 10);
            $table->string('label_reason');
            $table->string('label_industry');
            $table->string('label_land_plot');
            $table->string('label_timeline_construction');
            $table->string('label_energy_utility');
            $table->string('placeholder_industry');
            $table->string('placeholder_land_plot');
            $table->string('placeholder_timeline_construction');
            $table->string('placeholder_total_power');
            $table->string('placeholder_total_water');
            $table->string('placeholder_total_gas');
            $table->string('placeholder_throughput_seaport');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reason_translations');
    }
};
