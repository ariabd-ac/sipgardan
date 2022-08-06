<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;

class RateController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $rates = Rate::orderBy('created_at')->get();
        return view('pages.rate.index', compact('rates'));
    }

    public function create(){
        return view('pages.rate.create');
    }

    public function store(Request $request){
        $rules = [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
        ];

        $message = [
            'required' => 'Form ini harus diisi',  
        ];

        $this->validate($request, $rules, $message);

        $removeDots  = str_replace(".", "", $request->price);
        $price = str_replace("Rp ", "", $removeDots);

        Rate::create([
            'name' => $request->name,
            'price' => $price,
            'status' => 1
        ]);

        return redirect()->route('rate')->with('success', 'Tarif berhasil ditambahkan');
    }

    public function edit($id){
        $rate = Rate::findOrFail($id);

        return view('pages.rate.edit', compact('rate'));
    }


    public function update(Request $request, $id){
        $rate = Rate::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
        ];

        $message = [
            'required' => 'Form ini harus diisi',  
        ];

        $this->validate($request, $rules, $message);

        $removeDots  = str_replace(".", "", $request->price);
        $price = str_replace("Rp ", "", $removeDots);

        $rate->update([
            'name' => $request->name,
            'price' => $price,
            'status' => $rate->status
        ]);

        return redirect()->route('rate')->with('success', 'Tarif berhasil diubah');
    }

    public function destroy($id){
        $rate = Rate::findOrFail($id);

        $rate->delete();

        return redirect()->route('rate')->with('success', 'Tarif berhasil dihapus');
    }

    public function changeStatus($id){
        $rate = Rate::findOrFail($id);

        $rate->update([
            'status' => $rate->status == '1' ? 0 : 1
        ]);

        return redirect()->route('rate')->with('success', "Status tarif berhasil diubah");
    }
}
