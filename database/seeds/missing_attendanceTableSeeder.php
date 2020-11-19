<?php

use Illuminate\Database\Seeder;

class missing_attendanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('missing_attendance')->insert([
            'id'=>null,
            'reason' => 'Fogot to mark fingerprint when leaving',
            'date' => '2020-08-10',
            'start' => '09:00',
            'end'=>'18:00',
            'request_by'=>'2',
            'manger_to_approve'=>'1',
            'status'=>'approved',//'approved','rejected','pending'
            'created_at' => now(),
            'updated_at' => now()
        ]);
       DB::table('missing_attendance')->insert([
            'id'=>null,
            'reason' => 'Fingerprint device was off',
            'date' => '2020-08-11',
            'start' => '09:00',
            'end'=>'18:00',
            'request_by'=>'3',
            'manger_to_approve'=>'1',
            'status'=>'pending',//'approved','rejected','pending'
            'created_at' => now(),
            'updated_at' => now()
        ]);
      DB::table('missing_attendance')->insert([
            'id'=>null,
            'reason' => 'Fingerprint device was off',
            'date' => '2020-08-11',
            'start' => '09:00',
            'end'=>'18:00',
            'request_by'=>'2',
            'manger_to_approve'=>'3',
            'status'=>'pending',//'approved','rejected','pending'
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
