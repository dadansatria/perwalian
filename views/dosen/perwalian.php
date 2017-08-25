<?php require_once('models/dadan_perwalian.php'); ?>

<?php $id = $_SESSION['id_model']; ?>
<?php $status = $_GET['status']; ?>


<h1>Daftar perwalian</h1>
<div>&nbsp;</div>
<div class="box box-primary">
    <div class="box-header">
    </div>
<!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Semester</th>
                <th>Dosen</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
            <?php $i=1; foreach (dadan_perwalian::findAllByAttributes("id_dosen = $id AND status=$status") as $value): ?>
            <tr>
                <td><?= $i ?></td>
                <td><a href="<?= dadan_components::getUrl('perwalian/view',['id'=>$value['id']]); ?>"><?= $value['nama']; ?></a></td>
                <td><?= $value['semester'] ?></td>
                <td><?= dadan_perwalian::relasi('dadan_dosen','nama',$value['id_dosen']); ?></td>
                <td><?= $value['keterangan'] ?></td>
                <td>
                    <a href="<?= dadan_components::getUrl('perwalian/view',['id'=>$value['id']]); ?>">View</a>
                </td>
            </tr>
            <?php $i++; endforeach; ?>
        </table>
    </div>
<!-- /.box-body -->
</div>


