<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        $this->call([calender_eventsTableSeeder::class]);
        $this->call([expense_claimTableSeeder::class]);
        $this->call([recruitmentTableSeeder::class]);
        $this->call([advance_requestsTableSeeder::class]);
        $this->call([daily_attendancesTableSeeder::class]);
        $this->call([leave_requestsTableSeeder::class]);
        $this->call([missing_attendanceTableSeeder::class]);
        $this->call([salaryTableSeeder::class]);
        $this->call([skill_ratingTableSeeder::class]);
        $this->call([training_scheduleTableSeeder::class]);
    }
}
