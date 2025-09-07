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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_no');
            $table->string('invoice_prefix');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('customer_group_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('payment_first_name')->nullable();
            $table->string('payment_last_name')->nullable();
            $table->string('payment_company')->nullable();
            $table->string('payment_address_1')->nullable();
            $table->string('payment_address_2')->nullable();
            $table->string('payment_city')->nullable();
            $table->string('payment_postcode')->nullable();
            $table->string('payment_zone')->nullable();
            $table->string('payment_country')->nullable();
            $table->string('shipping_first_name')->nullable();
            $table->string('shipping_last_name')->nullable();
            $table->string('shipping_company')->nullable();
            $table->string('shipping_address_1')->nullable();
            $table->string('shipping_address_2')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_postcode')->nullable();
            $table->string('shipping_zone')->nullable();
            $table->string('shipping_country')->nullable();
            $table->text('comment')->nullable();
            $table->decimal('tax', 15, 4);
            $table->decimal('total', 15, 4);
            $table->unsignedInteger('order_status_id');
            $table->unsignedInteger('affiliate_id');
            $table->decimal('commission', 15, 4);
            $table->string('locale');
            $table->unsignedInteger('currency_id');
            $table->string('currency_code');
            $table->decimal('currency_value', 15, 4);
            $table->dateTime('date_add');
            $table->dateTime('date_modified');
            $table->string('delivery_from')->nullable();
            $table->string('delivery_to')->nullable();
            $table->string('delivery_package')->nullable();
            $table->double('delivery_price')->nullable();
            $table->unsignedInteger('payment_method_id')->nullable();
            $table->integer('delivery_weight')->nullable();
            $table->boolean('is_read')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
