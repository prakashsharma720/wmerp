
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
      <?php if($this->session->flashdata('success')): ?>
         <div class="alert alert-success alert-dismissible" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> Success!</h5>
                 <?php echo $this->session->flashdata('success'); ?>
               </div>
          <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
      <?php endif; ?>

      <?php if($this->session->flashdata('failed')): ?>
         <div class="alert alert-error alert-dismissible " >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> Alert!</h5>
                 <?php echo $this->session->flashdata('failed'); ?>
               </div>
      <?php endif; ?>
<div class="container-fluid">
    <div class="card card-primary card-outline">
      	<div class="card-header">
        	<h3 class="card-title"><?= $title ?></h3>
        	<div class="pull-right "></div>
		</div> <!-- /.card-body -->
      	<div class="card-body">
	      	<div class="row">
	          <div class="col-12">
	            <!-- Custom Tabs -->
	            <div class="card">
	              <div class="card-header d-flex p-0">
	                <ul class="nav nav-pills ml-auto p-2">

	                <?php foreach($categories as $category) { ?>
	                  <li class="nav-item"><a class="nav-link  show" href="#tab_<?= $category['id']?>" data-toggle="tab"> <?= $category['category_name']?></a></li>
	                  	
	               	<?php } ?>
	                </ul>
	              </div><!-- /.card-header -->
	              <div class="card-body">
	                <div class="tab-content">
	                	<?php foreach($categories as $category) { ?>

	                  <!-- /.tab-pane -->
	                  <div class="tab-pane" id="tab_<?= $category['id']?>">
	                   	<?php echo $category['category_name'];?>
	                   	 

	          </div>
	          <!-- /.col -->
	        </div>
		</div>
	</div>
</div>
