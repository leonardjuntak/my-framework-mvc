<?php

namespace App\Controllers;

use Core\Auth;
use Core\View;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;

class UserController
{
    /**
     * Tampilkan daftar user.
     */
    public function index()
    {
        Auth::isAdmin(); // Hanya admin yang bisa mengakses

        $user = new User();
        $users = $user->getAll();
        return View::render('admin/users/index', ['users' => $users], 'app');
    }

    /**
     * Tampilkan form tambah user.
     */
    public function create()
    {
        Auth::isAdmin(); // Hanya admin yang bisa mengakses

        return View::render('admin/users/create', [], 'app');
    }

    /**
     * Proses tambah user.
     */
    public function store()
    {
        Auth::isAdmin(); // Hanya admin yang bisa mengakses
        // var_dump($_POST);
        // die;
        $user = new User();
        $user->create($_POST);
        header('Location: /admin/users');
    }

    /**
     * Tampilkan form edit user.
     */
    public function edit($id)
    {
        Auth::isAdmin(); // Hanya admin yang bisa mengakses

        $user = new User();
        $userData = $user->find($id);
        return View::render('admin/users/edit', ['user' => $userData], 'app');
    }

    /**
     * Proses update user.
     */
    public function update($id)
    {
        Auth::isAdmin(); // Hanya admin yang bisa mengakses

        $user = new User();
        $user->update($id, $_POST);
        header('Location: /admin/users');
    }

    /**
     * Proses hapus user.
     */
    public function delete($id)
    {
        Auth::isAdmin(); // Hanya admin yang bisa mengakses

        $user = new User();
        $user->delete($id);
        header('Location: /admin/users');
    }

    /**
     * Proses Eksport Pdf
     */
    public function exportPdf()
    {
        // apakah user rolenya admin?
        Auth::isAdmin();

        // proses
        $user = new User();
        $users = $user->getAll();

        // Load view untuk PDF
        $html = View::render('admin.users.pdf', ['users' => $users], null, true); // true untuk mengembalikan string

        // // Debug: Tampilkan HTML
        // echo $html;
        // exit;

        // Setup Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);

        // Set ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF ke browser
        $dompdf->stream("user_data.pdf", [
            "Attachment" => false // true untuk download, false untuk preview di browser
        ]);
    }
}
