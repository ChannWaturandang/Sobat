<div class="form-container-beli border-container-beli m-auto">
    <!-- Judul -->
    <div class="row m-auto">
        <div class="col-md-12 mb-2 align-items-center d-flex">
            <div class="col-md-6">
                <h1 class="header-title-jual">Transaksi Beli</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="<?= APP_PATH; ?>/Home/data_pembelian" class="btn-data-penjualan"> <button class="btn btn-sm btn-info">DATA PEMBELIAN</button></a>
                <!-- <div class="sales-info-jual">Tanggal: <span id="currentDate"></span></div> -->
            </div>
        </div>
    </div>

    <hr style="width:90%;" class="m-auto">

    <div class="row m-auto mt-4">
        <!-- Header for Invoice Number, Supplier Name, and Purchase Period -->
        <div class="row m-auto">
            <div class="col-md-4">
                <label class="text-dark" for="no_faktur">Nomor Faktur</label>
                <div class="d-flex input-group">
                    <input type="text" class="form-control form-control-sm" id="no_faktur" name="no_faktur" required>
                    <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                </div>
            </div>

            <div class="col-md-4">
                <label class="text-dark" for="sup_nama_update">Supplier</label>
                <div class="d-flex input-group">
                    <input data-bs-toggle="modal" data-bs-target="#modal_datasupplier" type="text" class="form-control form-control-sm" id="sup_nama_update" name="sup_nama_update">
                    <!-- <input type="hidden" class="form-control form-control-sm" id="sup_nama_update" name="no_supplier"> -->
                    <button type="button" class="input-group-text" data-bs-toggle="modal" data-bs-target="#modal_datasupplier" id="btnSearch"><i class="fas fa-search"></i></button>
                </div>
            </div>

            <div class="col-md-4">
                <label class="text-dark" for="tgl_pembelian">Periode Pembelian</label>
                <div class="input-group">
                    <input type="date" class="form-control form-control-sm datepicker" id="tgl_pembelian" name="tgl_pembelian">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>


        <!-- Form Input -->

        <div class="row m-auto mt-4">
            <!-- Drug Search and Modal Trigger -->
            <div class="flex-column col-md-3">
                <form method="post" id="form-pembelian" autocomplete="off">

                    <label class="text-dark" for="drugSearch">Kode Obat</label>
                    <div class="input-group">
                        <input data-bs-toggle="modal" data-bs-target="#drugModal" type="text" class="form-control form-control-jual" id="kode_obat" placeholder="Search drug...">
                        <button data-bs-toggle="modal" data-bs-target="#drugModal" class="input-group-text bg-primary" style="color: white;" type="button" id="btnSearch"><i class="fas fa-search"></i></button>
                    </div>

                    <div class="form-group form-group-jual">

                        <input type="number" class="form-control form-control-jual" id="stok" name="stok" hidden>
                        <!-- Drug Name Input -->
                        <label class="text-dark" for="namaObat">Nama Obat</label>
                        <input type="text" class="form-control input-group-text" id="namaObat" name="namaObat" readonly>

                        <!-- Drug kadaluawarsa Input -->
                        <label class="text-dark" for="kadaluwarsa">Tanggal Kadaluarsa</label>
                        <input type="date" class="form-control form-control-jual" id="kadaluwarsa" name="kadaluwarsa" required>

                        <!-- Unit Input -->
                        <label class="text-dark" for="unit">Jumlah</label>
                        <div class="jumlah_obt input-group">
                            <input type="number" class="form-control form-control-jual" id="unit" name="unit">
                            <div class="input-group-append">
                                <span class="input-group-text">Satuan</span>
                            </div>
                        </div>

                        <!-- Price Input -->
                        <label class="text-dark" for="harga">Harga</label>
                        <div class="harga_obt input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" class="form-control form-control-jual" id="harga" name="harga_obat" required>
                        </div>

                        <!-- Total Price -->
                        <label class="text-dark" for="total_harga">Total Harga</label>
                        <div class="harga_obt input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" class="form-control form-control-jual" id="total_harga" name="total_harga" readonly>
                        </div>

                        <!-- Buttons -->
                        <div class="text-end mt-3">
                            <button type="reset" class="btn btn-reset-jual mx-2" id="btnReset">Reset</button>
                            <button type="button" class="btn btn-add-jual mx-2" id="btnAdd">Tambah</button>
                        </div>

                        <!-- supplier data -->
                        <input type="number" class="form-control form-control-sm" id="sup_id_update" name="sup_id_update" hidden>
                        <!-- <input type="text" class="form-control form-control-sm" id="sup_nama_update" name="sup_nama_update" hidden> -->
                        <input type="text" class="form-control form-control-sm" id="sup_alamat_update" name="sup_alamat_update" hidden>
                        <input type="text" class="form-control form-control-sm" id="sup_kontak_petugas_update" name="sup_kontak_petugas_update" hidden>
                        <input type="text" class="form-control form-control-sm" id="sup_nama_petugas_update" name="sup_nama_petugas_update" hidden>

                        <!-- pegawai id -->
                        <input type="number" class="form-control form-control-sm" id="pegawai_id" name="pegawai_id" value="<?= 1 ?>" hidden>
                    </div>
                </form>
            </div>
            <!-- table -->
            <div class="col-md-9 table-responsive">
                <table class="table table-bordered table-striped table-jual table-hover" id="beliTable">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">OBAT</th>
                            <th scope="col">TANGGAL KADALUWARSA</th>
                            <th scope="col">HARGA</th>
                            <th scope="col">UNIT</th>
                            <th scope="col">TOTAL</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Transaction entries will be added here dynamically -->
                    </tbody>
                </table>
            </div>
        </div>

        <hr style="width:90%;" class="m-auto">

        <!-- total pembayaran -->
        <div class="row d-flex flex-d-w mt-2 m-auto">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <label class="text-dark" for="totalPayment" class="labelp">Total: </label>
                    </div>

                    <div class="row">
                        <div class="total col-md-12">
                            <h3 class="rp-pay">Rp.</h3>
                            <input type="" class="form-control form-control-jual pay" id="totalPayment" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <label class="text-dark" for="cara_bayar">Metode Pembayaran</label>
                <select name="cara_bayar" id="cara_bayar" class="form-control" aria-placeholder="Pilih cara bayar" required>
                    <option value="bayar langsung">Bayar langsung</option>
                    <option value="utang">Utang</option>
                </select>
            </div>

            <div class="col-md-2">
                <!-- Tanggal Jatuh Tempo -->
                <label class="text-dark" for="jatuh_tempo">Jatuh Tempo</label>
                <input type="date" class="form-control" id="jatuh_tempo" name="jatuh_tempo" placeholder=".">
            </div>

            <div class="col-md-4"></div>
            <span class="button-container col-md-1 h-5 mt-4">
                <tr class="text-center mt-3">
                    <td colspan="7">
                        <button type="button" class="btn btn-primary" id="confirmPayment" data-bs-dismiss="modal" aria-label="Close">Confirm</button>
                    </td>
                </tr>
            </span>
        </div>
    </div>
</div>

<!-- modal data obat -->
<div class="modal fade" id="drugModal" tabindex="-1" aria-labelledby="drugModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 70%;">
        <div class="modal-content modal-content-jual">
            <div class="modal-header">
                <h5 class="modal-title">PILIH OBAT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive"> <!-- Wrapper for scrollable table -->
                    <table class="table table-bordered table-jual" id="dataTableBeliObat">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KODE</th>
                                <th>NAMA OBAT</th>
                                <th>HARGA</th>
                                <th>STOK</th>
                                <th>SATUAN</th>
                                <th>KATEGORI</th>
                                <th>OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($data['obat'] as $obt) : ?>
                                <tr>
                                    <td><?= $count; ?></td>
                                    <td><?= htmlspecialchars($obt['kode_obat']); ?></td>
                                    <td><?= htmlspecialchars($obt['nama_obat']); ?></td>
                                    <td><?= htmlspecialchars($obt['harga']); ?></td>
                                    <td><?= htmlspecialchars($obt['stok']); ?></td>
                                    <td><?= htmlspecialchars($obt['satuan']); ?></td>
                                    <td><?= htmlspecialchars($obt['kategori']); ?></td>
                                    <td class="text-center">
                                        <button data-bs-dismiss="modal" type="button" class="btn btn-info" data-id="<?= $obt['kode_obat']; ?>" onclick="
                                            $('#kode_obat').val('<?= $obt['kode_obat'] ?>');
                                            $('#namaObat').val('<?= $obt['nama_obat'] ?>');
                                            $('#harga').val('<?= $obt['harga'] ?>');
                                            $('#stok').val('<?= $obt['stok'] ?>');
                                            $('#satuan').val('<?= $obt['satuan'] ?>');
                                            ">
                                            <i class="fas fa-arrow-pointer"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php $count++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- modal data supplier -->
<div class="modal fade" id="modal_datasupplier" tabindex="-1" aria-labelledby="modal_datasupplierLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content modal-content-jual">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_datasupplierLabel">PILIH SUPPLIER</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-jual" id="dataTableBeliSupplier">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">NAMA SUPPLIER</th>
                                <th class="text-center">ALAMAT SUPPLIER</th>
                                <th class="text-center">NAMA PETUGAS</th>
                                <th class="text-center">KONTAK KONTAK</th>
                                <th class="text-center">TINDAKAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($data['supplier'] as $sup) : ?>
                                <tr>
                                    <td><?= $count; ?></td>
                                    <td><?= htmlspecialchars($sup['nama_supplier']); ?></td>
                                    <td><?= htmlspecialchars($sup['alamat_supplier']); ?></td>
                                    <td><?= htmlspecialchars($sup['nama_petugas']); ?></td>
                                    <td><?= htmlspecialchars($sup['kontak_petugas']); ?></td>
                                    <td class="text-center">
                                        <!-- edit button -->
                                        <button data-bs-dismiss="modal" type="button" class="btn btn-info" data-id="<?= $sup['supplier_id']; ?>" onclick="
                                                    $('#sup_id_update').val('<?= $sup['supplier_id'] ?>');
                                                    $('#sup_nama_update').val('<?= $sup['nama_supplier'] ?>');
                                                    $('#sup_alamat_update').val('<?= $sup['alamat_supplier'] ?>');
                                                    $('#sup_nama_petugas_update').val('<?= $sup['nama_petugas'] ?>');
                                                    $('#sup_kontak_petugas_update').val('<?= $sup['kontak_petugas'] ?>');
                                                    $('#formUpdateBox').modal('show');">
                                            <i class="fas fa-arrow-pointer"></i>
                                        </button>
                                        <!-- delete button -->
                                    </td>
                                </tr>
                                <?php $count++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>


<!-- JavaScript -->
<script>
    $(document).ready(function() {


        // Function to display the alert modal
        function showAlertModal(title, message) {
            const alertModal = new bootstrap.Modal(document.getElementById('alertModal'), {
                keyboard: false
            });

            const alertTitle = document.getElementById('alertModalTitle');
            const alertMessage = document.getElementById('alertModalBody');

            alertTitle.textContent = title;
            alertMessage.textContent = message;

            alertModal.show();
        }

        // Initialize the transaction table
        function initializeTable() {
            if ($.fn.DataTable.isDataTable('#beliTable')) {
                $('#beliTable').DataTable().destroy();
            }

            return $('#beliTable').DataTable({
                paging: false,
                searching: false
            });
        }

        const transactionTable = initializeTable();

        // Function to validate form data
        function checkFormData() {
            const noFaktur = $('#no_faktur').val();
            const namaSupplier = $('#sup_id_update').val();
            const tglPembelian = $('#tgl_pembelian').val();
            const tableData = transactionTable.data();

            if (!noFaktur || !namaSupplier || !tglPembelian || tableData.length === 0) {
                showAlertModal('Data Belum Terpenuhi', 'Harap isi semua data dan pastikan terdapat data dalam tabel.');
                return false;
            }

            return true;
        }

        // Function to update the total price based on unit and price
        function updateTotalPrice() {
            const unit = parseFloat($('#unit').val()) || 0;
            const price = parseFloat($('#harga').val()) || 0;
            $('#total_harga').val((unit * price).toFixed(2));
        }

        // Event listener for unit and price changes
        $('#unit, #harga').on('input', updateTotalPrice);

        // Function to add a new row to the table
        function addTransaction() {
            const drugName = $('#namaObat').val();
            const price = $('#harga').val();
            const unit = $('#unit').val();
            const expiration = $('#kadaluwarsa').val();
            const totalPrice = $('#total_harga').val();
            const kode_obat = $('#kode_obat').val();

            if (!drugName || !price || !unit || !totalPrice || !expiration) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Incomplete Data',
                    text: 'The data you entered is incomplete. Please fill in all fields.'
                });
                return false;
            }

            let found = false;

            // Loop through each row in the table to check for existing kode_obat and expiration date
            transactionTable.rows().every(function() {
                const data = this.data();

                // Cek jika kode_obat dan tanggal kadaluwarsa sama
                if (data[0] == kode_obat && data[2] == expiration) {
                    const existingUnit = parseFloat(data[4]) || 0;
                    const newUnit = existingUnit + parseFloat(unit);
                    data[4] = newUnit;
                    data[5] = (newUnit * parseFloat(price)).toFixed(2);
                    this.data(data).draw(false);
                    found = true;
                    return false; // Exit the loop once found
                }
            });

            // Jika tidak ditemukan, tambahkan baris baru
            if (!found) {
                transactionTable.row.add([
                    kode_obat,
                    drugName,
                    expiration,
                    price,
                    unit,
                    totalPrice,
                    '<button type="button" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash-alt"></i></button>'
                ]).draw();
            }

            // Reset form setelah data ditambahkan
            $('#form-pembelian')[0].reset();
            updateTotalPayment();
        }


        // Function to update the total payment
        function updateTotalPayment() {
            let totalPayment = 0;
            transactionTable.rows().every(function() {
                const data = this.data();
                const price = parseFloat(data[3]) || 0;
                const unit = parseFloat(data[4]) || 0;
                totalPayment += (unit * price);
            });

            $('#totalPayment').val(totalPayment.toFixed(2));
        }

        // Event listener for add button
        $('#btnAdd').on('click', addTransaction);

        // Function to delete a row
        $('#beliTable').on('click', '.btn-delete', function() {
            const row = $(this).closest('tr');
            transactionTable.row(row).remove().draw();
            updateTotalPayment();
        });

        // Function to confirm and save the transaction
        $('#confirmPayment').on('click', function() {
            // Ambil nilai input
            const supplier_name = $('#sup_nama_update').val();
            const pegawai_id = $('#pegawai_id').val();
            const tgl_pembelian = $('#tgl_pembelian').val();
            const total_harga = parseFloat($('#totalPayment').val()) || 0;
            const no_faktur = $('#no_faktur').val();
            const payment_method = $('#cara_bayar').val();
            const jatuh_tempo = $('#jatuh_tempo').val();


            // Cek jika ada field yang kosong
            if (!supplier_name || !pegawai_id || !tgl_pembelian || !no_faktur || total_harga === 0 || !payment_method) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Tidak Lengkap',
                    text: 'Silakan lengkapi semua data sebelum melanjutkan.'
                });
                return; // Berhenti di sini jika data belum lengkap
            }

            // Jika payment_method adalah 'utang', pastikan jatuh_tempo diisi
            if (payment_method === 'utang' && !jatuh_tempo) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Jatuh Tempo Tidak Lengkap',
                    text: 'Silakan lengkapi tanggal jatuh tempo sebelum melanjutkan.'
                });
                return; // Berhenti di sini jika jatuh_tempo belum diisi
            }

            // Tampilkan dialog konfirmasi
            Swal.fire({
                title: 'Konfirmasi Pembelian',
                text: "Apakah Anda yakin ingin menyimpan pembelian ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, simpan!',
                cancelButtonText: 'No, batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengkonfirmasi
                    const tableData = [];
                    const stokMap = {};

                    transactionTable.rows().every(function() {
                        const data = this.data();
                        const kode_obat = data[0];
                        const tgl_expired = data[2];
                        const unit = parseFloat(data[4]) || 0;

                        const key = `${kode_obat}_${tgl_expired}`;
                        stokMap[key] = (stokMap[key] || 0) + unit;

                        tableData.push({
                            kode_obat: kode_obat,
                            nama_obat: data[1],
                            tgl_expired: tgl_expired,
                            harga: parseFloat(data[3]) || 0,
                            unit: unit,
                            total_harga: parseFloat(data[5]) || 0
                        });

                        
                    });

                    const data = {
                        supplier_name: supplier_name,
                        pegawai_id: pegawai_id,
                        tgl_pembelian: tgl_pembelian,
                        total_harga: total_harga,
                        no_faktur: no_faktur,
                        payment_method: payment_method,
                        tableData: JSON.stringify(tableData),
                        stokMap: JSON.stringify(stokMap)
                    };

                    $.ajax({
                        type: 'POST',
                        url: '<?= APP_PATH; ?>/Home/save_histori_beli',
                        data: data,
                        success: function(response) {
                            console.log(response);
                            Swal.fire({
                                icon: 'success',
                                title: 'Pembelian Berhasil Disimpan',
                                text: 'Data pembelian telah berhasil disimpan.'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Gagal menyimpan pembelian.'
                            });
                        }
                    });
                }
            });
        });


        // Function to toggle due date field based on payment method
        function toggleDueDateField() {
            const paymentMethod = $('#cara_bayar').val();
            const dueDateField = $('#jatuh_tempo');

            if (paymentMethod === 'utang') {
                dueDateField.prop('readonly', false);
                dueDateField.prop('required', true);
            } else {
                dueDateField.prop('readonly', true);
                dueDateField.prop('required', false);
                dueDateField.val('');
            }
        }

        // Initial call to set the correct state
        toggleDueDateField();

        // Update the field whenever the payment method changes
        $('#cara_bayar').on('change', function() {
            toggleDueDateField();
        });

        // Function to update the current date in the topbar
        function updateCurrentDate() {
            const now = new Date();
            const formattedDate = now.toLocaleDateString();
            $('#currentDate').text(formattedDate);
        }

        updateCurrentDate();
    });
</script>