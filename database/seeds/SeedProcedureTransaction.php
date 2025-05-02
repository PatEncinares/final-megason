<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeedProcedureTransaction extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('procedure_transaction')->insert([
            'transaction_id'    => 1,
            'procedure_id'     => 2,
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedure_transaction')->insert([
            'transaction_id'    => 1,
            'procedure_id'     => 3,
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
    }
}
