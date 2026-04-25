<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<h3>Data Absensi</h3>

<a href="<?= base_url('absensi/create') ?>" class="btn btn-primary mb-3">+ Tambah</a>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php $no=1; foreach($absensi as $a): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $a['nama_karyawan'] ?></td>
        <td><?= $a['tanggal'] ?></td>
        <td>
            <?php if($a['status']=='hadir'): ?>
            <span class="badge badge-success">Hadir</span>
            <?php elseif($a['status']=='cuti'): ?>
            <span class="badge badge-info">Cuti</span>
            <?php else: ?>
            <span class="badge badge-danger">Tidak Hadir</span>
            <?php endif; ?>
        </td>
        <td>
            <a href="<?= base_url('absensi/edit/'.$a['id']) ?>" 
                class="btn btn-warning btn-sm">Edit</a>

            <a href="<?= base_url('absensi/delete/'.$a['id']) ?>"
               onclick="return confirm('Hapus data?')"
               class="btn btn-danger btn-sm">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?= $this->endSection(); ?>