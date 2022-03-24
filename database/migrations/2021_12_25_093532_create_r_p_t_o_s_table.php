<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRPTOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_p_t_o_s', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('ua_manufacturer')->nullable();
            $table->string('ua_model')->nullable();
            $table->string('rpto_certificate')->nullable();
            $table->date('date_of_issuance')->nullable();
            $table->foreignId('uas_operator_id')
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
        Schema::dropIfExists('r_p_t_o_s');
    }
}
