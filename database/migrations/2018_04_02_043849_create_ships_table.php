<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('ships');
        
        Schema::create('ships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('country_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('zip')->nullable();
            $table->text('address')->nullable();
            $table->string('courier_id')->nullable();
            $table->string('courier_name')->nullable();
            $table->double('total_weight')->nullable();
            $table->double('cost')->nullable();
            $table->string('service_name')->nullable();
            $table->text('service_description')->nullable();
            $table->string('estimate_delivery')->nullable();
            $table->string('receipt_number')->nullable();
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
        Schema::dropIfExists('ships');
    }
}
