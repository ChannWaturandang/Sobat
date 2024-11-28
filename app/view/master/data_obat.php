<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div class="row align-items-center">
			<div class="col">
				<h6 class="m-0 font-weight-bold text-dark">DATA OBAT</h6>
			</div>
			<div class="col-auto">
				<div class="d-flex justify-content-end">
					<button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#formInsertBox">
						<i class="fas fa-plus"></i> TAMBAH DATA OBAT
					</button>
					<a href="<?= APP_PATH; ?>/Home/kadaluwarsa" type="button" class="btn btn-danger">
						<i class="fas fa-exclamation-triangle"></i> KADALUWARSA OBAT
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">

			<table class="table table-bordered" id="dataTableInformasiObat" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="text-center">NO</th>
						<th class="text-center">KODE</th>
						<th class="text-center">OBAT</th>
						<th class="text-center">HARGA</th>
						<th class="text-center">STOK</th>
						<th class="text-center">SATUAN</th>
						<th class="text-center">KATEGORI</th>
						<th class="text-center">TINDAKAN</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$count = 1;
					foreach ($data['informasi_obat'] as $obt) : ?>
						<tr class="shadow-animation">
							<td><?= $count; ?></td>
							<td><?= htmlspecialchars($obt['kode_obat']); ?></td>
							<td><?= htmlspecialchars($obt['nama_obat']); ?></td>
							<td><?= htmlspecialchars($obt['harga']); ?></td>
							<td><?= htmlspecialchars($obt['stok']); ?></td>
							<td><?= htmlspecialchars($obt['satuan']); ?></td>
							<td><?= htmlspecialchars($obt['kategori']); ?></td>
							<td class="text-center">
								<!-- edit button -->
								<button type="button" class="btn btn-info" data-id="<?= $obt['kode_obat']; ?>" onclick="
												$('#obt_kode_update').val('<?= $obt['kode_obat'] ?>');
												$('#obt_nama_update').val('<?= $obt['nama_obat'] ?>');
												$('#obt_harga_update').val('<?= $obt['harga'] ?>');
												$('#obt_stok_update').val('<?= $obt['stok'] ?>');
												$('#obt_satuan_update').val('<?= $obt['satuan'] ?>');
												$('#obt_kategori_update').val('<?= $obt['kategori'] ?>');
												$('#indikasi_update').val('<?= $obt['indikasi'] ?>');
												$('#formUpdateBox').modal('show');">
									<i class="fas fa-edit"></i>
								</button>
	
								<button type="button" class="btn btn-success" onclick="getInfoObat('<?= $obt['kode_obat']; ?>')">
									<i class="fas fa-info-circle"></i>
								</button>
	
	
								<!-- delete button -->
								<a href="<?= APP_PATH; ?>/Home/delete/<?= $obt['kode_obat']; ?>" class="btn btn-danger" type="button">
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
						<form action="<?= APP_PATH; ?>/Home/insert" method="POST">
							<div class="row p-1">
								<div class="col-md-6">
									<label for="obt_kode" class="text-dark text-small">KODE OBAT</label>
									<input type="text" name="obt_kode" id="obt_kode" class="form-control input-sm" placeholder="masukan kode obat" required>
								</div>
								<div class="col-md-6">
									<label for="obt_nama" class="text-dark text-small">NAMA OBAT</label>
									<input type="text" name="obt_nama" id="obt_nama" class="form-control input-sm" placeholder="masukan nama obat" required>
								</div>
							</div>

							<div class="row p-1">
								<div class="col-md-6">
									<label for="obt_harga" class="text-dark text-small">HARGA OBAT</label>
									<input type="text" name="obt_harga" id="obt_harga" class="form-control input-sm" placeholder="masukan harga obat" required>
								</div>
								<div class="col-md-6">
									<label for="obt_stok" class="text-dark text-small">STOK OBAT</label>
									<input type="text" name="obt_stok" id="obt_stok" class="form-control input-sm" placeholder="stok obat" readonly>
								</div>
							</div>

							<div class="row p-1">
								<div class="col-md-6">
									<label for="obt_satuan" class="text-dark text-small">SATUAN OBAT:</label>
									<select name="obt_satuan" id="obt_satuan" class="form-control input-sm" required>
										<option value="" disabled selected>lakukan pembelian obat</option> <!-- Default empty option -->
										<?php foreach ($data['satuan'] as $satuan): ?>
											<option value="<?= $satuan['satuan']; ?>"><?= $satuan['satuan']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-md-6">
									<label for="obt_kategori" class="text-dark text-small">Kategori Obat:</label>
									<select name="obt_ketegori" id="obt_ketegori" class="form-control input-sm" required>
										<option value=""></option> <!-- Default empty option -->
										<?php foreach ($data['kategori'] as $kategori): ?>
											<option value="<?= $kategori['kategori']; ?>"><?= $kategori['kategori']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="row p-1">
								<div class="col-md-12">
									<label for="indikasi" class="text-dark text-small">INDIKASI</label>
									<textarea class="form-control" id="indikasi" name="indikasi" rows="4" required></textarea>
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
						<h4 class="modal-title">UPDATE DATA OBAT</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>
					<!-- Modal body -->
					<div class="modal-body">
						<form action="<?= APP_PATH; ?>/Home/update" method="POST" id="formUpdate">
							<div class="row">
								<div class="col-md-6">
									<label for="obt_kode_update" class="text-dark text-small">KODE OBAT</label>
									<input type="text" name="obt_kode_update" id="obt_kode_update" class="form-control input-sm" readonly>
								</div>

								<div class="col-md-6">
									<label for="obt_nama_update" class="text-dark text-small">NAMA OBAT:</label>
									<input type="text" name="obt_nama_update" id="obt_nama_update" class="form-control input-sm" required>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<label for="obt_harga_update" class="text-dark text-small">HARGA OBAT</label>
									<input type="text" name="obt_harga_update" id="obt_harga_update" class="form-control input-sm" required>
								</div>

								<div class="col-md-6">
									<label for="obt_stok_update" class="text-dark text-small">STOK OBAT</label>
									<input type="text" name="obt_stok_update" id="obt_stok_update" class="form-control input-sm" readonly>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<label for="obt_satuan_update" class="text-dark text-small">SATUAN OBAT</label>
									<select name="obt_satuan_update" id="obt_satuan_update" class="form-control input-sm" required>
										<option value="">Pilih satuan obat</option>
										<option id="obt_satuan_update" value="" selected></option>
										<?php foreach ($data['satuan'] as $satuan): ?>
											<option value="<?= $satuan['satuan']; ?>"><?= $satuan['satuan']; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="col-md-6">
									<label for="kategori" class="text-dark text-small">KATEGORI OBAT</label>
									<select name="obt_kategori_update" id="obt_kategori_update" class="form-control input-sm" required>
										<option id="obt_kategori_update" value=""></option> <!-- Default empty option -->
										<?php foreach ($data['kategori'] as $kategori): ?>
											<option value="<?= $kategori['kategori']; ?>"><?= $kategori['kategori']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="row p-1">
								<div class="col-md-12">
									<label for="indikasi_update" class="form-label text-dark">INDIKASI</label>
									<textarea class="form-control" id="indikasi_update" name="indikasi_update" rows="4" required></textarea>
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




		<!-- Modal Info Obat -->
		<div class="modal" id="formInfoBox">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header bg-gradient text-white">
						<h5 class="modal-title" id="infoObatBoxLabel">Detail Obat</h5>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<!-- Modal Body with Grid Layout -->
					<div class="modal-body">
						<div id="container_kadaluwarsa">
							<!-- Row akan ditambahkan di sini secara dinamis -->
						</div>
					</div>
					<!-- Modal Footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function getInfoObat(kode_obat) {
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
					// Menggunakan SweetAlert2 untuk notifikasi error
					Swal.fire({
						icon: 'error',
						title: 'Obat Tidak Ditemukan',
						text: data.error,
						confirmButtonText: 'OK'
					});
				} else {
					// Bersihkan input sebelumnya (hapus semua row sebelumnya)
					$('#container_kadaluwarsa').html('');

					// Loop untuk menambahkan row baru setiap kali ada data kadaluarsa dan qty
					data.forEach(function(item, index) {
						let newRow = `
							<div class="row">
								<div class="col-md-6">
									<label for="kadaluwarsa_${index}" class="text-dark text-small">KADALUWARSA</label>
									<input type="text" name="kadaluwarsa_${index}" id="kadaluwarsa_${index}" class="form-control input-sm" value="${item.tgl_expired}" readonly>
								</div>

								<div class="col-md-6">
									<label for="qty_${index}" class="text-dark text-small">QTY</label>
									<input type="text" name="qty_${index}" id="qty_${index}" class="form-control input-sm" value="${item.total_obat_masuk}" readonly>
								</div>
							</div>
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
</script>