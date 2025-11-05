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
        Schema::table('tenants', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('id');
            $table->string('logo')->nullable()->after('is_active');
        });
        Schema::table('tenant_translations', function (Blueprint $table) {
            $table->unsignedInteger('tenant_id')->nullable()->after('id');
            $table->string('locale')->nullable()->after('tenant_id');
            $table->string('name')->after('locale');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'logo']);
        });
        Schema::table('tenant_translations', function (Blueprint $table) {
            $table->dropColumn(['tenant_id', 'locale', 'name']);
        });
    }
};
