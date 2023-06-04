<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Klinik SIM</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets-fe/images/logo/favicon.png') ?>" type="image/x-icon">

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url('assets-fe/css/animate-3.7.0.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-fe/css/font-awesome-4.7.0.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-fe/css/bootstrap-4.1.3.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-fe/css/owl-carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-fe/css/jquery.datetimepicker.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-fe/css/linearicons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-fe/css/style.css') ?>">
    <style>
        .modern-button {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 10px;
            background-color: white;
            color: black;
            text-decoration: none;
            border: none;
            font-family: Arial, sans-serif;
            font-size: 16px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, color 0.3s, transform 0.3s;
        }

        .modern-button:hover {
            background-color: #f2f2f2;
            color: #333;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <!-- Preloader Starts -->
    <?= $this->include('layout/partials/Preloader') ?>
    <!-- Preloader End -->

    <!-- Header Area Starts -->
    <?= $this->include('layout/partials/HeaderHome') ?>
    <!-- Header Area End -->

    <?= $this->renderSection('content') ?>

    <!-- Footer Area Starts -->
    <?= $this->include('layout/partials/FooterHome') ?>
    <!-- Footer Area End -->

    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('assets-fe/js/vendor/jquery-2.2.4.min.js') ?>"></script>
	<script src="<?= base_url('assets-fe/js/vendor/bootstrap-4.1.3.min.js') ?>"></script>
    <script src="<?= base_url('assets-fe/js/vendor/wow.min.js') ?>"></script>
    <script src="<?= base_url('assets-fe/js/vendor/owl-carousel.min.js') ?>"></script>
    <script src="<?= base_url('assets-fe/js/vendor/jquery.datetimepicker.full.min.js') ?>"></script>
    <script src="<?= base_url('assets-fe/js/vendor/jquery.nice-select.min.js') ?>"></script>
    <script src="<?= base_url('assets-fe/js/vendor/superfish.min.js') ?>"></script>
    <script src="<?= base_url('assets-fe/js/main.js') ?>"></script>
    <?= $this->renderSection('script') ?>
</body>
</html>
