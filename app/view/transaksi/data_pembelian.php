<?php
$count_lunas = 0;
foreach ($data['informasi_lunas'] as $lunas) {
    $count_lunas++;
}
$count_belum_lunas = 0;
foreach ($data['informasi_utang'] as $utang) {
    $count_belum_lunas++;
}
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-dark">DATA PEMBELIAN OBAT</h6>
            </div>
            <div class="col-auto">
                <a href="<?= APP_PATH; ?>/Home/transaksi_beli" type="button" class="btn btn-info me-2">TRANSAKSI PEMBELIAN</a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <ul class="nav nav-pills col-12 col-md-8" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-small" id="lunas-tab" data-toggle="pill" href="#lunas" role="tab" aria-controls="lunas" aria-selected="true">lunas <sup>( <?= $count_lunas ?> )</sup></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-small" id="belum_lunas-tab" data-toggle="pill" href="#belum_lunas" role="tab" aria-controls="belum_lunas" aria-selected="false">belum Lunas <sup>( <?= $count_belum_lunas ?> )</sup></a>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <!-- TAB 30 HARI -->
            <div class="tab-pane fade active show" id="lunas" role="tabpanel" aria-labelledby="lunas-tab">
                <div class="table-responsive">
                    <table class="table table-bordered" id="status_lunas" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">NOMOR FAKTUR</th>
                                <th class="text-center">TANGGAL</th>
                                <th class="text-center">SUPPLIER</th>
                                <th class="text-center">TOTAL</th>
                                <th class="text-center">STATUS</th>
                                <th class="text-center">TINDAKAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($data['informasi_lunas'] as $item) :
                            ?>
                                <tr class="shadow-animation">
                                    <td class="text-center"><?= $count; ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['no_faktur']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['tgl_masuk']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['nama_supplier']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['total']); ?></td>
                                    <td class="status-lunas">
                                        <span class="badge badge-pill badge-success badge-status">
                                            <?php
                                            $ceklunas = htmlspecialchars(string: $item['status']);
                                            echo ($ceklunas === "bayar langsung") ? "Lunas" : $ceklunas;
                                            ?>
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <button type="button" class="btn btn-info" onclick="getInfoObat(
                                                    '<?= addslashes($item['no_faktur']); ?>', 
                                                    '<?= addslashes($item['tgl_masuk']); ?>', 
                                                    '<?= addslashes($item['nama_supplier']); ?>',
                                                    '<?= addslashes($item['nama_obat']); ?>',
                                                    '<?= addslashes($item['stok']); ?>'
                                                )">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        <a href="<?= APP_PATH; ?>/Home/delete/<?= $item['no_faktur']; ?>" class="btn btn-danger" type="button">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                $count++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>

            <!-- TAB 10 HARI -->
            <div class="tab-pane fade" id="belum_lunas" role="tabpanel" aria-labelledby="belum_lunas-tab">
                <div class="table-responsive">
                    <table class="table table-bordered" id="status_utang" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">NOMOR FAKTUR</th>
                                <th class="text-center">TANGGAL</th>
                                <th class="text-center">SUPPLIER</th>
                                <th class="text-center">TOTAL</th>
                                <th class="text-center">STATUS</th>
                                <th class="text-center">TINDAKAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($data['informasi_utang'] as $item) :
                            ?>
                                <tr class="shadow-animation">
                                    <td class="text-center"><?= $count; ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['no_faktur']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['tgl_masuk']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['nama_supplier']); ?></td>
                                    <td class="text-center"><?= htmlspecialchars($item['total']); ?></td>
                                    <td class="status-utang">
                                        <span class="badge badge-pill badge-danger badge-status">
                                            <?php
                                            $ceklunas = htmlspecialchars(string: $item['status']);
                                            echo ($ceklunas === "utang") ? "Belum Lunas" : $ceklunas;
                                            ?>
                                        </span>
                                    </td>


                                    <td class="text-center">
                                        <button type="button" class="btn btn-info" onclick="getInfoObat('<?= $item['no_faktur']; ?>')">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        <a href="<?= APP_PATH; ?>/Home/delete/<?= $item['no_faktur']; ?>" class="btn btn-danger" type="button">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="konfirmasiPelunasan('<?= $item['no_faktur']; ?>')" class="btn btn-success" type="button">
                                            <i class="fa-solid fa-check"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                $count++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pembelian -->
<div class="modal fade" id="detail_pembelian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-left" id="exampleModalLabel">Data Detail Obat</h5>
            </div>
            <div class="modal-body p-0">
                <div class="table-responsive">

                    <table class="table table-sm text-small">
                        <tbody>
                            <tr>
                                <td class="text-small text-start"><strong>No Faktur</strong></td>
                                <td class="text-small" id="no_fakturdetail">
                                    <!-- Kosongkan untuk diisi melalui JS -->
                                </td>
                                <td class="text-small"><strong>Tanggal</strong></td>
                                <td class="text-small text-end" id="tgl_pembeliandetail">
                                    <!-- Kosongkan untuk diisi melalui JS -->
                                </td>
                            </tr>
                            <tr>
                                <td class="text-small text-start"><strong>Supplier</strong></td>
                                <td class="text-small" id="nm_supplierdetail">
                                    <!-- Kosongkan untuk diisi melalui JS -->
                                </td>
                                <td class="text-small"><strong>Status</strong></td>
                                <td class="text-small text-end" id="status_pembeliandetail">
                                    <!-- Kosongkan untuk diisi melalui JS -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
    
                    <table class="table table-striped table-sm text-small"> <!-- Added table-sm for smaller table -->
                        <thead>
                            <tr>
                                <th>Nama Obat</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="data_detailpembelian">
                            <!-- Baris akan diisi melalui JS -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Total :</th>
                                <th class="text-right">
                                    <span id="total_pembeliandetail">0</span> <!-- Diupdate dari JS -->
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function getInfoObat(no_faktur, tgl_masuk, nama_supplier, nama_obat, stok) {
        $.ajax({
            url: '<?= APP_PATH; ?>/Home/data_pembelian/',
            type: 'POST',
            dataType: 'json',
            data: {
                no_faktur: no_faktur,
                tgl_masuk: tgl_masuk,
                nama_supplier: nama_supplier
            },
            success: function(response) {
                $("#data_detailpembelian").empty();
                $("#total_pembeliandetail").text("0");
                var total = 0;

                response.drug_details.forEach(function(drug) {
                    var nama_obat = drug.nama_obat;
                    var stok = drug.stok;

                    if (response.price_and_satuan[nama_obat] && response.price_and_satuan[nama_obat].length > 0) {
                        response.price_and_satuan[nama_obat].forEach(function(item) {
                            var subtotal = parseFloat(item.harga) * parseFloat(stok);
                            total += subtotal;

                            $("#no_fakturdetail").text(no_faktur);
                            $("#tgl_pembeliandetail").text(tgl_masuk);
                            $("#nm_supplierdetail").text(nama_supplier);
                            $("#status_pembeliandetail").text("Lunas");

                            // Format harga and subtotal to Rupiah
                            var hargaFormatted = parseFloat(item.harga).toLocaleString("id-ID", {
                                style: "currency",
                                currency: "IDR"
                            });
                            var subtotalFormatted = subtotal.toLocaleString("id-ID", {
                                style: "currency",
                                currency: "IDR"
                            });

                            $("#data_detailpembelian").append(`
                            <tr>
                                <td>${nama_obat}</td>
                                <td class="text-right">${hargaFormatted}</td>
                                <td class="text-center">${stok}</td>
                                <td>${item.satuan}</td>
                                <td class="text-right">${subtotalFormatted}</td>
                            </tr>
                        `);
                        });
                    }
                });

                // Set the total in Rupiah format
                $("#total_pembeliandetail").text(total.toLocaleString("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }));
                $("#detail_pembelian").modal('show');
            },
            error: function() {
                alert("Gagal mengambil data detail pembelian.");
            }
        });
    }
</script>


<script>
    function konfirmasiPelunasan(noFaktur) {
        Swal.fire({
            title: 'Apakah Anda telah menyelesaikan pembayaran?',
            text: "Data ini tidak dapat diubah kembali.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, saya sudah bayar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Arahkan ke URL jika pengguna menekan "Ya, saya sudah bayar"
                window.location.href = `<?= APP_PATH; ?>/Home/pelunasan_cek/${noFaktur}`;
            }
        });
    }
</script>