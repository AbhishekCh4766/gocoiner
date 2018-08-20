<?php

namespace App\Console\Commands;

use App\Library\CoinRepository;
use App\Library\JobQueueRepository;
use Illuminate\Console\Command;
use Log;

class UpdateDailyHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coin:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update daily historical data';

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
        $jobs = JobQueueRepository::queuedSymbols();
        foreach ($jobs as $job) {
            $this->updateSymbol($job->symbol);
        }
    }

    private function updateSymbol($symbol)
    {
        try {
            $daysSinceUpdate = CoinRepository::calcUpdateDelta($symbol, 365 * 3);
            if ($daysSinceUpdate < 1) {
                $daysSinceUpdate = CoinRepository::shouldRefresh($symbol, 15, 3);
            }

            if ($daysSinceUpdate > 0) {
                $this->info(sprintf('Updating %s for %d days', $symbol, $daysSinceUpdate));
                CoinRepository::updateDailyHistory($symbol, 'USD', $daysSinceUpdate);
            }
            JobQueueRepository::removeJob($symbol);
        } catch (\Exception $e) {
            // gobble gobble
            Log::error($e->getMessage());
        }
    }
}