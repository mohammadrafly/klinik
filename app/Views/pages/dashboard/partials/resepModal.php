<div class="modal fade" id="resep" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form">
                <div class="modal-body">
                    <input type="text" id="id" name="id" hidden>
                    <input type="text" id="kode_kunjungan" name="kode_kunjungan" hidden>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="antrian">Item</label>
                            <select type="text" class="form-control input-default" id="kode_obat" name="kode_obat">
                                <option>Pilih Item</option>
                                <?php foreach($obat as $data): ?>
                                <option value="<?= $data['kode_obat'] ?>" data-price="<?= $data['harga'] ?>"><?= $data['nama'] ?></option>
                                <?php endforeach ?>
                                <?php foreach($tindakan as $data): ?>
                                <option value="<?= $data['kode_tindakan'] ?>" data-price="<?= $data['harga'] ?>"><?= $data['nama_tindakan'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="antrian">Harga</label>
                            <input type="number" class="form-control input-default" id="harga" name="harga" readonly>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="antrian">Jumlah</label>
                            <input type="number" class="form-control input-default" id="quantity" name="quantity">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="antrian">Dosis</label>
                            <input type="text" class="form-control input-default" id="dosis" name="dosis">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="antrian">Subtotal</label>
                            <input type="number" class="form-control input-default" id="subtotal" name="subtotal" readonly>
                        </div>
                        <div class="col-md-1 mb-3">
                            <button type="button" class="btn btn-primary" onclick="addTableRow()">Add</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th hidden>Kode Obat</th>
                                        <th>Obat</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Dosis</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="simpanResep()">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>