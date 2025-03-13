<?php

namespace Core;

class View
{
    // revisi ke 2 

    /**
     * Render view dengan layout.
     *
     * @param string $view Nama file view (tanpa ekstensi .php)
     * @param array $data Data yang akan diteruskan ke view
     * @param string|null $layout Nama file layout (tanpa ekstensi .php)
     * @param bool $returnAsString Jika true, kembalikan output sebagai string
     * @return string|void
     */
    public static function render($view, $data = [], $layout = null, $returnAsString = false)
    {

        // Ubah dot notation menjadi path (misalnya 'dashboard.home' menjadi 'dashboard/home')
        $viewPath = str_replace('.', '/', $view);

        // Ekstrak data array ke variabel
        extract($data);

        // Mulai buffering output
        ob_start();

        // Include file view
        require __DIR__ . "/../app/Views/{$viewPath}.php";

        // Dapatkan output view
        $content = ob_get_clean();

        // Jika layout disediakan, include layout
        if ($layout) {
            ob_start();
            require __DIR__ . "/../app/Views/layouts/{$layout}.php";
            $content = ob_get_clean();
        }

        // Kembalikan output sebagai string atau langsung output
        if ($returnAsString) {
            return $content;
        } else {
            echo $content;
        }
    }



    // method awal sebelum revisi
    // public static function render($view, $data = [])
    // {
    //     extract($data);
    //     require __DIR__ . "/../app/Views/{$view}.php";
    // }

    // revisi pertama
    // public static function render($view, $data = [], $returnAsString = false)
    // {
    //     // Ekstrak data array ke variabel
    //     extract($data);

    //     // Mulai buffering output
    //     ob_start();

    //     // Include file view
    //     require __DIR__ . "/../app/Views/{$view}.php";

    //     // Dapatkan output dan bersihkan buffer
    //     $content = ob_get_clean();

    //     // Kembalikan output sebagai string atau langsung output
    //     if ($returnAsString) {
    //         return $content;
    //     } else {
    //         echo $content;
    //     }
    // }
}
