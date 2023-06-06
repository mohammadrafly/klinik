<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form">
                <div class="modal-body">
                        <input type="text" hidden id="id" name="id">
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
                        <div class="mb-3">
                            <label for="antrian">Email</label>
                            <input type="email" class="form-control input-default" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Username</label>
                            <input type="text" class="form-control input-default" id="username" name="username">
                        </div>
                        <div class="mb-3" id="password-input">
                            <label for="antrian">Password</label>
                            <input type="password" class="form-control input-default" id="password" name="password">
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