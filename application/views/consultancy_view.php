<!-- Page Content -->
<div class="nxl-content">
	<!-- Page Header -->
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('consultancy') ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
						<?= $this->lang->line('home') ?>
					</a>
				</li>
				<li class="breadcrumb-item"><?= $this->lang->line('consultancy_master') ?></li>
			</ul>
		</div>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
     <div class="page-header-right ms-auto">
			<div class="page-header-right-items">
				<?php $this->load->view('layout/alerts'); ?>
			</div>
			<!-- Mobile Toggle -->
			<div class="d-md-none d-flex align-items-center">
				<a href="javascript:void(0)" class="page-header-right-open-toggle">
					<i class="feather-align-right fs-20"></i>
				</a>
			</div>
		</div>
	</div>
  <div class="main-content">
		<div class="card card-primary card-outline">
	      	<div class="card-body">
		      	<div class="row">
		      		<div class="col-md-4">
		      			<?php  //echo $title; exit; ?>
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Consultancy/editPM/<?= $id ?>">
				    			<input type="hidden" name="pm_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Consultancy/add_newPM">
				    			<?php } ?>
				        <div class="form-group">
				        	Consultancy Code :  <label class="control-label"> <?= $service_code_view ?></label>
				        	<div class="row col-md-12">
					                <?php
					                 if ($categories): ?> 
					                  <?php 
					                    foreach ($categories as $value) : ?>
					                        <?php 
						                        if ($value['id'] == $categories_id): ?>
						                        	<input type="hidden" name="categories_id" value="<?= $value['id'] ?>" >

						                        	<input type="hidden" name="code" value="<?= $service_code_view ?>" >

						                        <label class="control-label"> <?= $value['category_name'] ?> <?=$this ->lang ->line('name')?></label>
						                     
						                        <?php endif;   ?>
					                    <?php  endforeach;  ?>
					                <?php else: ?>
					                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
					                <?php endif; ?>
					            </div>
					        <div class="row col-md-12">
					            	<!-- <label class="control-label"> Name</label>  -->
					                <input type="text"  placeholder="<?=$this ->lang ->line('enter_name')?>" name="name" class="form-control" value="<?= $name?>" required autofocus>
					          </div>
						   	 <!--<div class="row col-md-12">
				        		<div class="col-md-12 col-sm-12 ">
								<label class="control-label"> Code</label>
						                <input type="text"  placeholder="Enter Code" name="code" class="form-control" value="<?= $code?>" required autofocus>
								</div>
								</div>-->
					            <div class="row col-md-12">
					            	<label class="control-label"> <?=$this ->lang ->line('description')?></label>
					                <textarea type="text"  placeholder="<?=$this ->lang ->line('enter_description')?>" name="description" class="form-control" value="<?= $description?>" autofocus><?= $description ?></textarea>
					            </div>
					        <?php if(!empty($id)) { ?>
				           <div class="row col-md-12">
					            	<label class="control-label"><?=$this ->lang ->line('status')?></label>
					               <select class="form-control" name="flag">
					               		<option value="0"> <?=$this ->lang ->line('active')?></option>
					               		<option value="1"> <?=$this ->lang ->line('de_active')?></option>
					               </select>
				        	</div>
				        <?php } ?>
				           <div class="row col-md-12">
					            	<label class="control-label" style="visibility: hidden;"> <?=$this ->lang ->line('name')?></label><br>
					            	<button type="submit" class="btn btn-primary btn-block"><?=$this ->lang ->line('save')?></button>
					        </div>
				        </div>
				        </form>
					</div>
				 <!-- /form -->
				<div class="col-md-8">
					<h5> <?=$this ->lang ->line('consultancy')?></h5>
					<div class="table-responsive">
					 <div class="dataTables_wrapper dt-bootstrap5 no-footer shadow-sm p-3 mt-3 rounded" style="background-color: #fff;">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped dataTable no-footer align-middle" id="proposalList" aria-describedby="proposalList_info">
							<thead class="table-light">
							<tr>
								<th> <?=$this ->lang ->line('sr_no')?>.</th>
								<th> <?=$this ->lang ->line('name')?></th>
								
								<th> <?=$this ->lang ->line('code')?></th>
							
								<th><?=$this ->lang ->line('description')?></th>
								<th><?=$this ->lang ->line('action')?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($consultancies as $consultancy) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $consultancy['name'] ?></td>
								<td><?= $consultancy['code'] ?></td>
								
								<td><?= $consultancy['description'] ?></td>
								<td> <a class="btn btn-icon avatar-text avatar-md" href="<?php echo base_url(); ?>index.php/Consultancy/index/<?php echo $consultancy['id'];?>"><i class="feather feather-edit-3 "></i></a></td>
							</tr>
						<?php $i++;} ?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>+