<?php

namespace App\Exports;

use App\Models\Parking;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $start_date, $end_date;

    function __construct($start_date = null, $end_date = null){
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function view():View
    {
        $reports = Parking::orderBy('clockin', 'DESC')->get();
        $current_date = \Carbon\Carbon::now()->format("d M Y H:i:s");

        $start_date = $this->start_date;
        $end_date = $this->end_date;

        if($this->start_date != null){
            $reports = Parking::whereBetween('clockin',[$this->start_date,$this->end_date])->orderBy('clockin', 'DESC')->get();
        }

        return view('pages.report.print.excel', compact('reports', 'current_date', "start_date", "end_date"));
        
    }
}
