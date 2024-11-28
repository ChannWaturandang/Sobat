<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian - Apotek Sehat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 30px;
            max-width: 900px;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        .table thead th {
            background-color: #007bff;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .header-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }

        .date-time {
            font-size: 14px;
            color: #6c757d;
        }

        @media print {
            .btn {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header-info">
            <img src="<?= APP_PATH . '/img/sobat.png' ?>" alt="Logo Apotek" class="logo h-25 w-25">
            <h1>Laporan Pembelian</h1>
            <div class="date-time">
                <?php echo "Tanggal: " . date("d-m-Y H:i:s"); ?>
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>No. Faktur</th>
                    <th>Nama Supplier</th>
                    <th>Tanggal Masuk</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data['data_pembelian'] as $dat): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($dat['no_faktur']); ?></td>
                        <td><?= htmlspecialchars($dat['nama_supplier']); ?></td>
                        <td><?= htmlspecialchars($dat['tgl_masuk']); ?></td>
                        <td><?= htmlspecialchars($dat['nama_obat']); ?></td>
                        <td><?= htmlspecialchars($dat['obat_masuk']); ?></td>
                        <td>Rp <?= number_format($dat['total_harga'], 2, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-end mt-3 mb-3">
            <a href="<?= APP_PATH; ?>/Home/laporan" class="btn btn-danger ms-2">Kembali</a>
            <button class="btn btn-primary ms-1" onclick="window.print()">Print</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
