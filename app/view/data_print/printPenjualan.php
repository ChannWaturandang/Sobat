<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Laporan Penjualan - Apotek Sehat</title>
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

        h1, h3 {
            text-align: center;
            font-weight: 700;
            color: #007bff;
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

        @media print {
            .header, .btn, .dataTables_length, .dataTables_filter, .dataTables_paginate, .dataTables_info {
                display: none;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            table, th, td {
                border: 1px solid black;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="<?= APP_PATH; ?>/img/sobat.png" alt="Apotek Sehat Logo" class="h-25 w-25">
            <div>
                <p><strong>Apotek Sehat</strong></p>
                <p>Jl. Kesehatan No. 123, Jakarta</p>
                <p>Email: info@apoteksehat.com</p>
                <p>Telp: (021) 123-4567</p>
            </div>
        </div>

        <!-- Judul dan Tanggal -->
        <div class="info">
            <h1>Invoice Laporan Penjualan</h1>
            <p>Tanggal: <?= date("d M Y, H:i:s"); ?></p>
        </div>

        <!-- Tabel Laporan Penjualan -->
        <table id="laporanPenjualan" class="table table-striped">
            <thead>
                <tr>
                    <th>No. Penjualan</th>
                    <th>Nama Obat</th>
                    <th>Tanggal Penjualan</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['data_penjualan'] as $dat): ?>
                    <tr>
                        <td><?= htmlspecialchars($dat['no_penjualan']); ?></td>
                        <td><?= htmlspecialchars($dat['nama_obat']); ?></td>
                        <td><?= htmlspecialchars($dat['tgl_penjualan']); ?></td>
                        <td><?= htmlspecialchars($dat['jumlah']); ?></td>
                        <td>Rp <?= number_format($dat['harga'], 2, ',', '.'); ?></td>
                        <td>Rp <?= number_format($dat['total_bayar'], 2, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Tombol Cetak -->
        <div class="text-end mt-4">
            <a href="<?= APP_PATH; ?>/Home/laporan" class="btn btn-danger ms-2">Kembali</a>
            <button class="btn btn-primary ms-1" onclick="window.print()">Print</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#laporanPenjualan').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
        });
    </script>
</body>

</html>
