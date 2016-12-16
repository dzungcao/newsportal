<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('picture')->nullable();
            $table->text('content');
            $table->boolean('published');
            $table->timestamp('publish_date');
            $table->unsignedInteger('author_id');
            $table->foreign('author_id')
              ->references('id')->on('users');
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
        Schema::table('news_items', function (Blueprint $table) {
            //
        });
    }
}
