<div class="modal fade" id="transaksi" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputModalLabel">Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form">
                <div class="modal-body">
                    <div>
                        <h6>Nama Lengkap: <span id="nama_lengkap"></span></h6>
                        <h6>Kode Kunjungan: <span id="kode_kunjungan"></span></h6>
                        <h6>Kode Pasien: <span id="kode_pasien"></span></h6>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Obat</th>
                                <th>Harga</th>
                                <th>Quantity</th>
                                <th>Dosis</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="item-list">
                            <!-- Dynamically add rows for items here using JavaScript -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
                                <td id="total"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="printInvoice()">Print</button>
                </div>
            </form>
        </div>
    </div>
</div>