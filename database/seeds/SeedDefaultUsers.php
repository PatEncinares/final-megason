<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeedDefaultUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jack Delos Trino',
            'email' => 'jack@yahoo.com',
            'contact_number' => '+639999931103',
            'password' => Hash::make('admin'),
            'type'  => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Delmar Silva',
            'email' => 'silvadelmar@yahoo.com',
            'contact_number' => '+639999931103',
            'password' => Hash::make('doctor'),
            'type'  => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Mel Ragay',
            'email' => 'mhel.ragay24@gmail.com',
            'contact_number' => '+639999931103',
            'password' => Hash::make('patient'),
            'type'  => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Beverly Mandia',
            'email' => 'beverly23@yahoo.com',
            'contact_number' => '+639999931103',
            'password' => Hash::make('receptionist'),
            'type'  => 4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Melanie Reyes',
            'email' => 'laniereyes@yahoo.com',
            'contact_number' => '+639999931103',
            'password' => Hash::make('hr123'),
            'type'  => 5,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Ruth Molera',
            'email' => 'ruthmolera23@yahoo.com',
            'contact_number' => '+639999931103',
            'password' => Hash::make('accounting'),
            'type'  => 6,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Darlene Barreno',
            'email' => 'darlene.barreno@gmail.com',
            'contact_number' => '+639999931103',
            'password' => Hash::make('cashier'),
            'type'  => 7,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Tesalonika Encinares',
            'email' => 'niksanityoyea@yahoo.com',
            'contact_number' => '+639999931103',
            'password' => Hash::make('nurse'),
            'type'  => 8,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Lara Isabel',
            'email' => 'lara.isabel@gmail.com',
            'contact_number' => '+639999931103',
            'password' => Hash::make('lab123'),
            'type'  => 9,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
    }
}