# **my-framework-mvc**

Sebuah framework MVC sederhana yang saya kembangkan untuk mempercepat proses pembuatan aplikasi. Dengan framework ini, Anda tidak perlu lagi melakukan konfigurasi dari awal sehingga dapat langsung fokus pada pengembangan kode aplikasi.

## 🚀 Fitur
- **Model**: Mengatur logika data dan komunikasi dengan database.  
- **View**: Mengatur tampilan antarmuka pengguna.  
- **Controller**: Menangani alur data antara Model dan View.  
- **Router**: Router bertugas memetakan URL yang diminta (request) ke **controller** dan **method** yang tepat untuk memprosesnya, memastikan aplikasi berjalan sesuai dengan jalur yang ditentukan.

## Prerequisite
- **PHP OOP:** Menguasai PHP OOP minimal mengetahui PHP OOP Dasar.
- **MVC:** Memahami dasar struktur folder MVC.

## 🛠️ Cara Instalasi
Pastikan Anda sudah memiliki **Composer** untuk mengunduh semua dependensi yang dibutuhkan. Kemudian jalankan perintah berikut:

```bash
composer install
```

## 🔌 Cara Menghubungkan Database
1. Buka file 📂 **database.php** yang berada di folder **config/database.php**.  
2. Isikan detail berikut:
   - **Host** → Isi dengan nama host Anda, biasanya **localhost**.  
   - **DBName** → Isi dengan nama database Anda.  
   - **Username** → Isi dengan nama pengguna database Anda, misalnya **root**.  
   - **Password** → Isi dengan password database Anda. Jika tidak ada password, biarkan kosong (`''`).
3. Buat database sesuai konfigurasi Anda dan pastikan koneksi berhasil.

## 🗺️ Cara Mengkonfigurasikan Router
1. Buka file 📂 **web.php** yang berada di folder **Routes**.
2. **Router:**. Untuk membuat **router** Anda dapat menambahkan konfigurasi sebagai berikut:

```php
$router->get('isikan path route anda', 'NamaController@method');
```

**Contohnya:**
```php
$router->get('/users', 'UserController@index');
```
- **$router->get()** → merupakan route yang menggunakan metode GET, ada dua metode yang dapat digunakan yaitu GET dan POST.
- **/users** → merupakan path routenya.
- **UserController@index** → merupakan **UserController** dan method-nya adalah **index**.

3. **Middleware:** Untuk membuat **Middleware** Anda dapat menambahkan konfigurasi sebagai berikut:
```php
$router->middleware('NamaMiddleware', ['Path Route yang dijaga'])
```
Jika ingin lebih dari satu path route yang dijaga, dapat menambahkan koma di sebelah path route lainnya, contoh:
```php
$router->middleware('NamaMiddleware', ['Path Route 1', 'Path Route 2', dst..])
```

- **Contoh** penerapannya:
```php
$router->middleware('AuthMiddleware', ['/users']);
```

## 💿 Membuat Models, Views, dan Controllers
1. **Membuat Model**
   - Contoh Membuat Model **User** dengan 📂 file berada di **app/Models/User.php**
  ```php
  <?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['username', 'password', 'role'];

    /**
     * Ambil semua user.
     */
    public function getAll()
    {
        return $this->query("SELECT * FROM {$this->table}");
    }
}
  ```
2. **Membuat Controller**
   - Contoh Membuat Controller **UserController** dengan 📂 file berada di **app/Controllers/UserController.php**
  ```php
<?php

namespace App\Controllers;

use Core\Auth;
use Core\View;
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
        return View::render('users.index', ['users' => $users], 'app');
    }
}
```
Untuk memahami **View::render()** saya akan menjelaskan secara singkat:
```php
return View::render('lokasi file view', [data yang di kirimkan ke halaman view], halaman layout yang ada di folder layout);
```
parameter dari **View::render()** ada tiga (3), :
- Parameter pertama adalah lokasi file view yang akan kita gunakan contoh : **Views/users/index.php** tempat untuk menampilkan halaman index dari **index** method yang ada di controller.
- Parameter ke dua (2) adalah data yang kita kirimkan ke halaman view, contoh : membuat variabel $users (untuk halaman view) di isi dengan variabel $user di controller
- Parameter ke tiga (3) adalah memanggil halaman **app** layout yang ada di folder layout, kalau di laravel istilahnya layouting. filenya berada di **Views/layouts/app.php**
   
3. **Membuat View**
   - Contoh Membuat Views **index** dengan 📂 file berada di **app/Views/users/index.php** untuk menampilkan view dari method **index** yang berada di **UserController**
```php
<h1>Daftar User</h1>
<a href="/users/create">Tambah User</a>
<table border="1" style="margin-top: 10px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>
                <td>
                    <a href="/users/edit/<?= $user['id'] ?>">Edit</a>
                    <form action="/users/delete/<?= $user['id'] ?>" method="POST" style="display:inline;">
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
```

Setelah proses selesai, framework siap digunakan untuk membangun aplikasi Anda. Happy Coding... 😊 dan silahkan eksplorasi sendiri hehe. 

