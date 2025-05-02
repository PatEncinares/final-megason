<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class SeedAttendanceTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-16',
            'time' => '08:00',
            'type' => 'IN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-16',
            'time' => '17:00',
            'type' => 'OUT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-17',
            'time' => '08:00',
            'type' => 'IN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-17',
            'time' => '17:00',
            'type' => 'OUT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-18',
            'time' => '08:00',
            'type' => 'IN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-18',
            'time' => '17:00',
            'type' => 'OUT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-19',
            'time' => '08:00',
            'type' => 'IN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-19',
            'time' => '17:00',
            'type' => 'OUT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-20',
            'time' => '08:00',
            'type' => 'IN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-20',
            'time' => '17:00',
            'type' => 'OUT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-21',
            'time' => '08:00',
            'type' => 'IN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-21',
            'time' => '17:00',
            'type' => 'OUT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-22',
            'time' => '08:00',
            'type' => 'IN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-22',
            'time' => '17:00',
            'type' => 'OUT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-23',
            'time' => '08:00',
            'type' => 'IN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-23',
            'time' => '17:00',
            'type' => 'OUT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-24',
            'time' => '08:00',
            'type' => 'IN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-24',
            'time' => '17:00',
            'type' => 'OUT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-25',
            'time' => '08:00',
            'type' => 'IN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-25',
            'time' => '17:00',
            'type' => 'OUT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-26',
            'time' => '08:00',
            'type' => 'IN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-26',
            'time' => '17:00',
            'type' => 'OUT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-27',
            'time' => '08:00',
            'type' => 'IN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-27',
            'time' => '17:00',
            'type' => 'OUT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-28',
            'time' => '08:00',
            'type' => 'IN',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('attendance')->insert([
            'employee_id' => 1,
            'date' => '2021-06-28',
            'time' => '17:00',
            'type' => 'OUT',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
