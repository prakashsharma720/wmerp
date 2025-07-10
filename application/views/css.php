<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Muskowl ERP - Admin Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!--  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">  -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>plugins/iCheck/all.css">
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>plugins/bootstrap/css/bootstrap.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>plugins/datatables/dataTables.bootstrap4.css">
 <!--  <link rel="stylesheet" href="<?php //echo base_url()."assets/"; ?>plugins/morris/morris.css"> -->
  <!-- jvectormap -->
<!--   <link rel="stylesheet" href="<?php //echo base_url()."assets/"; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css"> -->
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>plugins/select2/select2.css">
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>plugins/select2/select2.min.css">

  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
<!--   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">   -->
  <style type="text/css">
    .button-group{
      display: flex;
    }
    .button-group > *:not(:first-child) {
       margin-left: 10px;
  }

  .btn-pending{
    background-color:#28262b;
    color: #fff;
    border-radius: 5px;
  } .btn-approved{
    background-color:#127ce8;
    color: #fff;
    border-radius: 5px;
  } .btn-inprocess{
    background-color:#b1541d;
    color: #fff;
    border-radius: 5px;
  } .btn-converted{
    background-color:green;
    color: #fff;
    border-radius: 5px;
  } .btn-rejected{
    background-color:red;
    color: #fff;
    border-radius: 5px;
  }
  .modal-header{
    background-color: #28262b;
    color: #fff;
  }
  .close{
    color: #fff;
  }
    .addrow{
      font-size: 15px;
      background-color: #99a216;
      border:1px solid #99a216;
    } 
    .deleterow{
      font-size: 15px;
      background-color: #dc6913;
       border:1px solid #dc6913;
    }
    /* .btnEdit{
    width: 50%;
    border-radius: 2px;
    margin: 1px;
    padding: 5px;
  } */
  .successs_mesg{
  background-color: #32a338;
    width: 100%;
    height: 45px;
    padding: 10px;
    color: aliceblue;   
  }
  .error_mesg{
    background-color: #e82121;
    width: 100%;
    height: 45px;
    padding: 10px;
    color: aliceblue;   
  }

  .select2{
    height:45px !important;
    /*width: 100% !important;*/
  }
  .btn-block{
    background-color:#167f0f  !important;
    border-color:#167f0f  !important;
  }
  fieldset {
      border:1px solid #999;
      border-radius:8px;
      //box-shadow:0 0 10px #999;
      padding: 15px;
    }
    legend{
      margin-left: 15px;
      color:#144277;
      font-size: 17px;
      margin-bottom:0px;
      border:none;
      background:#fff;
      padding: 15px;
      //font-family: 'Poppins', sans-serif !important;
    }

  </style>
<style type="text/css">
  .fa-circle{
    font-size: 10px !important;
  }
  .fa-circle-o{
    font-size: 10px !important;
  }
</style>
<style type="text/css">
 .btn{
  display: table-cell !important;
 }
 /**/
  .col-md-4,.col-md-6{
    margin-bottom: 10px;
  }
  .radiobtn{
    margin: 20px;
  }
  .required{
    color: red;
  }
  @media (min-width: 1281px) {
  
  CSS
  aside>.main-sidebar{
    width: 320px !important;
  }
  .elevation-4{
    width: 320px !important;
  }
  
}

/* 
  ##Device = Laptops, Desktops
  ##Screen = B/w 1025px to 1280px
*/

@media (min-width: 1025px) and (max-width: 1280px) {
  
   aside>.main-sidebar{
   width: 320px !important;
  }
  .elevation-4{
    width: 320px !important;
  }
}

/* 
  ##Device = Tablets, Ipads (portrait)
  ##Screen = B/w 768px to 1024px
*/

@media (min-width: 768px) and (max-width: 1024px) {
  
  .main-sidebar{
    width: 320px !important;
  }
  .elevation-4{
    width: 3200px !important;
  }
}

/* 
  ##Device = Tablets, Ipads (landscape)
  ##Screen = B/w 768px to 1024px
*/

@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
  
  .main-sidebar{
    width: 270px !important;
  }
  .elevation-4{
    width: 270px !important;
  }
}

/* 
  ##Device = Low Resolution Tablets, Mobiles (Landscape)
  ##Screen = B/w 481px to 767px
*/

@media (min-width: 481px) and (max-width: 767px) {
  
  .main-sidebar{
    width: 250px !important;
  }
  .elevation-4{
    width: 250px !important;
  }
}

/* 
  ##Device = Most of the Smartphones Mobiles (Portrait)
  ##Screen = B/w 320px to 479px
*/

@media (min-width: 320px) and (max-width: 480px) {
  
  .main-sidebar{
    width: 250px !important;
  }
  .elevation-4{
    width: 250px !important;
  }
}

</style>

<!-- <script type="text/javascript">

function confSubmit(form) {
  if (confirm("Are you sure you want to submit the form?")) {
  form.submit();
  }

  else {
  alert("You decided to not submit the form!");
  }
}
</script> -->

</head>