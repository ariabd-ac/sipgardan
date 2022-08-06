<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->string('barcode');
            $table->string('motorcycle_plate');
            $table->string('driver_name');
            $table->string("phone_number", 15);
            $table->timestamp('clockin')->useCurrentOrUpdate();
            $table->timestamp('clockout')->nullable();
            $table->string("amount")->nullable();
            $table->string('duration')->nullable();
            $table->string('payment')->nullable();
            $table->string('change')->nullable();
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
        Schema::dropIfExists('parkings');
    }
}
