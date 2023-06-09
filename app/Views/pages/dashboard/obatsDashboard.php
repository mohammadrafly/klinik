<?= $this->extend('layout/DashboardLayout') ?>
<?= $this->section('content') ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modal">Tambah Data</button>
                                <h4 class="card-title"><?= $title ?></h4>
                            </div>
                            <?= $this->include('pages/dashboard/partials/obatsModal') ?>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Kode Obat</th>
                                                <th>Nama Obat</th>
                                                <th>Deskripsi</th>
                                                <th>Stok</th>
                                                <th>Harga</th>
                                                <th>Dibuat Tanggal</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($content as $data): ?>
                                            <tr>
                                                <td><?= $data['kode_obat'] ?></td>
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['deskripsi'] ?></td>
                                                <td><?= $data['stok'] ?></td>
                                                <td><?= $data['harga'] ?></td>
                                                <td><?= $data['created_at'] ?></td>
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

  var url = id ? `${base_url}dashboard/obats/update/${id}` : `${base_url}dashboard/obats`;

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
    fetch(`${base_url}dashboard/obats/update/${id}`)
    .then(response => response.json())
    .then(data => {
        console.log(data);
        $('#id').val(data.id);
        $('#nama').val(data.nama);
        $('#deskripsi').val(data.deskripsi);
        $('#stok').val(data.stok);
        $('#harga').val(data.harga);
        $('#modal').modal('show');
    })
    .catch(error => {
        console.log('Terjadi kesalahan:', error);
    });
}

function deleteItem(id) {
    const confirmDelete = confirm('Are you sure you want to delete this item?');
    if (!confirmDelete) {
        return; // Abort the deletion if the user cancels
    }

    fetch(`${base_url}dashboard/obats/delete/${id}`, {
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