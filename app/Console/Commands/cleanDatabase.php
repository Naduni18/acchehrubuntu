<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class cleanDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:oldDBRecords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete old db records';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    $now  = Carbon::now();
       $schedule->call(function () {
            DB::table('training_schedule')->where('created_at','<',$now->subDays(730))->delete();
       DB::table('missing_attendance')->where('created_at','<',$now->subDays(730))->delete();
       DB::table('leave_requests')->where('date_','<',$now->subDays(3))->delete();
       DB::table('expense_claim')->where('date','<',$now->subDays(730))->delete();
       DB::table('daily_attendances')->where('date','<',$now->subDays(730))->delete();
       DB::table('calender_events')->where('created_at','<',$now->subDays(90))->delete();
       DB::table('advance_requests')->where('created_at','<',$now->subDays(120))->delete();
       
        })->daily();
    }
}
