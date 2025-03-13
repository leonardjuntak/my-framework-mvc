<h1>Data Products</h1>
<?php
if ($_SESSION['user']['role'] == 'admin') { ?>
    <a href="/products/create">Create New Product</a>
    <a href="/products/export-pdf" target="_blank">Export to PDF</a>
<?php } ?>

<table border="1" style="margin-top: 30px;">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Gambar</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($i) ?></td>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= htmlspecialchars($product['description']) ?></td>
                <td><?= htmlspecialchars($product['price']) ?></td>
                <td>
                    <?php if ($product['image']): ?>
                        <img src="/uploads/<?= htmlspecialchars($product['image']) ?>" alt="Gambar Produk" width="25">
                    <?php else: ?>
                        Tidak ada gambar
                    <?php endif; ?>
                </td>
                <td>
                    <?php
                    if ($_SESSION['user']['role'] == 'user') {
                        echo "Lihat";
                    } elseif ($_SESSION['user']['role'] == 'admin') {
                    ?>
                        <a class="a-edit" href="/products/edit/<?= $product['id'] ?>">Edit</a>
                        <form action="/products/delete/<?= $product['id'] ?>" method="POST" style="display:inline;">
                            <button type="submit">Delete</button>
                        </form>
                    <?php } ?>
                </td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </tbody>
</table>