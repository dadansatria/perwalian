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
            <?php
            	$i=1;
            	$jurusan = dadan_user::getIdJurusan();
            	$semester = $value['semester'];
            		foreach (dadan_matkul::findAllByAttributes("id_jurusan = $jurusan AND semester = $semester") as $value): ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $value['kode'] ?></td>
                <td><?= dadan_matkul::relasi('dadan_jurusan','nama',$value['id_jurusan']); ?></td>
                <td><?= $value['nama'] ?></td>
                <td>
                	<?php if(dadan_perwalian_matkul::isDiambil($id,$value['id'])){ ?>
                		Telah Diambil
                	<?php } else { ?> 
                    	<input type="checkbox" name="perwalian[<?= $value['id']; ?> ]" value="<?= $value['id']; ?>">
                    <?php } ?>
                </td>
            </tr>
            <?php $id_per = $value['kode']; ?>
            <?php $i++; endforeach; ?>

            <!-- SIMPAN DATA PERWALIAN -->

			<?php 
				if(isset($_POST['submit'])){
					$db = koneksi::getKoneksi();

					foreach ($_POST['perwalian'] as $key => $value) {
						$query = 
						$db->prepare(
							"INSERT INTO perwalian_matkul(
								id_matkul,
								id_perwalian,
								nilai,status
							) VALUES(
								'$value',
								'$id',
								null,
								'2'
							)"
						);
						if($query->execute()){
							dadan_components::redirect('perwalian/view&id='.$id);
						}
					}
				}
			?>

			<!-- SELESAI SIMPAN DATA PERWALIAN -->

        </table>
	</div>
	<div class="box-footer">
		<button type="submit" name="submit" class="btn btn-info pull-right">Ambil Mata Kuliah</button>
	</div>
</div>

</form>