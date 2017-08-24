<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\komCrawler;

class KomGetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kom:getdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will visit the API website from kiesopmaat and get all the data from there.';

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
        $crawler = new komCrawler;

        $users = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $bar = $this->output->createProgressBar(count($users));

        $result = $crawler->clitest($bar, $users);

        if ($result) {
            echo "\r\nHet crawlen is succesvol voltooid.";
        }

        //return "you handled it!";
    }
}
