
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
				<label for="inputEmail3" class="col-sm-2 control-label">Nama</label>

				<div class="col-sm-6">
					<input type="text" name="nama" value="<?= $value['nama']; ?>" class="form-control" id="inputEmail3" placeholder="nama">
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Dosen Wali</label>

				<div class="col-sm-6">
					<?= dadan_widgets::dropdown([
						'data' => dadan_dosen::findAll(),
						'key' => 'id',
						'value' => 'nama',
						'name' => 'id_dosen',
						'class' => 'form-control'
						])
					?>


				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Keterangan</label>

				<div class="col-sm-6">
					<input type="text" name="keterangan" value="<?= $value['keterangan']; ?>" class="form-control" id="inputEmail3" placeholder="keterangan">
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

