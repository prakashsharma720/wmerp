<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Duralux Dashboard" />
    <meta name="keywords" content="dashboard, admin, template" />
    <meta name="author" content="flexilecode" />
    <title>Duralux | Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url()."assets2/"; ?>/images/favicon.ico" type="image/x-icon" />

    <!-- CSS Files -->
    <?php $this->load->view('layout/css'); ?>
</head>

<body>
    <!-- Sidebar Navigation -->
    <?php $this->load->view('layout/navigation'); ?>

    <!-- Page Header -->
    <?php $this->load->view('layout/header'); ?>

    <!-- Main Content Wrapper -->
    <main class="nxl-container">
        <?= $contents ?>
    </main>

    <!-- Footer -->
    <?php $this->load->view('layout/footer'); ?>

    <!-- Additional Scripts or Customizer -->

       <?php $this->load->view('layout/js'); ?>
</body>

</html>
