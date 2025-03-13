<?php

namespace App\Models;

use Core\Model;

class Product extends Model
{
    public function getAll()
    {
        return $this->query("SELECT * FROM products")->fetchAll();
    }

    public function find($id)
    {
        return $this->query("SELECT * FROM products WHERE id = :id", ['id' => $id])->fetch();
    }

    public function create($name, $description, $price, $image)
    {
        $this->query("INSERT INTO products (name, description, price, image) VALUES (:name, :description, :price, :image)", [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'image' => $image
        ]);
    }

    public function update($id, $name, $description, $price, $image = null)
    {
        // $this->query("UPDATE products SET name = :name, description = :description, price = :price WHERE id = :id", [
        //     'id' => $id,
        //     'name' => $name,
        //     'description' => $description,
        //     'price' => $price
        // ]);

        $this->query(
            "UPDATE products SET name = :name, description = :description, price = :price, image = :image WHERE id = :id",
            [
                'id' => $id,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'image' => $image
            ]
        );
    }

    public function delete($id)
    {
        $this->query("DELETE FROM products WHERE id = :id", ['id' => $id]);
    }
}
