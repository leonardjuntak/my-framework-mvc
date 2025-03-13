<?php

namespace Core;

class Auth
{
    /**
     * Periksa apakah pengguna sudah login.
     * Jika belum login, redirect ke halaman login.
     */
    public static function isLoggedIn()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    }

    /**
     * Periksa apakah pengguna saat ini adalah admin.
     * Jika bukan admin, redirect ke halaman utama.
     */
    public static function isAdmin()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /');
            exit;
        }
    }

    /**
     * Periksa apakah pengguna saat ini sudah login.
     * Jika sudah loggin dan ingin mengakses ke halaman /login maka, redirect ke halaman dashboard.
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            header('location: /');
            exit();
        }
    }
}
