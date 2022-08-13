<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\InfractionController;

use Rawilk\Printing\Receipts\ReceiptPrinter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.app');
// });

Auth::routes();


// email
Route::get('/send-email', [App\Http\Controllers\MailController::class, 'sendEmail']);
Route::get('/test', function()
{
	$msg = "SIP-GARDAN PELANGGARAN NOTIFICATION 
	\r\n NAMA : A
	\r\n STATUS : A
	\r\n NO TELFON :  A
	\r\n DAERAH IRIGASI :  A
	\r\n KORDINAT : A
	\r\n JENIS PELANGGARAN : A
	\r\n PELAPOR : A";

	$data = [
		'api_key' => 'b2d95af932eedb4de92b3496f338aa5f97b36ae0',
		'sender'  => '6285156930294',
		'number'  => '6283113729917',
		'message' => $msg
	];

		// $curl = curl_init();
		// curl_setopt_array($curl, array(
		// CURLOPT_URL => "https://wa.sip-gardan.com/app/",
		// CURLOPT_RETURNTRANSFER => true,
		// CURLOPT_ENCODING => "",
		// CURLOPT_MAXREDIRS => 10,
		// CURLOPT_TIMEOUT => 0,
		// CURLOPT_FOLLOWLOCATION => true,
		// // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		// CURLOPT_CUSTOMREQUEST => "POST",
		// CURLOPT_SSL_VERIFYHOST => false,
		// CURLOPT_SSL_VERIFYPEER => false,
		// CURLOPT_POSTFIELDS => json_encode($data))
		// );

		// $response = curl_exec($curl);

		// curl_close($curl);
		// echo $response;

	

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://wa.sip-gardan.com/app/"');

		// save cookies to 'public/cookie.txt' you can change this later.
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');

		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

		curl_exec($ch);

		// supply cookie with request
		// curl_setopt($ch, CURLOPT_COOKIE, 'cookie.txt');

		// // the url you would like to visit
		// curl_setopt($ch, CURLOPT_URL, 'https://example.net/profile/');

		$content = curl_exec($ch);

		curl_close($ch);

		var_dump($content);
		die;

		// webpage will be displayed in your browser
		return;

});

// download
Route::get('/download/${id}/type/${type}', [App\Http\Controllers\InfractionController::class, 'downloadSP1'])->name('infraction.download');

// user
Route::get('/infractions', [App\Http\Controllers\InfractionController::class, 'index'])->name('infraction');
Route::get('/infraction/{id}',[App\Http\Controllers\InfractionController::class, 'show'])->name('infraction.show');
Route::get('/add',[App\Http\Controllers\InfractionController::class, 'create'])->name('infraction.create');
Route::post('/infractions/store',[App\Http\Controllers\InfractionController::class, 'store'])->name('infraction.store');

// admin
Route::get('/admin_infractions', [App\Http\Controllers\InfractionController::class, 'index_admin'])->name('admin_infraction');
Route::get('/admin_infractions/create', [App\Http\Controllers\InfractionController::class, 'create_admin'])->name('admin_infraction.create');
Route::post('/admin_infractions/store',[App\Http\Controllers\InfractionController::class, 'store_admin'])->name('admin_infraction.store');
Route::get('/admin_infractions/{id}', [App\Http\Controllers\InfractionController::class, 'show_admin'])->name('admin_infraction.show');
Route::get('/admin_infractions/edit/{id}', [App\Http\Controllers\InfractionController::class, 'edit'])->name('admin_infraction.edit');
Route::delete('/admin_infractions/destroy/{id}', [App\Http\Controllers\InfractionController::class, 'destroy'])->name('admin_infraction.destroy');
Route::get('/admin_infractions/edit/{id}', [App\Http\Controllers\InfractionController::class, 'edit'])->name('admin_infraction.edit');
Route::put('/admin_infractions/update/{id}', [App\Http\Controllers\InfractionController::class, 'update'])->name('admin_infraction.update');
Route::get('/admin_infractions/barcode/{id}', [App\Http\Controllers\InfractionController::class, 'printReceipt'])->name('admin_infraction.print');



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// User

Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/user/tambah', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::put('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::delete('/user/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
Route::put("/user/status/{id}", [App\Http\Controllers\UserController::class, 'changeStatus'])->name('user.status');
Route::get('/user/profile/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');



//Parking
Route::get('/parking', [ParkingController::class, "index"])->name('parking');
Route::get('/parking/tambah', [ParkingController::class, "create"])->name('parking.create');
Route::get('/parking/checkout', [ParkingController::class, "checkoutParkingView"])->name('parking.checkout');
Route::get('/parking/{id}', [ParkingController::class, "show"])->name('parking.show');
Route::post('/parking/store', [ParkingController::class, "store"])->name('parking.store');
Route::get('/parking/barcode/{id}', [ParkingController::class, "printReceipt"])->name('parking.print');
Route::post('/parking/checkout/{id}', [ParkingController::class, "checkOut"])->name('parking.checkout.proses');
Route::get('/parking/edit/{id}', [ParkingController::class, "edit"])->name('parking.edit');
Route::put('/parking/update/{id}', [ParkingController::class, "update"])->name('parking.update');
Route::delete('/parking/destroy/{id}', [ParkingController::class, "destroy"])->name('parking.destroy');

//Rate
Route::get('/rate', [RateController::class, "index"])->name('rate');
Route::get('/rate/tambah', [RateController::class, "create"])->name('rate.create');
Route::post('/rate/store', [RateController::class, "store"])->name('rate.store');
Route::get('/rate/edit/{id}', [RateController::class, "edit"])->name('rate.edit');
Route::put('/rate/update/{id}', [RateController::class, "update"])->name('rate.update');
Route::delete('/rate/delete/{id}', [RateController::class, "destroy"])->name('rate.destroy');
Route::put("/rate/status/{id}", [RateController::class, 'changeStatus'])->name('rate.status');

//Profile


//Slot
Route::put("/slot/update/{id}", [SlotController::class, 'update'])->name('slot.update');

Route::get("/chart-monthly", [HomeController::class, 'chartMontly'])->name('chart.month');
Route::get("/chart-weekly", [HomeController::class, 'chartWeekly'])->name('chart.week');


// Report
Route::get('/report', [ReportController::class, "index"])->name('report');

// Report Print
Route::get('/report/pdf', [ReportController::class, 'printPDF'])->name('report.pdf');
Route::get('/report/excel', [ReportController::class, 'printExcel'])->name('report.excel');