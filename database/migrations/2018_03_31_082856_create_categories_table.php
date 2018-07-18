<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('categories');
        
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en');
            $table->string('name_id')->nullable();
            $table->string('slug')->unique();
            $table->string('feature_image')->nullable();
            $table->string('type')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_id')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
