<?= $this->extend('layout/HomeLayout') ?>

<?= $this->section('content') ?>
    <!-- Hotline Area Starts -->
    <section class="hotline-area text-center section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="antrian">
                        <span id="current-queue">Antrian saat ini: <?= $currentQueue ?></span>
                        <p class="pt-3">Hallo, <?= session()->get('isLoggedIn') ? session()->get('name') : 'Pasien' ?><br>
                        <?php if ($antrianSaya !== null): ?>
                            <?= session()->get('isLoggedIn') ? 'Berikut adalah nomor antrian anda: <strong>'. $antrianSaya->nomor_antrian .'</strong>' : 'Anda belum melakukan login. Silakan login terlebih dahulu.' ?>
                        <?php else: ?>
                            <?= session()->get('isLoggedIn') ? 'Saat ini Anda tidak masuk dalam antrian. Silakan lanjutkan dengan permintaan Antrian Online.' : 'Anda belum melakukan login. Silakan login terlebih dahulu.' ?>
                        <?php endif ?>
                        </p>
                        <button type="button" onclick="<?= session()->get('isLoggedIn') ? 'requestAntrian()' : 'errorPopUp()' ?>" class="modern-button">Antrian Online</button>
                    </div>
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
