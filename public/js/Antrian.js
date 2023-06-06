function detail(id) {
    $.ajax({
        url: `${base_url}dashboard/antrian/detail/${id}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(respond) {
            $('#id').val(respond.id);
            $('#nomor_antrian').val(respond.nomor_antrian);
            $('#kode_pasien').val(respond.kode_pasien);
            $('#status').val(respond.status);
            $('#antrian').modal('show');
            $('#nomor_antrian_input').removeAttr('hidden');
            $('#status_input').removeAttr('hidden');

            $('#name_input').hide();
            $('#usia_input').hide();
            $('#nomor_hp_input').hide();
            $('#jenis_kelamin_input').hide();
            $('#alamat_input').hide();
            $('#pilih-pasien').hide();

            $('.modal-title').text('Detail Antrian'); 

            $('#antrian').on('hidden.bs.modal', function () {
                location.reload();
            });
        },
        error: function(textStatus) {
            showAlert('error', 'Gagal!', textStatus);
        }
    });
}

function simpan() {
    const id = $('#id').val();
    const url = id ? `${base_url}dashboard/antrian/detail/${id}` : `${base_url}dashboard/antrian`;

    $.ajax({
        url,
        type: 'POST',
        data: $('#form').serialize(),
        dataType: 'json',
        success: (data) => {
            showAlert(data.icon, data.title, data.message);
            location.reload()
        },
        error: (textStatus) => {
            showAlert('error', 'Error!', textStatus);
        },
    });
}
