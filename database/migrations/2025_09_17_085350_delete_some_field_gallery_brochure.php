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
        Schema::table('gallery_brochures', function (Blueprint $table) {
            $table->dropColumn([
                'price',
                'orientation',
                'image_2',
                'image_3',
                'image_4',
                'image_5',
                'url_video',
            ]);
        });
        // Tambah kolom file pada table gallery_brochures_translations
        Schema::table('gallery_brochures_translations', function (Blueprint $table) {
            $table->string('file')->nullable()->after('content');
            $table->dropColumn([
                'sub_title_2',
                'content'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan kolom yang dihapus (type disesuaikan dengan sebelumnya)
        Schema::table('gallery_brochures', function (Blueprint $table) {
            $table->decimal('price', 15, 2)->nullable();
            $table->string('orientation')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_4')->nullable();
            $table->string('image_5')->nullable();
            $table->string('url_video')->nullable();
        });

        // Hapus kolom file
        Schema::table('gallery_brochures_translations', function (Blueprint $table) {
            $table->dropColumn('file');
            $table->string('sub_title_2')->nullable();
            $table->text('content')->nullable();
        });
    }
};
