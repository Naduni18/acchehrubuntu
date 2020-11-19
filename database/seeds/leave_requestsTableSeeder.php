<?php

use Illuminate\Database\Seeder;

class leave_requestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('leave_requests')->insert([
            'id'=>null,
            'document_id'=>'doc1.txt',
            'reason' => 'Attending to a wedding',
            'date_' => '2020-08-10',
            'start' => '09:00',
            'end'=>'18:00',
            'request_by'=>'2',
            'approved_by'=>'1',
            'status'=>'approved',//'approved','rejected','pending'
            'category'=>'full day',//'full day','half day','short leave'
            'type'=>'annual',//'no pay','sick','annual'
            'created_at' => now(),
            'updated_at' => now()
        ]);
    DB::table('leave_requests')->insert([
            'id'=>null,
            'document_id'=>'doc1.txt',
            'reason' => 'Attending to sons parents day',
            'date_' => '2020-08-11',
            'start' => '09:00',
            'end'=>'12:00',
            'request_by'=>'3',
            'approved_by'=>'1',
            'status'=>'rejected',//'approved','rejected','pending'
            'category'=>'half day',//'full day','half day','short leave'
            'type'=>'no pay',//'no pay','sick','annual'
            'created_at' => now(),
            'updated_at' => now()
        ]);
    DB::table('leave_requests')->insert([
            'id'=>null,
            'document_id'=>'doc1.txt',
            'reason' => 'meet doctor',
            'date_' => '2020-08-16',
            'start' => '09:00',
            'end'=>'10:00',
            'request_by'=>'1',
            'approved_by'=>'4',
            'status'=>'pending',//'approved','rejected','pending'
            'category'=>'short leave',//'full day','half day','short leave'
            'type'=>'sick',//'no pay','sick','annual'
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
