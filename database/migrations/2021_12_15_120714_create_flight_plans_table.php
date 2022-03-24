<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_plans', function (Blueprint $table) {
            $table->id();
            $table->string('lat');
            $table->string('lng');
            $table->string('purpose');
            $table->string('description');
            $table->string('timezone');
            $table->string('vlos_cylinder_radius');
            $table->string('vlos_cylinder_radius_unit');
            $table->string('max_height');
            $table->string('max_height_unit');
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time');
            $table->string('fly_less_120m')->nullable();
            $table->string('observer_mobile_number')->nullable();
            $table->string('additional_information')->nullable();
            $table->string('uas_plan_id')->unique();
            $table->string('status')->default('pending');
            $table->foreignId('uas_operator_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('unmanned_aircraft_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flight_plans');
    }
}
