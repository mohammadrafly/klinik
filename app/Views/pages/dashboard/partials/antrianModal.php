<div class="modal fade" id="antrian" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form">
                <div class="modal-body">
                    <input type="text" hidden id="id">
                    <div class="mb-3" id="pilih-pasien">
                        <label for="antrian">Pasien</label>
                        <select type="text" class="form-control input-default" id="kode_user" name="kode_user">
                            <option value="pilih_pasien">Pilih Pasien</option>
                            <option value="tambah_pasien">Tambah Pasien</option>
                            <?php foreach($pasien as $data): ?>
                            <option value="<?= $data['kode_user'] ?>"><?= $data['name'] ?> - <?= $data['kode_user'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div id="tambah_pasien">
                        <div class="mb-3" id="nomor_antrian_input" hidden>
                            <label for="antrian">Nomor Antrian</label>
                            <input type="number" class="form-control input-default" id="nomor_antrian" readonly>
                        </div>
                        <div class="mb-3" id="kode_pasien_input" hidden>
                            <label for="antrian">Kode Pasien</label>
                            <input type="text" class="form-control input-default" id="kode_pasien" name="kode_pasien" readonly>
                        </div>
                        <div class="mb-3" id="status_input" hidden>
                            <label for="antrian">Status</label>
                            <select type="text" class="form-control input-default" id="status" name="status">
                                <option>Pilih Status</option>
                                <option value="antri">Antri</option>
                                <option value="dalam_pemeriksaan">Dalam Progress</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="mb-3" id="name_input">
                            <label for="antrian">Nama Lengkap</label>
                            <input type="text" class="form-control input-default" id="name" name="name">
                        </div>
                        <div class="mb-3" id="usia_input">
                            <label for="antrian">Tanggal Lahir</label>
                            <input type="date" class="form-control input-default" id="tanggal_lahir" name="tanggal_lahir">
                        </div>
                        <div class="mb-3" id="nomor_hp_input">
                            <label for="antrian">Nomor HP</label>
                            <input type="number" class="form-control input-default" id="nomor_hp" name="nomor_hp">
                        </div>
                        <div class="mb-3" id="jenis_kelamin_input">
                            <label for="antrian">Jenis Kelamin</label>
                            <select type="text" class="form-control input-default" id="jenis_kelamin" name="jenis_kelamin">
                                <option>Pilih Jenis Kelamin</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3" id="alamat_input">
                            <label for="antrian">Alamat</label>
                            <textarea type="text" class="form-control input-default" id="alamat" name="alamat"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>