<h1>Daftar User</h1>
<a href="/admin/users/create">Tambah User</a>
<a href="/admin/users/export-pdf" target="_blank">Eksport Pdf</a>
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
                    <a href="/admin/users/edit/<?= $user['id'] ?>">Edit</a>
                    <form action="/admin/users/delete/<?= $user['id'] ?>" method="POST" style="display:inline;">
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>