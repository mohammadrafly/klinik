<?= $this->extend('layout/DashboardLayout') ?>
<?= $this->section('content') ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#antrian">Tambah Antrian Offline</button>
                                <h4 class="card-title"><?= $title ?></h4>
                            </div>
                            <?= $this->include('pages/dashboard/partials/antrianModal') ?>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Nomor Antrian</th>
                                                <th>Kode Pasien</th>
                                                <th>Status</th>
                                                <th>Tipe Antrian</th>
                                                <th>Tanggal</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($content as $data): ?>
                                            <tr>
                                                <td><?= $data['nomor_antrian'] ?></td>
                                                <td><?= $data['kode_pasien'] ?></td>
                                                <td><?= $data['status'] ?></td>
                                                <td><?= $data['type_antrian'] ?></td>
                                                <td><?= $data['created_at'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" onclick="detail(<?= $data['id'] ?>)">
                                                        Detail
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nomor Antrian</th>
                                                <th>Kode Pasien</th>
                                                <th>Status</th>
                                                <th>Tipe Antrian</th>
                                                <th>Tanggal</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url('js/Antrian.js') ?>"></script>
<?= $this->endSection() ?>
