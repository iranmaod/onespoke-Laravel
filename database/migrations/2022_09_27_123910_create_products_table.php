<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();;
            // $table->bigInteger('price');
            $table->text('description')->nullable();
            $table->text('slug')->nullable();;
            $table->text('image')->nullable();;
            $table->text('image_ex1')->nullable();
            $table->text('image_ex2')->nullable();
            $table->text('image_ex3')->nullable();
            $table->text('image_ex4')->nullable();
            $table->text('image_ex5')->nullable();
            $table->text('original_url')->nullable();
            $table->mediumInteger('supplier_id');
            $table->bigInteger('views_count')->default(0);
            $table->bigInteger('cart_count')->default(0);
            $table->integer('parent_id')->default(0);
            $table->integer('variant_id')->default(0);
            $table->text('variant_name')->nullable();
            $table->text('unique_value')->nullable();//for instant access of variant page
            $table->integer('category_id')->default(1);
            $table->integer('rating_id')->nullable()->default(4);
            $table->decimal('price', 9,2)->nullable();
            $table->decimal('supplier_price', 9,2)->nullable();
            $table->integer('stock')->default(0);
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('products');
    }
}
