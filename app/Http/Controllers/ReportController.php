<?php

namespace App\Http\Controllers;

use App\Events\Reports;
use App\Models\Car;
use App\Models\Vessel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Route;
use App\Notifications\SendNotifications;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
class ReportController extends Controller
{

        public function __construct()
        {
        $id = Route::current()->parameter('id');
        $this->middleware("auth");
        $this->middleware("canView:$id", [
        'only' => [
            'stats' ,

            ]
    ]);
    }
    //get  cars
    public function cars($id)
    {

        $vessel = Vessel::where('vessel_id', $id)->first();
  if($vessel ){
        $total_cars = Car::where('vessel_id', $id)->groupBy('car_no')->get()->count();
        $active_cars = Car::where([['vessel_id', $id], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
        $toktok_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة توكتوك'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
        $qlab_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة قلاب'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
        $company_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة الشركة'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
        $grar_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة جرار'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
       $users = User::where('type', '1')->get();
            Notification::send($users, new SendNotifications(' تم الدخول على تقرير السيارات المفعلة '.$vessel->name, auth()->user()->id));
        return view('reports.cars', [
            'vessel' => $vessel,
            'total_cars' => $total_cars,
            'active_cars' => $active_cars,
            'toktok_cars' => $toktok_cars,
            'qlab_cars' => $qlab_cars,
            'company_cars' => $company_cars,
            'grar_cars' => $grar_cars,
        ]);
        }
          return redirect('/');
    }

    //get  cars
    public function analysis($id)
    {
        $vessel = Vessel::where('vessel_id', $id)->first();
        
         if($vessel){
               $users = User::where('type', '1')->get();
            Notification::send($users, new SendNotifications(' تم الدخول على تقرير بيان تحليلى بالكميات '.$vessel->name, auth()->user()->id));
        return view('reports.analysis', [
            'vessel' => $vessel,
        ]); 
         }
          return redirect('/');
    }
    public function stats($id)
    {
        $vessel = Vessel::where('vessel_id', $id)->first();
         if($vessel){
               $users = User::where('type', '1')->get();
            Notification::send($users, new SendNotifications(' تم الدخول على تقرير معدلات الباخرة '.$vessel->name, auth()->user()->id));
        return view('reports.stats', [
            'vessel' => $vessel,
        ]);
         }
          return redirect('/');
    }
    //get  stats
    public function DStats($id)
    {
        $vessel = Vessel::where('vessel_id', $id)->first();
        $start_date = Carbon::parse($vessel->start_date);

        if ($vessel->done == 0) {
            $now = Carbon::now();
        } else {
            $now = $vessel->end_date;
        }

        $total_cars = Car::where('vessel_id', $id)->groupBy('car_no')->get()->count();
        $active_cars = Car::where([['vessel_id', $id], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
        $toktok_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة توكتوك'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
        $qlab_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة قلاب'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
        $company_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة الشركة'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
        $grar_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة جرار'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();

        $diff = $start_date->diff($now);
        $days = $diff->d *24;
        $hours = $diff->h + $days;
        $minutes = $diff->m;

        $move_sum = DB::table('move')
            ->select(DB::raw('SUM(jumbo) as total_jumbo'), DB::raw('count(*) as moves_count'))
            ->where([['vessel_id', $id], ['arrival', 1]])
            ->first();
        $loading_sum = DB::table('loading')
            ->select(DB::raw('SUM(jumbo) as total_jumbo'), DB::raw('count(*) as moves_count'), DB::raw('SUM(qnt) as total_qnt'))
            ->where([['vessel_id', $id]])
             ->whereNotNull('qnt_date')
            ->first();

        $room_sum = DB::table('move')
            ->select('*', DB::raw('SUM(qnt) as total_qnt'), DB::raw('count(*) as moves_count'), DB::raw('SUM(qnt) as total_qnt'))
            ->where([['vessel_id', $id], ['arrival', 1]])
            ->groupBy('room_no')
            ->orderby('room_no', 'asc')
            ->get();

        $seer_sum = DB::table('move')
            ->select('*', DB::raw('SUM(qnt) as total_qnt'), DB::raw('count(*) as moves_count'), DB::raw('SUM(qnt) as total_qnt'))
            ->where([['vessel_id', $id], ['arrival', 1]])
            ->groupBy('seer')
         ->orderby('seer', 'asc')
            ->get();
            $seer_room=[];
        for($f=0;$f< $seer_sum->count();$f++){
            for($i=0;$i< $room_sum->count();$i++){
              
            $seer_room[$f][$i]  = DB::table('move')
            ->select('*', DB::raw('SUM(qnt) as total_qnt'), DB::raw('count(*) as moves_count'))
            ->where([['vessel_id', $id], ['seer', $seer_sum[$f]->seer ], ['room_no', $room_sum[$i]->room_no]])
             ->orderby('room_no', 'asc')
            ->get();

            }
        }
          

        
        $hla_sum = DB::table('move')
            ->select('*', DB::raw('SUM(qnt) as total_qnt'), DB::raw('count(*) as moves_count'), DB::raw('SUM(qnt) as total_qnt'))
            ->where([['vessel_id', $id], ['arrival', 1]])
            ->groupBy('hla1')
            ->get();
        

             $hla2_sum = DB::table('move')
            ->select('*', DB::raw('SUM(qnt) as total_qnt'), DB::raw('count(*) as moves_count'), DB::raw('SUM(qnt) as total_qnt'))
            ->where([['vessel_id', $id], ['arrival', 1]])
            ->groupBy('hla2')
            ->get();

        $kbsh_sum = DB::table('move')
            ->select('*', DB::raw('SUM(qnt) as total_qnt'), DB::raw('count(*) as moves_count'), DB::raw('SUM(qnt) as total_qnt'))
            ->where([['vessel_id', $id], ['arrival', 1]])
            ->groupBy('kbsh')
            ->get();

        $crane_sum = DB::table('move')
            ->select('*', DB::raw('SUM(qnt) as total_qnt'), DB::raw('count(*) as moves_count'))
            ->where([['vessel_id', $id], ['arrival', 1], ['crane','!=', 'بدون أوناش']])
            ->groupBy('crane')
            ->orderby('crane', 'asc')
            ->get();
             $crane_room =[];
        for($f=0;$f< $crane_sum->count();$f++){
            for($i=0;$i< $room_sum->count();$i++){
              
            $crane_room[$f][$i]  = DB::table('move')
            ->select('*', DB::raw('SUM(qnt) as total_qnt'), DB::raw('count(*) as moves_count'))
            ->where([['vessel_id', $id], ['crane', $crane_sum[$f]->crane ], ['room_no', $room_sum[$i]->room_no]])
             ->orderby('room_no', 'asc')
            ->get();

            }
        }


        $type_sum = DB::table('move')
            ->select('*', DB::raw('SUM(qnt) as total_qnt'), DB::raw('count(*) as moves_count'))
            ->where([['vessel_id', $id]])
            ->groupBy('type')
             ->orderby('type', 'asc')
            ->get();
        $type_room=[];
        for($f=0;$f< $type_sum->count();$f++){
            for($i=0;$i< $room_sum->count();$i++){
              
            $type_room[$f][$i]  = DB::table('move')
            ->select('*', DB::raw('SUM(qnt) as total_qnt'), DB::raw('count(*) as moves_count'))
            ->where([['vessel_id', $id], ['type', $type_sum[$f]->type ], ['room_no', $room_sum[$i]->room_no]])
             ->orderby('room_no', 'asc')
            ->get();
            }
        }
        $store_no_sum = DB::table('move')
            ->select('*', DB::raw('SUM(qnt) as total_qnt'), DB::raw('count(*) as moves_count'), DB::raw('SUM(qnt) as total_qnt'))
            ->where([['vessel_id', $id]])
            ->groupBy('store_no')
            ->get();

        $car_owners = DB::table('cars')
            ->select('*')
            ->where([['cars.vessel_id', $id]])
            ->groupBy('car_owner')
            ->get();
        foreach ($car_owners as $car_owner) {

            $car_owner_cars = DB::table('cars')
                ->select('*')
                ->where([['vessel_id', $id], ['car_owner', $car_owner->car_owner]])
                ->get();
                $car_owner_cars2 = DB::table('cars')
                ->select('*')
                ->where([['vessel_id', $id], ['car_owner', $car_owner->car_owner], ['done', 0]])
                ->count();

                $moves_count = 0;
                $qnts = 0;
                
                foreach ($car_owner_cars as $car) {
                        $moves = DB::table('move')
                        ->select(DB::raw('count(*) as moves_count'),DB::raw('sum(qnt) as qnts'))
                        ->where([['vessel_id', $id], ['sn', $car->sn],  ['arrival', 1]])
                        ->get();


                        $moves_count +=  $moves[0]->moves_count;
                        $qnts +=  $moves[0]->qnts;
                }
          
                $count = DB::table('cars')
                ->select('*')
                ->where([['vessel_id', $id], ['car_owner', $car_owner->car_owner]])
                ->groupBy('car_no')
                ->get()->count();

                $car_owner->limits =  $count;
                $car_owner->now =  $car_owner_cars2;
                $car_owner->vacant =  $moves_count;
                $car_owner->mehwer = $qnts;
                 
        }
       
 

        $cars = DB::table('cars')
            ->select('*', 'limits as moves_count', 'vacant as qnts',  'mehwer as avg')
            ->where([['cars.vessel_id', $id]])
            ->orderby('id','asc')
            ->groupBy('car_no')
            ->get();
       
            foreach ($cars as $car) {
                    $car->moves_count = 0 ;
                    $car->qnts = 0 ;
                    $car->avg = 0;
                    $car->sn = '';
                    $cars_no = Car::where([['vessel_id', $id], ['car_no',$car->car_no]])->get();
                    $num = $cars_no->count() - 1;
                    for($i=0;$i < $cars_no->count(); $i++){
                            $car->sn .=  '  '.$cars_no[$i]->sn.'  ';
                            $moves = DB::table('move')
                            ->select(DB::raw('count(*) as moves_count'),DB::raw('sum(qnt) as qnts'))
                            ->where([['vessel_id', $id], ['sn', $cars_no[$i]->sn],  ['arrival', 1]])
                            ->get();
                            $car->moves_count +=  $moves[0]->moves_count;
                            $car->qnts +=  $moves[0]->qnts; 
                            
                            if ($moves[0]->moves_count != 0) {
                                $car->avg +=   $moves[0]->qnts /  $moves[0]->moves_count; 
                            }else {
                                $car->avg = 0;
                            }
                    } 
            


                    $car->qnts =  number_format($car->qnts, 3, '.', ''); 
                    $car->avg =   number_format($car->avg, 3, '.', ' '); 
                        if ($car->hla1 == 'بدون حِلل') $car->hla1 = '-'; 
                        if ($car->hla2 == 'بدون حله ثانيه') $car->hla2 = '-'; 

                    $car->hla =   $car->hla1.' - '.$car->hla2; 
                
                    $last = DB::table('cars')
            ->select('*', 'limits as moves_count', 'vacant as qnts',  'mehwer as avg')
            ->where([['cars.vessel_id', $id],['car_no', $car->car_no]])
            ->orderby('id','desc')
            ->get()->first();
                    if($last->exit_date == null){
                        $car->exit_date = '----------';
                        $car->status = 'ما زالت على الباخرة';
                    }else {
                        $car->exit_date =$last->exit_date;
                        $car->status = 'خرجت';
                    }
                    }


        return view('reports.stats_load', [
            'vessel' => $vessel,
            'total_cars' => $total_cars,
            'active_cars' => $active_cars,
            'toktok_cars' => $toktok_cars,
            'qlab_cars' => $qlab_cars,
            'company_cars' => $company_cars,
            'grar_cars' => $grar_cars,
            'days' => $days,
            'hours' => $hours,
            'minutes' => $minutes,
            'move_sum' => $move_sum,
            'loading_sum' => $loading_sum,
            'room_sum' => $room_sum,
            'seer_sum' => $seer_sum,
            'seer_room' => $seer_room,
            'hla_sum' => $hla_sum,
            'hla2_sum' => $hla2_sum,
            'kbsh_sum' => $kbsh_sum,
            'crane_sum' => $crane_sum,
            'crane_room' => $crane_room,
            'type_sum' => $type_sum,
            'type_room' => $type_room,
            'store_no_sum' => $store_no_sum,
            'car_owners' => $car_owners,
            'cars' => $cars
        ]);
    }

    //get  stats
    public function loading($id)
    {
        $vessel = Vessel::where('vessel_id', $id)->first();
        if($vessel ){
              $users = User::where('type', '1')->get();
            Notification::send($users, new SendNotifications(' تم الدخول على تقرير التحميل من المخزن '.$vessel->name, auth()->user()->id));
        return view('reports.loading', [
            'vessel' => $vessel,
        ]);
         }
          return redirect('/');
    }
    //get  stats
    public function arrival($id)
    {
        $vessel = Vessel::where('vessel_id', $id)->first();
         if($vessel ){
               $users = User::where('type', '1')->get();
            Notification::send($users, new SendNotifications(' تم الدخول على تقرير الشحن على الرصيف '.$vessel->name, auth()->user()->id));
        return view('reports.arrival', [
            'vessel' => $vessel,
        ]);
         }
          return redirect('/');
    }


    //get  stats
    public function quantity($id)
    {
        $vessel = Vessel::where('vessel_id', $id)->first();
          if($vessel ){
        $start_date = Carbon::parse($vessel->start_date);

        if ($vessel->done == 0) {
            $now = Carbon::now();
        } else {
            $now = $vessel->end_date;
        }

         $total_cars = Car::where('vessel_id', $id)->groupBy('car_no')->get()->count();
        $active_cars = Car::where([['vessel_id', $id], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
        $toktok_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة توكتوك'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
        $qlab_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة قلاب'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
        $company_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة الشركة'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
        $grar_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة جرار'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();

        $diff = $start_date->diff($now);
        $days = $diff->d;
        $hours = $diff->h;
        $minutes = $diff->m;

        $move_sum = DB::table('move')
            ->select(DB::raw('SUM(jumbo) as total_jumbo'), DB::raw('count(*) as moves_count'))
            ->where([['vessel_id', $id], ['arrival', 1]])
            ->first();
        $loading_sum = DB::table('loading')
            ->select(DB::raw('SUM(jumbo) as total_jumbo'), DB::raw('count(*) as moves_count'), DB::raw('SUM(qnt) as total_qnt'))
            ->where([['vessel_id', $id]])
             ->whereNotNull('qnt_date')
            ->first();

        $loadings = DB::table('loading')
            ->join('cars', 'cars.sn', 'loading.sn')
            ->select('loading.*', 'cars.car_no as car_no')
            ->where([['loading.vessel_id', $id],['cars.vessel_id', $id]])
            ->orderByDesc('loading.date')
            ->get();
        $total_moves = $loadings->count();
            $users = User::where('type', '1')->get();
            Notification::send($users, new SendNotifications(' تم الدخول على تقرير مطابقة الكميات مع الموازين '.$vessel->name , auth()->user()->id));
        return view('reports.quantity', [
            'vessel' => $vessel,
            'total_cars' => $total_cars,
            'active_cars' => $active_cars,
            'toktok_cars' => $toktok_cars,
            'qlab_cars' => $qlab_cars,
            'company_cars' => $company_cars,
            'grar_cars' => $grar_cars,
            'days' => $days,
            'hours' => $hours,
            'minutes' => $minutes,
            'move_sum' => $move_sum,
            'loading_sum' => $loading_sum,
            'loadings' => $loadings,
            'total_moves' => $total_moves,

        ]);
 }
          return redirect('/');
    }
    public function stops($id)
    {
        $vessel = Vessel::where('vessel_id', $id)->first();
        if($vessel ){
            $users = User::where('type', '1')->get();
            Notification::send($users, new SendNotifications(' تم الدخول على تقرير التوقفات '.$vessel->name, auth()->user()->id));
        return view('reports.stops', [
            'vessel' => $vessel,
        ]);
         }
        return redirect('/');
    }
    public function minus($id)
    {
        $vessel = Vessel::where('vessel_id', $id)->first();
        if($vessel ){
             $users = User::where('type', '1')->get();
            Notification::send($users, new SendNotifications(' تم الدخول على تقرير الخصومات على سيارات النقل '.$vessel->name, auth()->user()->id));
        return view('reports.minus', [
            'vessel' => $vessel,
        ]);
         }
        return redirect('/');
    }
    public function travels($id)
    {
        $vessel = Vessel::where('vessel_id', $id)->first();
        if($vessel ){
            $users = User::where('type', '1')->get();
            Notification::send($users, new SendNotifications(' تم الدخول على تقرير رحلات السيارات '.$vessel->name, auth()->user()->id));
        return view('reports.travels', [
            'vessel' => $vessel,
        ]);
         }
        return redirect('/');
    }
 //get  stats
    public function live()
    {
        $vessels = DB::table('vessels_log')
            ->select('*', 'qnt as quantity', 'archive as days', 'notes as hours', 'quay as minutes')
            ->where([['done', 0]])
            ->get();
    foreach ($vessels as $vessel) {
            $qnt_sum = DB::table('loading')
            ->select(DB::raw('SUM(jumbo) as total_jumbo'), DB::raw('SUM(qnt) as total_qnt'),  DB::raw('count(*) as count'))
            ->where([['vessel_id', $vessel->vessel_id]])
            ->whereNotNull('qnt_date')
            ->first();
            if ($qnt_sum->total_jumbo == 0 ) $qnt_sum->total_jumbo='';
            else $qnt_sum->total_jumbo= ' ('. $qnt_sum->total_jumbo.')';

            $move_count = DB::table('move')
            ->select( DB::raw('count(*) as moves_count'))
            ->where([['vessel_id', $vessel->vessel_id] ,[ 'arrival' , '1']])
            ->first();
            $car_count = DB::table('cars')
            ->select('*')
            ->where([['vessel_id', $vessel->vessel_id],['done', 0]])
            ->count(); 

            $vessel->quantity = number_format($qnt_sum->total_qnt, 3, '.', ''); 
            $vessel->archive = '('. $qnt_sum->count.')';
            $vessel->phones = $qnt_sum->total_jumbo;
            $vessel->notes = $move_count->moves_count;
            $vessel->done = $car_count;

        if ($vessel->done == 0) {
            $now = Carbon::now();
        } else {
            $now = $vessel->end_date;
        }

        $arrival =   DB::table('arrival')
            ->select('*')
            ->where([['vessel_id', $vessel->vessel_id]])
            ->orderby('id', 'asc')
            ->first();
        $vessel->hours = 0;
        if(isset($arrival->date)){

        $normal_date =strtotime($arrival->date);

        if($vessel->done == 1){
            $arrivals2 =   DB::table('arrival')
                ->select('*')
                ->where([['vessel_id', $vessel->vessel_id]])
                ->orderby('id', 'desc')
                ->first();

            $now = Carbon::parse($arrivals2->date);

        }else{
            $now = Carbon::now();
        }

        $normal_date0 = Carbon::parse($normal_date);
        $diff = $normal_date0->diff($now);

        $vessel->days = $diff->d *24;
        $vessel->hours = $diff->h + $vessel->days;
        $vessel->minutes = $diff->m;
    }
        }
    return view('reports.live2', [
            'vessels' => $vessels,
    ]);
    }
    public function carsAnalysis($id)
    {
        $cars = DB::table('cars')
            ->select('*', 'limits as moves_count', 'vacant as qnts',  'mehwer as avg', 'car_owner as status')
            ->where([['cars.vessel_id', $id]])
            ->orderby('id','asc')
            ->groupBy('car_no')
            ->get();
        $vessel = Vessel::where([['vessel_id', $id]])->first();

        if($vessel ){
        $total_cars = Car::where('vessel_id', $id)->groupBy('car_no')->get()->count();
        $active_cars = Car::where([['vessel_id', $id], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
        $toktok_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة توكتوك'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
        $qlab_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة قلاب'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
        $company_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة الشركة'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
        $grar_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة جرار'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
    
        $owners = Car::where('vessel_id', $id)->groupBy('car_owner')->get();
        $total_owners = $owners->count();
        foreach ($owners as $owner) {

            $count = DB::table('cars')
                ->select('*')
                ->where([['vessel_id', $id], ['car_owner', $owner->car_owner]])
                ->groupBy('car_no')
                ->get()->count();

                $owner->vacant =  $count;                 
        }

            foreach ($cars as $car) {
                  $car->moves_count = 0 ;
                   $car->qnts = 0 ;
                   $car->avg = 0;
                   $car->sn = '';
                    $cars_no = Car::where([['vessel_id', $id], ['car_no',$car->car_no]])->get();
                        $num = $cars_no->count() - 1;
                    for($i=0;$i < $cars_no->count(); $i++){
                            $car->sn .=  '  '.$cars_no[$i]->sn.'  ';
                        $moves = DB::table('move')
                        ->select(DB::raw('count(*) as moves_count'),DB::raw('sum(qnt) as qnts'))
                        ->where([['vessel_id', $id], ['sn', $cars_no[$i]->sn],  ['arrival', 1]])
                        ->get();

                        $car->moves_count +=  $moves[0]->moves_count;
                        $car->qnts +=  $moves[0]->qnts; 
                        if ($moves[0]->moves_count != 0) {
                            $car->avg +=   $moves[0]->qnts /  $moves[0]->moves_count; 
                        }else {
                            $car->avg = 0;
                        }
                        }

                        $car->qnts =  number_format($car->qnts, 3, '.', ''); 
                        $car->avg =   number_format($car->avg, 3, '.', ' '); 
                          $last = DB::table('cars')
            ->select('*', 'limits as moves_count', 'vacant as qnts',  'mehwer as avg')
            ->where([['cars.vessel_id', $id],['car_no', $car->car_no]])
            ->orderby('id','desc')
            ->get()->first();
                    if($last->exit_date == null){
                        $car->exit_date = '----------';
                        $car->status = 'ما زالت على الباخرة';
                    }else {
                        $car->exit_date =$last->exit_date;
                        $car->status = 'خرجت';
                    }
    
                    }
                

            $all_cost = DB::table('cars')
                ->select(DB::raw('sum(all_cost) as total_cost'))
                ->where([['vessel_id', $id]])
                ->get()->first();
                 $users = User::where('type', '1')->get();
            Notification::send($users, new SendNotifications(' تم الدخول على تقرير سيارات النقل '.$vessel->name, auth()->user()->id));
        return view('reports.carsAnalysis', [
            'cars' => $cars,
            'vessel' => $vessel,
            'total_cars' => $total_cars,
            'active_cars' => $active_cars,
            'toktok_cars' => $toktok_cars,
            'qlab_cars' => $qlab_cars,
            'company_cars' => $company_cars,
            'grar_cars' => $grar_cars,
            'total_owners' => $total_owners,
            'total_cost' => $all_cost->total_cost,
            'owners' => $owners,

        ]);
        }
             return redirect('/');
    }
    public function carAnalysis($car_no,$id)
    {
        $car_table = Car::where('id', $id)->get()->first();
        $vessel = Vessel::where([['vessel_id', $car_table->vessel_id]])->first();
            $cars = DB::table('cars')
                ->select('*', 'limits as moves_count', 'vacant as qnts',  'mehwer as avg', 'car_owner as status')
                ->where([['car_no', $car_no], ['vessel_id', $vessel->vessel_id]])
                ->orderby('id','asc')
                ->get();
             $num = $cars->count() - 1;
        if($cars ){
            $count =0;
            $qnt =0;
            $minus_sum =0;
            $arr=[];
        foreach ($cars as $car) {
          array_push( $arr, $car->sn);
        $qnts = DB::table('move')
                        ->select(DB::raw('SUM(qnt) as qnt'))
                        ->where([['vessel_id',  $car->vessel_id], ['sn', $car->sn],  ['arrival', 1]])
                        ->get()->first();
        $qnt += $qnts->qnt;
        
        $move = DB::table('move')
                        ->select('*')
                        ->where([['vessel_id',  $car->vessel_id], ['sn', $car->sn],  ['arrival', 1]])
                        ->get()->count();

        $count +=  $move;


        $minus = DB::table('minus')
                        ->select(DB::raw('SUM(TIME_TO_SEC(minus_duration)) as minus_sum'))
                        ->where([['vessel_id',  $car->vessel_id], ['sn', $car->sn]])
                        ->get()->first();

            $minus_sum  +=  $minus->minus_sum;
            $minus_minutes = $minus_sum / 60 % 60;
            $minus_hours =  $minus_sum / 3600 % 24;
            $minus_days =  $minus_sum / 86400 % 7 ;

            if( $car->exit_date == null)  $car->exit_date = '----------';

                }
                $loading = DB::table('loading')
                        ->select('date')
                        ->where([['vessel_id',   $vessel->vessel_id], ['sn', $cars[0]->sn]])
                        ->orderby('id','asc')
                        ->get()->first();

            $arrival = DB::table('arrival')
                        ->select('date')
                        ->where([['vessel_id',   $vessel->vessel_id], ['sn', $cars[$num]->sn]])
                        ->orderby('id','desc')
                        ->get()->first();

            $cars = DB::table('cars')
                        ->select('start_date')
                        ->where([['vessel_id',   $vessel->vessel_id], ['sn', $cars[0]->sn]])
                        ->orderby('id','desc')
                        ->get()->first();

            $start_date  = 0;
            $end_date  = 0 ;
            if(isset($loading->date)) $start_date =strtotime($loading->date);
            if(isset($arrival->date)) $end_date  =strtotime($arrival->date);
            $wait_date = $start_date - strtotime($cars->start_date)  ;
            $all_time = abs($end_date -$start_date) ;

            $all_hours =$all_time / 3600 ;
    
        $wait_hours = $wait_date / 3600 ;
        
        $moves = DB::table('move')
            ->select('*','hla1 as load_employee','hla2 as arrival_employee' , 'crane as duration')
            ->where('vessel_id',   $vessel->vessel_id)
            ->whereIn('sn',$arr)
            ->orderby('load_date', 'asc')
            ->get();



            foreach ($moves as $move) {
                $loading = DB::table('loading')
                        ->select('*')
                        ->where([['vessel_id',   $vessel->vessel_id], ['move_id', $move->move_id]])
                        ->get()->first(); 
                $arrival = DB::table('arrival')
                        ->select('*')
                        ->where([['vessel_id',   $vessel->vessel_id], ['move_id', $move->move_id]])
                        ->get()->first();
                if($loading) $move->load_employee =  $loading->ename;
                if($arrival) $move->arrival_employee =  $arrival->ename;
                
                if ($move->arrival == 1) {
                    $from = strtotime($move->arrival_date);
                    $to =     strtotime($move->load_date);
                    $diff =  $from - $to;
                    $day = $diff / 86400 % 7 . " " . "يوم";
                    $hour = $diff / 3600 % 24 . " " . "ساعة";
                    $minute = $diff / 60 % 60 . " " . "دقيقة";
                    if($diff / 86400 % 7 == 0 )    $day ='';
                    if($diff / 3600 % 24 == 0 )    $hour ='';
                    if($diff / 60 % 60 == 0 )    $minute ='';
                    $move->duration = $minute . " " . $hour . " " . $day;
                } elseif($move->arrival == 0) {
                    $to = Carbon::parse($move->load_date);
                    $to = strtotime($move->load_date);
                    $from =  strtotime(date("Y-m-d H:i:s"));
                    $diff =  $from - $to;
                    $day = $diff / 86400 % 7 . " " . "يوم";
                    $hour = $diff / 3600 % 24 . " " . "ساعة";
                    $minute = $diff / 60 % 60 . " " . "دقيقة";
                    if($diff / 86400 % 7 == 0 )    $day ='';
                    if($diff / 3600 % 24 == 0 )    $hour ='';
                    if($diff / 60 % 60 == 0 )    $minute ='';
                    $move->duration = $minute . " " . $hour . " " . $day;
                } 


        }
            $users = User::where('type', '1')->get();
            Notification::send($users, new SendNotifications(' تم الدخول على تقرير سيارة نقل '.$vessel->name, auth()->user()->id));
        return view('reports.carAnalysis', [
            'car' => $car,
            'count' => $count,
            'qnt' => $qnt,
            'minus_minutes' => $minus_minutes,
            'minus_hours' => $minus_hours,
            'minus_days' => $minus_days,
            'all_hours' => number_format((float)$all_hours, 3, '.', ''),
            'wait_hours' => number_format((float)$wait_hours, 3, '.', ''),
            'moves' => $moves,
            'vessel' => $vessel
        ]);
        }
            return redirect('/');
    }

    public function carOwners($id)
    {
        $owners = DB::table('cars')
            ->select('*')
            ->where([['vessel_id', $id]])
            ->groupBy('car_owner')
            ->get();
        $vessel = Vessel::where([['vessel_id', $id]])->first();
        $total_owners = $owners->count();
        foreach ($owners as $owner) {

            $count = DB::table('cars')
                ->select('*')
                ->where([['vessel_id', $id], ['car_owner', $owner->car_owner]])
                ->groupBy('car_no')
                ->get()->count();

                $owner->vacant =  $count;                 
        }
        foreach ($owners as $car_owner) {

            $car_owner_cars = DB::table('cars')
                ->select('*')
                ->where([['vessel_id', $id], ['car_owner', $car_owner->car_owner]])
                ->get();

                $moves_count = 0;
                $qnts = 0;

                foreach ($car_owner_cars as $car) {
                    $moves = DB::table('move')
                        ->select(DB::raw('count(*) as moves_count'),DB::raw('sum(qnt) as qnts'))
                        ->where([['vessel_id', $id], ['sn', $car->sn],  ['arrival', 1]])
                        ->get();

                        $moves_count +=  $moves[0]->moves_count;
                        $qnts +=  $moves[0]->qnts;
                }
          
                $count = DB::table('cars')
                ->select('*')
                ->where([['vessel_id', $id], ['car_owner', $car_owner->car_owner]])
                ->groupBy('car_no')
                ->get()->count();

                $car_owner->limits =  $count;
                $car_owner->all_cost =  $moves_count;
                $car_owner->mehwer = $qnts;
                 
        }
        if($vessel ){
            $total_cars = Car::where('vessel_id', $id)->groupBy('car_no')->get()->count();
            $active_cars = Car::where([['vessel_id', $id], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
            $toktok_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة توكتوك'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
            $qlab_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة قلاب'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
            $company_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة الشركة'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
            $grar_cars = Car::where([['vessel_id', $id], ['car_type', 'سيارة جرار'], ['done', $vessel->done]])->groupBy('car_no')->get()->count();
            $all_cost = DB::table('cars')
                ->select(DB::raw('sum(all_cost) as total_cost'))
                ->where([['vessel_id', $id]])
                ->get()->first();
            $users = User::where('type', '1')->get();
            Notification::send($users, new SendNotifications(' تم الدخول على حساب تكاليف النقل   '.$vessel->name, auth()->user()->id));
            return view('reports.carOwners', [
                'owners' => $owners,
                'vessel' => $vessel,
                'total_cars' => $total_cars,
                'active_cars' => $active_cars,
                'toktok_cars' => $toktok_cars,
                'qlab_cars' => $qlab_cars,
                'company_cars' => $company_cars,
                'grar_cars' => $grar_cars,
                'total_owners' => $total_owners,
                'total_cost' => $all_cost->total_cost,
                
            ]);
        }
        return redirect('/');
    }

      public function carOwner($car_owner, $vessel_id)
    {
        $vessel = Vessel::where([['vessel_id', $vessel_id]])->first();
        $all_cost = DB::table('cars')
        ->select(DB::raw('sum(all_cost) as total_cost'))
        ->where([['vessel_id', $vessel_id],['car_owner', $car_owner]])
        ->get()->first();
        $cars = DB::table('cars')
                ->select('*', 'limits as moves_count', 'vacant as qnts')
                ->where([['car_owner', $car_owner], ['vessel_id', $vessel->vessel_id]])
                ->groupby('car_no')
                ->get();
        $car_owner = DB::table('cars')
                ->select('*', 'limits as count', 'vacant as qnt')
                ->where([['car_owner', $car_owner], ['vessel_id', $vessel->vessel_id]])
                ->groupby('car_no')
                ->get()->first();
        $moves_count =0;
        $qnts =0;
        foreach ($cars as $car) {
            $cars_no = Car::where([['vessel_id', $vessel_id], ['car_no',$car->car_no]])->get();
            $car->sn = '';
            $car->moves_count = 0 ;
            $car->qnts = 0 ;
            for($i=0;$i < $cars_no->count(); $i++){
                
                        $car->sn .=  '  '.$cars_no[$i]->sn.'  ';
                        $moves = DB::table('move')
                        ->select(DB::raw('count(*) as moves_count'),DB::raw('sum(qnt) as qnts'))
                        ->where([['vessel_id', $vessel_id], ['sn', $cars_no[$i]->sn],  ['arrival', 1]])
                        ->get();
                       
                        $car->moves_count +=  $moves[0]->moves_count; 
                        $car->qnts +=  $moves[0]->qnts; 
                        $moves_count += $moves[0]->moves_count; 
                        $qnts += $moves[0]->qnts; 
                    
            }
        }    
        $car_owner->count = $moves_count ;
        $car_owner->qnt =  $qnts ;
        $num = $cars->count() - 1;
        if($cars ){
       
        $users = User::where('type', '1')->get();
        Notification::send($users, new SendNotifications(' تم الدخول على تقرير مقاول  نقل '.$vessel->name, auth()->user()->id));
        return view('reports.carOwner', [
            'cars' => $cars,
            'car_owner' => $car_owner,
            'vessel' => $vessel,
            'total_cost' => $all_cost->total_cost
        ]);
        }
            return redirect('/');
    }
}   