<h1>Daftar jurusan</h1>
<div>&nbsp;</div>
<div class="box box-primary">
    <div class="box-header">
        <a class="btn btn-primary btn-flat" href="<?= dadan_components::getUrl('jurusan/create'); ?>">Tambah jurusan </a>
    </div>
<!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
            <?php $i=1; foreach (dadan_jurusan::findAll() as $value): ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $value['nama'] ?></td>
                <td>
                    <a href="<?= dadan_components::getUrl('jurusan/view',['id'=>$value['id']]); ?>">View</a>
                    <a href="<?= dadan_components::getUrl('jurusan/update',['id'=>$value['id']]); ?>">Edit</a>
                    <a href="<?= dadan_components::getUrl('jurusan/delete',['id'=>$value['id']]); ?>">Delete</a>
                </td>
            </tr>
            <?php $i++; endforeach; ?>
        </table>
    </div>
<!-- /.box-body -->
</div>


