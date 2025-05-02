<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeedProceduresTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('procedures')->insert([
            'name' => 'Fecalysis',
            'price' => '2500',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedures')->insert([
            'name' => 'Hematology',
            'price' => '500',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedures')->insert([
            'name' => 'Urinalysis',
            'price' => '500',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedures')->insert([
            'name' => 'X-ray',
            'price' => '8500',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedures')->insert([
            'name' => 'Ultrasound',
            'price' => '500',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedures')->insert([
            'name' => 'Check Up',
            'price' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('procedures')->insert([
            'name' => 'Medical Certificate',
            'price' => '200',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // DB::table('procedures')->insert([
        //     'name' => 'DNA Test',
        //     'price' => '16000',
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        // ]);

        // DB::table('procedures')->insert([
        //     'name' => 'Urinalysis',
        //     'price' => '800',
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        // ]);

        // DB::table('procedures')->insert([
        //     'name' => 'Magnetic Resonance Imaging (MRI)',
        //     'price' => '15000',
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        // ]);

        // DB::table('procedures')->insert([
        //     'name' => 'Mammography',
        //     'price' => '25000',
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        // ]);

        // DB::table('procedures')->insert([
        //     'name' => 'Prenatal Testing',
        //     'price' => '2500',
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        // ]);

        // DB::table('procedures')->insert([
        //     'name' => 'Ultrasound',
        //     'price' => '3500',
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        // ]);

        // DB::table('procedures')->insert([
        //     'name' => 'Electrocardiography (ECG)',
        //     'price' => '18000',
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        // ]);

        // DB::table('procedures')->insert([
        //     'name' => 'X-Ray',
        //     'price' => '300',
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        // ]);
    }
}
