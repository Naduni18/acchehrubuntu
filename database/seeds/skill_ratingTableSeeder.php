<?php

use Illuminate\Database\Seeder;

class skill_ratingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skill_rating')->insert([
            'id'=>null,
            'emp_id' => '2',
            'rated_by' => '1',
            'file_receivings' => '10',
            'offers'=>'10',
            'visa_grants'=>'10',
            'IELTS_class_registrations'=>'10',
            'IELTS_exam_registrations'=>'10',
            'total_kpi'=>'80',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    DB::table('skill_rating')->insert([
            'id'=>null,
            'emp_id' => '3',
            'rated_by' => '1',
            'file_receivings' => '20',
            'offers'=>'10',
            'visa_grants'=>'10',
            'IELTS_class_registrations'=>'10',
            'IELTS_exam_registrations'=>'10',
            'total_kpi'=>'90',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    DB::table('skill_rating')->insert([
            'id'=>null,
            'emp_id' => '4',
            'rated_by' => '1',
            'file_receivings' => '10',
            'offers'=>'10',
            'visa_grants'=>'10',
            'IELTS_class_registrations'=>'10',
            'IELTS_exam_registrations'=>'10',
            'total_kpi'=>'80',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    DB::table('skill_rating')->insert([
            'id'=>null,
            'emp_id' => '5',
            'rated_by' => '1',
            'file_receivings' => '10',
            'offers'=>'10',
            'visa_grants'=>'10',
            'IELTS_class_registrations'=>'10',
            'IELTS_exam_registrations'=>'10',
            'total_kpi'=>'80',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
