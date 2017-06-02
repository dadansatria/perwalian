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
				<label for="inputEmail3" class="col-sm-2 control-label">NPM</label>

				<div class="col-sm-6">
					<input type="text" name="npm" value="<?= $value['npm']; ?>" class="form-control" id="inputEmail3" placeholder="NPM">
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Nama</label>

				<div class="col-sm-6">
					<input type="text" name="nama" value="<?= $value['nama']; ?>" class="form-control" id="inputPassword3" placeholder="Nama">
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>

				<div class="col-sm-6">
					<input type="text" name="alamat" value="<?= $value['alamat']; ?>" class="form-control" id="inputEmail3" placeholder="Alamat">
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
				<label for="inputPassword3" class="col-sm-2 control-label">Angkatan</label>

				<div class="col-sm-6">
					<input type="text" name="angkatan" value="<?= $value['angkatan']; ?>" class="form-control" id="inputPassword3" placeholder="Angkatan">
				</div>
			</div>


			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<div class="checkbox">
						<label>
							<input type="checkbox"> Remember me
						</label>
					</div>
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

