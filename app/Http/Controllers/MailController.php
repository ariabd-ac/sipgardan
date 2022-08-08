<?php

namespace App\Http\Controllers;

use App\Mail\InfractionMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function sendEmail(){
        $detail = [
            'title' => 'Mail from ari',
            'body' => 'testing for mail using gmail',
        ];

        Mail::to("sp.dentalcaries@gmail.com")->send(new InfractionMail($detail));
        return "Email send";
    }
}
