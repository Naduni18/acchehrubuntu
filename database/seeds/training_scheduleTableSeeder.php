<?php

use Illuminate\Database\Seeder;

class training_scheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('training_schedule')->insert([
            'id'=>null,
            'title' => 'New IELTS syllabus introduction',
            'start' => '2020-08-18 07:00',
            'end'=>'2020-08-18 08:00',
            'assigned_by'=>'1',
            'conducted_by'=>'2',
            'assigned_to'=>'1,2,3,6,',
            'location'=>'Room no:0v35',
            'notes'=>'be there before 15 minutes',
            'created_at' => now(),
            'updated_at' => now()
        ]);
       DB::table('training_schedule')->insert([
            'id'=>null,
            'title' => 'New Visa regulations update session 1',
            'start' => '2020-08-13 07:00',
            'end'=>'2020-08-13 08:00',
            'assigned_by'=>'3',
            'conducted_by'=>'1',
            'assigned_to'=>'1,2,3,6,',
            'location'=>'Room no:0v34',
            'notes'=>'be there before 15 minutes',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    DB::table('training_schedule')->insert([
            'id'=>null,
            'title' => 'New Visa regulations update session 2',
            'start' => '2020-08-08 07:00',
            'end'=>'2020-08-08 08:00',
            'assigned_by'=>'3',
            'conducted_by'=>'1',
            'assigned_to'=>'1,2,3,6,',
            'location'=>'Room no:0v34',
            'notes'=>'be there before 15 minutes',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
