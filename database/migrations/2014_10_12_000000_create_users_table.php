<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('document_type')->nullable();
            $table->string('national_passport_id')->unique()->nullable();
            $table->string('national_passport_file_link')->unique()->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', [1, 2])->nullable(); //1: Male, 2: Female
            $table->string('mobile_number')->unique()->nullable();
            $table->string('nationality')->nullable();
            $table->string('password');
            $table->boolean('profile_complete')->default(false);
            $table->boolean('is_pilot')->default(false);
            $table->boolean('has_org')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
