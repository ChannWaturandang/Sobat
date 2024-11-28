<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-dark">FORM CETAK LAPORAN</h6>
            </div>
        </div>
    </div>


    <div class="card-body">
        <div class="row">
            <ul class="nav nav-pills col-12 col-md-8" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-small bg-warning text-dark me-2 transition" id="penjualan-tab" data-toggle="pill" href="#penjualan" role="tab" aria-controls="penjualan" aria-selected="true">Laporan Penjualan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-small bg-info text-dark me-2 transition" id="pembelian-tab" data-toggle="pill" href="#pembelian" role="tab" aria-controls="pembelian" aria-selected="false">Laporan Pembelian</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-small bg-danger text-white me-2 transition" id="kadaluwarsa-tab" data-toggle="pill" href="#kadaluwarsa" role="tab" aria-controls="kadaluwarsa" aria-selected="false">Laporan Kadaluwarsa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-small bg-dark text-light transition" id="info_obat-tab" data-toggle="pill" href="#info_obat" role="tab" aria-controls="info_obat" aria-selected="false">Informasi Obat</a>
                </li>
            </ul>
        </div>

        <style>
            .nav-link.transition {
                transition: transform 0.1s ease;
            }

            .nav-link.transition:hover {
                transform: scale(1.05);
                /* Scale up on hover */
            }

            .nav-link.transition::after {
                color: aliceblue;

            }

            .transition:hover {
                transform: scale(1.05);
                /* Scale up on hover */
            }
        </style>



        <div class="tab-content mt-3" id="pills-tabContent">
            <!-- Form Laporan Penjualan -->
            <div class="tab-pane fade show active" id="penjualan" role="tabpanel" aria-labelledby="penjualan-tab">
                <form action="<?php echo APP_PATH; ?>/Home/printPenjualan" method="POST">
                    <div class="form-group">
                        <label for="tgl_penjualan">Pilih Rentang Tanggal:</label>
                        <select name="tgl_penjualan" id="tgl_penjualan" class="form-control" onchange="toggleCustomDateOptions('penjualan')">
                            <option value="today">Hari Ini</option>
                            <option value="1_week">1 Minggu Terakhir</option>
                            <option value="1_month">1 Bulan Ini</option>
                            <option value="1_year">1 Tahun Ini</option>
                            <option value="custom">Kustom</option>
                        </select>
                    </div>

                    <?php
                    $currentYear = date('Y');
                    $currentMonth = date('n'); // 'n' gives the month without leading zeros (1-12)
                    ?>

                    <div id="custom-date-options-penjualan" style="display: none;">
                        <div class="form-group">
                            <label for="custom_start_date">Pilih Tanggal Mulai:</label>
                            <input
                                type="date"
                                name="custom_start_date"
                                id="custom_start_date"
                                class="form-control"
                                onclick="showDatePicker(this)"
                                onfocus="showDatePicker(this)">
                            <label>
                                <input
                                    type="checkbox"
                                    id="has_end_date_penjualan"
                                    onclick="toggleEndDateField('penjualan')"> Sampai Tanggal
                            </label>
                            <input
                                type="date"
                                name="custom_end_date"
                                id="custom_end_date_penjualan"
                                class="form-control"
                                style="display: none;"
                                onclick="showDatePicker(this)"
                                onfocus="showDatePicker(this)">
                        </div>

                        <!-- Month Selection -->
                        <div class="form-group">
                            <label for="bulan_penjualan">Pilih Bulan:</label>
                            <select name="bulan_penjualan" id="bulan_penjualan" class="form-control">
                                <option value="">-- Pilih Bulan --</option>
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                    <option value="<?= $i; ?>">
                                        <?= DateTime::createFromFormat('!m', $i)->format('F'); ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <!-- Year Selection -->
                        <div class="form-group">
                            <label for="tahun_penjualan">Pilih Tahun:</label>
                            <select name="tahun_penjualan" id="tahun_penjualan" class="form-control">
                                <option value="">-- Pilih Tahun --</option>
                                <?php for ($year = 2000; $year <= $currentYear; $year++): ?>
                                    <option value="<?= $year; ?>" <?= ($year == $currentYear) ? 'selected' : ''; ?>><?= $year; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pegawai">Pilih Pegawai:</label>
                        <select name="pegawai" id="pegawai" class="form-control">
                            <option value="all">Semua Pegawai</option>
                            <?php foreach ($data['pegawai'] as $pegawai): ?>
                                <option value="<?= $pegawai['pegawai_id']; ?>"><?php echo $pegawai['nama_pegawai']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success transition">Cetak Laporan Penjualan</button>
                </form>
            </div>


            <!-- Form Laporan Pembelian -->
            <div class="tab-pane fade" id="pembelian" role="tabpanel" aria-labelledby="pembelian-tab">
                <form action="<?php echo APP_PATH; ?>/Home/printPembelian" method="POST">
                    <div class="form-group">
                        <label for="tgl_pembelian">Pilih Rentang Tanggal:</label>
                        <select name="tgl_pembelian" id="tgl_pembelian" class="form-control" onchange="toggleCustomDateOptions('pembelian')">
                            <option value="today">Hari Ini</option>
                            <option value="1_week">1 Minggu Terakhir</option>
                            <option value="1_month">1 Bulan Ini</option>
                            <option value="1_year">1 Tahun Ini</option>
                            <option value="custom">Kustom</option>
                        </select>
                    </div>
                    <div id="custom-date-options-pembelian" style="display: none;">
                        <div class="form-group">
                            <label for="custom_start_date">Pilih Tanggal Mulai:</label>
                            <input type="date" name="custom_start_date" id="custom_start_date_pembelian" class="form-control" onclick="showDatePicker(this)"
                            onfocus="showDatePicker(this)">
                            <label>
                                <input type="checkbox" id="has_end_date_pembelian" onclick="toggleEndDateField('pembelian')"> Sampai Tanggal
                            </label>
                            <input type="date" name="custom_end_date" id="custom_end_date_pembelian" onclick="showDatePicker(this)"
                            onfocus="showDatePicker(this)" class="form-control" style="display: none;">
                        </div>
                        <div class="form-group">
                            <label for="bulan_pembelian">Pilih Bulan:</label>
                            <select name="bulan_pembelian" id="bulan_pembelian" class="form-control">
                                <option value="">-- Pilih Bulan --</option>
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                    <option value="<?= $i; ?>"><?= DateTime::createFromFormat('!m', $i)->format('F'); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tahun_pembelian">Pilih Tahun:</label>
                            <select name="tahun_pembelian" id="tahun_pembelian" class="form-control">
                                <option value="">-- Pilih Tahun --</option>
                                <?php for ($year = 2000; $year <= $currentYear; $year++): ?>
                                    <option value="<?= $year; ?>" <?= ($year == $currentYear) ? 'selected' : ''; ?>><?= $year; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="supplier">Pilih Supplier:</label>
                        <select name="supplier" id="supplier" class="form-control">
                            <option value="all">Semua Supplier</option>
                            <?php foreach ($data['supplier'] as $supplier): ?>
                                <option value="<?= $supplier['nama_supplier']; ?>"><?= $supplier['nama_supplier']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success transition">Cetak Laporan Pembelian</button>
                </form>
            </div>


            <!-- Form Laporan Kadaluwarsa -->
            <div class="tab-pane fade" id="kadaluwarsa" role="tabpanel" aria-labelledby="kadaluwarsa-tab">
                <form action="<?php echo APP_PATH; ?>/Home/printKadaluwarsa" method="POST">
                    <div class="form-group">
                        <label for="expired_range">Pilih Rentang Kadaluwarsa:</label>
                        <select name="expired_range" id="expired_range" class="form-control">
                            <option value="less_than_30">Kurang Dari 30 Hari</option>
                            <option value="less_than_10">Kurang Dari 10 Hari</option>
                            <option value="expired">Telah Kadaluarsa</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success transition">Cetak Laporan Kadaluwarsa</button>
                </form>
            </div>

            <!-- Form Informasi Obat -->
            <div class="tab-pane fade" id="info_obat" role="tabpanel" aria-labelledby="info_obat-tab">
                <form action="<?php echo APP_PATH; ?>/Home/printObat" method="POST">
                    <div>
                        <label for="kategori">Kategori</label>
                        <input type="radio" name="filter" id="kategori" value="kategori" onclick="toggleSelect('kategori')" required>
                    </div>

                    <div>
                        <label for="satuan">Satuan</label>
                        <input type="radio" name="filter" id="satuan" value="satuan" onclick="toggleSelect('satuan')" required>
                    </div>

                    <div class="form-group" id="kategori_select" style="display: none;">
                        <label for="kategori_value">Pilih Kategori:</label>
                        <select name="kategori_value" id="kategori_value" class="form-control">
                            <option value=""></option> <!-- Default empty option -->
                            <?php foreach ($data['kategori'] as $kategori): ?>
                                <option value="<?= $kategori['kategori']; ?>"><?= $kategori['kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group" id="satuan_select" style="display: none;">
                        <label for="satuan_value">Pilih Satuan:</label>
                        <select name="satuan_value" id="satuan_value" class="form-control">
                            <option value=""></option> <!-- Default empty option -->
                            <?php foreach ($data['satuan'] as $satuan): ?>
                                <option value="<?= $satuan['satuan']; ?>"><?= $satuan['satuan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success transition">Cetak Informasi Obat</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleCustomDateOptions(tab) {
        const customOptions = document.getElementById(`custom-date-options-${tab}`);
        const selectElement = document.getElementById(`tgl_${tab}`);

        if (selectElement.value === 'custom') {
            customOptions.style.display = 'block';
        } else {
            customOptions.style.display = 'none';
        }
    }

    function toggleEndDateField(tab) {
        const endDateField = document.getElementById(`custom_end_date_${tab}`);
        const checkbox = document.getElementById(`has_end_date_${tab}`);

        if (checkbox.checked) {
            endDateField.style.display = 'block';
        } else {
            endDateField.style.display = 'none';
        }
    }

    document.querySelector("form").addEventListener("submit", function(event) {
        const tglPenjualan = document.getElementById("tgl_penjualan");
        const customStartDate = document.getElementById("custom_start_date");

        if (tglPenjualan.value === "custom" && !customStartDate.value) {
            alert("Please select a start date for the custom range.");
            customStartDate.focus();
            event.preventDefault(); // Prevent form submission
        }
    });
</script>

<script>
    function toggleSelect(option) {
        // Hide both selects initially
        document.getElementById('kategori_select').style.display = 'none';
        document.getElementById('satuan_select').style.display = 'none';

        // Show the selected one
        if (option === 'kategori') {
            document.getElementById('kategori_select').style.display = 'block';
        } else if (option === 'satuan') {
            document.getElementById('satuan_select').style.display = 'block';
        }
    }
</script>

<script>
    function showDatePicker(input) {
        input.showPicker(); // This triggers the date picker to open immediately
    }

    // Automatically focus on the date input when clicked, opening the date picker on most browsers
    document.getElementById('custom_start_date').addEventListener('click', function() {
        this.focus();
    });

    document.getElementById('custom_end_date_penjualan').addEventListener('click', function() {
        this.focus();
    });
</script>

<script>
    function showDatePicker(input) {
        input.showPicker(); // This triggers the date picker to open immediately
    }

    // Automatically focus on the date input when clicked, opening the date picker on most browsers
    document.getElementById('custom_start_date').addEventListener('click', function() {
        this.focus();
    });

    document.getElementById('custom_end_date_pembelian').addEventListener('click', function() {
        this.focus();
    });
</script>