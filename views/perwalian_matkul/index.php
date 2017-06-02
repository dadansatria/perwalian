<h1>Daftar perwalian_matkul</h1>
<div>&nbsp;</div>
<div class="box box-primary">
    <div class="box-header">
        <a class="btn btn-primary btn-flat" href="<?= dadan_components::getUrl('perwalian_matkul/create'); ?>">Tambah perwalian_matkul </a>
    </div>
<!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>perwalian_matkul</th>
                <th>Aksi</th>
            </tr>
            <?php $i=1; foreach (dadan_perwalian_matkul::findAll() as $value): ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $value['nama'] ?></td>
                <td>
                    <a href="<?= dadan_components::getUrl('perwalian_matkul/view',['id'=>$value['id']]); ?>">View</a>
                    <a href="<?= dadan_components::getUrl('perwalian_matkul/update',['id'=>$value['id']]); ?>">Edit</a>
                    <a href="<?= dadan_components::getUrl('perwalian_matkul/delete',['id'=>$value['id']]); ?>">Delete</a>
                </td>
            </tr>
            <?php $i++; endforeach; ?>
        </table>
    </div>
<!-- /.box-body -->
</div>


