<?php

namespace App\Http\Controllers;

use File;

class SSLController extends Controller
{


    public function File1()
    {
        $file = File::get(public_path().'/etc/ssl/CcdxAVaZBHMCmFkWLTKHEXTv_6ggh30ymzOrihprM_I');
        return $file;
    }

    public function File2()
    {
        $file = File::get(public_path().'/etc/ssl/mvjuKMRHhsfYoqxJwpVAvnYnH4mEoPiL06dLo2Epr1A');
        return $file;
    }
}