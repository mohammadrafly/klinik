<?= $this->extend('layout/DashboardLayout') ?>
<?= $this->section('content') ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= $title ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Kode Kunjungan</th>
                                                <th>Nama Pasien</th>
                                                <th>Keluhan</th>
                                                <th>Tindakan</th>
                                                <th>Hari/Tanggal</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $mergedData = [];

                                        foreach ($content as $data) {
                                            $kodeKunjungan = $data['kode_kunjungan'];

                                            if (!isset($mergedData[$kodeKunjungan])) {
                                                // Create a new entry if it doesn't exist
                                                $mergedData[$kodeKunjungan] = $data;
                                            } else {
                                                // Merge the existing entry with the current data
                                                $mergedData[$kodeKunjungan] = array_merge($mergedData[$kodeKunjungan], $data);
                                            }
                                        }
                                        ?>
                                        <?php foreach($mergedData as $data): ?>
                                            <tr>
                                                <td><?= $data['kode_kunjungan'] ?></td>
                                                <td><?= $data['name'] ?></td>
                                                <td><?= $data['keluhan_utama'] ?></td>
                                                <td><?= $data['tindakan'] ?></td>
                                                <td><?= $data['created_at'] ?></td>
                                                <td>
                                                    <button class="btn btn-primary" onclick="details(<?= $data['kode_kunjungan'] ?>)">Details</button>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?= $this->endSection() ?>