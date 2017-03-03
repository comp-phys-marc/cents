<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/.well-known/acme-challenge/CcdxAVaZBHMCmFkWLTKHEXTv_6ggh30ymzOrihprM_I',
        '/etc/ssl/mvjuKMRHhsfYoqxJwpVAvnYnH4mEoPiL06dLo2Epr1A'
    ];
}
