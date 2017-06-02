

<?php require_once('models/dadan_matkul.php'); ?>


<!--=====================================
=            Logic Here :3            =
======================================-->

<?php
	$id = $_GET['id']; 
	$value = dadan_perwalian::find($id);
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
				<td>Alamat</td>
				<td>:</td>
				<td><?= dadan_perwalian::relasi('dadan_dosen','nama',$value['id_dosen']); ?></td>
			</tr>
			<tr>
				<td>No HP</td>
				<td>:</td>
				<td><?= $value['keterangan'] ?></td>
			</tr>
		</table>
	</div>
</div>

<?php 
	if(isset($_POST['submit'])){
		print_r($_POST);
	}
?>
<form method="post">

<div class="box box-primary">
	<div class="box-header">
		Pilih Mata Pelajaran Yang Akan Diiambil
	</div>
	<div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Jurusan</th>
                <th>Nama Mata Kuliah</th>
                <th>Pilih Mata Kuliah</th>
            </tr>
            <?php $i=1; foreach (dadan_matkul::findAll() as $value): ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $value['kode'] ?></td>
                <td><?= dadan_matkul::relasi('dadan_jurusan','nama',$value['id_jurusan']); ?></td>
                <td><?= $value['nama'] ?></td>
                <td>
                    <input type="checkbox" name="id_perwalian_<?= $value['id']; ?>" value="<?= $value['id']; ?>">
                </td>
            </tr>
            <?php $id_per = $value['kode']; ?>

<?php 
	if(isset($_POST['submit'])){
		$db = koneksi::getKoneksi();
		$query = $db->prepare("INSERT INTO perwalian_matkul (id_matkul,id_perwalian,nilai,status) VALUES
		 ('$id_per','$id','0','1')");

		if($query->execute()){
			dadan_components::redirect('perwalian/view',['id'=>$id]);
		}
	}
?>

            <?php $i++; endforeach; ?>
        </table>
	</div>
	<div class="box-footer">
		<button type="submit" name="submit" class="btn btn-info pull-right">Ambil Mata Kuliah</button>
	</div>
</div>

</form>