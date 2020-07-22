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
        'pm_d_status'=>'배송 완료',
        'pm_status' =>'구매 확정'
      ]);
    }
}
// 배송중인 상품의 결제완료 시간
// $complete_date = DB::table('payment')->pluck('pm_complete_date');
// //현재시간
// $today = Carbon::now();
// $date_diff = [];
// for($i=0; $i<count($complete_date); $i++){
//   $date_diff[$i] = $today->diffInDays($complete_date[$i]);
//
//   //참고 : null일때도 차는 0임(당일과 같은 값)
//   if($date_diff[$i]>=7){
//     DB::table('payment')->where('pm_d_status','like','%배송중%')
//     ->update([
//       'pm_d_status'=>'배송 완료'
//     ]);
//   }//if
// }//for
