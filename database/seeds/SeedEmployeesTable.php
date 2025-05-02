<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeedEmployeesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'user_id'    => 2,
            'daily_rate'     => 373,
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('employees')->insert([
            'user_id'    => 4,
            'daily_rate'     => 373,
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('employees')->insert([
            'user_id'    => 5,
            'daily_rate'     => 373,
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('employees')->insert([
            'user_id'    => 6,
            'daily_rate'     => 373,
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('employees')->insert([
            'user_id'    => 7,
            'daily_rate'     => 373,
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('employees')->insert([
            'user_id'    => 8,
            'daily_rate'     => 373,
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('employees')->insert([
            'user_id'    => 9,
            'daily_rate'     => 373,
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
