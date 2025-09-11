<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrustProxies extends \Illuminate\Http\Middleware\TrustProxies
{
    protected $proxies = '*'; // Důvěřuj všem proxy (nebo nastav IP Caddy)
}
