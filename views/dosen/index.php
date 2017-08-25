<h1>Daftar Mahasiswa</h1>
<div>&nbsp;</div>
<div class="box box-primary">
    <div class="box-header">
        <a class="btn btn-primary btn-flat" href="<?= dadan_components::getUrl('mahasiswa/create'); ?>">Tambah Mahasiswa </a>

        <a class="btn btn-primary btn-flat" href="#">Cetak Foto </a>
    </div>
<!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Angkatan</th>
                <th>Aksi</th>
            </tr>
            <?php $i=1; foreach (dadan_dosen::findAll() as $value): ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $value['nama'] ?></td>
                <td><?= $value['alamat'] ?></td>
                <td><?= $value['angkatan'] ?></td>
                <td>
                    <a href="<?= dadan_components::getUrl('mahasiswa/view',['id'=>$value['id']]); ?>">View</a>
                    <a href="<?= dadan_components::getUrl('mahasiswa/update',['id'=>$value['id']]); ?>">Edit</a>
                    <a href="<?= dadan_components::getUrl('mahasiswa/delete',['id'=>$value['id']]); ?>">Delete</a>
                </td>
            </tr>
            <?php $i++; endforeach; ?>
        </table>
    </div>
<!-- /.box-body -->
</div>
