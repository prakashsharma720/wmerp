<style>
	.control-label {
margin: 0.7rem
}
</style>
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
	  
<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10"><?= $this->lang->line('daily_tasks') ?></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('projects') ?>
                </li>
            </ul>
        </div>

        <div class="page-header-right ms-auto">
           
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
                    <div class="col-lg-4">
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
					                <input type="text"  placeholder="<?= $this->lang->line('enter_project_name') ?> " name="project_name" class="form-control" value="<?= $project_name?>" required autofocus>
					            </div>
					           <!--start date-->	
									<div class="col-md-12 col-sm-12">
						            	<label class="control-label"> <?= $this->lang->line('start_date') ?> </label> <span class="required">*</span>
						                <input type="text" data-date-formate="dd-mm-yyyy" name="start_date" class="form-control date-picker" value="<?php echo $start_date;?>" placeholder="<?= $this->lang->line('dd_mm_yyyy') ?>"  required>
			            			</div>
								<!--end date-->	
									<div class="col-md-12 col-sm-12">
						            	<label class="control-label"> <?= $this->lang->line('end_date') ?> </label> <span class="required">*</span>
						                <input type="text" data-date-formate="dd-mm-yyyy" name="end_date" class="form-control date-picker" value="<?php echo $end_date;?>" placeholder="<?= $this->lang->line('dd_mm_yyyy') ?>"  required>
			            			</div>
									<!-- status -->
									 <!--Status-->
									 <div class="col-md-12 col-sm-12">
							

									
										  <label class="control-label">  <?= $this->lang->line('status') ?></label>
										 <select class="form-control" name="project_status">
										 <option value="" ><?= $this->lang->line('select_status') ?></option>
												 <option <?php if($project_status) { if($project_status=="In Process") { echo "selected"; } } ?> value="In Process" ><?= $this->lang->line('in_process') ?></option>
												 <option  <?php if($project_status) { if($project_status=="On Hold") { echo "selected"; } }  ?> value="On Hold" > <?= $this->lang->line('on_hold') ?> </option>
												 <option  <?php if($project_status) { if($project_status=="Completd") { echo "selected"; } } ?> value="Completd" > <?= $this->lang->line('completed') ?></option>
												
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
					               <textarea class="form-control message" rows="3" placeholder="<?= $this->lang->line('enter_message') ?>" name="description" value="<?php echo $description;?>"><?php echo $description;?></textarea>
					            </div>
								<!-- Technology -->
								<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label"> <?= $this->lang->line('technology_name') ?></label>
					                <input type="text"  placeholder="<?= $this->lang->line('enter_technology_name') ?>" name="technology" class="form-control"  value="<?php echo $technology;?>">
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
                        <div class="col-lg-8">
<h5><?= $this->lang->line('project_list') ?></h5>
					<div class="table-responsive">
                <table class="table table-hover  table-bordered table-striped" id="proposalList">
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


								

								
								<td> 
									<a class="avatar-text avatar-md" 
									href="<?php echo base_url(); ?>index.php/Dailytasks/projects/<?php echo $project['id'];?>">
									<i class="feather feather-edit-3 "></i></a></td>
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
</div>
</div>
