<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Dompet : Payment Admin Template" />
	<meta property="og:title" content="Dompet : Payment Admin Template" />
	<meta property="og:description" content="Dompet : Payment Admin Template" />
	<meta property="og:image" content="https://dompet.dexignlab.com/xhtml/social-image.png" />
	<meta name="format-detection" content="telephone=no">
	<title>Klinik | <?= $title ?></title>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
	<link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/favicon.png') ?>" />
	<link href="<?= base_url('assets/vendor/datatables/css/jquery.dataTables.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
</head>
<body>
    <div id="main-wrapper">
        <?= $this->include('layout/partials/Header') ?>
        <?= $this->include('layout/partials/Sidebar') ?>
        <div class="content-body">
			<div class="container-fluid">
				<?= $this->renderSection('content') ?>
            </div>
        </div>
        <div class="footer">
            <div class="copyright">
                <p>Copyright © 2023</p>
            </div>
        </div>
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url('js/Main.js') ?>"></script>
	<script src="<?= base_url('assets/vendor/datatables/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins-init/datatables.init.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/global/global.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/dashboard/dashboard-1.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/dlabnav-init.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
	<?= $this->renderSection('script') ?>
</body>
</html>