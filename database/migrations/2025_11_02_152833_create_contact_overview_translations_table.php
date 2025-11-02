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
        Schema::create('contact_overview_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('contact_overviews_id');
            $table->string('locale');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->longText('description')->nullable();
            $table->string('office_name')->nullable();
            $table->string('phone')->nullable();
            $table->longText('address')->nullable();
            $table->longText('map_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_overview_translations');
    }
};
