<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<h3>Data Cuti Karyawan</h3>

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
        <th>Keterangan</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php if(!empty($cuti)): ?>
        <?php $no=1; foreach($cuti as $c): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $c['nama_karyawan'] ?></td>
            <td><?= $c['tanggal_mulai'] ?> - <?= $c['tanggal_selesai'] ?></td>
            <td><?= $c['keterangan'] ?></td>
            <td>
                <?php if($c['status']=='pending'): ?>
                    <span class="badge badge-warning">Pending</span>
                <?php elseif($c['status']=='disetujui'): ?>
                    <span class="badge badge-success">Disetujui</span>
                <?php else: ?>
                    <span class="badge badge-danger">Ditolak</span>
                <?php endif; ?>
            </td>

            <td>
                <?php if($c['status']=='pending'): ?>
                    <a href="<?= base_url('admin/cuti/approve/'.$c['id']) ?>" class="btn btn-success btn-sm">✔ Approve</a>
                    <a href="<?= base_url('admin/cuti/reject/'.$c['id']) ?>" class="btn btn-danger btn-sm">✖ Reject</a>
                <?php else: ?>
                    <span class="text-muted">Selesai</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6" class="text-center">Tidak ada data cuti</td>
        </tr>
    <?php endif; ?>
</table>

<?= $this->endSection(); ?>