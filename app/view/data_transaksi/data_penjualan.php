<div class="container-fluid">
	<div class="page-content">
		<div class="row mb-3">
			<div class="col-6 text-left">
				<h4 class="judul">Data Penjualan</h4>
			</div>
			<div class="col-6 text-right">
				<a href="?page=form_laporanpenjualan" class="size btn btn-sm btn-pink">
					Buat Laporan Penjualan
				</a>
				<a href="?page=datapenjualan_perobat" class="size btn btn-sm btn-green">
					Data Penjualan per Obat
				</a>
				<a href="<?= APP_PATH; ?>/Home/transaksi_jual">
					<button class="btn btn-sm btn-info size">Transaksi Penjualan Obat</button>
				</a>
			</div>

		</div>
		<!-- table data penjualan -->
		<div class="table-responsive">
			<table class="table table-striped table-hover table-data" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr class="table-light">
						<th class="text-center">No</th>
						<th class="text-center">No Penjualan</th>
						<th class="text-center">Tanggal Penjualan</th>
						<th class="text-center">Pegawai</th>
						<th class="text-center">Total Penjualan</th>
						<th class="text-center">Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$count = 1;
					foreach ($data['obat'] as $obt) : ?>
						<tr>
							<td><?= $count; ?></td>
							<td><?= htmlspecialchars($obt['no_penjualan']); ?></td>
							<td><?= htmlspecialchars($obt['tgl_penjualan']); ?></td>
							<td><?= htmlspecialchars($obt['pegawai']); ?></td>
							<td><?= htmlspecialchars($obt['total_penjualan']); ?></td>
						
							<td class="text-center">
								<!-- edit button -->
								<button type="button" class="btn btn-info" data-id="<?= $obt['obat_id']; ?>" onclick="
										$('#obt_id_update').val('<?= $obt['obat_id'] ?>');
										$('#obt_kode_update').val('<?= $obt['kode_obat'] ?>');
										$('#obt_nama_update').val('<?= $obt['nama_obat'] ?>');
										$('#obt_harga_update').val('<?= $obt['harga'] ?>');
										$('#obt_stok_update').val('<?= $obt['stok'] ?>');
										$('#obt_satuan_update').val('<?= $obt['satuan'] ?>');
										$('#obt_ketegori_update').val('<?= $obt['kategori'] ?>');
										$('#obt_tgl_masuk_update').val('<?= $obt['tgl_masuk'] ?>');
										$('#obt_tgl_kadaluarsa_update').val('<?= $obt['tgl_kadaluarsa'] ?>');
										$('#obt_tgl_pengembalian_update').val('<?= $obt['tgl_pengembalian'] ?>');
										$('#obt_sisa_hari_update').val('<?= $obt['sisa_hari'] ?>');
										$('#formUpdateBox').modal('show');">
									<i class="fa-solid fa-circle-info"></i>
								</button>

								<button type="button" class="btn btn-dark"><i class="fa-solid fa-print"></i></button>

								<!-- delete button -->
								<a href="<?= APP_PATH; ?>/Home/delete/<?= $obt['obat_id']; ?>" class="btn btn-danger" type="button">
									<i class="fas fa-trash-alt"></i>
								</a>
							</td>
						</tr>
						<?php $count++; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>