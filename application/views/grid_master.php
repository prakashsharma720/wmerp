
<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h5><i class="icon fa fa-check"></i><?= $this->lang->line('success') ?> !</h5>
		<?php echo $this->session->flashdata('success'); ?>
	</div>
	<!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
<?php endif; ?>

<?php if ($this->session->flashdata('failed')): ?>
	<div class="alert alert-error alert-dismissible ">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h5><i class="icon fa fa-check"></i> <?= $this->lang->line('alert') ?>!</h5>
		<?php echo $this->session->flashdata('failed'); ?>
	</div>
<?php endif; ?>

<div class="nxl-content">
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('product_grid_master') ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
				</li>
				<li class="breadcrumb-item"><?= $this->lang->line('leave_history') ?>
				</li>
			</ul>
		</div>

		<div class="page-header-right ms-auto">
			<div class="page-header-right-items">

			</div>

			<!-- Mobile Toggle -->
			<div class="d-md-none d-flex align-items-center">
				<a href="javascript:void(0)" class="page-header-right-open-toggle">
					<i class="feather-align-right fs-20"></i>
				</a>
			</div>
		</div>
	</div>
	










<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  
	      
	      	<div class="card-body p-3 bg-white">
		      	<div class="row">
		      		<div class="col-md-6">
		      			<?php  //echo $title; exit; ?>
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Grid/editgrid/<?= $id ?>">
				    			<input type="hidden" name="grid_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Grid/add_new_grid">
				    			<?php } ?>
				        <div class="form-group">
				        	<div class="row col-md-12">
				        		<div class="col-md-8 col-sm-8 ">
					            	<label class="control-label"><?=$this ->lang->line('grid_name')?></label>
					                <input type="text"  placeholder="<?= $this->lang->line('enter_grid_name') ?>" name="grid_name" class="form-control" value="<?= $grid_name?>" required autofocus>
					            </div>
					        </div>
					        <span class="help-block"></span>
					        <?php if(!empty($id)) { ?>
				           <div class="row col-md-12">
				        		<div class="col-md-8 col-sm-8 ">
					            	<label class="control-label"><?=$this ->lang->line('status')?></label>
					               <select class="form-control" name="flag">
					               		<option value="0"><?=$this ->lang->line('active')?></option>
					               		<option value="1"><?=$this ->lang->line('de_active')?></option>
					               </select>
					            </div>
				        	</div>
				        <?php } ?>
				           <div class="row col-md-12">
					            <div class="col-md-8 col-sm-8 ">
					            	<label class="control-label" style="visibility: hidden;"><?=$this ->lang->line('name')?></label><br>
					            	<button type="submit" class="btn btn-primary btn-block"><?=$this ->lang->line('save')?></button>
					            </div>
					        </div>
				        </div>
				        </form>
					</div>
				 <!-- /form -->
				<div class="col-md-6">
				  <div class="table-responsive">
					<h5><?=$this ->lang->line('grid_list')?> </h5>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th> <?=$this ->lang->line('sr_no')?></th>
								<th><?=$this ->lang->line('grid_name')?></th>
								<th><?=$this ->lang->line('action')?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($grids as $grid) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $grid['grid_name']?></td>
								<td> <a class="border rounded bg-light shadow-sm text-dark px-1 py-0" style="padding: 2px 3px;" href="<?php echo base_url(); ?>index.php/Grid/index/<?php echo $grid['id'];?>"><i class="feather feather-edit-3"></i></a></td>
							</tr>
						<?php $i++;} ?>
						</tbody>
						
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
