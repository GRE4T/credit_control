<?php

namespace App\Console\Commands;

use App\Support\NotificationService;
use Illuminate\Console\Command;

class CronNotificationService extends Command
{

    use NotificationService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifies services to expire';

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
        $this->certificates();
        $this->domains();
        $this->servers();
        $this->emails();
        return 0;
    }
}
