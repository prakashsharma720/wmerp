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
        <h3 class="card-title"><?= $page_title ?></h3>
        <div class="pull-right ">
			

			    <!-- <span class="error_mesg"><?php echo $this->session->flashdata('failed'); ?></span> -->
		</div>
	      </div> <!-- /.card-body -->
	      	<div class="card-body">
		      	<div class="row">
		      		<div class="col-md-4">
		      			<?php  //echo $title; exit; ?>
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Dailytasks/editprojects/<?= $id ?>">
				    			<input type="hidden" name="category_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Dailytasks/add_new_project/">
				    			<?php } ?>
				        <div class="form-group">			        		  	
						      <div class="row col-md-18">
				        		<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label"> <?= $this->lang->line('project_name') ?></label>
					                <input type="text"  placeholder="Enter project Name " name="project_name" class="form-control" value="<?= $project_name?>" required autofocus>
					            </div>
					           <!--start date-->	
									<div class="col-md-12 col-sm-12">
						            	<label class="control-label"> <?= $this->lang->line('start_date') ?> </label> <span class="required">*</span>
						                <input type="text" data-date-formate="dd-mm-yyyy" name="start_date" class="form-control date-picker" value="<?php echo $start_date;?>" placeholder="dd-mm-yyyy"  required>
			            			</div>
								<!--end date-->	
									<div class="col-md-12 col-sm-12">
						            	<label class="control-label"> <?= $this->lang->line('end_date') ?> </label> <span class="required">*</span>
						                <input type="text" data-date-formate="dd-mm-yyyy" name="end_date" class="form-control date-picker" value="<?php echo $end_date;?>" placeholder="dd-mm-yyyy"  required>
			            			</div>
									<!-- status -->
									 <!--Status-->
									 <div class="col-md-12 col-sm-12">
							

									
										  <label class="control-label">  <?= $this->lang->line('status') ?></label>
										 <select class="form-control" name="project_status">
										 <option value="" >Select status </option>
												 <option <?php if($project_status) { if($project_status=="In Process") { echo "selected"; } } ?> value="In Process" > In Process </option>
												 <option  <?php if($project_status) { if($project_status=="On Hold") { echo "selected"; } }  ?> value="On Hold" > On Hold </option>
												 <option  <?php if($project_status) { if($project_status=="Completd") { echo "selected"; } } ?> value="Completd" > Completd</option>
												
										 </select>
									  </div>
										

			        		
									
											
							 
						<!-- Department Dropdownmenu-->																					 
							<div class="col-md-12 col-sm-4 ">
						            	<label  class="control-label">  <?= $this->lang->line('department') ?> <span class="required">*</span></label>
						               <?php  
						            		echo form_dropdown('department_id', $departments,$department_id, '', 'required="required"')
						            	?>
							</div>    
									<!-- Work description -->
									<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label">  <?= $this->lang->line('work_description') ?> <span class="required"> *</span></label>
					               <textarea class="form-control message" rows="3" placeholder="Enter Message" name="description" value="<?php echo $description;?>"><?php echo $description;?></textarea>
					            </div>
								<!-- Technology -->
								<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label"> <?= $this->lang->line('technology_name') ?></label>
					                <input type="text"  placeholder="Enter Technology Name " name="technology" class="form-control"  value="<?php echo $technology;?>">
					            </div>	
							
					        </div>
					       
				           <div class="row col-md-14">
					            <div class="col-md-12 col-sm-12 ">
					            	<label class="control-label" style="visibility: hidden;"> Name</label><br>
					            	<button type="submit"  class="btn btn-primary btn-block" ><?= $this->lang->line('submit') ?></button>
					            </div>
					        </div>
				        </div>
				        </form>
					</div>
				 <!-- /form -->
			
				<div class=" col-md-8 col-sm-8">
					<h5><?= $this->lang->line('project_list') ?></h5>
					<div class="table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th><?= $this->lang->line('sr_no') ?></th>
								<th style="width: 90%;"><?= $this->lang->line('project_name') ?></th>
								<th><?= $this->lang->line('start_date') ?></th>
								<th><?= $this->lang->line('end_date') ?></th>
								<th><?= $this->lang->line('status') ?></th>
								<th><?= $this->lang->line('department') ?></th>
								<th><?= $this->lang->line('description') ?></th>
								<th><?= $this->lang->line('technology_name') ?></th>
								<th><?= $this->lang->line('action') ?></th>
								
								
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($projects as $project) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $project['project_name']?></td>
								<td><?= $project['start_date']?></td>
								<td><?= $project['end_date']?></td>
								<td><?= $project['status']?></td>
								<td><?= $project['department_id']?></td>

								<td><?= $project['description']?></td>
								<td><?= $project['technology']?></td>


								

								
								<td> <a class="btn btn-xs btn-info btnEdit" href="<?php echo base_url(); ?>index.php/Dailytasks/projects/<?php echo $project['id'];?>"><i class="fa fa-edit"></i></a></td>
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
