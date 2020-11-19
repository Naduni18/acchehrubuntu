<?php

use Illuminate\Database\Seeder;

class advance_requestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('advance_requests')->insert([
            'id'=>null,
            'amount' => '5000.00',
            'notes'=>null,
            'for_year' => '2020',
            'for_month'=>'August', //'January','February','March','April','May','June','July','August','September','October','November','December'
            'request_by'=>'2',
            'approved_by'=>'1',
            'status'=>'approved',//'approved','rejected','pending'
            'created_at' => now(),
            'updated_at' => now()
        ]);
     DB::table('advance_requests')->insert([
            'id'=>null,
            'amount' => '8000.00',
            'notes'=>null,
            'for_year' => '2020',
            'for_month'=>'July', //'January','February','March','April','May','June','July','August','September','October','November','December'
            'request_by'=>'3',
            'approved_by'=>'1',
            'status'=>'pending',//'approved','rejected','pending'
            'created_at' => now(),
            'updated_at' => now()
        ]);
     DB::table('advance_requests')->insert([
            'id'=>null,
            'amount' => '10000.00',
            'notes'=>null,
            'for_year' => '2020',
            'for_month'=>'August', //'January','February','March','April','May','June','July','August','September','October','November','December'
            'request_by'=>'4',
            'approved_by'=>'1',
            'status'=>'rejected',//'approved','rejected','pending'
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
