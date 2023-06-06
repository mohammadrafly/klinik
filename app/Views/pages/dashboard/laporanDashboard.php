<?= $this->extend('layout/DashboardLayout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">Export Excel</button>
                <h4 class="card-title"><?= $title ?></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>Kode Kunjungan</th>
                                <th>Nama Obat</th>
                                <th>Harga</th>
                                <th>Jumlah Obat</th>
                                <th>Total</th>
                                <th>Dibuat Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($content as $data): ?>
                            <tr>
                                <td><?= $data['kode_kunjungan'] ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['harga'] ?></td>
                                <td><?= $data['quantity'] ?></td>
                                <td><?= $data['harga'] * $data['quantity'] ?></td>
                                <td><?= $data['created_at'] ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Date Range Picker Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Export Date Range to Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="startDate">Start Date</label>
                    <input type="date" class="form-control" id="startDate" name="startDate">
                </div>
                <div class="form-group">
                    <label for="endDate">End Date</label>
                    <input type="date" class="form-control" id="endDate" name="endDate">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="exportBtn">Export</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    document.getElementById('exportBtn').addEventListener('click', function() {
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;
        var url = 'laporan/export/' + startDate + '/' + endDate;
        window.open(url, '_blank');
    });
</script>

<?= $this->endSection() ?>

