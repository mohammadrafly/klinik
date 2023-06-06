<?= $this->extend('layout/HomeLayout') ?>

<?= $this->section('content') ?>
    <!-- Hotline Area Starts -->
    <section class="hotline-area text-center section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                <?php
                $currentDay = date('N'); // Get the current day (1 for Monday, 2 for Tuesday, etc.)

                // Read the opening hours from the JSON file
                $openingHoursJson = file_get_contents(WRITEPATH . 'openingHours.json');
                $openingHours = json_decode($openingHoursJson, true); // Decode the JSON string into an associative array

                if (isset($openingHours[$currentDay])) {
                    $startTime = strtotime($openingHours[$currentDay]['startTime']);
                    $endTime = strtotime($openingHours[$currentDay]['endTime']);
                    
                    $currentTime = time();
                    if ($currentTime >= $startTime && $currentTime <= $endTime): ?>
                        <div id="antrian">
                            <span id="current-queue">Antrian saat ini: <?= $currentQueue ?></span>
                            <p class="pt-3">Hallo, <?= session()->get('isLoggedIn') ? session()->get('name') : 'Pasien' ?><br>
                            <?php if ($antrianSaya !== null): ?>
                                <?= session()->get('isLoggedIn') ? 'Berikut adalah nomor antrian anda: <strong>'. $antrianSaya->nomor_antrian .'</strong>' : 'Anda belum melakukan login. Silakan login terlebih dahulu.' ?>
                            <?php else: ?>
                                <?= session()->get('isLoggedIn') ? 'Saat ini Anda tidak masuk dalam antrian. Silakan lanjutkan dengan permintaan Antrian Online.' : 'Anda belum melakukan login. Silakan login terlebih dahulu.' ?>
                            <?php endif ?>
                            </p>
                            <?php if (session()->get('role') === 'pasien'): ?>
                                <button type="button" onclick="<?= session()->get('isLoggedIn') ? 'requestAntrian()' : 'errorPopUp()' ?>" class="modern-button">Antrian Online</button>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <span>Maaf, klinik sedang tutup</span>
                    <?php endif;
                } else {
                    echo "<span>Maaf, klinik sedang tutup</span>";
                }
                ?>
                </div>

            </div>
        </div>
    </section>
    <!-- Hotline Area End -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    //var currentQueueElement = document.getElementById('current-queue');
    //var greetingElement = document.querySelector('#antrian p');
    //var buttonElement = document.querySelector('#antrian button');
    //var currentTime = new Date(Date.now()).toLocaleTimeString('id-ID', { timeZone: 'Asia/Jakarta' });

    //var openingTime = '12:30:00';
    //var closingTime = '17:00:00';

    //if (currentTime < openingTime || currentTime > closingTime) {
    //    currentQueueElement.textContent = 'Maaf, antrian online sedang tutup.';
    //    greetingElement.style.display = 'none';
    //    buttonElement.style.display = 'none';
    //    document.getElementById('antrian').style.display = 'block';
    //} else {
    //    document.getElementById('antrian').style.display = 'none';
    //}

    function requestAntrian() {
        fetch(`${base_url}pasien/antrian-online`, {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                showAlert(data.icon, data.title, data.message);
                location.reload()
            } else {
                showAlert(data.icon, data.title, data.message);
            }
        })
        .catch(error => {
            showAlert('error', 'Gagal!', 'Terjadi kesalahan saat mengambil nomor antrian');
        });
    }

    function errorPopUp() {
        showAlert('error', 'Peringatan!', 'Anda belum melakukan login. Silakan login terlebih dahulu.')
    }
</script>
<?= $this->endSection() ?>
