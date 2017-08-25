<?php 
	require_once('models/dadan_matkul.php'); 
	require_once('models/dadan_perwalian_matkul.php'); 
	require_once('models/dadan_user.php'); 
?>


<!--=====================================
=            Logic Here :3            =
======================================-->

<?php
	$id = $_GET['id']; 
	$value = dadan_perwalian::find("id = $id");
?>

<div class="box box-primary">
	<div class="box-header">
		Detail Perwalian
	</div>
	<div class="box-body">
		<table class="table table-condensed">
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?= $value['nama'] ?></td>
			</tr>
			<tr>
				<td>Nama Dosen</td>
				<td>:</td>
				<td><?= dadan_perwalian::relasi('dadan_dosen','nama',$value['id_dosen']); ?></td>
			</tr>
			<tr>
				<td>Nama Mahasiswa</td>
				<td>:</td>
				<td><?= dadan_perwalian::relasi('dadan_mahasiswa','nama',$value['npm']); ?></td>
			</tr>
			<tr>
				<td>NPM</td>
				<td>:</td>
				<td><?= $value['npm']; ?></td>
			</tr>
			<tr>
				<td>Status</td>
				<td>:</td>
				<td><?= $value['status']; ?></td>
			</tr>
			<tr>
				<td>Keterangan Perwalian</td>
				<td>:</td>
				<td><?= $value['keterangan'] ?></td>
			</tr>
		</table>
	</div>
</div>

<?php if(dadan_user::isMahasiswa()){
	require_once('_mahasiswa.php');
} elseif(dadan_user::isDosen()){
	require_once('_dosen.php');
}
?>

<?php 
	if(isset($_POST['submit'])){
		print_r($_POST);
	}
?>
