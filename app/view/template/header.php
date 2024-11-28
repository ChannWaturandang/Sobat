<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start(); // Start the session if it's not already started
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $data['title']; ?></title>
  <link href="<?php echo APP_PATH; ?>/css/time-date.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <!-- DATATABLES BS 4-->
  <link rel="stylesheet" href="<?= APP_PATH; ?>/sb-admin/vendor/datatables/dataTables.bootstrap4.css" />
  <link rel="stylesheet" href="<?= APP_PATH; ?>/sb-admin/vendor/datatables/dataTables.bootstrap4.min.css" />
  <!-- Bootstrap core JavaScript-->
  <script src="<?= APP_PATH; ?>/sb-admin/vendor/jquery/jquery.min.js"></script>
  <script src="<?= APP_PATH; ?>/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?= APP_PATH; ?>/sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">


  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/css/bootstrap.min.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <link href="<?= APP_PATH; ?>/sb-admin/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= APP_PATH; ?>/css/chatbot.css" rel="stylesheet">
  <link href="<?= APP_PATH; ?>/css/module.css" rel="stylesheet">
  <link href="<?= APP_PATH; ?>/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= APP_PATH; ?>/css/transaksi_beli.css" rel="stylesheet">
  <link href="<?= APP_PATH; ?>/css/table_medicine_data.css" rel="stylesheet">
  <link href="<?= APP_PATH; ?>/css/transaksi_jual.css" rel="stylesheet">
  <link href="<?= APP_PATH; ?>/css/data_penjualan.css" rel="stylesheet">
  <link href="<?= APP_PATH; ?>/css/dashboard.css" rel="stylesheet">
  <link href="<?= APP_PATH; ?>/css/robot.css" rel="stylesheet">
  <style type="text/css">
    /* Chart.js */
    @keyframes chartjs-render-animation {
      from {
        opacity: .99
      }

      to {
        opacity: 1
      }
    }

    .chartjs-render-monitor {
      animation: chartjs-render-animation 1ms
    }

    .chartjs-size-monitor,
    .chartjs-size-monitor-expand,
    .chartjs-size-monitor-shrink {
      position: absolute;
      direction: ltr;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      overflow: hidden;
      pointer-events: none;
      visibility: hidden;
      z-index: -1
    }

    .chartjs-size-monitor-expand>div {
      position: absolute;
      width: 1000000px;
      height: 1000000px;
      left: 0;
      top: 0
    }

    .chartjs-size-monitor-shrink>div {
      position: absolute;
      width: 200%;
      height: 200%;
      left: 0;
      top: 0
    }
  </style>
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper" class="flex-column">