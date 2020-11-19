<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class deleteOldFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete_:oldFiles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete old user uploaded files from storage folder';

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
        collect(Storage::disk('public')->listContents('uploads/leave_documents', true))
	        ->each(function($file) {
		if ($file['type'] == 'file' && $file['timestamp'] < now()->subDays(730)->getTimestamp()) {
			Storage::disk('public')->delete($file['path']);
		}
	});
    
     collect(Storage::disk('public')->listContents('uploads/expense_claim', true))
	        ->each(function($file) {
		if ($file['type'] == 'file' && $file['timestamp'] < now()->subDays(730)->getTimestamp()) {
			Storage::disk('public')->delete($file['path']);
		}
	});
    
    }
}
