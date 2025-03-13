<h1>Welcome <?= $user['username'] ?? 'Pengunjung' ?> to the About Page</h1>
<p><?= $message ?? '' ?></p>
<a href="/dashboard">back</a>