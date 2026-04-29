<?= $this->extend('layout/user'); ?>
<?= $this->section('content'); ?>
<?php
/** @var array<int, array{
 *     id: int,
 *     nama_karyawan: string,
 *     tanggal: string,
 *     jam_masuk: string,
 *     jam_pulang: string|null,
 *     status: string
 * }> $absensi */
?>

<h3>Absensi Karyawan</h3>

<a href="<?= base_url('absensi/masuk') ?>" class="btn btn-success mb-3">
    Absen Masuk
</a>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>Jam Pulang</th>
        <th>Aksi</th>
    </tr>

    <?php $no=1; foreach($absensi as $a): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $a['tanggal'] ?></td>
        <td><?= $a['jam_masuk'] ?></td>
        <td><?= $a['jam_pulang'] ?></td>
        <td>
            <?php if(!$a['jam_pulang']): ?>
                <a href="<?= base_url('absensi/pulang/'.$a['id']) ?>"
                   class="btn btn-primary btn-sm">
                   Absen Pulang
                </a>
            <?php else: ?>
                <span class="text-success">Selesai</span>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?= $this->endSection(); ?>