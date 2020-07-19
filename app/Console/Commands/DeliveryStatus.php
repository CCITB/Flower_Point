<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class DeliveryStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delivery:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
      DB::table('payment')->where('pm_d_status','like','%배송중%')
      ->where('pm_complete_date','<', DB::raw('DATE_SUB(NOW(), INTERVAL 7 DAY)'))
      ->update([
        'pm_d_status'=>'배송 완료'
      ]);
    }
}
