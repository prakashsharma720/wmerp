<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title pull-left"><?=$this ->lang->line('update_task')?></h3>
        
	      </div> <!-- /.card-body -->
	      	<div class="card-body">
		      	<div class="row">
		      		<div class="col-md-12">
		      	
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Dailytasks/editTask/<?php echo $id;?> ">

				    			<!-- <input type="hidden" name="lead_code" value="<?php echo $lead_code;?>"> -->
				    			
				    		<div class="form-group"> 
					        <div class="row ">
								<!--Project name-->	
								<div class="col-md-4 col-sm-4">
						            	<label class="control-label"></label><?=$this ->lang->line('project')?><span class="required">*</span>
										<?php  
						               		echo form_dropdown('project_id', $projects,$project_id,'required="required"') 
						               ?>
						        </div>
								<!--Project -title-->	
								 <div class="col-md-4">
						            	<label class="control-label"> <?=$this ->lang->line('task_title')?></label><span class="required">*</span>
						                <input type="text"  placeholder="<?=$this ->lang->line('task_title')?>" name="task_title" class="form-control" value="<?php echo $task_name?>" required >
						        </div>
								
								<!--start date-->	
									<div class="col-md-4">
						            	<label class="control-label"><?=$this ->lang->line('start_date')?> </label> <span class="required">*</span>
						                <input type="text" data-date-formate="dd-mm-yyyy" name="start_date"
										 class="form-control date-picker"  placeholder="<?=$this ->lang->line('start_date')?>"  value="<?php echo $start_date?>" required>
			            			</div>
								<!--end date-->	
									<div class="col-md-4 col-sm-4">
						            	<label class="control-label"><?=$this ->lang->line('end_date')?> </label> <span class="required">*</span>
						                <input type="text" data-date-formate="dd-mm-yyyy" name="end_date" class="form-control date-picker" placeholder="<?=$this ->lang->line('end_date')?> " value="<?php echo $end_date?>" required>
			            			</div>

					        	<!--Prioroty-->	
								<?php if(!empty($id)) {
						          $hard ='';
						          $medium ='';
						          $easy ='';
						         
						         

			               if($priority == 'Hard'){
			                  $hard='selected';

			                }else if($priority == 'Medium'){
			                  $medium='selected';

			                }else if($priority == 'Easy'){
			                  $easy='selected';

			                }

						          	?> 
									  <div class="col-md-4  ">
										  <label class="control-label"> <?=$this ->lang->line('priority')?></label>
										 <select class="form-control" name="priority">
												 <option value="Hard" <?= $hard ?>> Hard </option>
												 <option value="Medium" <?= $medium ?>>Medium </option>
												 <option value="Easy" <?= $easy ?>> Easy</option>
												
										 </select>
									  </div>
								 
							  <?php } ?>
									
								



						        <!--Status-->
								<?php if(!empty($id)) {
						          $inprocess ='';
						          $onhold ='';
						          $completd ='';
						         
						         

			               if($status == 'In Process'){
			                  $inprocess='selected';

			                }else if($status == 'On Hold'){
			                  $onhold='selected';

			                }else if($status == 'Completd'){
			                  $completd='selected';

			                }

						          	?> 
									  <div class="col-md-4  ">
										  <label class="control-label"> <?=$this ->lang->line('status')?></label>
										 <select class="form-control" name="status">
												 <option value="In Process" <?= $inprocess ?>> In Process </option>
												 <option value="On Hold" <?= $onhold ?>> On Hold </option>
												 <option value="Completd" <?= $completd ?>> Completd</option>
												
										 </select>
									  </div>
								 
							  <?php } ?>
									</div>
								

			
							<!--assign to-->	
							
							<div class="col-md-4 col-sm-4" >
						            	<label class="control-label"> <?=$this ->lang->line('assign_to')?> </label><span class="required">*</span>
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
					            	<button type="submit" class="btn btn-primary btn-block"><?=$this ->lang->line('update')?></button>
					            </div>
								 	
						    
							</div>
				        </div>
			        </form>
				</div>
			</div>
		</div>
	</div>
</div>
