<?php
$rowCount30 = 0; // Inisialisasi untuk menghitung jumlah baris
foreach ($data['informasi_obat'] as $obt) {
    foreach ($data['30'] as $ed) {
        if ($obt['kode_obat'] == $ed['kode_obat']) {
            $rowCount30++; // Tambah satu setiap kali ada baris yang cocok
        }
    }
}
$rowCount10 = 0; // Inisialisasi untuk menghitung jumlah baris
foreach ($data['informasi_obat'] as $obt) {
    foreach ($data['10'] as $ed) {
        if ($obt['kode_obat'] == $ed['kode_obat']) {
            $rowCount10++; // Tambah satu setiap kali ada baris yang cocok
        }
    }
}
$rowCount = 0; // Inisialisasi untuk menghitung jumlah baris
foreach ($data['informasi_obat'] as $obt) {
    foreach ($data['expired'] as $ed) {
        if ($obt['kode_obat'] == $ed['kode_obat']) {
            $rowCount++; // Tambah satu setiap kali ada baris yang cocok
        }
    }
}
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-dark">INFORMASI KADALUWARSA</h6>
            </div>
            <div class="col-auto">
                <a href="<?= APP_PATH; ?>/Home/data_obat" type="button" class="btn btn-success me-2">DATA OBAT</a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <ul class="nav nav-pills col-12 col-md-8" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-small" id="tigapuluh_hari-tab" data-toggle="pill" href="#tigapuluh_hari" role="tab" aria-controls="tigapuluh_hari" aria-selected="true">Kurang Dari 30 Hari <sup>( <?= $rowCount30; ?> )</sup></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-small" id="sepuluh_hari-tab" data-toggle="pill" href="#sepuluh_hari" role="tab" aria-controls="sepuluh_hari" aria-selected="false">Kurang Dari 10 Hari <sup>( <?= $rowCount10; ?> )</sup></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-small" id="telah_kadaluarsa-tab" data-toggle="pill" href="#telah_kadaluarsa" role="tab" aria-controls="telah_kadaluarsa" aria-selected="false">Telah Kadaluarsa <sup>( <?= $rowCount; ?> )</sup></a>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <!-- TAB 30 HARI -->
            <div class="tab-pane fade active show" id="tigapuluh_hari" role="tabpanel" aria-labelledby="tigapuluh_hari-tab">
                <div class="table-responsive">
                    <table class="table table-bordered" id="ed30" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">KODE</th>
                                <th class="text-center">OBAT</th>
                                <th class="text-center">EXPIRED</th>
                                <th class="text-center">STOK</th>
                                <th class="text-center">SISA HARI</th>
                                <th class="text-center">TINDAKAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($data['informasi_obat'] as $obt) :
                                foreach ($data['30'] as $ed) :
                                    if ($obt['kode_obat'] == $ed['kode_obat']) :
                            ?>
                                        <tr class="shadow-animation">
                                            <td><?= $count; ?></td>
                                            <td><?= htmlspecialchars($obt['kode_obat']); ?></td>
                                            <td><?= htmlspecialchars($obt['nama_obat']); ?></td>
                                            <td><?= htmlspecialchars($ed['tgl_expired']); ?></td>
                                            <td><?= htmlspecialchars($ed['total_obat_masuk']); ?></td>
                                            <td><?= htmlspecialchars($ed['sisa_hari']); ?> Hari</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success" onclick="getInfoObat('<?= $obt['kode_obat']; ?>')">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                                <a href="<?= APP_PATH; ?>/Home/delete/<?= $obt['kode_obat']; ?>" class="btn btn-danger" type="button">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                            <?php
                                        $count++;
                                    endif;
                                endforeach;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 10 HARI -->
            <div class="tab-pane fade" id="sepuluh_hari" role="tabpanel" aria-labelledby="sepuluh_hari-tab">
                <div class="table-responsive">
                    <table class="table table-bordered" id="ed10" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">KODE</th>
                                <th class="text-center">OBAT</th>
                                <th class="text-center">EXPIRED</th>
                                <th class="text-center">STOK</th>
                                <th class="text-center">SISA HARI</th>
                                <th class="text-center">TINDAKAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($data['informasi_obat'] as $obt) :
                                foreach ($data['10'] as $ed) :
                                    if ($obt['kode_obat'] == $ed['kode_obat']) :
                            ?>
                                        <tr>
                                            <td><?= $count; ?></td>
                                            <td><?= htmlspecialchars($obt['kode_obat']); ?></td>
                                            <td><?= htmlspecialchars($obt['nama_obat']); ?></td>
                                            <td><?= htmlspecialchars($ed['tgl_expired']); ?></td>
                                            <td><?= htmlspecialchars($ed['total_obat_masuk']); ?></td>
                                            <td><?= htmlspecialchars($ed['sisa_hari']); ?> Hari</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success" onclick="getInfoObat('<?= $obt['kode_obat']; ?>')">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                                <a href="<?= APP_PATH; ?>/Home/delete/<?= $obt['kode_obat']; ?>" class="btn btn-danger" type="button">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                            <?php
                                        $count++;
                                    endif;
                                endforeach;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB TELAH KADALUARSA -->
            <div class="tab-pane fade" id="telah_kadaluarsa" role="tabpanel" aria-labelledby="telah_kadaluarsa-tab">
                <div class="table-responsive">
                    <table class="table table-bordered" id="kadaluwarsaObat" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">KODE</th>
                                <th class="text-center">OBAT</th>
                                <th class="text-center">EXPIRED</th>
                                <th class="text-center">STOK</th>
                                <th class="text-center">SISA HARI</th>
                                <th class="text-center">TINDAKAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($data['informasi_obat'] as $obt) :
                                foreach ($data['expired'] as $ed) :
                                    if ($obt['kode_obat'] == $ed['kode_obat']) :
                            ?>
                                        <tr>
                                            <td><?= $count; ?></td>
                                            <td><?= htmlspecialchars($obt['kode_obat']); ?></td>
                                            <td><?= htmlspecialchars($obt['nama_obat']); ?></td>
                                            <td><?= htmlspecialchars($ed['tgl_expired']); ?></td>
                                            <td><?= htmlspecialchars($ed['total_obat_masuk']); ?></td>
                                            <td><?= htmlspecialchars($ed['sisa_hari']); ?> Hari</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success" onclick="getInfoObat('<?= $obt['kode_obat']; ?>')">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                                <a href="<?= APP_PATH; ?>/Home/delete/<?= $obt['kode_obat']; ?>" class="btn btn-danger" type="button">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                            <?php
                                        $count++;
                                    endif;
                                endforeach;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>