<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUASOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uas_operators', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('postcode');
            $table->string('country');
//            $table->string('type');
            $table->string('type_of_intended_operation')->nullable(); // 1: Recreational,2: Hire & Reward ,3: Both (Recreational / Hire & Reward)
            $table->string('name_of_entity_registered_with_ssm')->nullable();
            $table->string('ssm_registration_number')->nullable();
            $table->string('ssm_certificate')->nullable();
            $table->string('certification');
            $table->json('rcoc_type')->nullable();
            $table->string('registration_id');
            $table->string('fly_registration_id');
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
        Schema::dropIfExists('u_a_s_operators');
    }
}
