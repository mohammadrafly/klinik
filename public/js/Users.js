function editData(id) {
    $.ajax({
        url: `${base_url}dashboard/users/update/${id}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(respond) {
            $('#id').val(id);
            $('#kode_user').val(respond.name);
            $('#username').val(respond.nik);
            $('#email').val(respond.role);
            $('#password').val(respond.alamat);
            $('#name').val(respond.nomor_hp);
            $('#alamat').val(respond.email);
            $('#role').val(respond.password);
            $('#modal').modal('show');
            $('.modal-title').text(`Edit ${variableModel}`); 
    
            $('#password, #email').prop('readonly', true);
        },
        error: function(textStatus) {
            alert(textStatus);
        }
    });
}

function saveData() {
    const id = $('#id').val();
    const url = id ? `${base_url}dashboard/users/update/${id}` : `${base_url}dashboard/users`;
  
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
            url: `${base_url}dashboard/users/delete/${id}`,
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