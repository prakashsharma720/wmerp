<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title pull-left"><?= $page_title ?></h3>
        
	      </div> <!-- /.card-body -->
	      	<div class="card-body">
		      	<div class="row">
		      		<div class="col-md-12">
		      	
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Dailytasks/add_new_task">

				    			<!-- <input type="hidden" name="lead_code" value="<?php echo $lead_code;?>"> -->
				    			
				    		<div class="form-group"> 
					        <div class="row ">
								<!--Project name-->	
								<div class="col-md-4 col-sm-4">
						            	<label class="control-label"> Project</label><span class="required">*</span>
										<?php  
						               		echo form_dropdown('project_id', $project_id,'required="required"') 
						               ?>
						        </div>
								<!--Project -title-->	
								 <div class="col-md-4">
						            	<label class="control-label"> Task Ttile</label><span class="required">*</span>
						                <input type="text"  placeholder="Enter Task Title" name="task_title" class="form-control" value="" required >
						        </div>
								
								<!--start date-->	
									<div class="col-md-4">
						            	<label class="control-label">Start Date </label> <span class="required">*</span>
						                <input type="text" data-date-formate="dd-mm-yyyy" name="start_date"
										 class="form-control date-picker"  placeholder="dd-mm-yyyy"  required>
			            			</div>
								<!--end date-->	
									<div class="col-md-4 col-sm-4">
						            	<label class="control-label">End Date </label> <span class="required">*</span>
						                <input type="text" data-date-formate="dd-mm-yyyy" name="end_date" class="form-control date-picker" placeholder="dd-mm-yyyy"  required>
			            			</div>

					        	<!--Prioroty-->	
								<div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> priority <span class="required">*</span></label>
								</br>
						               <select class="form-control " name="priority" required="required" tabindex="-1" aria-hidden="true">
							<option value="" selected="selected">Select priority...</option>
							<option value="hard">Hard</option>
							<option value="medium">Medium</option>
							<option value="easy">Easy</option>
							</select>
 
						            </div>



						        <!--Status-->
								<div class="col-md-4 col-sm-4">
						<label class="control-label"> Status </label>
						</br>
						<select name="task_status" class="form-control " tabindex="-1" aria-hidden="true">
							<option value="">Status</option>
							
							<option value="In Process"> In Process</option>
							<option value="In Process">On Hold</option>
							
							<option value="Completed"> Completed</option>
							
						</select>
						 		</div>
			
							<!--assign to-->	
							<div class="col-md-4 col-sm-4" >
						            	<label class="control-label"> Assign To</label><span class="required">*</span>
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
					            	<label class="control-label" style="visibility: hidden;"> Name</label><br>
					            	<button type="submit" class="btn btn-primary btn-block">Create</button>
					            </div>
								 	
						    
							</div>
				        </div>
			        </form>
				</div>
			</div>
		</div>
	</div>
</div>
