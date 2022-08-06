<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;

class ReportController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $reports = Parking::orderBy('clockin', "DESC")->get();

        if($start_date && $end_date){
            $reports = Parking::whereBetween('clockin', [$start_date." 00:00:00", $end_date." 23:59:00"])->orderBy('clockin', "DESC")->get();
        }

        
        return view('pages.report.index', compact("reports"));
    }

    public function printPDF(Request $request){
        $current_date = \Carbon\Carbon::now()->format("d M Y H:i:s");

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $reports = Parking::orderBy('clockin', "DESC")->get();

        if($start_date && $end_date){
            $reports = Parking::whereBetween('clockin', [$start_date." 00:00:00", $end_date." 23:59:00"])->orderBy('clockin', "DESC")->get();
        }

        $pdf = PDF::loadview("pages.report.print.pdf", compact("reports", "current_date", "start_date", "end_date"))->setPaper('A4')->setOption("footer-left", $current_date);

        return $pdf->download("Laporan-".$current_date.".pdf");
    }

    public function printExcel(Request $request) {
        $current_date = \Carbon\Carbon::now()->format("d M Y H:i:s");

        if($request->start_date){
            return Excel::download(new ReportExport($request->start_date." 00:00:00", $request->end_date." 23:59:00"), 'Laporan '.$current_date.'.xlsx');
        }
        return Excel::download(new ReportExport, 'Laporan '.$current_date.'.xlsx');
    }
}
