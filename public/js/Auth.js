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
                  if (response.role != 'pasien') {
                    showAlert(response.icon, response.title, response.message); 
                    window.location.href = `${base_url}dashboard`;
                  }
                  showAlert(response.icon, response.title, response.message); 
                  window.location.href = `${base_url}`;
                } else {
                  showAlert(response.icon, response.title, response.message); 
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
        const usiaInput = $('#usia');
        const nomorInput = $('#nomor_hp');
        const kelaminInput = $('#jenis_kelamin');
  
        const email = emailInput.val();
        const password = passwordInput.val();
        const username = usernameInput.val();
        const name = nameInput.val();
        const alamat = alamatInput.val();
        const usia = usiaInput.val();
        const nomor_hp = nomorInput.val();
        const jenis_kelamin = kelaminInput.val();
    
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

        if (nomor_hp) {
          alert("Nomor HP tidak boleh kosong");
          return;
        }
  
        if (jenis_kelamin) {
          alert("Jenis Kelamin tidak boleh kosong");
          return;
        }

        if (usia) {
          alert("Usia tidak boleh kosong");
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
            data: { email, password, username, name, usia, jenis_kelamin, nomor_hp ,alamat },
            dataType: 'JSON',
            success: function(response) {
              console.log(response)
                if (response.status) {
                  showAlert(response.icon, response.title, response.message); 
                  window.location.href = `${base_url}`;
                } else {
                  showAlert(response.icon, response.title, response.message); 
                }
            },
            error: function(error) {
              showAlert('error', 'Terjadi Error!', error)
            }
        });
    });
});

