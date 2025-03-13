<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My Framework' ?></title>
    <link rel="stylesheet" href="/css/style.css"> <!-- CSS -->
    <script src="/js/script.js" defer></script> <!-- JavaScript -->
</head>

<body>
    <header>
        <h1 class="header-layout">My Framework</h1>
        <nav>
            <a href="/home">Home</a>
            <a href="/about">About</a>
            <!-- Jika Sudah Login -->
            <?php if (isset($_SESSION['user'])): ?>

                <a href="/dashboard">Dashboard</a>
                <a href="/products">Products</a>
                <!-- Apakah Rolenya Admin -->
                <?php if ($_SESSION['user']['role'] == 'admin') : ?>
                    <a href="/admin/users">Kelola User</a>
                <?php endif ?>
                <!-- Tombol Logout -->
                <a href="/logout">Logout</a>

            <?php else : ?>
                <!-- Jika Belum Login tombol Login -->
                <a href="/login">Login</a>
            <?php endif ?>
        </nav>
    </header>

    <main>
        <?= $content ?> <!-- Konten utama -->
    </main>

    <footer>
        <p>&copy; 2025 My Framework</p>
    </footer>
</body>

</html>