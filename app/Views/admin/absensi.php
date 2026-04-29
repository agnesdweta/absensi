<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>


<h3>Data Absensi Karyawan</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php $no = 1; ?>

    <?php if(isset($absensi) && is_array($absensi) && count($absensi) > 0): ?>
        <?php foreach($absensi as $a): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= ($a['nama_karyawan'] ?? '-') ?></td>
                <td><?= ($a['tanggal'] ?? '-') ?></td>
                <td><?= ($a['jam_masuk'] ?? '-') ?></td>
                <td><?= ($a['jam_pulang'] ?? '-') ?></td>
                <td><?= ($a['status'] ?? '-') ?></td>
                <td>
                    <a href="<?= base_url('admin/absensi/edit/'.$a['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= base_url('admin/absensi/delete/'.$a['id']) ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin hapus?')">
                       Hapus
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7" class="text-center">Tidak ada data absensi</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection(); ?>