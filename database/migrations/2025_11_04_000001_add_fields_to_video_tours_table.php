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
        Schema::table('video_tours', function (Blueprint $table) {
            $table->longText('embed_code')->nullable()->after('id');
            $table->string('thumbnail')->nullable()->after('embed_code');
            $table->integer('position')->nullable()->after('thumbnail');
            $table->boolean('is_active')->default(true)->after('position');
        });
        Schema::table('video_tour_translations', function (Blueprint $table) {
            $table->unsignedInteger('video_tour_id')->nullable()->after('id');
            $table->string('locale')->nullable()->after('video_tour_id');
            $table->string('title')->after('locale');
            $table->longText('description')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('video_tours', function (Blueprint $table) {
            $table->dropColumn(['embed_code','thumbnail','position','is_active']);
        });
        Schema::table('video_tour_translations', function (Blueprint $table) {
            $table->dropColumn(['video_tour_id', 'locale', 'title', 'description']);
        });
    }
};
