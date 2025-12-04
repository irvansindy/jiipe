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
        Schema::table('page_appointments', function (Blueprint $table) {
            // Modify columns to allow NULL and set default
            $table->string('reason_other')->nullable()->default(null)->change();
            $table->string('classification_other')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page_appointments', function (Blueprint $table) {
            $table->string('reason_other')->nullable(false)->change();
            $table->string('classification_other')->nullable(false)->change();
        });
    }
};
