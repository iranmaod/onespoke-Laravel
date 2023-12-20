<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('currency_id')->nullable()->default(147);
            $table->string('site_name')->nullable()->default('');
            $table->string('site_email')->nullable()->default('');
            $table->string('site_number')->nullable()->default('');
            $table->string('site_address')->nullable()->default('');
            $table->string('site_about')->nullable()->default('');

            $table->string('keywords')->nullable()->default('keywords,keyword');
            $table->string('meta_name')->nullable()->default('Dropship get the best deal');
            $table->string('search_element')->nullable()->default('price');
            $table->string('search_order',10)->nullable()->default('desc');

            $table->string('disqus')->nullable()->default('https://comparison-1.disqus.com/embed.js');
            $table->string('social_facebook')->nullable()->default('https://facebook.com');
            $table->string('social_twitter')->nullable()->default('https://twitter.com');
            $table->string('social_instagram')->nullable()->default('https://instagram.com');
            $table->string('logo')->nullable()->default('');
            $table->integer('csv_import_limit')->nullable()->default(1000);
            $table->boolean('live_production')->nullable()->default(1);
            $table->integer('default_quantity')->nullable()->default(2);
            $table->integer('home_rand_pro')->nullable()->default(8);
            $table->integer('home_posts')->nullable()->default(4);
            $table->integer('home_users')->nullable()->default(6);
            $table->integer('compare_percentage')->nullable()->default(50);
            $table->integer('compared_products')->nullable()->default(10);
            $table->boolean('enable_admin')->nullable()->default(0);
            $table->integer('tax')->nullable()->default(21);
            $table->integer('price_percent_gain')->nullable()->default(10);
            $table->string('cart_button')->nullable()->default('Add to Cart');
            $table->text('delivery_terms')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
