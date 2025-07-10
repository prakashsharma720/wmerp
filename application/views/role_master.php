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
					            	<label class="control-label">Role Name</label>
					                <input type="text"  placeholder="Enter Role name" name="role" class="form-control" value="<?= $role?>" required autofocus>
					            </div>
								<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label">Authority</label>
					                <input type="number"  placeholder="authority level" name="auth_id" class="form-control"  value="<?= $auth_id?>" required autofocus>
					            </div>
					        </div>
					        <span class="help-block"></span>
					        <?php if(!empty($id)) { ?>
				           <div class="row col-md-12">
				        		<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label">Status</label>
					               <select class="form-control" name="flag">
					               		<option value="0"> Active</option>
					               		<option value="1"> De-active</option>
					               </select>
					            </div>
				        	</div>
							<?php } ?>
				           <div class="row col-md-12">
					            <div class="col-md-12 col-sm-12 ">
					            	<label class="control-label" style="visibility: hidden;"> Name</label><br>
					            	<button type="submit"  class="btn btn-primary btn-block" >Save</button>
					            </div>
					        </div>
				        </div>
				        </form>
					</div>
				
				 <!-- /form -->
				<div class="col-md-6">
					<h5> Role List</h5>
					<table id="example" class="table table-bordered table-striped" style="width:100%;">
						<thead>
							<tr>
								<th> Sr.No.</th>
								<th style="width: 90%;"> Roles</th>
								
								<th> Action</th>
								
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
									<h4 class="modal-title">Confirm Header </h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>                        
									</div>
									<div class="modal-body">
									<p>Are you sure, you want to delete <b><?php echo $role['role'];?> </b>Role ? </p>
									</div>
									<div class="modal-footer">
									<button type="submit" class="btn btn-primary delete_submit"> Yes </button>
									<button type="button" class="btn btn-danger" data-dismiss="modal"> No </button>
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
