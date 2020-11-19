<?php

use Illuminate\Database\Seeder;

class expense_claimTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('expense_claim')->insert([
            'claim_id'=>null,
            'date' => '2020-08-10',
            'reason' => 'office wifi bill payment',
            'amount' => '1000.00',
            'bill_id'=>'abc.jpg',
            'request_by'=>'1',
            'approved_by'=>'2',
            'status'=>'approved',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('expense_claim')->insert([
            'claim_id'=>null,
            'date' => '2020-08-10',
            'reason' => 'get new printer ink bill payment',
            'amount' => '4000.00',
            'bill_id'=>'abc.jpg',
            'request_by'=>'3',
            'approved_by'=>'1',
            'status'=>'rejected',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('expense_claim')->insert([
            'claim_id'=>null,
            'date' => '2020-08-10',
            'reason' => '10 paper bundles for accounts section bill payment',
            'amount' => '5000.00',
            'bill_id'=>'abc.jpg',
            'request_by'=>'2',
            'approved_by'=>'3',
            'status'=>'pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
