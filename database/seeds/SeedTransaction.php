<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeedTransaction extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert([
            'patient_id'    => 3,
            'doctor_id'     => 2,
            'schedule_id'   => 1,
            'doctor_fee'    => 18000,
            'lab_fee'       => 7000,
            'total_amount'  => 25000,
            'status'        => 'paid',
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('transactions')->insert([
            'patient_id'    => 3,
            'doctor_id'     => 2,
            'schedule_id'   => 1,
            'doctor_fee'    => 18000,
            'lab_fee'       => 7000,
            'total_amount'  => 25000,
            'status'        => 'unpaid',
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
