$(document).ready(function() {
    $('#formLogin').submit(function(event) {
        event.preventDefault();
  
        const emailInput = $('#email');
        const passwordInput = $('#password');
  
        const email = emailInput.val();
        const password = passwordInput.val();
    
        if (!email) {
          alert('Email/Email tidak boleh kosong');
          return;
        }
  
        if (!password) {
          alert('Password tidak boleh kosong.');
          return;
        }
  
        $.ajax({
            url: `${base_url}signin`,
            type: 'POST',
            data: { email, password },
            dataType: 'JSON',
            success: function(response) {
                if (response.status) {
                  alert(response.message)
                  window.location.href = `${base_url}dashboard`;
                } else {
                  alert(response.message);
                }
            },
            error: function() {
              alert('terjadi error!');
            }
        });
    });

    $('#formRegister').submit(function(event) {
        event.preventDefault();
  
        const emailInput = $('#email');
        const passwordInput = $('#password');
        const usernameInput = $('#username');
        const nameInput = $('#name');
        const alamatInput = $('#alamat');
  
        const email = emailInput.val();
        const password = passwordInput.val();
        const username = usernameInput.val();
        const name = nameInput.val();
        const alamat = alamatInput.val();
    
        if (!name) {
          alert('Nama Lengkap tidak boleh kosong.');
          return;
        }

        if (!username) {
          alert('Username tidak boleh kosong.');
          return;
        }

        if (!email) {
            alert('Email/Email tidak boleh kosong');
            return;
        }
  
        if (!alamat) {
          alert('Alamat tidak boleh kosong.');
          return;
        }

        if (!password) {
            alert('Password tidak boleh kosong.');
            return;
        }

        $.ajax({
            url: `${base_url}signup`,
            type: 'POST',
            data: { email, password, username, name, alamat },
            dataType: 'JSON',
            success: function(response) {
              console.log(response)
                if (response.status) {
                  alert(response.message);
                  window.location.href = `${base_url}dashboard`;
                } else {
                  alert(response.message);
                }
            },
            error: function(error) {
              alert('terjadi error!'. error)
            }
        });
    });
});
