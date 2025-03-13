<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>

<body>
    <div class="daftarProduct">
        <h1>Daftar User Toko Kita</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 15%;">ID</th>
                <th style="width: 35%;">Nama</th>
                <th style="width: 25%;">Role</th>
                <th style="width: 25%;">Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td><?= htmlspecialchars($user['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>