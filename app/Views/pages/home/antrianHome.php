<?= $this->extend('layout/HomeLayout') ?>

<?= $this->section('content') ?>
    <!-- Hotline Area Starts -->
    <section class="hotline-area text-center section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Antrian Online</h2>
                    <span>Antrian saat ini: 12</span>
                    <p class="pt-3">Hallo, <?= session()->get('isLoggedIn') ? session()->get('name') : 'Pasien' ?> <br>
                        <?= session()->get('isLoggedIn') ? 'Saat ini Anda tidak masuk dalam antrian. Silakan lanjutkan dengan permintaan Antrian Online.' : 'Anda belum melakukan login. Silakan login terlebih dahulu.' ?>
                    </p>
                    <button type="button" onclick="<?= session()->get('isLoggedIn') ? 'requestAntrian()' : 'showAlert(\'error\', \'Error\', \'Anda belum melakukan login. Silakan login terlebih dahulu.\')' ?>" class="modern-button">Antrian Online</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Hotline Area End -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
function requestAntrian() {

}

function errorPopUp() {
    showAlert('error', 'Peringatan!', 'Anda belum melakukan login. Silakan login terlebih dahulu.')
}

function showAlert(icon, title, text) {
    Swal.fire({
        icon: icon,
        title: title,
        text: text
    });
}
</script>
<?= $this->endSection() ?>