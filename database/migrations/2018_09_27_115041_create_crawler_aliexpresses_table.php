<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrawlerAliexpressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawler_aliexpresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_block_ini')->nullable()->default('.list-item-180');
            $table->string('product_name_element')->nullable()->default('h3 span');
            $table->string('product_url_element')->nullable()->default('h3 a.history-item');
            $table->string('product_image_element')->nullable()->default('img.picCore');
            $table->string('product_price_element')->nullable()->default('span.value');
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
        Schema::dropIfExists('crawler_aliexpresses');
    }
}
