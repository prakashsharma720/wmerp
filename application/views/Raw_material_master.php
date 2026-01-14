<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
        <div class="pull-right ">
			<?php echo validation_errors();?>
			
			<?php if($this->session->flashdata('success')): ?>
			    <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span>
			<?php endif; ?>

			<?php if($this->session->flashdata('failed')): ?>
			    <span class="error_mesg"><?php echo $this->session->flashdata('failed'); ?></span>
			<?php endif; ?>
		</div>
	      </div> <!-- /.card-body -->
	      	<div class="card-body">
		      	<div class="row">
		      		<div class="col-md-12">
		      			<?php  //echo $title; exit; ?>
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Raw_material/editrm/<?= $id ?>">
				    			<input type="hidden" name="old_item_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Raw_material/add_new_rm">
				    			<?php } ?>
				        <div class="form-group">
				        	
					        <span class="help-block"></span>
					        <div class="row col-md-12">
					        	 <div class="col-md-6">
						            	<label class="control-label"> <?= $this->lang->line('name') ?></label>
						                <input type="text"  placeholder="<?= $this->lang->line('enter_raw_material_name') ?>" name="rm_name" class="form-control" value="<?= $rm_name?>" required autofocus>
						        </div>
						        <div class="col-md-6">
						            <label class="control-label"> <?= $this->lang->line('grade') ?></label>
					                	<?php  $grades = array(
					            		 'No' => 'Select Option',
						                  'Food' => 'Food (F)',
						                  'NonFood' => 'Non-Food (NF)'
						                  );
					            		echo form_dropdown('grade', $grades,$grade)
					            		?>
						        </div>
						        
						     </div>
					        <span class="help-block"></span>
					         <div class="row col-md-12">
					        	 <div class="col-md-6">
						            	<label class="control-label"> <?= $this->lang->line('code') ?></label>
						                <input type="text"  placeholder="<?= $this->lang->line('enter_code') ?>" name="code" class="form-control" value="<?= $code?>" required autofocus>
						        </div>
						        <div class="col-md-6">
						            	<label class="control-label"> <?= $this->lang->line('unit') ?></label>
						                <input type="text"  placeholder="<?= $this->lang->line('enter_unit') ?>" name="unit" class="form-control" value="<?= $unit?>" required autofocus>
						        </div>
						     </div>
					       <span class="help-block"></span>
				        	<br>
				           <div class="row col-md-6">
					            	<label class="control-label" style="visibility: hidden;"> <?= $this->lang->line('name') ?></label><br>
					            	<button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('save') ?></button>
					            </div>
				        </div>
			        </form>
				</div>
			</div>
		</div>
	</div>
</div>

