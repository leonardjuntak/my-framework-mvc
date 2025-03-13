<?php

namespace Core\Middleware;

use Core\Auth;

class GuestMiddleware
{
    public function handle()
    {
        Auth::isGuest(); // Panggil method isNotGuest dari class Auth
    }
}
