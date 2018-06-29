<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('customers');
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('identity_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('country_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('sex')->nullable();
            $table->string('zip')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('address')->nullable();
            $table->string('picture')->nullable();
            $table->text('bio')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
