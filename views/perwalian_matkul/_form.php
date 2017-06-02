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
				<label for="inputPassword3" class="col-sm-2 control-label">Nama</label>

				<div class="col-sm-6">
					<input type="text" name="nama" value="<?= $value['nama']; ?>" class="form-control" id="inputPassword3" placeholder="Nama">
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

