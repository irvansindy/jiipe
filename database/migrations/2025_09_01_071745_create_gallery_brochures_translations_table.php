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
        Schema::create('gallery_brochures_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('gallery_brochure_id');
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('sub_title_2')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_brochures_translations');
    }
};
