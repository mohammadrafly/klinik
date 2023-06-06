<?= $this->extend('layout/DashboardLayout') ?>
<?= $this->section('content') ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= $title ?></h4>
                            </div>
                            <?= $this->include('pages/dashboard/partials/kunjunganModal') ?>
                            <?= $this->include('pages/dashboard/partials/resepModal') ?>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Nomor Antrian</th>
                                                <th>Kode Kunjungan</th>
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
                                                    <?php if (!$data['kode_kunjungan']): ?>
                                                    <button type="button" class="btn btn-primary" onclick="kerjakan(<?= $data['id'] ?>)">
                                                        Kerjakan
                                                    </button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-primary" onclick="buatResep(<?= $data['id'] ?>)">
                                                            Buat Resep
                                                        </button>
                                                    <?php endif ?>
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
        $(document).ready(function() {
            $('#kode_obat').select2();

            $('#kode_obat').on('change', function() {
                var selectedOption = $(this).find(':selected');
                var price = selectedOption.data('price');

                console.log(price);

                $('#harga').val(price);
            });
        });

    function simpanResep() {
        var kodeKunjungan = $("#kode_kunjungan").val();

        // Collect table data
        var tableData = [];
        $("#table-body tr").each(function() {
            var rowData = {
                kode_obat: $(this).find("td:eq(0)").text(),
                jumlah: $(this).find("td:eq(3)").text(),
                dosis: $(this).find("td:eq(4)").text()
            };
            tableData.push(rowData);
        });

        // Prepare the data to be sent
        var postData = {
            'kode_kunjungan' : kodeKunjungan,
            'kode_obat[]' : tableData.map(item => item.kode_obat),
            'quantity[]' : tableData.map(item => item.jumlah),
            'dosis[]' : tableData.map(item => item.dosis)
        };

        $.ajax({
            url: `${base_url}dashboard/kunjungan/resep`,
            type: "POST",
            data: JSON.stringify(postData),
            contentType: "application/json",
            success: function(response) {
                showAlert(response.icon, response.title, response.message);
                location.reload();
            },
            error: function(xhr, status, error) {
                showAlert(status, xhr, error);
            }
        });
    }

    document.getElementById('kode_obat').addEventListener('change', function() {
        var select = this;
        var price = select.options[select.selectedIndex].getAttribute('data-price');
        document.getElementById('harga').value = price;
    });

    document.getElementById('quantity').addEventListener('input', function() {
        var quantity = parseFloat(this.value);
        var price = parseFloat(document.getElementById('harga').value);
        var subtotal = isNaN(quantity) || isNaN(price) ? 0 : quantity * price;
        document.getElementById('subtotal').value = subtotal;
    });

    function addTableRow() {
        var kodeObat = document.getElementById('kode_obat').value;
        var obatName = document.getElementById('kode_obat').options[document.getElementById('kode_obat').selectedIndex].text;
        var harga = parseFloat(document.getElementById('harga').value);
        var quantity = parseFloat(document.getElementById('quantity').value);
        var dosis = document.getElementById('dosis').value;
        var subtotal = parseFloat(document.getElementById('subtotal').value);

        if (kodeObat && harga && quantity && dosis && subtotal) {
            var tableBody = document.getElementById('table-body');
            var newRow = tableBody.insertRow();
            var index = tableBody.rows.length - 1;

            newRow.innerHTML = `
                <td hidden>${kodeObat}</td>
                <td>${obatName}</td>
                <td>${harga}</td>
                <td>${quantity}</td>
                <td>${dosis}</td>
                <td>${subtotal}</td>
                <td><button type="button" class="btn btn-danger" onclick="deleteRow(${index})">Delete</button></td>
            `;
        }
    }

    function deleteRow(index) {
        var tableBody = document.getElementById('table-body');
        tableBody.deleteRow(index);
    }

    function buatResep(id) {
        $.ajax({
            url: `${base_url}dashboard/antrian/get/${id}`,
            type: 'GET',
            dataType: 'JSON',
            success: function(respond) {
                console.log(respond)
                $('#id').val(respond[0].id_antrian);
                $('#kode_kunjungan').val(respond[0].kode_kunjungan);
                $('#resep').modal('show');
                $('.modal-title').text('Buat Resep'); 

                $('#resep').on('hidden.bs.modal', function () {
                    location.reload();
                });
            },
            error: function(textStatus) {
                showAlert('error', 'Gagal!', textStatus);
            }
        });
    }

    function kerjakan(id) {
        $.ajax({
            url: `${base_url}dashboard/antrian/get/${id}`,
            type: 'GET',
            dataType: 'JSON',
            success: function(respond) {
                console.log(respond)
                var dob = respond[0].tanggal_lahir;
                var today = new Date();
                var birthDate = new Date(dob);
                var age = today.getFullYear() - birthDate.getFullYear();
                var monthDiff = today.getMonth() - birthDate.getMonth();

                // If the current month is earlier than the birth month, subtract 1 from the age
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                $('#id').val(respond[0].id_antrian);
                $('#kode_pasien').val(respond[0].kode_user);
                $('#name').val(respond[0].nama_lengkap);
                $('#usia').val(age);
                $('#nomor_hp').val(respond[0].nomor_hp);
                $('#jenis_kelamin').val(respond[0].jenis_kelamin);
                $('#alamat').val(respond[0].alamat);
                $('#kunjungan').modal('show');
                $('.modal-title').text('Buat Kunjungan'); 

                $('#kunjungan').on('hidden.bs.modal', function () {
                    location.reload();
                });
            },
            error: function(textStatus) {
                showAlert('error', 'Gagal!', textStatus);
            }
        });
    }

    let currentStep = 1;
    const totalSteps = 4;
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const saveBtn = document.getElementById('saveBtn');

    function showStep(stepNumber) {
        for (let i = 1; i <= totalSteps; i++) {
            const step = document.getElementById(`step${i}`);
            if (step) {
                if (i === stepNumber) {
                    step.style.display = 'block';
                } else {
                    step.style.display = 'none';
                }
            }
        }

        if (stepNumber === 1) {
            prevBtn.style.display = 'none';
        } else {
            prevBtn.style.display = 'block';
        }

        if (stepNumber === totalSteps) {
            nextBtn.style.display = 'none';
            saveBtn.style.display = 'block';
        } else {
            nextBtn.style.display = 'block';
            saveBtn.style.display = 'none';
        }
    }

    function nextStep() {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    }

    function simpan() {
        // Retrieve form values
        var id = document.getElementById("id").value;
        var kode_pasien = document.getElementById("kode_pasien").value;
        var kode_dokter = document.getElementById("kode_dokter").value;
        var keluhan_utama = document.getElementById("keluhan_utama").value;
        var riwayat_penyakit_sekarang = document.getElementById("riwayat_penyakit_sekarang").value;
        var riwayat_penyakit_dahulu = document.getElementById("riwayat_penyakit_dahulu").value;
        var keadaan_umum_pasien = document.getElementById("keadaan_umum_pasien").value;
        var tekanan_darah = document.getElementById("tekanan_darah").value;
        var nadi = document.getElementById("nadi").value;
        var suhu_badan = document.getElementById("suhu_badan").value;
        var pernapasan = document.getElementById("pernapasan").value;
        var berat_badan = document.getElementById("berat_badan").value;
        var tinggi_badan = document.getElementById("tinggi_badan").value;
        var keterangan_penunjang = document.getElementById("keterangan_penunjang").value;
        var diagnosa = document.getElementById("diagnosa").value;
        var tindakan = document.getElementById("tindakan").value;

        // Create an object to store the form data
        var formData = {
            id: id,
            kode_dokter: kode_dokter,
            kode_pasien: kode_pasien,
            keluhan_utama: keluhan_utama,
            riwayat_penyakit_sekarang: riwayat_penyakit_sekarang,
            riwayat_penyakit_dahulu: riwayat_penyakit_dahulu,
            keadaan_umum_pasien: keadaan_umum_pasien,
            tekanan_darah: tekanan_darah,
            nadi: nadi,
            suhu_badan: suhu_badan,
            pernapasan: pernapasan,
            berat_badan: berat_badan,
            tinggi_badan: tinggi_badan,
            keterangan_penunjang: keterangan_penunjang,
            diagnosa: diagnosa,
            tindakan: tindakan
        };

        $.ajax({
            url: `${base_url}dashboard/kunjungan`,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            success: function(response) {
                if (response.status) {
                    showAlert(response.icon, response.title, response.message);
                    $('#form')[0].reset();
                    location.reload()
                } else {
                    showAlert(response.icon, response.title, response.message);
                }
            },
            error: function() {
                alert('An error occurred while saving the form data. Please try again.');
            }
        });
    }

    showStep(currentStep);
</script>
<?= $this->endSection() ?>
