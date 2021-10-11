<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('news_title');
            $table->string('slug');
            $table->integer('category_id')->unsigned();
            $table->integer('news_type_id')->unsigned()->nullable();
            $table->longText('news_content');
            $table->string('thumbnail_image')->nullable();
            $table->string('video')->nullable();
            $table->integer('view_count')->default(0);
            $table->integer('author_id')->unsigned();
            $table->integer('approved_by')->nullable();
            $table->string('seo_title')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('seo_subtitle')->nullable();
            $table->string('description')->nullable();
            $table->string('keywords')->nullable();
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
        Schema::dropIfExists('news');
    }
}
