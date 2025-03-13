    <h1>Create Product</h1>
    <form action="/products/store" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
        <br>
        <br>
        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" id="price" required>
        <br>
        <br>
        <label for="image">Gambar:</label>
        <input type="file" name="image" id="image" accept="image/*">
        <br>
        <br>
        <br>
        <button type="submit">Create</button>
        <a href="/products">Back</a>
    </form>