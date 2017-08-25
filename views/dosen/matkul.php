<?php require_once 'models/dadan_matkul.php'; ?>
<?php require_once 'models/dadan_perwalian_matkul.php'; ?>


<div class="box box-primary">
	<div class="box-header with-border">
		Daftar Mata Kuliah
	</div>
	<div class="box-body">
		<table class="table table-bordered table-hover table-condensed">
			<?php for ($i=1; $i <=12 ; $i++) { ?>
				<tr>
					<th colspan="4">Semester <?= $i; ?></th>
				</tr>
				<?php $nomor=1; foreach(dadan_matkul::findAllByAttributes('semester = '.$i.' AND id_jurusan = '.dadan_user::getIdJurusan()) as $key => $value) { ?>
					<tr>
						<td><?= $nomor; ?></td>
						<td><?= $value['kode']; ?></td>
						<td><?= $value['nama']; ?></td>
						<td><?= $value['sks']; ?></td>
						<td>
							<?php if(dadan_perwalian_matkul::isDiambilByMahasiswa($i,$value['id'])){ ?>
								Diambil
							<?php } else { ?>
								Belum Diambil
							<?php } ?>
						</td>
					</tr>
				<?php $nomor++ ; } ?>

			<?php } ?>
		</table>
	</div>
</div>
