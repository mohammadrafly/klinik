const base_url = 'http://localhost:8080/';

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
    $.ajax({
        url: `${base_url}dashboard/logout`,
        type: 'GET',
        dataType: 'JSON',
        success: function (response) {
            if (response.success) {
                alert(response.message);
                window.location.href = `${base_url}`;
            } else {
                alert(response.message);
            }
        },
        error: function () {
            alert('An error occurred while processing your request.');
        }
    });
}