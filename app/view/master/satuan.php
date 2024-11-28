<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="row align-items-center">
			<div class="col">
				<h6 class="m-0 font-weight-bold text-dark">satuan</h6>
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
			<table class="table table-bordered" id="dataTableSatuan" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="text-center">NO</th>
						<th class="text-center">satuan</th>
						<th class="text-center">TINDAKAN</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$count = 1;
					foreach ($data['satuan'] as $obt) : ?>
						<tr>
							<td><?= $count; ?></td>
							<td><?= htmlspecialchars($obt['satuan']); ?></td>
							<td class="text-center">
								<!-- edit button -->
								<button type="button" class="btn btn-info" data-id="<?= $obt['satuan_id']; ?>" onclick="
											$('#satuan_id').val('<?= $obt['satuan_id'] ?>');
											$('#satuan_name').val('<?= $obt['satuan'] ?>');
											$('#formUpdateBox').modal('show');">
									<i class="fas fa-edit"></i>
								</button>
								<!-- delete button -->
								<a href="<?= APP_PATH; ?>/Home/delete_satuan/<?= $obt['satuan_id']; ?>" class="btn btn-danger" type="button">
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
						<form action="<?= APP_PATH; ?>/Home/insert_satuan" method="POST">
							<div class="mb-3 mt-3 flex-obat-module">
								<label for="satuan">satuan:</label>
								<input type="text" name="satuan" id="satuan" class="form-control input-sm" required>
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
						<form action="<?= APP_PATH; ?>/Home/update_satuan" method="POST" id="formUpdate">
							<input type="hidden" name="satuan_id" id="satuan_id">

							<!-- Grouping input with label -->
							<div class="form-group flex-obat-module">
								<label for="satuan">satuan:</label>
								<input type="text" name="satuan" id="satuan_name" class="form-control input-sm" required>
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