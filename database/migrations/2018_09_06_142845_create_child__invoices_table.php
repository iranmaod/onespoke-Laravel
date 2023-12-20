<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child__invoices', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->nullable();
            $table->string('product_name')->nullable();
            $table->integer('product_quantity')->nullable()->default(1);
            $table->decimal('price_without_tax', 27,2)->nullable();
            $table->decimal('price_with_tax', 27,2)->nullable();
            $table->decimal('tax_amount', 27,2)->nullable();

            $table->integer('supplier_id')->nullable();//Seller Supplier
            $table->string('supplier');//invoice number
            $table->integer('user_id');//buyer
            $table->string('invoice_number');//invoice number

            $table->integer('status')->default(0);
            $table->string('currency_symbol',50)->default('$');
            $table->text('tracking_code')->nullable();
            $table->text('link')->nullable();

            $table->decimal('amount_gain', 27,2)->nullable();
            $table->decimal('supplier_price', 27,2)->nullable();
            //coupons
            $table->decimal('initial_amount', 27, 2)->nullable();//amt before tax and coupons // actual amount
            $table->string('coupon_code')->nullable();
            $table->decimal('coupon_amount', 27,2)->nullable();
            $table->decimal('coupon_percentage_off', 3,1)->nullable();

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
        Schema::dropIfExists('child__invoices');
    }
}
