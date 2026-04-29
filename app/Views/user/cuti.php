<?= $this->extend('layout/user'); ?>
<?= $this->section('content'); ?>

<h3>Cuti Saya</h3>

<a href="<?= base_url('cuti/create') ?>" class="btn btn-primary mb-3">
    + Ajukan Cuti
</a>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th>Status</th>
    </tr>

    <?php if(!empty($cuti)): ?>
        <?php $no=1; foreach($cuti as $c): ?>
        <tr>
            <td><?= $no++ ?></td>
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
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4" class="text-center">Belum ada cuti</td>
        </tr>
    <?php endif; ?>
</table>

<?= $this->endSection(); ?>