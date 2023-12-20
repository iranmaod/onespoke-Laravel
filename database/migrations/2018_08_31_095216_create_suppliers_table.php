<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('contact_name')->nullable()->default('');
            $table->text('address')->nullable();
            $table->string('url')->nullable()->default('');
            $table->string('image')->nullable()->default('');
            $table->string('phone_number')->nullable()->default('');
            $table->decimal('amount_sold', 27,2)->default(0);
            $table->integer('currency_id')->nullable()->default(147);
            $table->integer('country_id')->nullable();
            $table->boolean('active')->default(0);
            $table->string('validation_code')->default(0);
            $table->string('price_update_block')->nullable()->default('');
            $table->string('price_update_element')->nullable()->default('');
            $table->string('stock_update_element')->nullable()->default('');
            $table->string('description_update_element')->nullable()->default('');
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
        Schema::dropIfExists('suppliers');
    }
}
