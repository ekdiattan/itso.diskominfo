<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('UpdateBelumMasuk:cron')
        //     ->dailyAt('07:40')
        //     ->runInBackground()
        //     ->withoutOverlapping();
            
        //$schedule->command('UpdateBelumPulang:cron')
            //->dailyAt('16:10')
            //->runInBackground()
            //->withoutOverlapping();
        
        // $schedule->command('UpdateRekapMasuk:cron')
        //     ->everyTenMinutes()
        //     ->runInBackground()
        //     ->withoutOverlapping();
        
        // $schedule->command('UpdateRekapPulang:cron')
        //     ->everyTenMinutes()
        //     ->runInBackground()
        //     ->withoutOverlapping();

        // $schedule->command('UpdateRekapUnit:cron')
        //     ->everyTenMinutes()
        //     ->runInBackground()
        //     ->withoutOverlapping();

        // $schedule->command('UpdateKehadiran:cron')
        //     ->everyTenMinutes()
        //     ->runInBackground()
        //     ->withoutOverlapping();
        
        $schedule->command('UpdateCuti:cron')
            ->hourly()
            ->weekdays()
            ->runInBackground();

        $schedule->command('UpdateDigi:cron')
            ->hourly()
            ->runInBackground();
            
        $schedule->command('UpdateRekap:cron')
            ->hourly()
            ->weekdays()
            ->runInBackground();

        
        $schedule->command('TelegramAbsenMasuk:cron')->weekdays()->dailyAt('7:00')->runInBackground();
        $schedule->command('TelegramAbsenMasuk:cron')->weekdays()->dailyAt('7:15')->runInBackground();
        $schedule->command('TelegramAbsenMasuk:cron')->weekdays()->dailyAt('7:25')->runInBackground();
        $schedule->command('TelegramAbsenPulang:cron')->weekdays()->dailyAt('16:15')->runInBackground();
        $schedule->command('TelegramAbsenPulang:cron')->weekdays()->dailyAt('17:00')->runInBackground();
        $schedule->command('TelegramAbsenPulang:cron')->weekdays()->dailyAt('18:00')->runInBackground();
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

