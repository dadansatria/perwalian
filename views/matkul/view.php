


<!--=====================================
=            Logic Here :3            =
======================================-->

<?php
	$id = $_GET['id']; 
	$value = dadan_matkul::find($id);
?>

<div class="box box-primary">
	<div class="box-header">
		Detail Mata Kuliah
	</div>
	<div class="box-body">
		<table class="table table-condensed">
			<tr>
				<td>Kode Matkul</td>
				<td>:</td>
				<td><?= $value['kode'] ?></td>
			</tr>
			<tr>
				<td>Jurusan</td>
				<td>:</td>
				<td><?= dadan_matkul::relasi('dadan_jurusan','nama',$value['id_jurusan']) ?></td>
			</tr>

			<tr>
				<td>Nama Matkul</td>
				<td>:</td>
				<td><?= $value['nama'] ?></td>
			</tr>

			<tr>
				<td>Jumlah SKS</td>
				<td>:</td>
				<td><?= $value['sks'] ?></td>
			</tr>
		</table>
	</div>
</div>