<?php

namespace App\Http\Controllers;

use App\Mail\InfractionMail;
use App\Models\Infraction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Snowfire\Beautymail\Beautymail;

class InfractionController extends Controller
{

    // public function __construct(){
    //     $this->middleware(['auth']);
    // }

    public function downloadSP1($id, $type)
    {
        $infraction = Infraction::findOrFail($id);

        $path = public_path($infraction->{$type});
            return response()->download("storage/{$infraction->{$type}}");

        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // //
        // $infractions = Infraction::get()->sortByDesc("id");

        // return view('pages.infraction.index',  compact('infractions'));

        // dd(request(('search')));

        return view('pages.infraction.index', [
            "infractions" => Infraction::latest()->filter()->get()
            // "infractions" => Infraction::get()->sortByDesc("id")->filter(request(['search']))
        ]);

        
    }

    public function index_admin()
    {
        //
        $infractions = Infraction::get()->sortByDesc("updated_at");

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
        $sender = '6285156930294';
        $api_key = 'qVLb8aRTYZC8MUFxsNFz0zUW3U5xeX';
        $URL = 'https://wa-md.sip-gardan.com/send-message';

        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'phone' => 'required|min:10',
            'di' => 'required',
            'jp' => 'required',
            'pelapor_name' => 'required',
            'kordinat' => 'required',
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

        // ==================================================================================
        // SEND WA KE KEPALA

        $msg = "SIP-GARDAN PELANGGARAN NOTIFICATION 
        \r\n NAMA : {$request->nama} 
        \r\n STATUS : {$request->status}
        \r\n NO TELFON :  {$request->phone}
        \r\n DAERAH IRIGASI :  {$request->di}
        \r\n KORDINAT : {$request->kordinat}
        \r\n JENIS PELANGGARAN : {$request->jp}
        \r\n PELAPOR : {$request->pelapor_name}";

        $data = [
            'api_key' =>  $api_key,
            'sender'  => $sender,
            'number'  => '6283113729917',
            'message' => $msg
        ];

     

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        echo $response;
        // var_dump($data);
        // die;

        // ==================================================================================

        // SEND KE 2 WA KE ADMIN
    
        $data2 = [
            'api_key' =>  $api_key,
            'sender'  => $sender,
            'number'  => '6285747066664',
            'message' => $msg
        ];
        
        $curl2 = curl_init();
        curl_setopt_array($curl2, array(
        CURLOPT_URL => $URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS => json_encode($data2),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
            ),
        ));

        $response2 = curl_exec($curl2);
        curl_close($curl2);

        echo $response2;

        // ==================================================================================
        // SEND WA KE PELAPOR

        $data3 = [
            'api_key' =>  $api_key,
            'sender'  => $sender,
            'number'  => $request->phone,
            'message' => $msg
        ];
        
        $curl3 = curl_init();
        curl_setopt_array($curl3, array(
        CURLOPT_URL => $URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS => json_encode($data3),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
            ),
        ));

        $response3 = curl_exec($curl3);

        curl_close($curl3);
        echo $response3;

        // ==================================================================================

        // KIRIM EMAILL KE KEPALA & ADMIN


        // Mail::to($emails)->send(new InfractionMail($detail));
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.infraction',[
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'di' => $request->di,
            'kordinat' => $request->kordinat,
            'jp' => $request->jp,
            'status' => $request->status,
            'pelapor_name' => $request->pelapor_name,
        ], 
        function($message){
        $emails = ['idprimadona@gmail.com', 'ariabghf@gmail.com'];
            $message
                ->from('ariabghufron@gmail.com')
                ->to($emails)
                ->subject('SIP-GARDAN!');
        }
    );

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
        $sender = '6285156930294';
        $api_key = 'qVLb8aRTYZC8MUFxsNFz0zUW3U5xeX';
        $URL = 'https://wa-md.sip-gardan.com/send-message';

        $infractions = Infraction::findOrFail($id);
        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'phone' => 'required|min:10',
            'jp' => 'required',
            'pelapor_name' => 'required',
            'foto' => 'image|file|max:3024',
            'sp1' => 'file|max:3024',
            'sp2' => 'file|max:3024',
            'sp3' => 'file|max:3024',
            'bukti_pelanggaran' => 'file|max:3024',
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

        $sp1 = $infractions->sp1;
        if ($request->sp1) {
            $sp1 = $request->file('sp1')->store('sp1');
            $sp1_path = $infractions->sp1;
            if (Storage::exists($sp1_path)) {
                Storage::delete($sp1_path);
            }
        }

        $sp2 = $infractions->sp2;
        if ($request->sp2) {
            $sp2 = $request->file('sp2')->store('sp2');
            $sp2_path = $infractions->sp2;
            if (Storage::exists($sp2_path)) {
                Storage::delete($sp2_path);
            }
        }

        $sp3 = $infractions->sp3;
        if ($request->sp3) {
            $sp3 = $request->file('sp3')->store('sp3');
            $sp3_path = $infractions->sp3;
            if (Storage::exists($sp3_path)) {
                Storage::delete($sp3_path);
            }
        }

        $bukti_pelanggaran = $infractions->bukti_pelanggaran;
        if ($request->bukti_pelanggaran) {
            $bukti_pelanggaran = $request->file('bukti_pelanggaran')->store('bukti');
            $bukti_pelanggaran_path = $infractions->bukti_pelanggaran;
            if (Storage::exists($bukti_pelanggaran_path)) {
                Storage::delete($bukti_pelanggaran_path);
            }
        }


        $msg = "SIP-GARDAN PELANGGARAN NOTIFICATION 
        \r\n NAMA : {$request->nama} 
        \r\n STATUS : {$request->status}
        \r\n NO TELFON :  {$request->phone}
        \r\n DAERAH IRIGASI :  {$request->di}
        \r\n KORDINAT : {$request->kordinat}
        \r\n JENIS PELANGGARAN : {$request->jp}
        \r\n PELAPOR : {$request->pelapor_name}";

        // IF STATUS DISPOSISI KIRIM EMAIL & WA KE KASI
        if ($request->status == 'disposisi') {
           
            // ======================================================================================
            // KIRIM WA KE KA
            $data = [
                'api_key' =>  $api_key,
                'sender'  => $sender,
                'number'  => '6283113729917',
                'message' => $msg
            ];
    
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
                ),
            ));
    
            $response = curl_exec($curl);
            curl_close($curl);
    
            echo $response;

            // ======================================================================================

            // KIRIM WA KE KASI
            $data2 = [
                'api_key' =>  $api_key,
                'sender'  => $sender,
                'number'  => '6285747066664',
                'message' => $msg
            ];
            
            $curl2 = curl_init();
            curl_setopt_array($curl2, array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => json_encode($data2),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
                ),
            ));
    
            $response2 = curl_exec($curl2);
            curl_close($curl2);
    
            echo $response2;
            // ======================================================================================

            // SEND WA KE PELAPOR

            $data3 = [
                'api_key' =>  $api_key,
                'sender'  => $sender,
                'number'  => $request->phone,
                'message' => $msg
            ];
            
            $curl3 = curl_init();
            curl_setopt_array($curl3, array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => json_encode($data3),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
                ),
            ));
    
            $response3 = curl_exec($curl3);
    
            curl_close($curl3);
            echo $response3;
            // ======================================================================================


            // KIRIM EMAIL KE KEPALA DAN KASI
            $beautymail = app()->make(Beautymail::class);
            $beautymail->send('emails.infraction',[
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'phone' => $request->phone,
                'di' => $request->di,
                'kordinat' => $request->kordinat,
                'jp' => $request->jp,
                'status' => $request->status,
                'pelapor_name' => $request->pelapor_name,
            ], 
            function($message){
            $emails = ['idprimadona@gmail.com', 'ariabghf@gmail.com'];
                $message
                    ->from('ariabghufron@gmail.com')
                    ->to($emails)
                    ->subject('SIP-GARDAN!');
                }

            
            );
            // ======================================== 
        }

        // IF SETATU PELANGGARAN KIRIM EMAIL KE ADMIN KEMBALI
        if ($request->status == 'pelanggaran' || $request->status == 'ditolak') {
            $rules_disposisi = [
                'keterangan_disposisi' => 'required',
            ];
    
            $message_disposisi = [
                'required' => ':attribute ini tidak boleh kosong',
                'min' => ':attribute minimal karakter :min',
                'max' => ':attribute max :max MB',
            ];
    
            $this->validate($request, $rules_disposisi, $message_disposisi);

            $infraction = Infraction::findOrFail($id);
            $infraction->update([
                'disposisi_datetime' => date('Y-m-d H:i:s'),
                'keterangan_disposisi' => $request->keterangan_disposisi,
            ]);

            // KIRIM WA KE KA
            // ======================================================================================
            // KIRIM WA KE KA
            $data = [
                'api_key' =>  $api_key,
                'sender'  => $sender,
                'number'  => '6283113729917',
                'message' => $msg
            ];
    
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
                ),
            ));
    
            $response = curl_exec($curl);
            curl_close($curl);
    
            echo $response;

            // ======================================================================================

            // KIRIM WA KE KASI
            $data2 = [
                'api_key' =>  $api_key,
                'sender'  => $sender,
                'number'  => '6285747066664',
                'message' => $msg
            ];
            
            $curl2 = curl_init();
            curl_setopt_array($curl2, array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => json_encode($data2),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
                ),
            ));
    
            $response2 = curl_exec($curl2);
            curl_close($curl2);
    
            echo $response2;
            // ======================================================================================

            // SEND WA KE PELAPOR

            $data3 = [
                'api_key' =>  $api_key,
                'sender'  => $sender,
                'number'  => $request->phone,
                'message' => $msg
            ];
            
            $curl3 = curl_init();
            curl_setopt_array($curl3, array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => json_encode($data3),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
                ),
            ));
    
            $response3 = curl_exec($curl3);
    
            curl_close($curl3);
            echo $response3;
            // ======================================================================================

            $beautymail = app()->make(Beautymail::class);
            $beautymail->send('emails.infraction',[
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'phone' => $request->phone,
                'di' => $request->di,
                'kordinat' => $request->kordinat,
                'jp' => $request->jp,
                'status' => $request->status,
                'pelapor_name' => $request->pelapor_name,
            ], 
            function($message){
            $emails = ['idprimadona@gmail.com', 'ariabghf@gmail.com'];
                $message
                    ->from('ariabghufron@gmail.com')
                    ->to($emails)
                    ->subject('SIP-GARDAN!');
            }
            );

        }
        
        // IF SETATUS SP KIRIM EMAIL KE KA BALAI / SATPOL KEMBALI
        if ($request->status == 'sp1' || $request->status == 'sp2' || $request->status == 'sp3') {
            // KIRIM WA KE KA
            $data = [
                'api_key' =>  $api_key,
                'sender'  => $sender,
                'number'  => '6283113729917',
                'message' => $msg
            ];
    
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
                ),
            ));
    
            $response = curl_exec($curl);
            curl_close($curl);
    
            echo $response;

            // =========================================================================

            // KIRIM WA KE ADMIN
            $data2 = [
                'api_key' =>  $api_key,
                'sender'  => $sender,
                'number'  => '6285747066664',
                'message' => $msg
            ];
            
            $curl2 = curl_init();
            curl_setopt_array($curl2, array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => json_encode($data2),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
                ),
            ));
    
            $response2 = curl_exec($curl2);
            curl_close($curl2);
    
            echo $response2;


            // SEND WA KE PELAPOR

            $data3 = [
                'api_key' =>  $api_key,
                'sender'  => $sender,
                'number'  => $request->phone,
                'message' => $msg
            ];
            
            $curl3 = curl_init();
            curl_setopt_array($curl3, array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => json_encode($data3),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
                ),
            ));
    
            $response3 = curl_exec($curl3);
    
            curl_close($curl3);
            echo $response3;

            // ======================================


            $beautymail = app()->make(Beautymail::class);
            $beautymail->send('emails.infraction',[
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'phone' => $request->phone,
                'di' => $request->di,
                'kordinat' => $request->kordinat,
                'jp' => $request->jp,
                'status' => $request->status,
                'pelapor_name' => $request->pelapor_name,
            ], 
            function($message){
            $emails = ['idprimadona@gmail.com', 'ariabghf@gmail.com'];
                $message
                    ->from('ariabghufron@gmail.com')
                    ->to($emails)
                    ->subject('SIP-GARDAN!');
            }
            );

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
            'sp1' => $sp1,
            'sp2' => $sp2,
            'sp3' => $sp3,
            'bukti_pelanggaran' => $bukti_pelanggaran,
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
