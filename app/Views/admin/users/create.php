<h1>Tambah User</h1>
<form action="/admin/users/store" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <label for="role">Role:</label>
    <select name="role" id="role" required>
        <option value="user" selected>User</option>
        <option value="admin">Admin</option>
    </select>
    <br>
    <button type="submit">Tambah</button>
</form>