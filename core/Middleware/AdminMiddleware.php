<?php

namespace Core\Middleware;

use Core\Auth;

class AdminMiddleware
{
    public function handle()
    {
        // Periksa apakah user sudah login dan role-nya admin
        Auth::isAdmin(); // Panggil method isAdmin dari class Auth
    }
}
