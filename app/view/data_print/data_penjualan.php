<html>

<head>
	<script src="https://cdn.tailwindcss.com">
	</script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
	<style>
		body {
			font-family: 'Roboto', sans-serif;
		}

		@media print {
			.no-print {
				display: none;
			}
		}
	</style>
</head>

<body class="bg-white p-8">
	<div class="max-w-2xl mx-auto">
		<div class="flex justify-between items-center mb-8">
			<img alt="Apotek Logo" class="h-12" height="50" src="https://storage.googleapis.com/a1aa/image/awkn4nzeMqTBIie41SLEUnBrGjfGxaggM8V4UWibHdJcmmTnA.jpg" width="100" />
			<div class="text-right">
				<p>
					Apotek Sehat
				</p>
				<p>
					Jl. Kesehatan No. 123
				</p>
				<p>
					Jakarta, Indonesia
				</p>
				<p>
					info@apoteksehat.com
				</p>
			</div>
		</div>
		<div class="mb-8">
			<h1 class="text-2xl font-bold">
				Nama Pelanggan
			</h1>
			<p>
				Tanggal Pembayaran:
				<span class="font-bold">
					24 Mei 2024
				</span>
			</p>
			<p>
				No. Penjualan:
				<span class="font-bold">
					12345
				</span>
			</p>
		</div>
		<table class="w-full mb-8">
			<thead>
				<tr class="text-left text-gray-500">
					<th class="py-2">
						QTY
					</th>
					<th class="py-2">
						DESKRIPSI
					</th>
					<th class="py-2">
						HARGA
					</th>
					<th class="py-2">
						SUBTOTAL
					</th>
				</tr>
			</thead>
			<tbody>
				<tr class="border-t">
					<td class="py-2">
						2
					</td>
					<td class="py-2">
						Obat A
					</td>
					<td class="py-2">
						Rp15.000
					</td>
					<td class="py-2 font-bold">
						Rp30.000
					</td>
				</tr>
				<tr class="border-t">
					<td class="py-2">
						4
					</td>
					<td class="py-2">
						Obat B
					</td>
					<td class="py-2">
						Rp10.000
					</td>
					<td class="py-2 font-bold">
						Rp40.000
					</td>
				</tr>
				<tr class="border-t">
					<td class="py-2">
						5
					</td>
					<td class="py-2">
						Obat C
					</td>
					<td class="py-2">
						Rp7.000
					</td>
					<td class="py-2 font-bold">
						Rp35.000
					</td>
				</tr>
			</tbody>
		</table>
		<div class="flex justify-between items-center mb-8">
			<div>
				<h2 class="text-gray-500">
					METODE PEMBAYARAN
				</h2>
				<p class="font-bold">
					Tunai
				</p>
			</div>
			<div class="text-right">
				<h2 class="text-gray-500">
					TOTAL DUE
				</h2>
				<p class="text-2xl font-bold text-red-500">
					Rp105.000
				</p>
			</div>
		</div>
		<div class="flex items-center">
			<i class="fas fa-heart text-red-500 mr-2">
			</i>
			<p>
				Terima kasih!
			</p>
		</div>
		<div class="flex justify-end mt-8 no-print">
			<a class="bg-green-500 text-white px-4 py-2 rounded mr-2" href="<?= APP_PATH;?>/Home/laporan">
				Kembali
			</a>
			<button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="window.print()">
				Cetak Struk
			</button>
		</div>
	</div>
</body>

</html>