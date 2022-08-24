<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Storage;
use Log;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // Launch script
            try{

                $dirs_certifications = Storage::disk('public')->allDirectories('screenshots-certifications');
                foreach($dirs_certifications as $dir){
                    $time = Storage::disk('public')->lastModified($dir);
                    if($time < (time() -  60*60)){
                        Storage::disk('public')->deleteDirectory($dir);
                    }
                }

                $files_certifications = Storage::disk('public')->allFiles('screenshots-certifications');
                foreach($files_certifications as $file){
                    $time = Storage::disk('public')->lastModified($file);
                    if($time < (time() -  60*60)){
                        Storage::disk('public')->delete($file);
                    }
                }


                $dirs_generations = Storage::disk('public')->allDirectories('generations');
                foreach($dirs_generations as $generate){
                    $time = Storage::disk('public')->lastModified($generate);
                    if($time < (time() -  60*60)){
                        Storage::disk('public')->deleteDirectory($generate);
                    }
                }
            }catch(\Exception $e){
                Log::error("Error Scripting Scheduling : ".$e->getMessage());
            }
        })->name('delete_dirs')->withoutOverlapping()->hourly()->timezone('Africa/Cairo')->onOneServer();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
