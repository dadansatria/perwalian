
<?php if(isset($_GET['status'])){
    if(dadan_perwalian::ubahStatus($value['id'], $_GET['status'])){
        dadan_components::redirect('perwalian/view&id='.$value['id']);
    }
} ?>

<div class="box box-primary">
    <div class="box-header">
        <?php if($value['status'] == dadan_perwalian::DIAMBIL){ ?>
            <a class="btn btn-success btn-flat" href="<?= dadan_components::getUrl('perwalian/view',['id'=>$value["id"],'status'=>dadan_perwalian::DITERIMA]); ?>"><i class="glyphicon glyphicon-ok"> </i> Setujui Perwalian </a>
        <?php } ?>
    </div>
    <?php $model = $value; ?>
<!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th width="5%">No</th>
                <th>Mata Kuliah</th>
                <?php if($value['status'] != dadan_perwalian::DIAMBIL){ ?>
                    <th>Nilai</th>
                    <th>Abjad</th>
                    <th>Aksi</th>
                <?php } ?>
            </tr>
            <?php $i=1; foreach (dadan_perwalian_matkul::findAllByAttributes("id_perwalian = $id") as $value): ?>
            <form method="post">
			<?php
				$id_perwalian_matkul = $value['id'];
				if(isset($_POST["submit_".$value['id']])){
					dadan_perwalian_matkul::updateData($_POST,$id_perwalian_matkul,'perwalian/view&id='.$id);
                    dadan_perwalian::ubahStatus($model['id'], 1);
				}
				$update = dadan_perwalian_matkul::getValueUpdate($id_perwalian_matkul);
			?>
            <tr>
                <td><?= $i ?></td>
                <td><?= dadan_perwalian_matkul::relasi('dadan_matkul','nama',$value['id_matkul']); ?></td>
                <?php if($model['status'] != dadan_perwalian::DIAMBIL){ ?>
                    <td><?= $value['nilai'] ?></td>
                    <td>
    					<?= dadan_widgets::dropdown([
    						'data' => dadan_perwalian_matkul::getListNilai(),
    						'key' => 'key',
    						'value' => 'value',
    						'name' => 'nilai',
    						'defaultValue' => $update['nilai'],
    						'class' => 'form-control'
    						])
    					?> 
                    </td>
                    <td><button type="submit" name="submit_<?= $value['id']; ?>" class="btn btn-info pull-right">Simpan</button></td>
                <?php } ?>
            </tr>
            </form>
            <?php $i++; endforeach; ?>
        </table>
    </div>
<!-- /.box-body -->
</div>

