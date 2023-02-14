<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // ============ UPLOADS =============
        // remove locally deleted files from s3
        $schedule->command('removefiles:cron')->daily('00:00');

        // ============ REPORTS =============
        // generate extended_student_records and student_assessment_records
        $schedule->command('generateReportData')->dailyAt('01:00');

        // ============ EMAILS =============
        // send first 500 queued_emails
        $schedule->command('sendEmails')->everyMinute();
        // remove queued_emails sent > 24 hrs ago
        $schedule->command('removeSentQueuedEmails')->daily('02:00');

        // ============ PANDADOCS =============
        $schedule->command('updatePandadocs')->everyFifteenMinutes();

        // ============ ERROR SCAN =============
        $schedule->command('scanStudentData')->daily('03:00');
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
