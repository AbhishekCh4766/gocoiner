<?php

namespace App\Console;

use App\Console\Commands\UpdateCoinData;
use App\Console\Commands\UpdateCoinNews;
use App\Console\Commands\UpdateCurrencyRates;
use App\Console\Commands\UpdateDailyHistory;
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
        UpdateCurrencyRates::class,
        UpdateCoinData::class,
        UpdateCoinNews::class,
        UpdateDailyHistory::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(UpdateCurrencyRates::class)
            ->hourly();

        $schedule->command(UpdateCoinData::class)
            ->everyMinute()
            ->withoutOverlapping();

        $schedule->command(UpdateDailyHistory::class)
            ->everyTenMinutes()
            ->withoutOverlapping();

        $schedule->command(UpdateCoinNews::class)
            ->everyThirtyMinutes();

    $schedule->call('App\Http\Controllers\Frontend\NewsController@saveBitData')->daily();
    $schedule->call('App\Http\Controllers\Frontend\NewsController@saveEthData')->daily();
    $schedule->call('App\Http\Controllers\Frontend\NewsController@saveRipData')->daily();
    $schedule->call('App\Http\Controllers\Frontend\NewsController@saveicoData')->daily();
    $schedule->call('App\Http\Controllers\Frontend\NewsController@saveBloData')->daily();
    $schedule->call('App\Http\Controllers\Frontend\NewsController@saveFeaData')->daily();
    $schedule->call('App\Http\Controllers\Frontend\IcoWatchListApiController@getICOs')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
