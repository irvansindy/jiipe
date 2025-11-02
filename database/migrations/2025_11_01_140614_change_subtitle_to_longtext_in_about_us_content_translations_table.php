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
        Schema::table('about_us_content_translations', function (Blueprint $table) {
            $table->longText('subtitle')->change();
        });

        Schema::table('about_us_contents', function (Blueprint $table) {
            $table->dropColumn('about_us_header_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_us_content_translations', function (Blueprint $table) {
            $table->text('subtitle')->change();
        });
        Schema::table('about_us_contents', function (Blueprint $table) {
            $table->unsignedBigInteger('about_us_header_id')->nullable()->after('id');
        });
    }
};
