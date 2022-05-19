<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdatePlayerRankingsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-player-rankings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to update player rankings.';

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
     * @return int
     */
    public function handle()
    {
        // TODO: implement this function
    }
}
