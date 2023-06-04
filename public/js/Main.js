const base_url = 'http://localhost:8080/';

function showAlert(icon, title, text) {
    Swal.fire({
        icon: icon,
        title: title,
        text: text
    });
}

function isFormValid() {
    var requiredFields = $('#form').find(':input[required]');
    var isValid = true;

    requiredFields.each(function() {
        if (!$(this).val()) {
            isValid = false;
            return false;
        }
    });

    return isValid;
}

function signOut() {
    Swal.fire({
        title: 'Logout',
        text: 'Are you sure you want to logout?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `${base_url}dashboard/logout`,
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    if (response.success) {
                        showAlert(response.icon, response.title, response.message);
                        window.location.href = `${base_url}signin`;
                    } else {
                        showAlert(response.icon, response.title, response.message);
                    }
                },
                error: function () {
                    alert('An error occurred while processing your request.');
                }
            });
        }
      });
}