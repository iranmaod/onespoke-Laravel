<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikePausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bike_pauses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bike_id');
            $table->timestamp('paused_at')->nullable();
            $table->timestamp('unpaused_at')->nullable();
            $table->unsignedBigInteger('pause_total')->default(0);
            $table->unsignedBigInteger('running_total')->default(0);
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
        Schema::dropIfExists('bike_pauses');
    }
}
