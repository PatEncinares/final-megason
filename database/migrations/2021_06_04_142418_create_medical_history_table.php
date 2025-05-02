<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->string('complains');
            $table->string('diagnosis');
            $table->string('treatment');
            $table->string('last_visit');
            $table->string('next_visit');
            $table->integer('attending_doctor');
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
        Schema::dropIfExists('medical_history');
    }
}
