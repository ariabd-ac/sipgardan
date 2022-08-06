<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\Rate;
use App\Models\Slot;
use PDF;

class ParkingController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $parkings = Parking::orderBy('barcode')->get();

        $space = Slot::findOrFail(1)->capasity;
        
        $ongoing = Parking::where('clockout', null)->count();

        $empty = $space - $ongoing;

        return view('pages.parking.index', compact('parkings', 'space', 'ongoing', 'empty'));
    }

    public function create(){
        $space = Slot::findOrFail(1)->capasity;
        
        $ongoing = Parking::where('clockout', null)->count();

        $empty = $space - $ongoing;

        return view('pages.parking.create',compact('space', 'ongoing', 'empty'));
    }

    public function store(Request $request){
        $rules = [
            'motorcycle_plate' => 'required',
            'driver_name' => 'required',
            'phone_number' => 'required|min:10',
        ];

        $message = [
            'required' => ':attribute ini tidak boleh kosong',
            'min' => ':attribute minimal karakter :min'
        ];

        $this->validate($request, $rules, $message);

        $barcode = date('YmdHis');

        $clockin = date("Y-m-d H:i:s");

        $parking = Parking::create([
            'barcode' => $barcode,
            'motorcycle_plate' => $request->motorcycle_plate,
            'driver_name' => $request->driver_name,
            'phone_number' => $request->phone_number,
            'clockin' => $clockin
        ]);

        return redirect()->route('parking.show', $parking->id)->with('success', 'Data parkir berhasil ditambahkan');

        
    }

    public function show($id){
        $parking = \App\Models\Parking::findOrFail($id);

        return view('pages.parking.show', compact('parking'));
    }

    public function printReceipt($id){
        $parking = \App\Models\Parking::findOrFail($id);
        
        return view('barcode.index', compact('parking'));
    }

    public function checkoutParkingView(Request $request) {
        $barcode = $request->barcode;
        $parking = \App\Models\Parking::where('barcode', $barcode)->first();

        if($parking){
            if($parking->clockout == null) {
                $current = date('Y-m-d H:i:s');
            
                $duration_minute = round(abs(strtotime($current) - strtotime($parking->clockin)) / 60);

        
                $t1 = \Carbon\Carbon::parse($parking->clockin);
                $t2 = \Carbon\Carbon::parse($current);
                $duration = $t1->diff($t2);
        
                // dd($duration);
        
                $price = 0;

                if($duration_minute <= 360){
                    $price = 3000;
                }else if($duration_minute > 360 && $duration_minute <= 720){
                    $price = 5000;
                }else if($duration_minute > 720 && $duration_minute <= 1440){
                    $price = 10000;
                }else{
                    $clockin = strtotime($parking->clockin);
                    $diff = strtotime($current) - $clockin;
                    $price = ceil($diff / (60 * 60 * 24)) * (int) "10000";
                    // if($duration_minute <= 1440 && $duration_minute > 720){
                    //     $price = 5000;
                    // }else{
                    //     $clockin = strtotime($parking->clockin);
                    //     $diff = strtotime($current) - $clockin;
                    //     $price = ceil($diff / (60 * 60 * 24)) * (int) "5000";
                    // }
                }
        
                return view('pages.parking.checkout', compact('parking', 'price', 'current', 'duration'));
            }else{
                return redirect()->route('parking.show', $parking->id);
            }
        }else{
            return redirect()->back()->with("error", "Data tidak ditemukan atau pastikan data yang di scan atau dimasukan benar");
        }


        

        
    }

    public function checkOut(Request $request, $id) {
        $rules = [
            'payment' => 'required',
            'change' => 'required',
        ];

        $messages = [
            'required' => 'Form ini harus diisi'
        ];

        $this->validate($request, $rules, $messages);

        $removePaymentDots  = str_replace(".", "", $request->payment);
        $payment = str_replace("Rp ", "", $removePaymentDots);

        $removeChangeDots  = str_replace(".", "", $request->change);
        $change = str_replace("Rp ", "", $removeChangeDots);

        $parking = Parking::findOrFail($id);

        $parking -> update([
            'clockout' => $request->clockout,
            'duration' => $request->duration,
            'amount' => $request->amount,
            'payment' => $payment,
            'change' => $change,
        ]);

        return redirect()->route('parking.show',$id)->with("success", "Data berhasil terupdate");
    }

    public function edit($id){
        $parking = Parking::findOrFail($id);

        $parkings = Parking::orderBy('barcode')->get();

        $space = Slot::findOrFail(1)->capasity;
        
        $ongoing = Parking::where('clockout', null)->count();

        $empty = $space - $ongoing;

        return view('pages.parking.edit', compact('parking', 'space', 'ongoing', 'empty'));
    }

    public function update(Request $request, $id){
        $rules = [
            'motorcycle_plate' => 'required',
            'driver_name' => 'required',
            'phone_number' => 'required|min:10',
        ];

        $message = [
            'required' => ':attribute ini tidak boleh kosong',
            'min' => ':attribute minimal karakter :min'
        ];

        $this->validate($request, $rules, $message);

        $parking = Parking::findOrFail($id);
        $parking->update([
            'motorcycle_plate' => $request->motorcycle_plate,
            'driver_name' => $request->driver_name,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('parking')->with('success', 'Data parkir berhasil diubah');
    }

    public function destroy($id){
        $parking = Parking::findOrFail($id);
        $parking->delete();

        return redirect()->route('parking')->with('success', 'Data parkir berhasil dihapus');
    }
}
