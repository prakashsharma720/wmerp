<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('layouts/darulux/header'); ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php $this->load->view('layouts/darulux/sidebar'); ?>

    <div class="content-wrapper">
        <?php
        if (isset($view) && $view != '') {
            $this->load->view($view, isset($data) ? $data : []);
        }
        ?>
    </div>

    <?php $this->load->view('layouts/darulux/footer'); ?>
</div>
</body>
</html>
