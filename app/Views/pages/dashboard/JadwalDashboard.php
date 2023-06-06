<?= $this->extend('layout/DashboardLayout') ?>
<?= $this->section('content') ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?= $title ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Hari</th>
                                                <th>Waktu Buka</th>
                                                <th>Waktu Tutup</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $daysOfWeek = [
                                            1 => 'Senin',
                                            2 => 'Selasa',
                                            3 => 'Rabu',
                                            4 => 'Kamis',
                                            5 => 'Jumat',
                                            6 => 'Sabtu',
                                            7 => 'Minggu'
                                        ];
                                        ?>

                                        <?php foreach ($openingHours as $day => $hours): ?>
                                            <tr>
                                                <td><?= $daysOfWeek[$day] ?></td>
                                                <td><?= $hours['startTime'] ?></td>
                                                <td><?= $hours['endTime'] ?></td>
                                                <td>
                                                    <button class="btn btn-primary" onclick="edit(<?= $day ?>)">Update</button>
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
                <!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Opening Hours</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="text" hidden id="day" name="day">
                    <div class="form-group">
                        <label for="startTime">Waktu Buka</label>
                        <div class="input-group date">
                            <input type="text" class="form-control" id="startTime" name="startTime" maxlength="8" oninput="validateTime(this)" placeholder="00:00:00">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="endTime">Waktu Tutup</label>
                        <div class="input-group date">
                            <input type="text" class="form-control" id="endTime" name="endTime" maxlength="8" oninput="validateTime(this)" placeholder="00:00:00">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
function validateTime(input) {
  var formattedTime = input.value.replace(/\D/g, ''); // Remove non-digit characters

  if (formattedTime.length > 6) {
    formattedTime = formattedTime.slice(0, 6); // Limit to 6 digits
  }

  if (formattedTime.length >= 2) {
    formattedTime = formattedTime.replace(/^(\d{2})/, '$1:'); // Insert first colon
  }
  if (formattedTime.length >= 5) {
    formattedTime = formattedTime.replace(/(\d{2})(?=\d{2}$)/, '$1:'); // Insert second colon
  }

  input.value = formattedTime; // Update the input value
}

var currentDay;

function edit(day) {
    currentDay = day;

    fetch(`${base_url}dashboard/jadwal/update/${day}`)
        .then(response => response.json())
        .then(data => {
            var currentDayInput = document.getElementById("day");
            var startTime = document.getElementById("startTime");
            var endTime = document.getElementById("endTime");

            currentDayInput.value = day;
            startTime.value = data.openingHour.startTime;
            endTime.value = data.openingHour.endTime;

            $('#editModal').modal('show');
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function save() {
    var currentDayInput = document.getElementById("day");
    var startTime = document.getElementById("startTime").value;
    var endTime = document.getElementById("endTime").value;

    var data = {
        start_time: startTime,
        end_time: endTime
    };

    fetch(`${base_url}dashboard/jadwal/update/${currentDayInput.value}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            alert('Opening hours updated successfully');
            location.reload();
        } else {
            alert('Failed to update opening hours');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
<?= $this->endSection() ?>