<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
      <?php if($this->session->flashdata('success')): ?>
         <div class="alert alert-success alert-dismissible" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('success') ?>!</h5>
                 <?php echo $this->session->flashdata('success'); ?>
               </div>
          <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
      <?php endif; ?>

      <?php if($this->session->flashdata('failed')): ?>
         <div class="alert alert-error alert-dismissible " >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('alert') ?>!</h5>
                 <?php echo $this->session->flashdata('failed'); ?>
               </div>
      <?php endif; ?>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $this->lang->line('role_master') ?></h3>
        <div class="pull-right ">
			

			    <!-- <span class="error_mesg"><?php echo $this->session->flashdata('failed'); ?></span> -->
		</div>
	      </div> <!-- /.card-body -->
	      	<div class="card-body">
		      	<div class="row">
		      		<div class="col-md-6">
		      			<?php  //echo $title; exit; ?>
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/User_authentication/editrole/<?= $id ?>">
				    			<input type="hidden" name="category_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/User_authentication/add_new_role">
				    			<?php } ?>
				        <div class="form-group">			        		  	
						      <div class="row col-md-12">
				        		<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label"><?= $this->lang->line('role_name') ?></label>
					                <input type="text"  placeholder="<?= $this->lang->line('enter_role_name') ?>" name="role" class="form-control" value="<?= $role?>" required autofocus>
					            </div>
								<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label"><?= $this->lang->line('authority') ?></label>
					                <input type="number"  placeholder="<?= $this->lang->line('enter_authority') ?>" name="auth_id" class="form-control"  value="<?= $auth_id?>" required autofocus>
					            </div>
					        </div>
					        <span class="help-block"></span>
					        <?php if(!empty($id)) { ?>
				           <div class="row col-md-12">
				        		<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label"><?= $this->lang->line('status') ?></label>
					               <select class="form-control" name="flag">
					               		<option value="0"> <?= $this->lang->line('active') ?></option>
					               		<option value="1"> <?= $this->lang->line('de_active') ?></option>
					               </select>
					            </div>
				        	</div>
							<?php } ?>
				           <div class="row col-md-12">
					            <div class="col-md-12 col-sm-12 ">
					            	<label class="control-label" style="visibility: hidden;"> <?= $this->lang->line('name') ?></label><br>
					            	<button type="submit"  class="btn btn-primary btn-block" ><?= $this->lang->line('submit') ?></button>
					            </div>
					        </div>
				        </div>
				        </form>
					</div>
				
				 <!-- /form -->
				<div class="col-md-6">
					<h5> <?= $this->lang->line('role_list') ?></h5>
					<table id="example" class="table table-bordered table-striped" style="width:100%;">
						<thead>
							<tr>
								<th> <?= $this->lang->line('sr_no') ?></th>
								<th style="width: 90%;"> <?= $this->lang->line('roles') ?></th>
								
								<th> <?= $this->lang->line('action') ?></th>
								
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($roles as $role) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $role['role']?></td>
							
								<td> <a class="btn btn-xs btn-info btnEdit" href="<?php echo base_url(); ?>index.php/User_authentication/role_master/<?php echo $role['id'];?>"><i class="fa fa-edit"></i></a>
								<a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $role['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i> </a>
							</td>
								<div class="modal fade" id="delete<?php echo $role['id'];?>" role="dialog">
								<div class="modal-dialog">
								<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/User_authentication/deleteItem/<?php echo $role['id'];?>">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
									<h4 class="modal-title"><?= $this->lang->line('confirm_header') ?> </h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>                        
									</div>
									<div class="modal-body">
									<p>Are you sure, you want to delete <b><?php echo $role['role'];?> </b>Role ? </p>
									</div>
									<div class="modal-footer">
									<button type="submit" class="btn btn-primary delete_submit"> <?= $this->lang->line('yes') ?> </button>
									<button type="button" class="btn btn-danger" data-dismiss="modal"> <?= $this->lang->line('no') ?> </button>
									</div>
								</div>
								</form>
								</div>
                </div>
									
							</tr>
						<?php $i++;} ?>
						</tbody>
						
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
