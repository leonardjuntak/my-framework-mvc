<body>
    <h1>Edit Product</h1>
    <form action="/products/update/<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($product['name']) ?>" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required><?= htmlspecialchars($product['description']) ?></textarea>
        <br>
        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" id="price" value="<?= htmlspecialchars($product['price']) ?>" required>
        <br>
        <label for="image">Gambar:</label>
        <input type="file" name="image" id="image" accept="image/*">
        <br>
        <?php if ($product['image']): ?>
            <img src="/uploads/<?= htmlspecialchars($product['image']) ?>" alt="Gambar Produk" width="100">
        <?php endif; ?>
        <br>
        <button type="submit">Update</button>
        <a href="/products">Back</a>
    </form>
</body>