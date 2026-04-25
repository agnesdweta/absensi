<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <a href="<?= base_url('karyawan/create') ?>" class="btn btn-primary">+ Tambah Karyawan</a>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Telp</th>
                <th>Aksi</th>
            </tr>

            <?php $no=1; foreach($karyawan as $k): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $k['nama'] ?></td>
                <td><?= $k['jabatan'] ?></td>
                <td><?= $k['telp'] ?></td>
                <td>
                    <a href="<?= base_url('karyawan/edit/'.$k['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= base_url('karyawan/delete/'.$k['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>

        </table>
    </div>
</div>

<?= $this->endSection(); ?>