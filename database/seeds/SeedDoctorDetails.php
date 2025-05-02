<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeedDoctorDetails extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctor_details')->insert([
            'user_id' => 2,
            'fullname' => 'Delmar Silva',
            'gender'  => 'Male',
            'specialization' => 'Cardiology',
            'address' => '258 San Jose Del Monte Bulacan',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
