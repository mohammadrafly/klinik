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
                        <div class="mb-3">
                            <label for="antrian">Nama Tindakan</label>
                            <input type="text" class="form-control input-default" id="nama_tindakan" name="nama_tindakan">
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Deskripsi</label>
                            <textarea type="text" class="form-control input-default" id="deskripsi" name="deskripsi"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="antrian">Harga<label>
                            <input type="number" class="form-control input-default" id="harga" name="harga">
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