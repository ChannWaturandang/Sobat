<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-dark">DATA SUPPLIER</h6>
            </div>
            <div class="col-auto">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#formInsertBox">
                        <i class="fas fa-plus"></i> TAMBAH DATA SUPPLIER
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTableSupplier" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">NAMA</th>
                        <th class="text-center">ALAMAT</th>
                        <th class="text-center">NAMA PETUGAS</th>
                        <th class="text-center">KONTAK PETUGAS</th>
                        <th class="text-center">TINDAKAN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($data['supplier'] as $sup) : ?>
                        <tr class="shadow-animation">
                            <td><?= $count; ?></td>
                            <td><?= htmlspecialchars($sup['nama_supplier']); ?></td>
                            <td><?= htmlspecialchars($sup['alamat_supplier']); ?></td>
                            <td><?= htmlspecialchars($sup['nama_petugas']); ?></td>
                            <td><?= htmlspecialchars($sup['kontak_petugas']); ?></td>
                            <td class="text-center">
                                <!-- edit button -->
                                <button type="button" class="btn btn-info" data-id="<?= $sup['supplier_id']; ?>" onclick="
                                        $('#sup_id_update').val('<?= $sup['supplier_id'] ?>');
                                        $('#sup_nama_update').val('<?= $sup['nama_supplier'] ?>');
                                        $('#sup_alamat_update').val('<?= $sup['alamat_supplier'] ?>');
                                        $('#sup_nama_petugas_update').val('<?= $sup['nama_petugas'] ?>');
                                        $('#sup_kontak_petugas_update').val('<?= $sup['kontak_petugas'] ?>');
                                        $('#formUpdateBox').modal('show');">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-- delete button -->
                                <a href="<?= APP_PATH; ?>/Home/deleteSupplier/<?= $sup['supplier_id']; ?>" class="btn btn-danger" type="button">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
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
                        <h4 class="modal-title">TAMBAH DATA SUPPLIER</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="<?= APP_PATH; ?>/Home/insertSupplier" method="POST">
                            <div class="row p-1">
                                <div class="col-md-12">
                                    <label for="sup_id" class="text-dark text-small">ID SUPPLIER:</label>
                                    <input type="text" name="sup_id" id="sup_id" class="form-control input-sm" placeholder="..." readonly>
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="col-md-6">
                                    <label for="sup_nama" class="text-dark text-small">NAMA SUPPLIER:</label>
                                    <input type="text" name="sup_nama" id="sup_nama" class="form-control input-sm" placeholder="masukan nama supplier" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="sup_alamat" class="text-dark text-small">ALAMAT SUPPLIER:</label>
                                    <input type="text" name="sup_alamat" id="sup_alamat" class="form-control input-sm" placeholder="masukan alamat supplier" required>
                                </div>
                            </div>

                            <div class="row p-1">
                                <div class="col-md-6">
                                    <label for="sup_nama_petugas" class="text-dark text-small">NAMA PETUGAS:</label>
                                    <input type="text" name="sup_nama_petugas" id="sup_nama_petugas" class="form-control input-sm" placeholder="masukan nama petugas" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="sup_kontak_petugas" class="text-dark text-small">KONTAK PETUGAS:</label>
                                    <input type="text" name="sup_kontak_petugas" id="sup_kontak_petugas" class="form-control input-sm" placeholder="masukan kontak petugas" required>
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
                        <h4 class="modal-title">UPDATE DATA SUPPLIER</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="<?= APP_PATH; ?>/Home/updateSupplier" method="POST" id="formUpdate">
                            <div class="row p-1">
                                <div class="col-md-12">
                                    <label for="sup_id_update" class="text-dark text-small">ID SUPPLIER:</label>
                                    <input type="text" name="sup_id_update" id="sup_id_update" class="form-control input-sm" readonly>
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="col-md-6">
                                    <label for="sup_nama_update" class="text-dark text-small">NAMA SUPPLIER:</label>
                                    <input type="text" name="sup_nama_update" id="sup_nama_update" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="sup_alamat_update" class="text-dark text-small">ALAMAT:</label>
                                    <input type="text" name="sup_alamat_update" id="sup_alamat_update" class="form-control input-sm" required>
                                </div>
                            </div>

                            <div class="row p-1">
                                <div class="col-md-6">
                                    <label for="sup_nama_petugas_update" class="text-dark text-small">NAMA PETUGAS:</label>
                                    <input type="text" name="sup_nama_petugas_update" id="sup_nama_petugas_update" class="form-control input-sm" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="sup_kontak_petugas_update" class="text-dark text-small">KONTAK PETUGAS:</label>
                                    <input type="text" name="sup_kontak_petugas_update" id="sup_kontak_petugas_update" class="form-control input-sm" required>
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