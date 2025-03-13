<h1>Edit User</h1>
<form action="/admin/users/update/<?= $user['id'] ?>" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']) ?>" required>
    <br>
    <label for="password">Password (biarkan kosong jika tidak ingin mengubah):</label>
    <input type="password" name="password" id="password">
    <br>
    <label for="role">Role:</label>
    <select name="role" id="role" required>
        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
    </select>
    <br>
    <button type="submit">Update</button>
</form>