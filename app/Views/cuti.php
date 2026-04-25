<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<h3>Data Cuti</h3>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
<div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<!-- FILTER -->
<form method="get" class="mb-3">
    <div class="row">
        <div class="col-md-3">
            <input type="date" name="start" value="<?= esc($start) ?>" class="form-control">
        </div>
        <div class="col-md-3">
            <input type="date" name="end" value="<?= esc($end) ?>" class="form-control">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="all" <?= ($status=='all')?'selected':'' ?>>Semua</option>
                <option value="pending" <?= ($status=='pending')?'selected':'' ?>>Pending</option>
                <option value="disetujui" <?= ($status=='disetujui')?'selected':'' ?>>Disetujui</option>
                <option value="ditolak" <?= ($status=='ditolak')?'selected':'' ?>>Ditolak</option>
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary">Filter</button>
            <a href="<?= base_url('cuti') ?>" class="btn btn-secondary">Reset</a>
        </div>
    </div>
</form>

<table class="table table-bordered table-striped">
    <thead class="bg-dark text-white">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th width="250">Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php $no=1; foreach($cuti as $c): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= esc($c['nama_karyawan']) ?></td>
        <td><?= $c['tanggal_mulai'] ?> - <?= $c['tanggal_selesai'] ?></td>

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
            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail<?= $c['id'] ?>">
                Detail
            </button>

            <?php if($c['status']=='pending'): ?>
                <a href="<?= base_url('cuti/approve/'.$c['id']) ?>" 
                   class="btn btn-success btn-sm"
                   onclick="return confirm('Setujui cuti ini?')">
                   ✔
                </a>

                <a href="<?= base_url('cuti/reject/'.$c['id']) ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Tolak cuti ini?')">
                   ✖
                </a>
            <?php else: ?>
                <span class="text-muted">Selesai</span>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<!-- MODAL (PINDAH KE BAWAH) -->
<?php foreach($cuti as $c): ?>
<div class="modal fade" id="detail<?= $c['id'] ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Detail Cuti</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p><b>Nama:</b> <?= esc($c['nama_karyawan']) ?></p>
                <p><b>Tanggal:</b> <?= $c['tanggal_mulai'] ?> - <?= $c['tanggal_selesai'] ?></p>
                <p><b>Keterangan:</b> <?= esc($c['keterangan']) ?></p>

                <p><b>Status:</b>
                    <?php if($c['status']=='pending'): ?>
                        <span class="badge badge-warning">Pending</span>
                    <?php elseif($c['status']=='disetujui'): ?>
                        <span class="badge badge-success">Disetujui</span>
                    <?php else: ?>
                        <span class="badge badge-danger">Ditolak</span>
                    <?php endif; ?>
                </p>
            </div>

        </div>
    </div>
</div>
<?php endforeach; ?>

<?= $this->endSection(); ?>