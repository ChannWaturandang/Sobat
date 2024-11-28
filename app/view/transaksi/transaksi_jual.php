<div class="form-container-beli border-container-beli m-auto">

    <!-- Header Container -->
    <div class="row m-auto"></div>
    <div class="mb-4 align-items-center d-flex">
        <div class="col-md-6">
            <h1 class="header-title-jual">Transaksi Jual</h1>
        </div>
        <div class="col-md-6 text-end">
            <div class="numDate">
                <div class="sales-info-jual">Nomor Penjualan <span id="salesNumber"></span></div>
                <div class="sales-info-jual">Tanggal: <span id="currentDate"></span></div>
            </div>
        </div>
    </div>

    <hr style="width:90%;" class="m-auto">

    <div class="row pt-2 m-auto p-2">
        <div class="col-md-12 d-flex justify-content-end">
            <a href="<?= APP_PATH; ?>/Home/data_penjualan" class="btn-data-penjualan"> <button class="btn btn-sm btn-info">Data Penjualan</button></a>
        </div>
    </div>

    <div class="row m-auto">
        <!-- Form Container -->
        <div class="col-md-3">
            <!-- Drug Search and Modal Trigger -->
            <div class="form-group form-group-jual">
                <label for="drugSearch">Search Drug</label>
                <div class="input-group">
                    <input data-bs-toggle="modal" data-bs-target="#drugModal" type="text" class="form-control form-control-jual" id="kode_obat" placeholder="Search drug...">
                    <button data-bs-toggle="modal" data-bs-target="#drugModal" class="input-group-text bg-primary text-white" type="button" id="btnSearch"><i class="fas fa-search custom-icon"></i></button>
                </div>
            </div>

            <form id="formTransaksi" class="form-group form-group-jual" action="<?= APP_PATH; ?>/Home/update_stok_obat" method="POST">
                <input type="number" class="form-control form-control-jual" id="stok" name="stok" hidden>
                <input type="number" class="form-control form-control-jual" id="pegawai_id" value="<?= $_SESSION['user_id']?>" name="stok" hidden>
                <!-- Drug Name Input -->
                <label for="namaObat">Nama Obat</label>
                <input type="text" class="form-control form-control-jual" id="namaObat" name="nama_obat" readonly>

                <!-- Price Input -->
                <label for="harga">Harga</label>
                <div class="harga_obt input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" class="form-control form-control-jual" id="harga" name="harga_obat" required>
                </div>

                <!-- Unit Input -->
                <label for="unit">Jumlah</label>
                <div class="jumlah_obt input-group">
                    <input type="number" class="form-control form-control-jual" id="unit" name="unit">
                    <div class="input-group-append">
                        <span class="input-group-text">Satuan</span>
                    </div>
                </div>


                <!-- Satuan Input -->
                <label for="satuan" hidden>Satuan</label>
                <input type="text" class="form-control form-control-jual" id="satuan" name="satuan" hidden>

                <!-- Total Price -->
                <label for="total_harga">Total Harga</label>
                <input type="number" class="form-control form-control-jual" id="total_harga" name="total_harga" readonly>

                <!-- Buttons -->
                <div class="row">
                    <div class="d-flex justify-content-center mt-3 col-md-12">
                        <button type="reset" class="btn btn-reset-jual mx-2" id="btnReset">Reset</button>
                        <button type="button" class="btn btn-add-jual mx-2" id="btnAdd">Add</button>
                    </div>

                </div>
            </form>
        </div>
        <div class="col-md-9">
            <table class="table table-bordered table-striped table-jual" id="dataTableJualObat">
                <thead>
                    <tr>
                        <th scope="col">KODE</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">HARGA</th>
                        <th scope="col">UNIT</th>
                        <th scope="col">SATUAN</th>
                        <th scope="col">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Transaction entries will be added here dynamically -->
                </tbody>
            </table>
        </div>
    </div>

    <hr style="width:90%;" class="m-auto">

    <div class="row pt-3">
        <div class="d-flex justify-content-end col-md-12">
            <button type="button" class="btn btn-success" id="submit_button">Submit</button>
        </div>
    </div>
    <!-- Table Container for Transaction History -->

    <!-- Modal for Drug Selection -->
    <div class="modal fade" id="drugModal" tabindex="-1" aria-labelledby="drugModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 70%;">
            <div class="modal-content modal-content-jual">
                <div class="modal-header">
                    <h5 class="modal-title" id="drugModalLabel">Select Drug</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive"> <!-- Wrapper for scrollable table -->
                        <table class="table table-bordered table-jual" id="dataTableObatJual">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Nama Obat</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th>Kategori</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                foreach ($data['obat'] as $obt) : ?>
                                    <tr class="shadow-animation" data-bs-dismiss="modal" onclick="getInfoObat(
                                            '<?= addslashes($obt['kode_obat']); ?>', 
                                            '<?= addslashes($obt['nama_obat']); ?>', 
                                            '<?= addslashes($obt['harga']); ?>',
                                            '<?= addslashes($obt['satuan']); ?>',
                                            '<?= addslashes($obt['kategori']); ?>',
                                            '<?= addslashes($obt['stok']); ?>'
                                        )">
                                        <td><?= $count; ?></td>
                                        <td><?= htmlspecialchars($obt['kode_obat']); ?></td>
                                        <td><?= htmlspecialchars($obt['nama_obat']); ?></td>
                                        <td><?= htmlspecialchars($obt['harga']); ?></td>
                                        <td><?= htmlspecialchars($obt['stok']); ?></td>
                                        <td><?= htmlspecialchars($obt['satuan']); ?></td>
                                        <td><?= htmlspecialchars($obt['kategori']); ?></td>
                                        <td class="text-center">
                                            <button data-bs-dismiss="modal" type="button" class="btn btn-info" onclick="
                                            var stok = parseFloat('<?= $obt['stok'] ?>');
        
                                            if (stok <= 0) {
                                                // Jika stok kosong atau kurang dari 0, tampilkan notifikasi dan kosongkan input
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Stok Kosong!',
                                                    text: 'Stok obat ini sudah habis.',
                                                });

                                                // Kosongkan input field jika stok kosong
                                                $('#kode_obat').val('');
                                                $('#namaObat').val('');
                                                $('#harga').val('');
                                                $('#stok').val('');
                                                $('#satuan').val('');
                                            } else {
                                                // Jika stok mencukupi, masukkan nilai ke dalam input
                                                getInfoObat(
                                                    '<?= addslashes($obt['kode_obat']); ?>', 
                                                    '<?= addslashes($obt['nama_obat']); ?>', 
                                                    '<?= addslashes($obt['harga']); ?>',
                                                    '<?= addslashes($obt['satuan']); ?>',
                                                    '<?= addslashes($obt['kategori']); ?>',
                                                    '<?= addslashes($obt['stok']); ?>'
                                                )
                                            }
                                            
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

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-tosca" style="color: white; border-bottom: none; border-top-left-radius: 10px; border-top-right-radius: 10px; padding: 10px 15px;">
                    <h5 class="modal-title" id="paymentModalLabel" style="font-size: 16px;">Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <!-- Total Payment -->
                    <div class="form-group">
                        <label for="totalPayment" class="form-label">Total</label>
                        <input type="number" class="form-control" id="totalPayment" name="totalPayment" readonly
                            style="border: 1px solid #e2e2e2; border-radius: 5px; padding: 8px 10px; font-size: 14px; transition: border-color 0.3s ease;">
                    </div>

                    <!-- Customer Payment -->
                    <div class="form-group mt-2">
                        <label for="customerPayment" class="form-label">Dibayar</label>
                        <input type="number" class="form-control" id="customerPayment" name="customerPayment" placeholder="Rp 0"
                            style="border: 1px solid #e2e2e2; border-radius: 5px; padding: 8px 10px; font-size: 14px; transition: border-color 0.3s ease;">
                    </div>

                    <!-- Change -->
                    <div class="form-group mt-2">
                        <label for="change" class="form-label">Kembalian</label>
                        <input type="number" class="form-control" id="change" name="change" readonly
                            style="border: 1px solid #e2e2e2; border-radius: 5px; padding: 8px 10px; font-size: 14px; transition: border-color 0.3s ease;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
                        style="padding: 5px 10px; font-size: 14px; border-radius: 5px; background-color: #6c757d; border-color: #6c757d;">Batal</button>
                    <button type="button" class="btn btn-primary btn-sm" id="confirmPayment"
                        style="padding: 5px 10px; font-size: 14px; border-radius: 5px; background-color: #007bff; border-color: #007bff; transition: background-color 0.3s ease;">Bayar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="formInfoBox">
        <div class="modal-dialog modal-dialog-centered modal-xs">
            <div class="modal-content">
                <!-- Modal Header -->

                <div class="modal-body">
                    <table class="table table-bordered" id="table_kadaluwarsa">
                        <thead>
                            <tr class="shadow-animation">
                                <th>KADALUWARSA</th>
                                <th>QTY</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="container_kadaluwarsa">
                            <!-- Baris akan ditambahkan di sini secara dinamis -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- JavaScript -->
    <script>
        let availableQty = {};

        function getInfoObat(kode_obat, nama_obat, harga, satuan, kategori, stok) {
            // Kirim AJAX request ke controller
            $.ajax({
                url: '<?= APP_PATH; ?>/Home/data_obat',
                type: 'POST',
                data: {
                    kode_obat: kode_obat
                },
                success: function(response) {
                    // Parse JSON response
                    var data = JSON.parse(response);

                    // Cek apakah ada data atau error
                    if (data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Stok Obat Kosong',
                            text: data.error,
                            confirmButtonText: 'OK'
                        });

                        // Kosongkan input form
                        $('#kode_obat').val('');
                        $('#namaObat').val('');
                        $('#harga').val('');
                        $('#stok').val('');
                        $('#satuan').val('');
                    } else {
                        // Bersihkan tabel sebelumnya (hapus semua row sebelumnya)
                        $('#container_kadaluwarsa').html('');

                        // Loop untuk menambahkan row baru ke dalam tabel
                        data.forEach(function(item, index) {
                            const tgl_expired = item.tgl_expired;
                            const qty = item.total_obat_masuk;

                            let newRow = `
                        <tr>
                            <td data-tgl-expired="${tgl_expired}">${tgl_expired}</td>
                            <td data-qty="${qty}">${qty}</td>
                            <td>
                                <button type="button" class="btn btn-primary" 
                                    onclick="pilihObat('${tgl_expired}', ${qty}, '${kode_obat}', '${nama_obat}', ${harga}, '${satuan}', '${kategori}', ${stok}, this)">
                                    Pilih
                                </button>
                            </td>
                        </tr>   
                    `;
                            // Tambahkan row baru ke dalam container
                            $('#container_kadaluwarsa').append(newRow);
                        });

                        // Tampilkan modal
                        $('#formInfoBox').modal('show');
                    }
                },
                error: function() {
                    alert('Gagal mengambil data obat');
                }
            });
        }

        // Fungsi untuk menangani ketika tombol "Pilih" diklik
        function pilihObat(tgl_expired, qty, kode_obat, nama_obat, harga, satuan, kategori, stoktotal, el) {
            // Log data yang dipilih
            console.log('Kode Obat:', kode_obat);
            console.log('Nama Obat:', nama_obat);
            console.log('Harga:', harga);
            console.log('Satuan:', satuan);
            console.log('Kategori:', kategori);
            console.log('Stok Total:', stoktotal);

            // Menyimpan quantity yang tersedia
            availableQty[kode_obat] = qty;
            console.log(availableQty);

            // Ambil dan simpan nilai qty dan tgl_expired
            qty1 = qty;
            console.log('Quantity:', qty1);
            tgl_expired1 = tgl_expired;
            console.log('Tanggal Kadaluwarsa:', tgl_expired1);

            // Mengisi input form dengan nilai yang dipilih
            $('#kode_obat').val(kode_obat);
            $('#namaObat').val(nama_obat);
            $('#harga').val(harga);
            $('#satuan').val(satuan);
            $('#kategori').val(kategori);
            $('#stoktotal').val(stoktotal);

            // Tutup modal setelah memilih
            $('#formInfoBox').modal('hide');
        }
    </script>



    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable tanpa paging dan searching
            function initializeTable() {
                if ($.fn.DataTable.isDataTable('#dataTableJualObat')) {
                    $('#dataTableJualObat').DataTable().destroy();
                }

                return $('#dataTableJualObat').DataTable({
                    paging: false,
                    searching: false
                });
            }

            const transactionTable = initializeTable();

            $('#submit_button').on('click', function() {
                // Cek apakah ada data di dalam tabel transaksi
                if (transactionTable.data().count() === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'No transactions!',
                        text: 'Please add at least one transaction before submitting.',
                    });
                    $('#paymentModal').modal('hide');
                    return false; // Mencegah aksi lanjut jika tabel kosong
                } else {
                    $('#paymentModal').modal('show');
                }
            });

            $('#unit').on('input', function() {
                const unit = parseFloat($(this).val()) || 0;
                const qty = qty1;

                // Cek apakah unit yang diinput lebih besar dari stok yang tersedia
                if (unit > qty) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Stok Tidak Cukup',
                        text: 'Unit yang dimasukkan melebihi stok yang tersedia.',
                        confirmButtonText: 'OK'
                    });

                    // Kosongkan input unit atau kembalikan ke nilai stok maksimal
                    $(this).val('');
                }
            });

            // Fungsi untuk menghitung total harga berdasarkan unit dan harga
            function updateTotalPrice() {
                const unit = parseFloat($('#unit').val()) || 0;
                const price = parseFloat($('#harga').val()) || 0;
                $('#total_harga').val((unit * price).toFixed(2));
            }

            // Event listener untuk perubahan unit dan harga
            $('#unit, #harga').on('input', updateTotalPrice);

            // Fungsi untuk menghitung total stok dari tabel
            function updateTotalStock() {
                const stokMap = {};
                transactionTable.rows().every(function() {
                    const data = this.data();
                    const kode_obat = data[0]; // Menggunakan kode_obat sebagai VARCHAR
                    const unit = parseFloat(data[3]) || 0;
                    console.log(`Kode Obat: ${kode_obat}, Unit: ${unit}`); // Tambahkan ini untuk cek
                    stokMap[kode_obat] = (stokMap[kode_obat] || 0) + unit;
                });
                console.log(stokMap); // Tambahkan log ini untuk memantau stokMap
                return stokMap;
            }


            // Fungsi untuk menambahkan baris transaksi baru ke tabel
            function addTransaction() {

                const drugName = $('#namaObat').val();
                const price = $('#harga').val();
                const unit = $('#unit').val();
                const satuan = $('#satuan').val();
                const totalPrice = $('#total_harga').val();
                const kode_obat = $('#kode_obat').val();

                // Validasi input
                if (!drugName || !price || !unit || !totalPrice) {
                    return null; // Menghentikan proses jika ada field yang kosong
                }


                let found = false;
                transactionTable.rows().every(function() {
                    const data = this.data();
                    if (data[1] === drugName) {
                        const existingUnit = parseFloat(data[3]) || 0;
                        const newUnit = existingUnit + parseFloat(unit);
                        data[3] = newUnit;
                        data[5] = (newUnit * parseFloat(price)).toFixed(2);
                        this.data(data).draw(false);
                        found = true;
                        return false;
                    }
                });

                if (!found) {
                    transactionTable.row.add([kode_obat, drugName, price, unit, satuan, totalPrice]).draw();
                }

                $('#formTransaksi')[0].reset();
                updatePaymentModal();
                updateTotalStock();
            }

            // Event listener untuk tombol tambah
            $('#btnAdd').on('click', addTransaction);

            // Fungsi untuk mengupdate total pembayaran di modal
            function updatePaymentModal() {
                let totalPayment = 0;
                transactionTable.rows().every(function() {
                    const totalPrice = parseFloat(this.data()[5]) || 0;
                    totalPayment += totalPrice;
                });
                $('#totalPayment').val(totalPayment.toFixed(2));
                $('#customerPayment, #change').val('');
            }

            // Fungsi untuk menghitung kembalian
            function updateChange() {
                const customerPayment = parseFloat($('#customerPayment').val()) || 0;
                const totalPayment = parseFloat($('#totalPayment').val()) || 0;
                const change = customerPayment - totalPayment;

                if (change < 0) {
                    $('#change').val('');
                    return false;
                } else {
                    $('#change').val(change.toFixed(2));
                    return true;
                }
            }

            // Event listener untuk input pembayaran pelanggan
            $('#customerPayment').on('input', updateChange);

            // Fungsi untuk mendapatkan nomor penjualan terakhir dari server
            function getLastSalesNumber(dateString) {
                let lastSalesNumber;
                $.ajax({
                    type: 'GET',
                    url: '<?= APP_PATH; ?>/Home/get_last_sales_number',
                    async: false,
                    data: {
                        date: dateString
                    },
                    success: function(response) {
                        lastSalesNumber = response.lastSalesNumber;
                    },
                    error: function() {
                        lastSalesNumber = null;
                    }
                });
                return lastSalesNumber;
            }

            // Fungsi untuk membuat nomor penjualan baru
            function generateSalesNumber() {
                const currentDate = new Date();
                const dateString = currentDate.toISOString().split('T')[0].replace(/-/g, '');
                const lastSalesNumber = getLastSalesNumber(dateString);

                let nextNumber = lastSalesNumber ?
                    ('0' + (parseInt(lastSalesNumber.split('/')[2], 10) + 1)).slice(-2) : '01';

                return `PJL/${dateString}/${nextNumber}`;
            }

            // Fungsi untuk menetapkan nomor penjualan dan tanggal
            function setSalesDetails() {
                $('#salesNumber').text(generateSalesNumber());

                const currentDate = new Date();
                const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                $('#currentDate').text(`${('0' + currentDate.getDate()).slice(-2)}/${monthNames[currentDate.getMonth()]}/${currentDate.getFullYear()}`);
            }

            setSalesDetails();

            // Event listener untuk konfirmasi pembayaran
            $('#confirmPayment').on('click', function() {
                const totalPayment = parseFloat($('#totalPayment').val()) || 0;
                const customerPayment = parseFloat($('#customerPayment').val()) || 0;
                const change = customerPayment - totalPayment;

                if (change < 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Insufficient Funds!',
                        text: 'The amount paid is less than the total payment.',
                    });
                    return false;
                } else {
                    const stokMap = updateTotalStock(); // Menghitung stokMap sebelum mengirim data

                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: "btn btn-success custom-btn-spacing",
                            cancelButton: "btn btn-danger custom-btn-spacing"
                        },
                        buttonsStyling: false
                    });

                    swalWithBootstrapButtons.fire({
                        title: "Are you sure you want to proceed?",
                        text: "Please confirm your payment before continuing.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes",
                        cancelButtonText: "No",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            swalWithBootstrapButtons.fire({
                                title: "Done",
                                text: "Your payment is complete!",
                                icon: "success"
                            }).then(function() {
                                // Mengumpulkan semua data transaksi dalam satu array
                                const transactionData = [];
                                transactionTable.rows().every(function() {
                                    const data = this.data();
                                    transactionData.push({
                                        no_penjualan: $('#salesNumber').text(),
                                        tgl_penjualan: new Date().toISOString().slice(0, 10),
                                        pegawai: '<?= $_SESSION['user_id'] ?>',
                                        total_penjualan: totalPayment.toFixed(2),
                                        nama_obat: data[1],
                                        harga: parseFloat(data[2]) || 0,
                                        jumlah: parseFloat(data[3]) || 0,
                                        satuan: data[4],
                                        subtotal: parseFloat(data[5]) || 0,
                                        kembalian: change.toFixed(2),
                                        tgl_expired: tgl_expired1,
                                        stokMap: stokMap // Tambahkan stokMap ke dalam setiap transaksi
                                    });
                                });
                                alert(JSON.stringify(transactionData));

                                // Kirim data transaksi ke server via AJAX
                                $.ajax({
                                    type: 'POST',
                                    url: '<?= APP_PATH; ?>/Home/save_histori_jual',
                                    data: {
                                        transaksi: transactionData
                                    }, // Kirim data dalam bentuk array
                                    success: function(response) {
                                        console.log(response);
                                        location.reload();
                                    },
                                    error: function() {
                                        console.log("Error sending transaction data.");
                                    }
                                });
                            });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            swalWithBootstrapButtons.fire({
                                title: "Cancelled",
                                text: "Payment has been canceled.",
                                icon: "error"
                            });
                        }
                    });
                }

                return true;
            });

        });
    </script>