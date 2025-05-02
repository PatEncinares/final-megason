<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('doctor_id')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('address')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('emergency_name')->nullable();
            $table->string('emergency_number')->nullable();
            $table->string('emergency_address')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('civil_status')->nullable();
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
        Schema::dropIfExists('patient_details');
    }
}
