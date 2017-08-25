<?php require_once 'models/dadan_matkul.php'; ?>
<?php require_once 'models/dadan_perwalian_matkul.php'; ?>
<?php require_once 'models/dadan_perwalian.php'; ?>
<?php require_once 'models/dadan_user.php'; ?>

<style type="text/css">
	table{
		border-collapse: collapse;

	}
	td{
		padding: 10px;
	}
</style>


<div><h2>DATA PERWALIAN: <?= dadan_user::getNamaMahasiswa(); ?></h2></div>

<table border="1">
	<?php for ($i=1; $i <= dadan_matkul::getSemesterSekarang() ; $i++) { ?>
	
		<tr bgcolor="#ccc">
			<th style="vertical-align: middle; width: 10%" colspan="3" rowspan="2"> Semester <?= $i; ?></th>
			<th style="vertical-align: middle; text-align: center" rowspan="2">SKS</th>
			<th style="text-align: center;" colspan="4">Status</th>
		</tr>
		<tr bgcolor="#ccc">
			<th style="text-align: center;">Diambil</th>
			<th style="text-align: center;">Dinilai</th>
			<th style="text-align: center;">Bobot</th>
			<th style="text-align: center;">Nilai</th>
		</tr>	

		<?php 
			$sks = 0;
			$bobot = 0;
			$akhir = 0;
			$abjad = null;
		?>

		<?php $nomor=1; foreach(dadan_perwalian_matkul::findAllMakul($i) as $key => $value) { ?>
			<tr >
				<td style="width: 1%" ><?= $nomor; ?></td>
				<td style="width: 20%"><?= dadan_matkul::relasi('dadan_matkul','kode',$value['id_matkul']); ?></td>
				<td style="width: 40%"><?= dadan_matkul::relasi('dadan_matkul','nama',$value['id_matkul']); ?></td>
				<td style="text-align: center"><?= dadan_matkul::relasi('dadan_matkul','sks',$value['id_matkul']); ?></td>
				<td style="text-align: center">
					<?php if(dadan_perwalian_matkul::isDiambilByMahasiswa($i,$value['id_matkul'])) { ?>
						OK
					<?php } ?>
				</td>
				<td style="text-align: center">
					<?php if(dadan_perwalian_matkul::isDinilai($i,$value['id_matkul'])){ ?>
						OK
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
		<tr bgcolor="#ccc">
			<th colspan="3" style="text-align: center">KALKULASI</th>
			<th style="text-align: center"><?= $sks; ?></th>
			<th colspan="2"></th>
			<th style="text-align: center"><?= $bobot; ?>.00 : <?= $sks; ?></th>
			<th style="text-align: center"><?= $akhir; ?></th>
		</tr>
		<tr>
			<td colspan="8">&nbsp;</td>
		</tr>
	<?php } ?>
</table>

    <script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
      $(function () {

        $('#dataKurikulum').DataTable({"pageLength": 25});

      });

    </script>