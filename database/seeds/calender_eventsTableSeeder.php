<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class calender_eventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calender_events')->insert([
            'id'=>null,
            'title' => 'Client meeting',
            'description' => 'Client meeting about project no-0034',
            'start' => '2020-08-18 07:00',
            'end'=>'2020-08-18 08:00',
            'startTime'=>NULL,
            'endTime'=>NULL,
            'startRecur'=>NULL,
            'endRecur'=>NULL,
            'groupId'=>null,
            'daysOfWeek'=>null,
            'assigned_by'=>'1',
            'assigned_to'=>'1,2,3,6,',
            'location'=>'Room no:0v35',
            'notes'=>'be there before 15 minutes',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('calender_events')->insert([
            'id'=>null,
            'title' => 'Client meeting',
            'description' => 'Client meeting about project no-0039',
            'start' => '2020-08-12 07:00',
            'end'=>'2020-08-12 08:00',
            'startTime'=>NULL,
            'endTime'=>NULL,
            'startRecur'=>NULL,
            'endRecur'=>NULL,
            'groupId'=>null,
            'daysOfWeek'=>null,
            'assigned_by'=>'2',
            'assigned_to'=>'1,2,3,6,',
            'location'=>'Room no:0v35',
            'notes'=>'be there before 15 minutes',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('calender_events')->insert([
            'id'=>null,
            'title' => 'Client meeting',
            'description' => 'Client meeting about project no-0041',
            'start' => '2020-08-18 07:00',
            'end'=>'2020-08-18 08:00',
            'startTime'=>NULL,
            'endTime'=>NULL,
            'startRecur'=>NULL,
            'endRecur'=>NULL,
            'groupId'=>null,
            'daysOfWeek'=>null,
            'assigned_by'=>'1',
            'assigned_to'=>'1,3,6,',
            'location'=>'Room no:0v35',
            'notes'=>'be there before 15 minutes',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('calender_events')->insert([
            'id'=>null,
            'title' => 'Client meeting',
            'description' => 'Client meeting about project no-0034',
            'start' => NULL,
            'end'=>NULL,
            'startTime'=>'07:00',
            'endTime'=>'09:00',
            'startRecur'=>'2020-08-20',
            'endRecur'=>'2020-08-30',
            'groupId'=>Str::uuid(),
            'daysOfWeek'=>'[2,3,4]',
            'assigned_by'=>'2',
            'assigned_to'=>'1,5,6,',
            'location'=>'Room no:0v39',
            'notes'=>'be there before 15 minutes',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('calender_events')->insert([
            'id'=>null,
            'title' => 'Staff meeting',
            'description' => 'Monthly progress discussion',
            'start' => NULL,
            'end'=>NULL,
            'startTime'=>'07:00',
            'endTime'=>'09:00',
            'startRecur'=>'2020-08-10',
            'endRecur'=>'2020-08-15',
            'groupId'=>Str::uuid(),
            'daysOfWeek'=>'[1,5,6]',
            'assigned_by'=>'1',
            'assigned_to'=>'1,2,4,6,',
            'location'=>'Room no:0v36',
            'notes'=>'be there before 15 minutes',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
