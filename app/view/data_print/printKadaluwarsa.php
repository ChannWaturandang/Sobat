<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kadaluwarsa - Apotek Sehat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 30px;
            max-width: 900px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 2px solid #007bff;
            margin-bottom: 20px;
        }

        .header img {
            height: 50px;
        }

        .header .text-right {
            text-align: right;
        }

        h1,
        h3 {
            text-align: center;
            font-weight: 700;
            color: #007bff;
            margin-bottom: 5px;
        }

        .info {
            text-align: center;
            font-size: 1.1em;
            margin-bottom: 10px;
        }

        .table {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f5f9;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        @media print {
            .btn .header {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container bg-white shadow pb-5">
        <!-- Header -->
        <div class="header">
            <img src="<?= APP_PATH; ?>/img/sobat.png" alt="Apotek Logo" class="h-25 w-25">
            <div class="text-right">
                <p><strong>Apotek Sehat</strong></p>
                <p>Jl. Kesehatan No. 123, Jakarta</p>
                <p>Email: info@apoteksehat.com</p>
                <p>Telp: (021) 123-4567</p>
            </div>
        </div>

        <!-- Judul dan Tanggal -->
        <div class="info">
            <h1>Laporan Kadaluwarsa Obat</h1>
            <p><?= date("d M Y, H:i:s"); ?></p>
        </div>

        <!-- Tabel Kadaluwarsa -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kode Obat</th>
                    <th>Nama Obat</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Sisa Hari</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['kadaluwarsa'] as $dat): ?>
                    <tr>
                        <td><?= htmlspecialchars($dat['kode_obat']); ?></td>
                        <td><?= htmlspecialchars($dat['nama_obat']); ?></td>
                        <td><?= htmlspecialchars($dat['tgl_expired']); ?></td>
                        <td><?= htmlspecialchars($dat['sisa_hari']); ?> Hari</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Tombol Cetak -->
        <div class="text-end mt-3 mb-3">
            <a href="<?= APP_PATH; ?>/Home/laporan" class="btn btn-danger ms-2">Kembali</a>
            <button class="btn btn-success ms-1" onclick="window.print()">Print</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
