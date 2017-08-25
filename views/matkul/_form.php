
<?php  

require_once 'models/dadan_jurusan.php';


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
				<label for="inputEmail3" class="col-sm-2 control-label">Kode</label>

				<div class="col-sm-6">
					<input type="text" name="kode" value="<?= $value['kode']; ?>" class="form-control" id="inputEmail3" placeholder="kode">
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Jurusan</label>

				<div class="col-sm-6">
					<?= dadan_widgets::dropdown([
						'data' => dadan_jurusan::findAll(),
						'key' => 'id',
						'value' => 'nama',
						'name' => 'id_jurusan',
						'class' => 'form-control'
						])
					?>
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
						'class' => 'form-control'
						])
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nama</label>

				<div class="col-sm-6">
					<input type="text" name="nama" value="<?= $value['nama']; ?>" class="form-control" id="inputEmail3" placeholder="nama">
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">SKS</label>

				<div class="col-sm-6">
					<input type="text" name="sks" value="<?= $value['sks']; ?>" class="form-control" id="inputPassword3" placeholder="Jurusan">
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
