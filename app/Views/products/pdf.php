<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Daftar Produk Toko Kita</title>
    <style>
        .daftarProduct h1 {
            margin-top: 10px;
            font-weight: 400;
            font-size: 14;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 0.5px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .kop-surat {
            padding-left: 55px;
            padding-top: 0;
            padding-bottom: 12px;
            padding-bottom: 10px;
            margin-bottom: 0px;
            margin-top: 0;
            text-align: center;
            border-bottom: 4px solid #000;
        }

        .kop-surat img {
            height: 90px;
            position: absolute;
            left: 40px;
            top: 0px;
            bottom: 15px;
        }

        .kop-surat h1 {
            font-weight: normal;
        }

        .kop-surat h1,
        .kop-surat h2,
        .kop-surat p {
            margin: 1;
        }

        .kop-surat p {
            margin-top: 1;
            text-align: center;
            font-size: 10;
        }

        .no-surat h3 {
            font-size: 12;
            font-weight: bold;
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .content {
            padding: 20;
        }
    </style>
</head>

<body>
    <div class="kop-surat">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Lambang_Kabupaten_Landak.png/640px-Lambang_Kabupaten_Landak.png" alt="Logo Instansi" />
        <h1 style="text-align: center; font-size: 14;">PEMERINTAH KABUPATEN LANDAK</h1>
        <h2 style="text-align: center; font-size: 18;">BADAN KESATUAN BANGSA DAN POLITIK</h2>
        <p>Jalan Pangeran Cinata, Ngabang, Landak, Kalimantan Barat 79357</p>
        <p>Laman kesbangpol.landakkab.go.id, Pos-el kesbangpollandak@gmail.com</p>
    </div>

    <div class="content">
        <div class="no-surat">
            <h3>Nomor: 800.1.13.1/44/Kesbangpol-A</h3>
        </div>

        <div class="daftarProduct">
            <h1>Daftar Produk Toko Kita</h1>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">ID</th>
                    <th style="width: 30%;">Nama</th>
                    <th style="width: 45%;">Deskripsi</th>
                    <th style="width: 20%;">Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['id']) ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['description']) ?></td>
                        <td><?= "Rp " . number_format(htmlspecialchars($product['price']), 0, ",", ".") ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        $formatter = new IntlDateFormatter(
            'id_ID',
            IntlDateFormatter::NONE,  // Tidak menampilkan nama hari
            IntlDateFormatter::NONE,  // Tidak menampilkan waktu
            'Asia/Jakarta',
            IntlDateFormatter::GREGORIAN,
            'dd MMMM yyyy'            // Format sesuai kebutuhan (09 Maret 2025)
        );
        ?>
        <div style="text-align: right; margin-top: 64px; margin-right:16px">
            <p style="margin: 4px 0; padding-right: 25px;">Ngabang, <?php echo $formatter->format(time()); ?></p>
            <p style="margin: 4px 0; padding-right: 15px;">Yang Membuat Pernyataan,</p>
            <div style="height: 84px;"></div> <!-- Ruang untuk tanda tangan -->
            <p style="margin: 4px 0; font-weight: bold;">Leonard Simanjuntak, S.Kom.</p>
        </div>
    </div>
</body>

</html>