
<style>
    .control-label {
margin: 0.7rem
}
</style>

	  
<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
               <h5> <a href="<?php echo base_url('index.php/Dailytasks/projects'); ?>"><?= $this->lang->line('daily_tasks') ?></a></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('create_task') ?>
                </li>
            </ul>
        </div>
      <?php $this->load->view('layout/alerts'); ?>

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
                    <div class="col-lg-12">
	<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Dailytasks/add_new_task">

				    			<!-- <input type="hidden" name="lead_code" value="<?php echo $lead_code;?>"> -->
				    			
				    		<div class="form-group"> 
					        <div class="row ">
								<!--Project name-->	
								<div class="col-md-4 col-sm-4">
						            	<label class="control-label"><?=$this ->lang->line('project')?></label><span class="required">*</span>
										<?php  
						               		echo form_dropdown('project_id', $project_id,'required="required"') 
						               ?>
						        </div>
								<!--Project -title-->	
								 <div class="col-md-4">
						            	<label class="control-label"><?=$this ->lang->line('task_title')?></label><span class="required">*</span>
						                <input type="text"  placeholder="<?=$this ->lang->line('task_title')?>" name="task_title" class="form-control" value="" required >
						        </div>
								
								<!--start date-->	
									<div class="col-md-4">
						            	<label class="control-label"><?=$this ->lang->line('start_date')?> </label> <span class="required">*</span>
						                <input type="date" data-date-formate="dd-mm-yyyy" name="start_date"
										 class="form-control date-picker"  placeholder="<?= $this->lang->line('dd_mm_yyyy') ?>"  required>
			            			</div>
								<!--end date-->	
									<div class="col-md-4 col-sm-4">
						            	<label class="control-label"><?=$this ->lang->line('end_date')?></label> <span class="required">*</span>
						                <input type="date" data-date-formate="dd-mm-yyyy" name="end_date" class="form-control date-picker" placeholder="<?= $this->lang->line('dd_mm_yyyy') ?>"  required>
			            			</div>

					        	<!--Prioroty-->	
								<div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"><?=$this ->lang->line('priority')?> <span class="required">*</span></label>
								</br>
						               <select class="form-control " name="priority" required="required" tabindex="-1" aria-hidden="true">
							<option value="" selected="selected"><?=$this ->lang->line('priority')?></option>
							<option value="hard"><?=$this ->lang->line('hard')?></option>
							<option value="medium"><?=$this ->lang->line('medium')?></option>
							<option value="easy"><?=$this ->lang->line('easy')?></option>
							</select>
 
						            </div>



						        <!--Status-->
								<div class="col-md-4 col-sm-4">
						<label class="control-label"> <?=$this ->lang->line('status')?> </label>
						</br>
						<select name="task_status" class="form-control " tabindex="-1" aria-hidden="true">
							<option value=""><?=$this ->lang->line('status')?></option>
							
							<option value="In Process"> <?=$this ->lang->line('in_process')?></option>
							<option value="In Process"><?=$this ->lang->line('on_hold')?></option>
							
							<option value="Completed"> <?=$this ->lang->line('completed')?></option>
							
						</select>
						 		</div>
			
							<!--assign to-->	
							<div class="col-md-4 col-sm-4" >
						            	<label class="control-label"> <?=$this ->lang->line('assign_to')?></label><span class="required">*</span>
										<?php  
						               		if($designation_id=='4') {
												echo form_dropdown('assignto', $assignto, $Assign_to,'required="required"'); 
										 }
										 else if($designation_id=='8'){
											 echo form_dropdown('assigntoemp', $assignto, $assigntoemp,'required="required"'); 
										 }
										 else{
											 echo form_dropdown('assignto', $assignto, $Assign_to,'required="required"'); 
										 }
						               ?>
						        </div>	
								<!--assign by-->	
										
								
								<div class="row col-md-12">
					            	<label class="control-label" style="visibility: hidden;"><?=$this ->lang->line('name')?></label><br>
					            	<button type="submit" class="btn btn-primary btn-block"><?=$this ->lang->line('create')?></button>
					            </div>
								 	
						    
							</div>
				        </div>
			        </form>                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


