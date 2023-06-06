<?= $this->extend('layout/DashboardLayout') ?>
<?= $this->section('content') ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= $title ?></h4>
                            </div>
                            <?= $this->include('pages/dashboard/partials/rekamModal') ?>
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
                                                <button class="btn btn-primary btn-details" data-kode="<?= $data['kode_kunjungan'] ?>">Details</button>
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
<?= $this->section('script') ?>
<script>
    function printInvoice() {
        var namaLengkap = $('#nama_lengkap').text();
        var kodeKunjungan = $('#kode_kunjungan').text();
        var kodePasien = $('#kode_pasien').text();
        var itemList = $('#item-list').html();
        var total = $('#total').text();

        // Open a new window with the invoice content for printing
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Invoice</title>');
        printWindow.document.write('<style>');
        printWindow.document.write('body { font-family: Arial, sans-serif; }');
        printWindow.document.write('h2 { color: #1e88e5; }');
        printWindow.document.write('h4 { color: #555; }');
        printWindow.document.write('table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }');
        printWindow.document.write('thead th { background-color: #f5f5f5; text-align: left; padding: 8px; }');
        printWindow.document.write('tbody td { padding: 8px; }');
        printWindow.document.write('tfoot td { background-color: #f5f5f5; text-align: right; padding: 8px; font-weight: bold; }');
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<h2>Invoice</h2>');
        printWindow.document.write('<h4 style="margin-bottom: 10px;">Nama Lengkap: ' + namaLengkap + '</h4>');
        printWindow.document.write('<h4 style="margin-bottom: 10px;">Kode Kunjungan: ' + kodeKunjungan + '</h4>');
        printWindow.document.write('<h4 style="margin-bottom: 20px;">Kode Pasien: ' + kodePasien + '</h4>');
        printWindow.document.write('<table>');
        printWindow.document.write('<thead><tr><th>Nama Obat</th><th>Harga</th><th>Quantity</th><th>Dosis</th><th>Subtotal</th></tr></thead>');
        printWindow.document.write('<tbody>' + itemList + '</tbody>');
        printWindow.document.write('<tfoot><tr><td colspan="4" style="text-align: right;">Total:</td><td>' + total + '</td></tr></tfoot>');
        printWindow.document.write('</table>');
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        // Trigger the print dialog for the print window
        printWindow.print();
    }

    $(document).ready(function() {
        $('.btn-details').on('click', function() {
        var kode = $(this).data('kode');
        bayar(kode);
        });
        
        function bayar(kode) {
        // AJAX request to fetch the invoice data
        $.ajax({
            url: `${base_url}dashboard/transaksi/pembayaran/${kode}`,
            method: 'GET',
            success: function(response) {
            var invoiceData = response;

            // Populate the content
            $('#nama_lengkap').text(invoiceData[0].nama_lengkap);
            $('#kode_kunjungan').text(invoiceData[0].kode_kunjungan);
            $('#kode_pasien').text(invoiceData[0].kode_pasien);

            var itemList = $('#item-list');
            var total = 0;

            // Clear any existing rows
            itemList.empty();

            // Add rows for each item
            invoiceData.forEach(function(item) {
                var row = $('<tr></tr>');

                var namaObatCell = $('<td></td>').text(item.nama);
                row.append(namaObatCell);

                var hargaCell = $('<td></td>').text(item.harga);
                row.append(hargaCell);

                var quantityCell = $('<td></td>').text(item.quantity);
                row.append(quantityCell);

                var dosisCell = $('<td></td>').text(item.dosis);
                row.append(dosisCell);

                var subtotalCell = $('<td></td>').text(item.harga * item.quantity);
                row.append(subtotalCell);

                itemList.append(row);

                total += item.harga * item.quantity;
            });

            // Update the total
            $('#total').text(total);

            // Open the modal
            $('#transaksi').modal('show');
            },
            error: function() {
            // Handle error scenario
            console.log('Error retrieving invoice data');
            }
        });
        }
    });
</script>
<?= $this->endSection() ?>