<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-dark">DATA PEGAWAI</h6>
            </div>
            <div class="col-auto">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#formInsertBox">
                        <i class="fas fa-plus"></i> TAMBAH DATA PEGAWAI
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTablePegawai" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">NAMA</th>
                        <th class="text-center">POSISI</th>
                        <th class="text-center">ALAMAT</th>
                        <th class="text-center">JENIS KELAMIN</th>
                        <th class="text-center">TANGGAL LAHIR</th>
                        <th class="text-center">NOMOR TELEPON</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">TINDAKAN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($data['pegawai'] as $pgw) : ?>
                        <tr class="shadow-animation">
                            <td><?= $count; ?></td>
                            <td><?= htmlspecialchars($pgw['nama_pegawai']); ?></td>
                            <td><?= htmlspecialchars($pgw['posisi']); ?></td>
                            <td><?= htmlspecialchars($pgw['alamat_pegawai']); ?></td>
                            <td><?= htmlspecialchars($pgw['jenis_kelamin']); ?></td>
                            <td><?= htmlspecialchars($pgw['tanggal_lahir']); ?></td>
                            <td><?= htmlspecialchars($pgw['telepon_pegawai']); ?></td>
                            <td><?= htmlspecialchars($pgw['email_pegawai']); ?></td>
                            <td class="text-center">
                                <!-- edit button -->
                                <button type="button" class="btn btn-info" data-id="<?= $pgw['pegawai_id']; ?>" onclick="
                                            $('#pgw_id_update').val('<?= $pgw['pegawai_id'] ?>');
                                            $('#pgw_nama_update').val('<?= $pgw['nama_pegawai'] ?>');
                                            $('#pgw_posisi_update').val('<?= $pgw['posisi'] ?>');
                                            $('#pgw_alamat_update').val('<?= $pgw['alamat_pegawai'] ?>');
                                            $('#pgw_jenis_kelamin_update').val('<?= $pgw['jenis_kelamin'] ?>');
                                            $('#pgw_tanggal_lahir_update').val('<?= $pgw['tanggal_lahir'] ?>');
                                            $('#pgw_telepon_update').val('<?= $pgw['telepon_pegawai'] ?>');
                                            $('#pgw_email_update').val('<?= $pgw['email_pegawai'] ?>');
                                            $('#formUpdateBox').modal('show');">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-- delete button -->
                                <button type="button" class="btn btn-danger" onclick="confirmDelete('<?= $pgw['pegawai_id']; ?>', '<?= htmlspecialchars($pgw['nama_pegawai']); ?>')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <?php $count++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


        <!-- insert modal -->
        <div class="modal" id="formInsertBox">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah data pegawai</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="<?= APP_PATH; ?>/Home/insertPegawai" method="POST" id="formUpdate">
                            <div class="row p-1">
                                <div class="col-md-6">
                                    <label for="pgw_id" class="text-dark text-small">ID:</label>
                                    <input type="text" name="pgw_id" id="pgw_id" class="form-control input-sm" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="pgw_nama" class="text-dark text-small">Nama:</label>
                                    <input type="text" name="pgw_nama" id="pgw_nama" class="form-control input-sm" required>
                                </div>
                            </div>

                            <div class="row p-1">
                                <div class="col-md-6">
                                    <label for="pgw_posisi " class="text-dark text-small">Posisi:</label>
                                    <select name="pgw_posisi" id="pgw_posisi" class="form-control input-sm" required>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                                <div class="col-md-6" class="text-dark text-small">
                                    <label for="pgw_alamat">Alamat:</label>
                                    <input type="text" name="pgw_alamat" id="pgw_alamat" class="form-control input-sm" required>
                                </div>
                            </div>

                            <div class="row p-1">
                                <div class="col-md-6">
                                    <label for="pgw_jenis_kelamin" class="text-dark text-small">Jenis Kelamin:</label>
                                    <select name="pgw_jenis_kelamin" id="pgw_jenis_kelamin" class="form-control input-sm" required>
                                        <option value=""></option>
                                        <option value="Laki-laki">Pria</option>
                                        <option value="Perempuan">Wanita</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="pgw_tanggal_lahir" class="text-dark text-small">Tanggal Lahir:</label>
                                    <input type="date" name="pgw_tanggal_lahir" id="pgw_tanggal_lahir" class="form-control input-sm" required>
                                </div>
                            </div>

                            <div class="row p-1">
                                <div class="col-md-6">
                                    <label for="pgw_nomor_hp" class="text-dark text-small">Nomor HP:</label>
                                    <input type="text" name="pgw_nomor_hp" id="pgw_nomor_hp" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="pgw_email" class="text-dark text-small">Email:</label>
                                    <input type="text" name="pgw_email" id="pgw_email" class="form-control input-sm" required>
                                </div>
                            </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Masukan data</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- update modal -->
        <div class="modal" id="formUpdateBox">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update data pegawai</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="<?= APP_PATH; ?>/Home/updatePegawai" method="POST" id="formUpdate">
                            <div class="row p-1">
                                <div class="col-md-6">
                                    <label for="pgw_id_update" class="text-dark text-small">ID:</label>
                                    <input type="text" name="pgw_id_update" id="pgw_id_update" class="form-control input-sm" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="pgw_nama_update" class="text-dark text-small">Nama:</label>
                                    <input type="text" name="pgw_nama_update" id="pgw_nama_update" class="form-control input-sm" required>
                                </div>
                            </div>

                            <div class="row p-1">
                                <div class="col-md-6">
                                    <label for="pgw_posisi_update" class="text-dark text-small">Posisi:</label>
                                    <select name="pgw_posisi_update" id="pgw_posisi_update" class="form-control input-sm" required>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="pgw_alamat_update" class="text-dark text-small">Alamat:</label>
                                    <input type="text" name="pgw_alamat_update" id="pgw_alamat_update" class="form-control input-sm" required>
                                </div>
                            </div>

                            <div class="row p-1">
                                <div class="col-md-6">
                                    <label for="pgw_jenis_kelamin_update" class="text-dark text-small">Jenis Kelamin:</label>
                                    <select name="pgw_jenis_kelamin_update" id="pgw_jenis_kelamin_update" class="form-control input-sm" required>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="pgw_tanggal_lahir_update" class="text-dark text-small">Tanggal Lahir:</label>
                                    <input type="date" name="pgw_tanggal_lahir_update" id="pgw_tanggal_lahir_update" class="form-control input-sm" required>
                                </div>
                            </div>

                            <div class="row p-1">
                                <div class="col-md-6">
                                    <label for="pgw_telepon_update" class="text-dark text-small">Nomor HP:</label>
                                    <input type="text" name="pgw_nomor_hp_update" id="pgw_telepon_update" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="pgw_email_update" class="text-dark text-small">Email:</label>
                                    <input type="text" name="pgw_email_update" id="pgw_email_update" class="form-control input-sm" required>
                                </div>
                            </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update data</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(pegawaiId, namaPegawai) {
        Swal.fire({
            title: `Apakah Anda yakin ingin menghapus data '${namaPegawai}'?`,
            text: "Data ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke URL penghapusan setelah konfirmasi
                window.location.href = `<?= APP_PATH; ?>/Home/deletePegawai/${pegawaiId}`;
            }
        });
    }
</script>