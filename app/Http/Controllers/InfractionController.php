<?php

namespace App\Http\Controllers;

use App\Mail\InfractionMail;
use App\Models\Infraction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class InfractionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $infractions = Infraction::get()->sortByDesc("id");

        return view('pages.infraction.index',  compact('infractions'));


        
    }

    public function index_admin()
    {
        //
        $infractions = Infraction::get()->sortByDesc("id");

        return view('pages.admin_infraction.index', compact('infractions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.infraction.create');
    }

    public function create_admin()
    {
        return view('pages.admin_infraction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'phone' => 'required|min:10',
            'di' => 'required',
            'jp' => 'required',
            'pelapor_name' => 'required',
            'foto' => 'required|image|file|max:3024'
        ];

        $message = [
            'required' => ':attribute ini tidak boleh kosong',
            'min' => ':attribute minimal karakter :min',
            'max' => ':attribute max :max MB',
        ];

        $this->validate($request, $rules, $message);


        $file_photo = $request->file('foto')->store('post-images');
        Infraction::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'di' => $request->di,
            'kordinat' => $request->kordinat,
            'jp' => $request->jp,
            'foto' => $file_photo,
            'status' => $request->status,
            'pelapor_name' => $request->pelapor_name,
            
        ]);

        $detail = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'di' => $request->di,
            'kordinat' => $request->kordinat,
            'jp' => $request->jp,
            'status' => $request->status,
            'pelapor_name' => $request->pelapor_name,
        ];

        $emails = ['sp.dentalcaries@gmail.com', 'ariabghf@gmail.com'];

        Mail::to($emails)->send(new InfractionMail($detail));

        return redirect()->route('infraction')->with('success', "User berhasil ditambahkan");
    }

    public function store_admin(Request $request)
    {
        //
        // dd($request);
        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'phone' => 'required|min:10',
            'di' => 'required',
            'jp' => 'required',
            'pelapor_name' => 'required',
            'foto' => 'image|file|max:3024'
        ];

        $message = [
            'required' => ':attribute ini tidak boleh kosong',
            'min' => ':attribute minimal karakter :min',
            'max' => ':attribute max :max MB',
        ];

        $this->validate($request, $rules, $message);

        $file_photo = $request->file('foto')->store('post-images');
        Infraction::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'di' => $request->di,
            'kordinat' => $request->kordinat,
            'jp' => $request->jp,
            'foto' => $file_photo,
            'status' => $request->status,
            'pelapor_name' => $request->pelapor_name,
            
        ]);

        return redirect()->route('admin_infraction')->with('success', "Data berhasil di tambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\infraction  $infraction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $infraction = Infraction::findOrFail($id);

        return view('pages.infraction.show', compact('infraction'));
    }


    public function show_admin($id)
    {
        //
        $infraction = Infraction::findOrFail($id);

        return view('pages.admin_infraction.show', compact('infraction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\infraction  $infraction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $infraction = Infraction::findOrFail($id);

        return view('pages.admin_infraction.edit', compact('infraction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\infraction  $infraction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $infractions = Infraction::findOrFail($id);
        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'phone' => 'required|min:10',
            'jp' => 'required',
            'pelapor_name' => 'required',
            'foto' => 'image|file|max:3024'
        ];

        $message = [
            'required' => ':attribute ini tidak boleh kosong',
            'min' => ':attribute minimal karakter :min',
            'max' => ':attribute max :max MB',
        ];

        $this->validate($request, $rules, $message);

        $foto = $infractions->foto;
        if ($request->foto) {
            $foto = $request->file('foto')->store('post-images');
            $foto_path = $infractions->foto;
            if (Storage::exists($foto_path)) {
                Storage::delete($foto_path);
            }
        }

        $infraction = Infraction::findOrFail($id);
        $infraction->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'di' => $request->di,
            'kordinat' => $request->kordinat,
            'jp' => $request->jp,
            'foto' =>  $foto,
            'status' => $request->status,
            'pelapor_name' => $request->pelapor_name,
        ]);

        return redirect()->route('admin_infraction')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\infraction  $infraction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $infraction = Infraction::findOrFail($id);
        $infraction->delete();

        return redirect()->route('admin_infraction')->with('success', 'Data  berhasil dihapus');
    }

    public function printReceipt($id){
        $infraction = Infraction::findOrFail($id);
        
        return view('barcode.infraction', compact('infraction'));
    }
}
