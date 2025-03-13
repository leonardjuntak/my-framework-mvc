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

    /**
     * Tambah user baru.
     */
    public function create($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->query("INSERT INTO {$this->table} (username, password, role) VALUES (:username, :password, :role)", $data);
    }

    /**
     * Update user.
     */
    public function update($id, $data)
    {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        $data['id'] = $id;
        return $this->query("UPDATE {$this->table} SET username = :username, password = :password, role = :role WHERE id = :id", $data);
    }

    /**
     * Hapus user.
     */
    public function delete($id)
    {
        return $this->query("DELETE FROM {$this->table} WHERE id = :id", ['id' => $id]);
    }

    /**
     * Ambil user berdasarkan ID.
     */
    public function find($id)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id = :id", ['id' => $id])->fetch();
    }

    // mencari user name di database apakah ada dengan yang di ketik user
    public function findByUserName($userName)
    {
        return $this->query("SELECT * FROM Users WHERE username =:username", ['username' => $userName])->fetch();
    }

    // verifikasi password di database dan yang di input user
    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }
    // public function getAll()
    // {
    //     return $this->query("SELECT * FROM users")->fetchAll();
    // }

    // public function create($name, $email)
    // {
    //     $this->query("INSERT INTO users (name, email) VALUES (:name, :email)", [
    //         'name' => $name,
    //         'email' => $email
    //     ]);
    // }
}
