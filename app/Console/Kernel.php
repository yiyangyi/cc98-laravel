<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\Inspire',
		'App\Console\Commands\BackupDatabase',
		'App\Console\Commands\RenameUser',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('inspire')
				 ->hourly();
	    $schedule->call(function()
	    {
	    	// Do some task...

	    })->hourly();
	    $schedule->exec('composer self-update')->daily();
	    $schedule->command('foo')->cron('* * * * *');
	    $schedule->command('foo')->everyFiveMinutes();
	    $schedule->command('foo')->everyTenMinutes();
	    $schedule->command('foo')->everyThirtyMinutes();
	    $schedule->command('foo')->daily();
	    $schedule->command('foo')->dailyAt('15:00');
	    $schedule->command('foo')->twiceDaily();
	    $schedule->command('foo')->weekdays();
	    $schedule->command('foo')->weekly();
	    $schedule->command('foo')->weeklyOn(1, '8:00');
	    $schedule->command('foo')->monthly();
	    $schedule->command('foo')->mondays();
        $schedule->command('foo')->tuesdays();
        $schedule->command('foo')->thursdays();
        $schedule->command('foo')->fridays();
        $schedule->command('foo')->saturdays();
        $schedule->command('foo')->sundays();
        $schedule->command('foo')->monthly()->environments('production');
        $schedule->command('foo')->monthly()->evenInMaintenanceMode();
        $schedule->command('foo')->monthly()->when(function()
		{
		    return true;
		});
		$schedule->command('foo')->sendOutputTo($filePath)->emailOutputTo('foo@example.com');
		$schedule->command('foo')->sendOutputTo($filePath);
		$schedule->command('foo')->thenPing($url);
	}

}
