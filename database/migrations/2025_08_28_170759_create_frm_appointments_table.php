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
        Schema::create('frm_appointments', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->integer('status')->default(1);
            $table->integer('sort');
            $table->enum('flag', ['reason', 'industry', 'land plot', 'timeline', 'power', 'gas', 'water', 'throughput'])->default('industry');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frm_appointments');
    }
};
