<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class PHPVersionCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'phpversion';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Show PHP Version';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $version=shell_exec('php -v');
        $this->info($version);

    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
