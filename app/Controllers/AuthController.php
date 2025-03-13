<?php

namespace App\Controllers;

use App\Models\User;
use Core\View;

/**
 * Controller Auth (Yang berkaitan dengan Login)
 */
class AuthController
{
    /**
     * Menampilkan halaman formulir login.
     *
     * @return void
     */
    public function showLoginForm()
    {
        return View::render('auth.login', $data = [], 'app');
    }

    /**
     * Memproses data login yang dikirimkan oleh pengguna.
     * 
     * @return void
     */
    public function login()
    {
        // $username = $_POST['username'];
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];

        // validasi jika username dan password kosong
        if (!$username || !$password) {
            header('Location: /login?error=invalid_input');
            exit;
        }

        // cari username di database
        $userModel = new User();
        $user = $userModel->findByUsername($username);

        if ($user && $userModel->verifyPassword($password, $user['password'])) {
            // Login berhasil
            $_SESSION['user'] = $user;
            header('Location: /dashboard');
            exit;
        } else {
            // Login gagal
            header('Location: /login?error=1');
            exit;
        }
    }

    /**
     * Mengakhiri sesi pengguna (logout).
     *
     * @return void
     */
    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit;
    }
}
