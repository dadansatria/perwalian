<?php require_once 'models/dadan_matkul.php'; ?>
<?php require_once 'models/dadan_perwalian_matkul.php'; ?>
<?php require_once 'models/dadan_perwalian.php'; ?>
<?php require_once 'models/dadan_user.php'; ?>


<div class="box box-primary">
	<div class="box-header with-border">
		<h2>Data Perwalian <?= dadan_user::getNamaMahasiswa(); ?></h2>
		<div></div>
		<a class="btn btn-success" href="<?= dadan_components::getUrl('mahasiswa/pdf'); ?>"> <i class="glyphicon glyphicon-print"></i> Ekspor PDF </a>
	</div>
	<div class="box-body">
		<table class="table table-bordered table-condensed">
			<?php for ($i=1; $i <= dadan_matkul::getSemesterSekarang() ; $i++) { ?>
			
				<tr>
					<th style="vertical-align: middle; width: 70%" class="info" colspan="3" rowspan="2"><a href="<?= dadan_perwalian::getUrlPerwalian($i); ?>"> Semester <?= $i; ?></th>
					<th style="vertical-align: middle; text-align: center" class="info" rowspan="2">SKS</th>
					<th style="text-align: center;" class="info" colspan="4">Status</th>
				</tr>
				<tr>
					<th style="text-align: center;" class="info">Diambil</th>
					<th style="text-align: center;" class="info">Dinilai</th>
					<th style="text-align: center;" class="info">Bobot</th>
					<th style="text-align: center;" class="info">Nilai</th>
				</tr>	

				<?php 
					$sks = 0;
					$bobot = 0;
					$akhir = 0;
					$abjad = null;
				?>

				<?php $nomor=1; foreach(dadan_perwalian_matkul::findAllMakul($i) as $key => $value) { ?>
					<tr <?= dadan_matkul::getClassAktif($i,$value['id_matkul']); ?> >
						<td><?= $nomor; ?></td>
						<td><?= dadan_matkul::relasi('dadan_matkul','kode',$value['id_matkul']); ?></td>
						<td><?= dadan_matkul::relasi('dadan_matkul','nama',$value['id_matkul']); ?></td>
						<td style="text-align: center"><?= dadan_matkul::relasi('dadan_matkul','sks',$value['id_matkul']); ?></td>
						<td style="text-align: center">
							<?php if(dadan_perwalian_matkul::isDiambilByMahasiswa($i,$value['id_matkul'])) { ?>
								<i class="glyphicon glyphicon-ok"></i>
							<?php } ?>
						</td>
						<td style="text-align: center">
							<?php if(dadan_perwalian_matkul::isDinilai($i,$value['id_matkul'])){ ?>
								<i class="glyphicon glyphicon-ok"></i>
							<?php } ?>
						</td>
						<td style="text-align: center"><?= $value['nilai']; ?>.00 x <?= dadan_matkul::relasi('dadan_matkul','sks',$value['id_matkul']); ?></td>
						<td style="text-align: center">
							<?= dadan_perwalian_matkul::getNilai($i,$value['id_matkul']); ?>
						</td>
					</tr>
					<?php 
						$sks = $sks + dadan_matkul::relasi('dadan_matkul','sks',$value['id_matkul']);
						$bobot = $bobot + ($value['nilai'] * dadan_matkul::relasi('dadan_matkul','sks',$value['id_matkul'])); 
						$akhir = $bobot/$sks;
					?>
				<?php $nomor++ ; } ?>
				<tr>
					<th class="info" colspan="3" style="text-align: center">KALKULASI</th>
					<th class="info" style="text-align: center"><?= $sks; ?></th>
					<th class="info" colspan="2"></th>
					<th class="info" style="text-align: center"><?= $bobot; ?>.00 : <?= $sks; ?></th>
					<th class="info" style="text-align: center"><?= $akhir; ?></th>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>
