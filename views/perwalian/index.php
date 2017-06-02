<h1>Daftar perwalian</h1>
<div>&nbsp;</div>
<div class="box box-primary">
    <div class="box-header">
        <a class="btn btn-primary btn-flat" href="<?= dadan_components::getUrl('perwalian/create'); ?>">Tambah perwalian </a>
    </div>
<!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Dosen</th>
                <th>Aksi</th>
            </tr>
            <?php $i=1; foreach (dadan_perwalian::findAll() as $value): ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= dadan_perwalian::relasi('dadan_dosen','nama',$value['id_dosen']); ?></td>
                <td><?= $value['keterangan'] ?></td>
                <td>
                    <a href="<?= dadan_components::getUrl('perwalian/view',['id'=>$value['id']]); ?>">View</a>
                    <a href="<?= dadan_components::getUrl('perwalian/update',['id'=>$value['id']]); ?>">Edit</a>
                    <a href="<?= dadan_components::getUrl('perwalian/delete',['id'=>$value['id']]); ?>">Delete</a>
                </td>
            </tr>
            <?php $i++; endforeach; ?>
        </table>
    </div>
<!-- /.box-body -->
</div>


