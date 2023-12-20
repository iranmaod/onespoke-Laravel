<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrawlerEbaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawler_ebays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_block_ini')->nullable()->default('li.s-item');
            $table->string('product_name_element')->nullable()->default('h3.s-item__title');
            $table->string('product_url_element')->nullable()->default('a.s-item__link');
            $table->string('product_image_element')->nullable()->default('img.s-item__image-img');
            $table->string('product_price_element')->nullable()->default('span.s-item__price');
            $table->string('affiliate_id')->default('');
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
        Schema::dropIfExists('crawler_ebays');
    }
}
