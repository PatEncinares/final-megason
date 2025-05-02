<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('procedure_id');
            $table->string('color')->nullable();
            $table->string('character')->nullable();
            $table->string('reaction')->nullable();
            $table->string('occult_blood')->nullable();
            $table->string('ova_or_parasite')->nullable();
            $table->string('concentration_technique')->nullable();
            $table->string('pus_cells')->nullable();
            $table->string('rbc_count')->nullable();
            $table->string('macrophage')->nullable();
            $table->string('fat_globules')->nullable();
            $table->string('hemoglobin')->nullable();
            $table->string('hematocrit')->nullable();
            $table->string('wbc_count')->nullable();
            $table->string('platelet_count')->nullable();
            $table->string('reticulocyte_count')->nullable();
            $table->string('erythocytes_sedimentation_rate')->nullable();
            $table->string('bleeding_time')->nullable();
            $table->string('clotting_time')->nullable();
            $table->string('neutrophils')->nullable();
            $table->string('lymphocytes')->nullable();
            $table->string('monocytes')->nullable();
            $table->string('eosinophils')->nullable();
            $table->string('stab_cells')->nullable();
            $table->string('basophils')->nullable();
            $table->string('abo_grp')->nullable();
            $table->string('rh_type')->nullable();
            $table->string('specific_gravity')->nullable();
            $table->string('albumin')->nullable();
            $table->string('bilirubin')->nullable();
            $table->string('pH')->nullable();
            $table->string('sugar')->nullable();
            $table->string('ketone')->nullable();
            $table->string('casts')->nullable();
            $table->string('crystals')->nullable();
            $table->string('pregnancy_test')->nullable();
            $table->string('method_used')->nullable();
            $table->string('e_cells')->nullable();
            $table->string('a_urates')->nullable();
            $table->string('m_threads')->nullable();
            $table->string('findings')->nullable();
            $table->string('chest_pa')->nullable();
            $table->string('impression')->nullable();
            $table->string('others')->nullable();
            $table->string('remarks')->nullable();
            $table->string('pathologist')->nullable();
            $table->string('medical_technologist')->nullable();
            $table->string('radiologist')->nullable();
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
        Schema::dropIfExists('lab_results');
    }
}
