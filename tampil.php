<?php

//session_start();
include 'config/connection.php';

include 'include/check.php';

$query = "SELECT a.*, b.itemName FROM temp_order a INNER JOIN item b ON a.itemID=b.itemID WHERE a.user='$_SESSION[username]'";
$result = mysqli_query($dbc, $query); ?>

<div class="card">
	<div class="card-body">
		<h4 class="card-title">Daftar Barang</h4>
		<h6 class="card-subtitle">Daftar barang pesanan</h6>

		<div class="table-responsive mt-4">
			<table class="table" style="width: 100%;">
				<thead class="bg-primary text-white">
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Jumlah</th>
						<th class="text-center">Nama</th>
						<th class="text-center">Harga</th>
						<th class="text-center">Total</th>
						<th class="text-center">Keterangan</th>
						<!-- <th class="text-center">Foto/Gambar</th> -->
						<!-- <th class="text-center">Opsi</th> -->
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					while ($data = mysqli_fetch_array($result)) { ?>
						<tr>
							<td><?= $i++ ?></td>
							<td class="text-right"><?= Round($data['quantity']) ?></td>
							<td><?= $data['itemName'] ?></td>
							<td class="text-right"><?= rupiah(Round($data['price'])) ?></td>
							<td class="text-right"><?= rupiah($data['quantity'] * $data['price']) ?></td>
							<td><?= $data['keterangan'] ?></td>
							<!-- <td><img src="storage/order/<?= $data['image'] ?>" width="200px;" />
							</td>							 -->
						</tr>
					<?php }

					function rupiah($angka)
					{

						$hasil_rupiah = number_format($angka, 0, ',', '.');
						return $hasil_rupiah;
					}
					?>
				</tbody>
			</table>



		</div>
	</div>
</div>