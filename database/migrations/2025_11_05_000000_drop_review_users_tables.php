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
        Schema::dropIfExists('review_user_translations');
        Schema::dropIfExists('review_users');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('review_users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('review_user_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
};