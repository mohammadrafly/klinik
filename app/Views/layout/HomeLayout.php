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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url('assets-fe/css/animate-3.7.0.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-fe/css/font-awesome-4.7.0.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-fe/css/bootstrap-4.1.3.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-fe/css/owl-carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-fe/css/jquery.datetimepicker.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-fe/css/linearicons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets-fe/css/style.css') ?>">
    <style>
   .chat-messages {
  height: 300px;
  overflow-y: scroll;
}

.message-container {
  margin-bottom: 10px;
}

.message-content {
  display: inline-block;
  padding: 10px;
  border-radius: 10px;
}

.sent {
  background-color: #e2f0ff;
  float: right;
}

.received {
  background-color: #f0f0f0;
  float: left;
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
    <div id="chatContainer">
        <div id="chatMessages"></div>
        <div id="chatForm">
            <input type="text" id="messageInput" placeholder="Type your message">
            <button id="sendButton">Send</button>
        </div>
    </div>

    <!-- Javascript -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url('js/Main.js') ?>"></script>
    <script src="<?= base_url('assets-fe/js/vendor/jquery-2.2.4.min.js') ?>"></script>
	<script src="<?= base_url('assets-fe/js/vendor/bootstrap-4.1.3.min.js') ?>"></script>
    <script src="<?= base_url('assets-fe/js/vendor/wow.min.js') ?>"></script>
    <script src="<?= base_url('assets-fe/js/vendor/owl-carousel.min.js') ?>"></script>
    <script src="<?= base_url('assets-fe/js/vendor/jquery.datetimepicker.full.min.js') ?>"></script>
    <script src="<?= base_url('assets-fe/js/vendor/jquery.nice-select.min.js') ?>"></script>
    <script src="<?= base_url('assets-fe/js/vendor/superfish.min.js') ?>"></script>
    <script src="<?= base_url('assets-fe/js/main.js') ?>"></script>
    <script>
    </script>
    <?= $this->renderSection('script') ?>
</body>
</html>
