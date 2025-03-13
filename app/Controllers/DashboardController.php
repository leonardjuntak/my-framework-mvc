<?php

namespace App\Controllers;

use Core\View;

/**
 * Controller Dashboard (Yang berkaitan method yang ada di dashboard)
 */
class DashboardController
{
    /**
     * Menampilkan halaman dashboard.
     *
     * @return void
     */
    public function index()
    {
        return View::render(
            /** 
             * Meload View Dashboard di Folder View/dashboard/dashboard.php 
             * Mengirimkan data kedalam {key => value} contoh {user => $_SESSION['user]}
             */
            'dashboard.dashboard',
            [
                'user' => $_SESSION['user']
            ],
            'app'
        );
    }
    /**
     * Menampilkan halaman home.
     *
     * @return void
     */
    public function home()
    {
        /**
         * Kalau user belum login maka data 'user' =>$_SESSION['user'] $ tidak di kirim
         */
        if (!isset($_SESSION['user']) || $_SESSION['user'] == "") {
            return  View::render(
                'dashboard.home',
                [
                    'title' => 'Home Pagesz',
                    'message' => 'Ini adalah halam Home'
                ],
                'app'
            );
        } else {
            return  View::render(
                'dashboard.home',
                [
                    'title' => 'Home Pagesz',
                    'message' => 'Ini adalah halam Home',
                    'user' => $_SESSION['user']
                ],
                'app'
            );
        }
    }

    /**
     * Menampilkan halaman About.
     *
     * @return void
     */
    public function about()
    {
        /**
         * @param array user
         */
        // Jika tidak ada user
        if (!isset($_SESSION['user'])) {
            return View::render(
                'dashboard.about',
                [
                    'message' => 'Ini adalah halam about US'
                ],
                'app'
            );
            // Jika sesi user / sesi login
        } else {
            return View::render(
                'dashboard.about',
                [
                    'message' => 'Ini adalah halam about US',
                    'user' => $_SESSION['user']
                ],
                'app'
            );
        }
    }
}
