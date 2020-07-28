<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class CouponStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupon:send';

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
      // DB::table('coupon')->where('end_date','<','NOW()')
      DB::table('coupon')
      ->select('*')
      ->where('end_date','<',DB::raw('GETDATE()'))
      ->update([
      'cp_expiration'=>'Y'
      ]);
    }
}
