


<!--=====================================
=            Logic Here :3            =
======================================-->

<?php
	$id = $_GET['id']; 
	$value = dadan_jurusan::find($id);
?>

<div class="box box-primary">
	<div class="box-header">
		Detail jurusan
	</div>
	<div class="box-body">
		<table class="table table-condensed">
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?= $value['nama'] ?></td>
			</tr>
		</table>
	</div>
</div>