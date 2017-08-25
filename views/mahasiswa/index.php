<?php if(isset($_GET['import'])){
    dadan_mahasiswa::import();
} 


    if(isset($_GET['search'])){
        $search = $_GET['search'];
    } else{
        $search = 'lorem';
    }

?>

<h1>Daftar Mahasiswa</h1>
<div>&nbsp;</div>
<div class="box box-primary">
    <div class="box-header">
        <a class="btn btn-primary btn-flat" href="<?= dadan_components::getUrl('mahasiswa/create'); ?>">Tambah Mahasiswa </a>

    </div>
<!-- /.box-header -->
    <div class="box-body">
        <table id="myTable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>NPM</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Angkatan</th>
                <th>Aksi</th>
            </tr>
            <?php $i=1; foreach (dadan_mahasiswa::findAllByAttributes("nama LIKE '%$search%'") as $value): ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $value['npm'] ?></td>
                <td><?= $value['nama'] ?></td>
                <td><?= $value['alamat'] ?></td>
                <td><?= $value['angkatan'] ?></td>
                <td>
                    <a href="<?= dadan_components::getUrl('mahasiswa/view',['npm'=>$value['npm']]); ?>">View</a>
                    <a href="<?= dadan_components::getUrl('mahasiswa/update',['npm'=>$value['npm']]); ?>">Edit</a>
                    <a href="<?= dadan_components::getUrl('mahasiswa/delete',['npm'=>$value['npm']]); ?>">Delete</a>
                </td>
            </tr>
            <?php $i++; endforeach; ?>
        </table>
    </div>
<!-- /.box-body -->
</div>