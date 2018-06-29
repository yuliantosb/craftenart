<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('articles');
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('feature_image')->nullable();
            $table->string('type');
            $table->integer('widget_id')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
