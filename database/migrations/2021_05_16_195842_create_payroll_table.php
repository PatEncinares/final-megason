<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('pay_period');
            $table->integer('total_hours_worked');
            $table->integer('total_days_worked');
            $table->integer('employee_leave');
            $table->integer('ot');
            $table->integer('rholiday');
            $table->integer('sholiday');
            $table->integer('tmonth');
            $table->integer('bonus');
            $table->double('gross_pay');
            $table->double('sss');
            $table->double('philhealth');
            $table->double('pagibig');
            $table->double('tax');
            $table->integer('total_deduction');
            $table->integer('total_pay');
            $table->integer('net_pay');
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
        Schema::dropIfExists('payroll');
    }
}
