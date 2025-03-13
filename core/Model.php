<?php

namespace Core;

use PDO;
use PDOException;

class Model
{
    protected $pdo;

    public function __construct()
    {
        // Load konfigurasi database
        $config = require __DIR__ . '/../config/database.php';

        // Buat koneksi PDO
        try {
            $this->pdo = new PDO(
                "mysql:host={$config['host']};dbname={$config['dbname']}",
                $config['username'],
                $config['password']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Aktifkan error mode
        } catch (PDOException $e) {
            die("Koneksi database gagal: " . $e->getMessage());
        }
    }

    // Method untuk menjalankan query
    public function query($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
