<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnmannedAircraftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unmanned_aircrafts', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('manufacturer_name');
            $table->string('model_name');
            $table->string('airframe');
            $table->string('uas_registration_number')->nullable();
            $table->string('colour');
            $table->string('mtow');
            $table->string('serial_number');
            $table->string('additional_information')->nullable();
            $table->string('markings');
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('unmanned_aircraft');
    }
}
