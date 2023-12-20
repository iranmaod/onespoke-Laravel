<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('manufacturer_id');
            $table->unsignedBigInteger('frame_type_id');
            $table->unsignedBigInteger('condition_id');
            $table->unsignedBigInteger('frame_size_id')->nullable();
            $table->unsignedBigInteger('wheel_size_id')->nullable();
            $table->unsignedBigInteger('gender_id')->nullable();
            $table->string('title');
            $table->string('frame_number')->nullable();
            $table->string('model')->nullable();
            $table->string('year')->nullable();
            $table->text('description')->nullable();
            $table->text('additional_details')->nullable();
            $table->unsignedInteger('price');
            $table->string('postcode')->nullable();
            $table->decimal('latitude', 8, 2)->nullable();
            $table->decimal('longitude', 8, 2)->nullable();
            $table->string('district')->nullable();
            $table->string('country')->nullable();
            $table->boolean('uploaded_to_bike_register')->default(0);
            $table->boolean('more_than_one_available')->default(0);
            $table->boolean('published')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->boolean('paused')->default(0);
            $table->timestamp('paused_at')->nullable();
            $table->boolean('sold')->default(0);
            $table->timestamp('sold_at')->nullable();
            $table->unsignedBigInteger('view_count')->default(0);
            $table->unsignedBigInteger('total_pause_duration')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('bikes');
    }
}
