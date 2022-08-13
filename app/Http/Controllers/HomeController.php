<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\Slot;
use App\Models\Infraction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $space = Slot::findOrFail(1)->capasity;
        
        $ongoing = Parking::where('clockout', null)->count();

        $empty = $space - $ongoing;

        $infractions = Infraction::get()->sortByDesc("updated_at");
        $disposisi = Infraction::get()->where('status', '=', 'disposisi')->sortByDesc("updated_at")->count();
        $draft = Infraction::get()->where('status', '=', 'draft')->sortByDesc("created_at")->count();
        $pelanggaran = Infraction::get()->where('status', '=', 'pelanggaran')->sortByDesc("updated_at")->count();
        $sp1 = Infraction::get()->where('status', '=', 'sp1')->sortByDesc("updated_at")->count();
        $sp2 = Infraction::get()->where('status', '=', 'sp2')->sortByDesc("updated_at")->count();
        $sp3 = Infraction::get()->where('status', '=', 'sp3')->sortByDesc("updated_at")->count();
        $sp3 = Infraction::get()->where('status', '=', 'sp3')->sortByDesc("updated_at")->count();
        $ditolak = Infraction::get()->where('status', '=', 'ditolak')->sortByDesc("updated_at")->count();
        $infractionCount = $infractions->count();
        
        return view('pages.home', compact('draft', 'pelanggaran', 'sp1', 'infractionCount', 'disposisi', 'sp2', 'sp3', 'ditolak'));
    }

    public function chartMontly(Request $request) {
        $months = (array) [
            "January" => 0,
            "February" => 0,
            "March" => 0,
            "April" => 0,
            "May" => 0,
            "June" => 0,
            "July" => 0,
            "August" => 0,
            "September" => 0,
            "October" => 0,
            "November" => 0,
            "December" => 0,

        ];
        $monthData = Infraction::select(\DB::raw("COUNT(*) as count"), \DB::raw("MONTHNAME(created_at) as month_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count', 'month_name');

        foreach($monthData as $index => $m){
            $months[$index] = $m;
        }

        
        
        return response()->json([
            // 'label' => $labels,
            'data' => (array) $months
        ]);
    }

    public function chartWeekly(Request $request){

        $weeks = (array) [
            "Minggu 1" => 0,
            "Minggu 2" => 0,
            "Minggu 3" => 0,
            "Minggu 4" => 0
        ];


        $weekData = Infraction::select(
            \DB::raw("WEEK(created_at) as week"),
            \DB::raw("COUNT(created_at) as total"),
        )
        ->groupBy('week')
        ->orderBy('week', 'ASC')
        ->get();

        foreach($weekData as $index => $w){
            $weeks["Minggu ".((int)$index + 1)] =  intval($w->total);
        }

        return response()->json([
            // 'label' => $labels,
            'data' => (array) $weeks
        ]);
    
    }
}
