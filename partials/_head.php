<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="MartDevelopers Inc">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIGE | Sistema de Gestão de Estoque</title>
    <!-- Favicon -->

    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/faviconivv.png">
    <link rel="icon" type="image/png" href="./assets/img/sige.png">
    
    <link rel="manifest" href="assets/img/icons/site.webmanifest">

    <meta charset="utf-8" />
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <link href="assets/css/custom-modern.css" rel="stylesheet" />
    <!-- Icons -->
    <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <script src="assets/js/swal.js"></script>
    <!--Load Swal-->
    <?php if (isset($success)) { ?>
       
        <script>
            setTimeout(function() {
                    swal("Sucesso", "<?php echo $success; ?>", "success");
                },
                100);
        </script>

    <?php } ?>
    <?php if (isset($err)) { ?>
     
        <script>
            setTimeout(function() {
                    swal("Falha", "<?php echo $err; ?>", "error");
                },
                100);
        </script>

    <?php } ?>
    <?php if (isset($info)) { ?>
     
        <script>
            setTimeout(function() {
                    swal("Sucesso", "<?php echo $info; ?>", "info");
                },
                100);
        </script>

    <?php } ?>
   
</head>
<body class="g-sidenav-show  bg-gray-200">