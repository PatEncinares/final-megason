<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class SeedPatientDetails extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patient_details')->insert([
            'user_id' => 3,
            'doctor_id' => 2,
            'mobile_number' => '+639123456789',
            'gender'  => 'Male',
            'civil_status' => 'Single',
            'age' => 26,
            'address' => 'B16 L39 Laspinas Pulang Lupa',
            'date_of_birth' => '05/06/1994',
            'emergency_name' => 'Steph Doe',
            'emergency_number' => '+639987654321',
            'emergency_address' => 'B16 L39 Laspinas Pulang Lupa',
            'weight' => '64.5',
            'height' => '157',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
