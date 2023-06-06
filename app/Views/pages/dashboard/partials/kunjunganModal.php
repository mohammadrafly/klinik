<div class="modal fade" id="kunjungan" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form">
                <div class="modal-body">
                    <div class="step" id="step1">
                        <div class="mb-3">
                            <label for="antrian">Dokter</label>
                            <select type="text" class="form-control input-default" id="kode_dokter" name="kode_dokter" readonly>
                                <option>Pilih Dokter</option>
                                <?php foreach($dokter as $data): ?>
                                <option value="<?= $data['kode_user'] ?>"><?= $data['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <h2>Data Pasien</h2>
                        <input type="text" hidden id="id" name="id">
                        <input type="text" id="kode_pasien" name="kode_pasien" hidden readonly>
                        <div class="mb-3">
                            <label for="antrian">Nama Lengkap</label>
                            <input type="text" class="form-control input-default" id="name" name="name" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Usia</label>
                            <input type="number" class="form-control input-default" id="usia" name="usia" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Nomor HP</label>
                            <input type="number" class="form-control input-default" id="nomor_hp" name="nomor_hp" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Jenis Kelamin</label>
                            <select type="text" class="form-control input-default" id="jenis_kelamin" name="jenis_kelamin" readonly>
                                <option>Pilih Jenis Kelamin</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Alamat</label>
                            <textarea type="text" class="form-control input-default" id="alamat" name="alamat" readonly></textarea>
                        </div>
                    </div>
                    <div class="step" id="step2">
                        <h2>Data Keluhan</h2>
                        <div class="mb-3">
                            <label for="antrian">Keluhan Utama</label>
                            <input type="text" class="form-control input-default" id="keluhan_utama" name="keluhan_utama">
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Riwayat Penyakit Sekarang</label>
                            <input type="text" class="form-control input-default" id="riwayat_penyakit_sekarang" name="riwayat_penyakit_sekarang">
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Riwayat Penyakit Dahulu</label>
                            <input type="text" class="form-control input-default" id="riwayat_penyakit_dahulu" name="riwayat_penyakit_dahulu">
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Keadaan Umum Pasien</label>
                            <input type="text" class="form-control input-default" id="keadaan_umum_pasien" name="keadaan_umum_pasien">
                        </div>
                    </div>
                    <div class="step" id="step3">
                        <h2>Tanda Vital</h2>
                        <div class="mb-3">
                            <label for="antrian">Tekanan Darah</label>
                            <input type="text" class="form-control input-default" id="tekanan_darah" name="tekanan_darah" placeholder="120/180">
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Nadi</label>
                            <input type="text" class="form-control input-default" id="nadi" name="nadi" placeholder="95-120">
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Suhu Badan</label>
                            <input type="text" class="form-control input-default" id="suhu_badan" name="suhu_badan" placeholder="35°">
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Pernapasan</label>
                            <input type="text" class="form-control input-default" id="pernapasan" name="pernapasan">
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Berat Badan</label>
                            <input type="number" class="form-control input-default" id="berat_badan" name="berat_badan">
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Tinggi Badan</label>
                            <input type="number" class="form-control input-default" id="tinggi_badan" name="tinggi_badan">
                        </div>
                    </div>
                    <div class="step" id="step4">
                        <h2>Diagnosa</h2>
                        <div class="mb-3">
                            <label for="antrian">Keterangan Penunjang</label>
                            <textarea type="text" class="form-control input-default" id="keterangan_penunjang" name="keterangan_penunjang"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Diagnosa Dokter</label>
                            <textarea type="text" class="form-control input-default" id="diagnosa" name="diagnosa"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Tindakan</label>
                            <textarea type="text" class="form-control input-default" id="tindakan" name="tindakan"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="prevStep()" id="prevBtn" style="display: none;">Previous</button>
                    <button type="button" class="btn btn-primary" onclick="nextStep()" id="nextBtn">Next</button>
                    <button type="button" class="btn btn-primary" onclick="simpan()" id="saveBtn" style="display: none;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
