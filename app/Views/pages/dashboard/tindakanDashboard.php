<?= $this->extend('layout/DashboardLayout') ?>
<?= $this->section('content') ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modal">Tambah Data</button>
                                <h4 class="card-title"><?= $title ?></h4>
                            </div>
                            <?= $this->include('pages/dashboard/partials/tindakanModal') ?>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Nama Tindakan</th>
                                                <th>Deskripsi</th>
                                                <th>Harga</th>
                                                <th>Dibuat</th>
                                                <th>Diperbarui</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($content as $data): ?>
                                            <tr>
                                                <td><?= $data['nama_tindakan'] ?></td>
                                                <td><?= $data['deskripsi'] ?></td>
                                                <td><?= $data['harga'] ?></td>
                                                <td><?= $data['created_at'] ?></td>
                                                <td><?= $data['updated_at'] ?></td>
                                                <td>
                                                    <button class="btn btn-primary" onclick="edit(<?= $data['id'] ?>)">Update</button>
                                                    <button class="btn btn-danger" onclick="deleteItem(<?= $data['id'] ?>)">Delete</button>
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
function simpan() {
  var form = document.getElementById("form");
  var formData = new FormData(form);
  var id = $('#id').val();

  var url = id ? `${base_url}dashboard/tindakan/update/${id}` : `${base_url}dashboard/tindakan`;

  fetch(url, {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      if (data.status) {
        alert(data.message);
        location.reload();
      } else {
        alert('Operasi gagal');
      }
    })
    .catch(error => {
      console.log('Terjadi kesalahan:', error);
    });
}

function edit(id) {
    fetch(`${base_url}dashboard/tindakan/update/${id}`)
    .then(response => response.json())
    .then(data => {
        console.log(data);
        $('#id').val(data.id);
        $('#username').val(data.username);
        $('#email').val(data.email);
        $('#password-input').hide();
        $('#name').val(data.name);
        $('#alamat').val(data.alamat);
        $('#role').val(data.role);
        $('#tanggal_lahir').val(data.tanggal_lahir);
        $('#nomor_hp').val(data.nomor_hp);
        $('#jenis_kelamin').val(data.jenis_kelamin);
        $('#modal').modal('show');
    })
    .catch(error => {
        console.log('Terjadi kesalahan:', error);
    });
}

function deleteItem(id) {
    const confirmDelete = confirm('Are you sure you want to delete this item?');
    if (!confirmDelete) {
        return;
    }

    fetch(`${base_url}dashboard/tindakan/delete/${id}`, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.status) {
            alert(data.message);
            location.reload();
        } else {
            alert('Failed to delete item!');
        }
    })
    .catch(error => {
        console.log('An error occurred:', error);
    });
}
</script>
<?= $this->endSection() ?>