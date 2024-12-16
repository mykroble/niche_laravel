<?php

namespace App\Console;

use Illuminate\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Register any Artisan commands here
    ];

    protected $routeMiddleware = [
        // Other middleware
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Define the command schedule here
        // Example: $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // Load the routes for console commands
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}