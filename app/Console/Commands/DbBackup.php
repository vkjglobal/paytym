<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DbBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Database Backup';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        $filename = "backup_".strtotime(now()).'_'.Carbon::today()->format('d-m-Y').".sql";
        $command = "mysqldump --user=".env('DB_USERNAME')." --password="
        .env('DB_PASSWORD')." --host=".env('DB_HOST')." ".env('DB_DATABASE')." > "
        .'storage/app/backup/'.$filename;
        // dd($command);
        exec($command);
        
        $filepath = 'storage/app/backup/'.$filename;
        $localpath = 'C:/Users/Aswinjith/Downloads/'.$filename;

        if (file_exists($filepath)) {
            // Copy the file to the local directory
            if (copy($filepath, $localpath)) {
                return "File downloaded successfully";
            }
            else {
                return "Failed to download file";
            }
        }
        else {
            // File does not exist
            return "File not found";
        }
        return Command::SUCCESS;
    }
}
