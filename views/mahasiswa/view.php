


<!--=====================================
=            Logic Here :3            =
======================================-->

<?php
	$id = $_GET['npm']; 
	$value = dadan_mahasiswa::find($id);
?>

<div class="box box-primary">
	<div class="box-header">
		Detail Mahasiswa
	</div>
	<div class="box-body">
		<table class="table table-condensed">
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?= $value['nama'] ?></td>
			</tr>

			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td><?= $value['alamat'] ?></td>
			</tr>

			<tr>
				<td>No HP</td>
				<td>:</td>
				<td><?= $value['angkatan'] ?></td>
			</tr>
		</table>
	</div>
</div>