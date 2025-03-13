<?php

namespace App\Controllers;

use App\Models\Product; //import  Model Product
use Core\View; // Import class View
use Core\Auth; // Import class Auth
use Dompdf\Dompdf;
use Dompdf\Options;

class ProductController
{
    public function index()
    {
        // Hanya user yang sudah login yang bisa melihat daftar produk
        Auth::isLoggedIn();

        $product = new Product();
        $products = $product->getAll();
        return View::render(
            'products.index',
            /** Meload halaman index di Views/products/index.php */
            [
                /** data yang di kirimkan */
                'products' => $products
            ],
            'app'
            /** Meload halaman layout di Views/layouts/app.php */
        );
    }

    public function create()
    {
        // apakah user rolenya admin?
        Auth::isAdmin();

        return View::render('products.create', [], 'app');
    }

    public function store()
    {
        // apakah user rolenya admin?
        Auth::isAdmin();

        $product = new Product();
        // $foto = "foto.jpg";
        // // var_dump($_POST, $_FILES);
        // // die;
        // $product->create($_POST['name'], $_POST['description'], $_POST['price'], $foto);
        // header('Location: /products');

        // // Handle upload gambar
        // if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        //     $uploadDir = __DIR__ . '/../../public/uploads/';
        //     if (!is_dir($uploadDir)) {
        //         mkdir($uploadDir, 0755, true);
        //     }

        //     $fileName = basename($_FILES['image']['name']);
        //     $uploadFile = $uploadDir . $fileName;

        //     if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        //         // Simpan path gambar ke database
        //         $product->create($_POST['name'], $_POST['description'], $_POST['price'], $fileName);
        //     } else {
        //         throw new \Exception("Gagal mengupload gambar.");
        //     }
        // } else {
        //     // Jika tidak ada gambar, simpan produk tanpa gambar
        //     $product->create($_POST['name'], $_POST['description'], $_POST['price'], null);
        // }

        // header('Location: /products');

        // Handle upload gambar
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Ambil ekstensi file asli
            $fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            // Generate nama file yang di-hash
            $hashedFileName = md5(uniqid()) . '.' . $fileExtension;
            $uploadFile = $uploadDir . $hashedFileName;

            // Pindahkan file ke folder upload
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                // Simpan nama file yang di-hash ke database
                $product->create($_POST['name'], $_POST['description'], $_POST['price'], $hashedFileName);
            } else {
                throw new \Exception("Gagal mengupload gambar.");
            }
        } else {
            // Jika tidak ada gambar, simpan produk tanpa gambar
            $product->create($_POST['name'], $_POST['description'], $_POST['price'], null);
        }

        header('Location: /products');
    }

    public function edit($id)
    {
        // apakah user rolenya admin?
        Auth::isAdmin();

        $product = new Product();
        $productData = $product->find($id);

        return View::render('products.edit', ['product' => $productData], 'app');
    }

    public function update($id)
    {
        // apakah user rolenya admin?
        Auth::isAdmin();

        // proses update
        $product = new Product();
        // $product->update($id, $_POST['name'], $_POST['description'], $_POST['price']);
        // header('Location: /products');

        // Handle upload gambar baru
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Ambil ekstensi file asli
            $fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            // Generate nama file yang di-hash
            $hashedFileName = md5(uniqid()) . '.' . $fileExtension;
            $uploadFile = $uploadDir . $hashedFileName;

            // Pindahkan file ke folder upload
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                // Hapus gambar lama (jika ada)
                if (!empty($_POST['existing_image'])) {
                    $oldImagePath = $uploadDir . $_POST['existing_image'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // Hapus file gambar lama
                    }
                }

                // Simpan nama file yang di-hash ke database
                $product->update($id, $_POST['name'], $_POST['description'], $_POST['price'], $hashedFileName);
            } else {
                throw new \Exception("Gagal mengupload gambar.");
            }
        } else {
            // Jika tidak ada gambar baru, update produk tanpa mengubah gambar
            $product->update($id, $_POST['name'], $_POST['description'], $_POST['price'], $_POST['existing_image']);
        }

        header('Location: /products');
    }

    public function delete($id)
    {
        // apakah user rolenya admin?
        Auth::isAdmin();

        // kalau iya maka proses
        $product = new Product();
        $product->delete($id);
        header('Location: /products');
    }

    // Method untuk generate PDF
    public function exportPdf()
    {
        // apakah user rolenya admin?
        Auth::isAdmin();

        // proses
        $product = new Product();
        $products = $product->getAll();

        // Load view untuk PDF
        $html = View::render('products/pdf', ['products' => $products], null, true); // true untuk mengembalikan string

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
        $dompdf->stream("products.pdf", [
            "Attachment" => false // true untuk download, false untuk preview di browser
        ]);
    }
}
