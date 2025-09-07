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
        Schema::create('basic_information_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('basic_information_id');
            $table->string('locale', 10);
            $table->string('title_basic_information');
            $table->string('label_full_name');
            $table->string('placeholder_full_name_1');
            $table->string('placeholder_full_name_2');
            $table->string('label_phone_number');
            $table->string('placeholder_phone_number');
            $table->string('label_email');
            $table->string('placeholder_email');
            $table->string('label_company_name');
            $table->string('placeholder_company_name');
            $table->string('label_company_origin_country');
            $table->string('placeholder_company_origin_country');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basic_information_translations');
    }
};
