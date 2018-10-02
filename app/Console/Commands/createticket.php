<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class createticket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:generate {amount : Amount of ticket to generate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Ticket';

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
        $amount = $this->argument('amount');
        if ($this->confirm('Do you want to generate '.$amount.' amount of Token?')) {
            for ($i=0 ; $i<$amount ; $i++) {
                $ticket = str_random(12);
                $user = new \App\USER;
                $user->ticket = $ticket;
                $user->save();
                $this->info($ticket);
            }
        }
    }
}
