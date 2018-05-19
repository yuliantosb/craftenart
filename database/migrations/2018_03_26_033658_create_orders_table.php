<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('orders');

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number')->unique();
            $table->double('subtotal', 20, 2);
            $table->double('tax', 20, 2);
            $table->double('discount', 20, 2);
            $table->double('shipping_fee', 20, 2);
            $table->double('total', 20, 2);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone', 13)->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('fraud_status')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
