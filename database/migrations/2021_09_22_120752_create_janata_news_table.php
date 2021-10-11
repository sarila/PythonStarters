<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJanataNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('janata_news', function (Blueprint $table) {
            $table->id();
            $table->string('news_title');
            $table->string('slug')->unique();
            $table->integer('category_id')->unsigned();
            $table->integer('news_type_id')->unsigned()->nullable();
            $table->longText('news_content');
            $table->string('thumbnail_image')->nullable();
            $table->string('video')->nullable();
            $table->integer('view_count')->default(0);
            $table->integer('user_id')->unsigned()->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('approved_id')->nullable();
            $table->tinyInteger('public')->default(1);

            $table->string('guest_name')->nullable();
            $table->string('guest_email')->nullable();
            $table->string('guest_phone')->nullable();
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
        Schema::dropIfExists('janata_news');
    }
}
