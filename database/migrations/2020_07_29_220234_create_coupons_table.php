<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('per_off',5)->nullable()->default(1);///%off backup
            $table->decimal('percentage_off', 4,2)->default(1);///vat percent  0 -> 100
            $table->integer('customer_age')->default(100000000); // 5 means 5 day old merchants
            $table->integer('usage_total')->default(50); //total times it can be used
            $table->integer('usage_per_customer')->default(1); //number of times a user can use
            $table->integer('min_product')->nullable()->default(1); //mini products to be eligible 
            $table->integer('min_item')->nullable()->default(1); //mini items to be eligible 
            $table->decimal('min_amount')->nullable()->default(1); //minimum amount required to be effective
            $table->datetime('start_date')->nullable(); // kick off must be less than 
            $table->datetime('end_date')->nullable(); // expiry
            $table->boolean('activation_method')->default(1); //1 Customer Activation or 0 Automatic Activation
            $table->boolean('status')->default(1); //1 or 0
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
        Schema::dropIfExists('coupons');
    }
}
