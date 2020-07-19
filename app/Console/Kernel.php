<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;

class Kernel extends ConsoleKernel
{
  /**
  * The Artisan commands provided by your application.
  *
  * @var array
  */
  protected $commands = [
    App\Console\Commands\DeliveryStatus::class
     // Commands\DeliveryStatus::class
  ];

  /**
  * Define the application's command schedule.
  *
  * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
  * @return void
  */
  protected function schedule(Schedule $schedule)
  {
    //현재시간과 배송중 인 상태의 시간의 차를 계산
    // $schedule->call(function () {
    //
    // })->hourlyAt(50);
    $schedule->command('delivery:send')
    ->hourlyAt(50);
  }

  /**
  * Register the commands for the application.
  *
  * @return void
  */
  protected function commands()
  {
    $this->load(__DIR__.'/Commands');

    require base_path('routes/console.php');
  }
}

//배송중인 상품의 결제완료 시간
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
