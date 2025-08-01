

<div class="nxl-content">
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('hsn_master') ?></h5>
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
	

	      	<div class="card-body p-3 bg-white " style="position: relative; top:20px;left:5px;">
		      	<div class="row">
		      		<div class="col-md-6">
		      			<?php  //echo $title; exit; ?>
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/HSN/editHSN/<?= $id ?>">
				    			<input type="hidden" name="HSN_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/HSN/add_new_HSN">
				    			<?php } ?>
				        <div class="form-group">
						<div class="row col-md-12">
							<div class="col-md-8 col-sm-8 ">
								<label class="control-label"> <?=$this ->lang->line('mineral_name')?></label>
						<input type="text" placeholder="<?=$this ->lang ->line('enter_mineral_name')?>" name="mineral_name" class="form-control" value="<?= $mineral_name?>" required autofocus>

								</div>
					        </div>
					        <span class="help-block"></span>
				        	<div class="row col-md-12">
				        		<div class="col-md-8 col-sm-8 ">
					            	<label class="control-label"><?=$this ->lang->line('hsn_code')?></label>
					                <input type="text"  placeholder="<?=$this ->lang ->line('enter_hsn_code')?>" name="hsn_code" class="form-control" value="<?= $hsn_code?>" required autofocus>
					            </div>
					        </div>
							
					        <?php if(!empty($id)) { ?>
				           <div class="row col-md-12">
				        		<div class="col-md-8 col-sm-8 ">
					            	<label class="control-label"><?=$this ->lang->line('status')?></label>
					               <select class="form-control" name="flag">
					               		<option value="0"> <?=$this ->lang->line('active')?></option>
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
					<h5> <?= $this->lang->line('hsn_list'); ?></h5>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th> <?=$this ->lang->line('sr_no')?>.</th>
								<th><?=$this ->lang->line('mineral_name')?></th>
								<th><?=$this ->lang->line('hsn_code')?></th>
								<th><?=$this ->lang->line('action')?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($HSNs as $HSN) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?=$this ->lang->line('mineral_name')?></td>
								<td><?= $HSN['hsn_code']?></td>
								<td> <a class="btn btn-icon avatar-text avatar-md" href="<?php echo base_url(); ?>index.php/HSN/index/<?php echo $HSN['id'];?>"><i class="feather feather-edit-3"></i></a></td>
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
