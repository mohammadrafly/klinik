function editData(id) {
    $.ajax({
        url: `${base_url}dashboard/obats/update/${id}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(respond) {
            $('#id').val(id);
            $('#kode_obat').val(respond.name);
            $('#nama').val(respond.nik);
            $('#deskripsi').val(respond.role);
            $('#stok').val(respond.alamat);
            $('#harga').val(respond.nomor_hp);
            $('#modal').modal('show');
            $('.modal-title').text(`Edit ${variableModel}`); 
        },
        error: function(textStatus) {
            alert(textStatus);
        }
    });
}

function saveData() {
    const id = $('#id').val();
    const url = id ? `${base_url}dashboard/obats/update/${id}` : `${base_url}dashboard/obats`;
  
    if (isFormValid()) {
        var formData = $('#form').serialize();
        console.log(formData);
        $.ajax({
            url,
            type: 'POST',
            data: $('#form').serialize(),
            processData: false,
            contentType: false,
            dataType: 'JSON',
            success: ({ message }) => {
              alert(message)
              location.reload()
            },
            error: () => {
              alert('An error occurred while processing your request.');
            },
        });
    } else {
        alert('Oops! Sepertinya ada yang terlewat. Mohon pastikan semua input telah diisi.')
    }
}

function deleteData(id) {
    if (confirm('Anda yakin ingin melakukan operasi ini?')) {
        $.ajax({
            url: `${base_url}dashboard/obats/delete/${id}`,
            type: 'GET',
            dataType: 'JSON',
            success: ({ message }) => {
                alert(message);
                location.reload();
            },
            error: function(textStatus) {
            alert(textStatus);
            }
        });
    }
}