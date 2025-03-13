<?php

namespace Core\Middleware;

use Core\Auth;

class AuthMiddleware
{
    public function handle()
    {
        // Periksa Apakah user sudah login
        Auth::isLoggedIn(); // Panggil method isLoggedIn dari class Auth
    }
}
