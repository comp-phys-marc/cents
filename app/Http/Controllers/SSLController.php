<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SSLController extends Controller
{


    public function File1()
    {
        return response()->file(asset('.well-known/acme-challenge/CcdxAVaZBHMCmFkWLTKHEXTv_6ggh30ymzOrihprM_I'));
    }

    public function File2()
    {
        return response()->file(asset('.well-known/acme-challenge/mvjuKMRHhsfYoqxJwpVAvnYnH4mEoPiL06dLo2Epr1A'));
    }
}
