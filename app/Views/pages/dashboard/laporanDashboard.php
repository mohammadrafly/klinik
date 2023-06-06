<?= $this->extend('layout/DashboardLayout') ?>
<?= $this->section('content') ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modal">Export Excel</button>
                                <h4 class="card-title"><?= $title ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Kode Obat</th>
                                                <th>Nama Obat</th>
                                                <th>Deskripsi</th>
                                                <th>Stok</th>
                                                <th>Harga</th>
                                                <th>Dibuat Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($content as $data): ?>
                                            <tr>
                                                <td><?= $data['kode_obat'] ?></td>
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['deskripsi'] ?></td>
                                                <td><?= $data['stok'] ?></td>
                                                <td><?= $data['harga'] ?></td>
                                                <td><?= $data['created_at'] ?></td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Kode Obat</th>
                                                <th>Nama Obat</th>
                                                <th>Deskripsi</th>
                                                <th>Stok</th>
                                                <th>Harga</th>
                                                <th>Dibuat Tanggal</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?= $this->endSection() ?>