<?php

use Illuminate\Database\Seeder;

class recruitmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recruitment')->insert([
            'id'=>null,
            'cv_id' => 'abc.jpg',
            'name' => 'A.A.Perera',
            'NIC' => '123456789V',
            'email'=>'aaperera@gmail.com',
            'applied_job_position'=>'Student Counsellor',
            'first_interview_date'=>'2020-06-10',
            'second_interview_date'=>'2020-07-10',
            'interviewer'=>'4',
            'notes'=>'has 5 years experience',
            'current_status'=>'first_interview_passed',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('recruitment')->insert([
            'id'=>null,
            'cv_id' => 'abc.jpg',
            'name' => 'B.B.Perera',
            'NIC' => '123456780V',
            'email'=>'bbperera@gmail.com',
            'applied_job_position'=>'Accountant',
            'first_interview_date'=>'2020-06-10',
            'second_interview_date'=>'2020-07-10',
            'interviewer'=>'4',
            'notes'=>'no experience,fresh graduate',
            'current_status'=>'keeping_cv_for_future_vacancies',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('recruitment')->insert([
            'id'=>null,
            'cv_id' => 'abc.jpg',
            'name' => 'C.C.Perera',
            'NIC' => '123456781V',
            'email'=>'ccperera@gmail.com',
            'applied_job_position'=>'Manager',
            'first_interview_date'=>'2020-03-10',
            'second_interview_date'=>'2020-04-10',
            'interviewer'=>'4',
            'notes'=>'10 years experience',
            'current_status'=>'second_interview_passed',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('recruitment')->insert([
            'id'=>null,
            'cv_id' => 'abc.jpg',
            'name' => 'D.D.Perera',
            'NIC' => '123456782V',
            'email'=>'ddperera@gmail.com',
            'applied_job_position'=>'Accountant',
            'first_interview_date'=>'2020-06-10',
            'second_interview_date'=>'2020-07-10',
            'interviewer'=>'4',
            'notes'=>'1 year experience',
            'current_status'=>'cv_selected',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
