<?php

namespace App\Http\Controllers;

class SSLController extends Controller
{


    public function File1()
    {
        $file = response()->file(base_path().'/etc/ssl/CcdxAVaZBHMCmFkWLTKHEXTv_6ggh30ymzOrihprM_I');
        dd($file);
        return $file;
    }

    public function File2()
    {
        return response()->file(base_path().'/etc/ssl/mvjuKMRHhsfYoqxJwpVAvnYnH4mEoPiL06dLo2Epr1A');
    }
}
