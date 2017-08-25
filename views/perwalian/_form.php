
<?php  

require_once 'models/dadan_dosen.php';


?>

<!-- Horizontal Form -->
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Horizontal Form</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<form class="form-horizontal" method="post">
		<div class="box-body">

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Subjek</label>

				<div class="col-sm-6">
					<?php if(dadan_user::isMahasiswa()) { ?>
						<input type="text" name="nama" value="Perwalian Semester <?= $_GET['semester']; ?>" class="form-control" id="inputEmail3" placeholder="nama">
					<?php } ?>

				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Dosen Wali</label>

				<div class="col-sm-6">
					<?= dadan_widgets::dropdown([
						'data' => dadan_dosen::findAllByAttributes('id = '.dadan_user::getDosenWali()),
						'key' => 'id',
						'value' => 'nama',
						'name' => 'id_dosen',
						'defaultValue' => $value['id_dosen'],
						'class' => 'form-control',
						])
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Mahasiswa</label>
				<div class="col-sm-6">
					<input type="text" name="npm" value="<?= $_SESSION['id_model']; ?>" readonly="readonly" class="form-control" id="inputEmail3" placeholder="keterangan">
				</div>
			</div>

			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Semester</label>

				<div class="col-sm-6">
					<?= dadan_widgets::dropdown([
						'data' => dadan_jurusan::getListSemester(),
						'key' => 'id',
						'value' => 'semester',
						'name' => 'semester',
						'defaultValue' => $_GET['semester'],
						'class' => 'form-control'
						])
					?>
				</div>
			</div>

		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<button type="submit" name="submit" class="btn btn-info pull-right">Input Data</button>
		</div>
		<!-- /.box-footer -->
	</form>
</div>
<!-- /.box -->
<!-- general form elements disabled -->

