<?= $this->extend('layout/admin'); ?>
<?= $this->section('content'); ?>

<h3>Log Aktivitas</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Aktivitas</th>
            <th>Aksi</th>
            <th>Waktu</th>
        </tr>
    </thead>

    <tbody>
        <?php $no = 1; ?>

        <?php if(!empty($log)): ?>
            <?php foreach($log as $l): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($l['user'] ?? '-') ?></td>
                    <td><?= esc($l['aktivitas'] ?? '-') ?></td>
                    <td><?= esc($l['aksi'] ?? '-') ?></td>
                    <td>
                        <?= !empty($l['created_at']) 
                            ? date('d-m-Y H:i', strtotime($l['created_at'])) 
                            : '-' ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Tidak ada log aktivitas</td>
            </tr>
        <?php endif; ?>
    </tbody>

</table>

<?= $this->endSection(); ?>