<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="row align-items-center">
			<div class="col">
				<h6 class="m-0 font-weight-bold text-dark">Kategori</h6>
			</div>
			<div class="col-auto">
				<div class="d-flex justify-content-end">
					<button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#formInsertBox">
						<i class="fas fa-plus"></i> Tambah data obat
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">

			<table class="table table-bordered" id="dataTableKategori" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="text-center">NO</th>
						<th class="text-center">KATEGORI</th>
						<th class="text-center">TINDAKAN</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$count = 1;
					foreach ($data['kategori'] as $obt) : ?>
						<tr>
							<td><?= $count; ?></td>
							<td><?= htmlspecialchars($obt['kategori']); ?></td>
							<td class="text-center">
								<!-- edit button -->
								<button type="button" class="btn btn-info" data-id="<?= $obt['kategori_id']; ?>" onclick="
												$('#kategori_id').val('<?= $obt['kategori_id'] ?>');
												$('#kategori_name').val('<?= $obt['kategori'] ?>');
												$('#formUpdateBox').modal('show');">
									<i class="fas fa-edit"></i>
								</button>
								<!-- delete button -->
								<a href="<?= APP_PATH; ?>/Home/delete_kategori/<?= $obt['kategori_id']; ?>" class="btn btn-danger" type="button">
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
						<h4 class="modal-title">TAMBAH DATA OBAT</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<!-- Modal body -->
					<div class="modal-body">
						<form action="<?= APP_PATH; ?>/Home/insert_kategori" method="POST">
							<div class="mb-3 mt-3 flex-obat-module">
								<label for="kategori">Kategori:</label>
								<input type="text" name="kategori" id="kategori" class="form-control input-sm" required>
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
						<h4 class="modal-title">UPDATE DATA OBAT</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<!-- Modal body -->
					<div class="modal-body">
						<form action="<?= APP_PATH; ?>/Home/update_kategori" method="POST" id="formUpdate">
							<input type="hidden" name="kategori_id" id="kategori_id">

							<!-- Grouping input with label -->
							<div class="form-group flex-obat-module">
								<label for="kategori">Kategori:</label>
								<input type="text" name="kategori" id="kategori_name" class="form-control input-sm" required>
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