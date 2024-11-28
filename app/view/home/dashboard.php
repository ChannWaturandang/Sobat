<div class="col-md-12 text-start mt-4">
    <h5 class="m-0 font-weight-bold text-dark">DASHBOARD</h5>
</div>
<br />

<div class="row">
    <!--STATUS cardS -->
    <div class="col-md-3 mb-3">
        <div class="card custom-card">
            <div class="card-header bg-gradient-tosca text-white d-flex justify-content-between align-items-center">
                <h6 class="pt-2"><i class="fas fa-cubes"></i> Total Penjualan hari ini</h6>
                <span class="badge bg-light text-dark">Today</span>
            </div>
            <div class="card-body text-center">
                <h2 class="text-tosca fw-bold mb-0">
                    <?php
                    $total = $data['total_jual'];
                    echo isset($total) ? "Rp " . number_format($total, 0, ',', '.') : "Rp 0";
                    ?>
                </h2>
                <small class="text-muted">Sales made today</small>
            </div>
            <div class="card-footer bg-white">
                <a class="text-tosca fw-bold d-flex justify-content-between align-items-center" href='index.php?page=barang'>
                    Lihat Detail <i class='fa fa-angle-double-right'></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Total Pembelian Hari Ini -->
    <div class="col-md-3 mb-3">
        <div class="card custom-card custom-card-blue">
            <div class="card-header bg-gradient-blue text-white d-flex justify-content-between align-items-center">
                <h6 class="pt-2"><i class="fas fa-chart-bar"></i> Total Pembelian Hari Ini</h6>
                <span class="badge bg-light text-dark">Today</span>
            </div>
            <div class="card-body text-center">
                <h2 class="text-blue fw-bold mb-0">
                    <?php
                    $total = $data['total_beli'];
                    echo isset($total) ? "Rp -" . number_format($total, 0, ',', '.') : "Rp 0";
                    ?>
                </h2>
                <small class="text-muted">Purchases made today</small>
            </div>
            <div class="card-footer bg-white">
                <a class="text-blue fw-bold d-flex justify-content-between align-items-center" href='#'>
                    Lihat Detail <i class='fa fa-angle-double-right'></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Total Kadaluarsa -->
    <div class="col-md-3 mb-3">
        <div class="card custom-card custom-card-red">
            <div class="card-header bg-gradient-red text-white d-flex justify-content-between align-items-center">
                <h6 class="pt-2"><i class="fas fa-upload"></i> Total Kadaluarsa < 30 hari</h6>
                <span class="badge bg-light text-dark">Alert</span>
            </div>
            <div class="card-body text-center">
                <h2 class="text-red fw-bold mb-0">
                    8
                </h2>
                <small class="text-muted">Items expired</small>
            </div>
            <div class="card-footer bg-white">
                <a class="text-red fw-bold d-flex justify-content-between align-items-center" href='<?= APP_PATH; ?>/Home/kadaluwarsa'>
                    Tabel Laporan <i class='fa fa-angle-double-right'></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card custom-card custom-card-red">
            <div class="card-header bg-gradient-red text-white d-flex justify-content-between align-items-center">
                <h6 class="pt-2"><i class="fas fa-upload"></i> Obat sudah mau habis</h6>
                <span class="badge bg-light text-dark">Alert</span>
            </div>
            <div class="card-body text-center">
                <h2 class="text-red fw-bold mb-0">
                    7
                </h2>
                <small class="text-muted">Items expired</small>
            </div>
            <div class="card-footer bg-white">
                <a class="text-red fw-bold d-flex justify-content-between align-items-center" href='<?= APP_PATH; ?>/Home/kadaluwarsa'>
                    Tabel Laporan <i class='fa fa-angle-double-right'></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Total Stok Saat Ini -->
    <div class="col-md-3 mb-3">
        <div class="card custom-card custom-card-purple">
            <div class="card-header bg-gradient-purple text-white d-flex justify-content-between align-items-center">
                <h6 class="pt-2"><i class="fa fa-bookmark"></i> Total Stok Saat Ini</h6>
                <span class="badge bg-light text-dark">Stock</span>
            </div>
            <div class="card-body text-center">
                <h2 class="text-purple fw-bold mb-0"><?php
                                                        $total_obat = $data['total_obat'];
                                                        echo isset($total_obat) ? $total_obat : 0; ?></h2>
                <small class="text-muted">Current stock level</small>
            </div>
            <div class="card-footer bg-white">
                <a class="text-purple fw-bold d-flex justify-content-between align-items-center" href='<?= APP_PATH; ?>/Home/data_obat'>
                    Lihat Detail <i class='fa fa-angle-double-right'></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /col-md-3-->

</div>
<div class="row">
    <div class="col-md-4 pb-3">

        <div class="box bg-white shadow d-flex flex-column">
            <div class="calendar-container d-flex justify-content-end">
                <i class="bi bi-calendar4-week" id="calendar-icon" style="cursor: pointer;"></i>
            </div>
            <canvas id="polar"></canvas>
        </div>
    </div>

    <div class="col-md-8">
        <div class="box bg-white shadow">
            <canvas id="earning"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<?php
$nama_obat_dijual = $data['nama_obat_dijual']['nama_obat'];
$harga_obat_dijual = $data['nama_obat_dijual']['total_penjualan'];


?>
<script>
    // Chart 1 Polar Area
    const ctx1 = document.getElementById('polar').getContext('2d');
    const ctx2 = document.getElementById('earning').getContext('2d');

    window.myPolarChart = new Chart(ctx1, {
        type: 'polarArea',
        data: {
            labels: <?= json_encode($nama_obat_dijual); ?>,
            datasets: [{
                label: 'Obat Terlaris',
                data: <?= json_encode($harga_obat_dijual) ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
            }]
        },

        options: {
            responsive: true,
        }
    });

    // Chart 2 Polar Area

    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                    label: 'Pembelian',
                    data: <?= json_encode($data['pembelian_per_bulan']) ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.7)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Penjualan',
                    data: <?= json_encode($data['penjualan_per_bulan']) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Keuntungan',
                    data: <?= json_encode($data['keuntungan_bulanan']) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    stacked: false
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>