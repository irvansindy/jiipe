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
        Schema::create('page_appointments', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('company_name');
            $table->string('country_origin');
            $table->string('reason');
            $table->string('reason_other');
            $table->string('classification');
            $table->string('classification_other');
            $table->string('land_plot');
            $table->string('timeline');
            $table->string('power');
            $table->string('industrial_water');
            $table->string('natural_gas');
            $table->string('throughput_via_seaport');
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_appointments');
    }
};
