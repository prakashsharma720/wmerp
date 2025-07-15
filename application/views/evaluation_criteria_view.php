<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php if($this->session->flashdata('success')): ?>
         <div class="alert alert-success alert-dismissible" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> <?=$this ->lang->line('success')?>!</h5>
                 <?php echo $this->session->flashdata('success'); ?>
               </div>
          <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
      <?php endif; ?>

      <?php if($this->session->flashdata('failed')): ?>
         <div class="alert alert-error alert-dismissible " >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> <?=$this ->lang->line('alert')?>!</h5>
                 <?php echo $this->session->flashdata('failed'); ?>
               </div>
      <?php endif; ?>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
        <div class="pull-right ">
			<?php echo validation_errors();?>
		
		</div>
	      </div> <!-- /.card-body -->
	      	<div class="card-body">
		      	<div class="row">
		      		<div class="col-md-6">
		      			<?php  //echo $title; exit; ?>
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Evaluation_criteria/editEC/<?= $id ?>">
				    			<input type="hidden" name="ec_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Evaluation_criteria/add_new_EC">
				    			<?php } ?>
				        <div class="form-group">
				        	<div class="row col-md-12">
			        		  	<?php 
		        						$supplier='';
										$service_provider='';
										$transporter='';
		        						
		        						if(!empty($ec_type)) {
		        							if($ec_type=='Supplier'){
		        								$supplier='checked';
		        							}elseif($ec_type=='Service Provider') {
		        								$service_provider='checked';
		        							}
											elseif($category_type=='Transporter') {
												$transporter='checked';
											}

		        						}else{
		        							$supplier='checked';
		        						}
		        						?>
						        		<div class="col-md-12 col-sm-12 ">
						        		<label class="control-label">  <?=$this ->lang->line('criteria_type')?> </label>
						        			<div class="form-check">
							               		<input class="form-check-input" type="radio" name="ec_type" value="Supplier" <?php echo $supplier; ?>> <?=$this ->lang->line('supplier')?></input>
							               		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

							               		<input class="form-check-input" type="radio" name="ec_type" value="Service Provider" <?php echo $service_provider; ?> > <?=$this ->lang->line('service_provider')?></input>
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

							               		<input class="form-check-input" type="radio" name="ec_type" value="Transporter" <?php echo $transporter; ?> > <?=$this ->lang->line('transporter')?></input>
						            		</div>
						            	</div>
						            </div>
						      <div class="row col-md-12">
				        		<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label"> <?=$this ->lang->line('criteria_name')?></label>
					                <input type="textarea" size="30"  placeholder="<?=$this ->lang->line('enter_criteria_name')?>" name="ec_name" class="form-control" value="<?= $ec_name?>" required autofocus>
					            </div>
					        </div>
					        <span class="help-block"></span>
					        <?php if(!empty($id)) { ?>
				           <div class="row col-md-12">
				        		<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label"><?=$this ->lang->line('status')?></label>
					               <select class="form-control" name="flag">
					               		<option value="0"> <?=$this ->lang->line('active')?></option>
					               		<option value="1"><?=$this ->lang->line('de_active')?></option>
					               </select>
					            </div>
				        	</div>
				        <?php } ?>
				           <div class="row col-md-12">
					            <div class="col-md-12 col-sm-12	 ">
					            	<label class="control-label" style="visibility: hidden;"> <?=$this ->lang->line('name')?></label><br>
					            	<button type="submit" class="btn btn-primary btn-block"><?=$this ->lang->line('save')?></button>
					            </div>
					        </div>
				        </div>
				        </form>
					</div>
				 <!-- /form -->
				<div class="col-md-6">
					<h5> Criteria List</h5>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th> <?=$this ->lang->line('sr_no')?>.</th>
								<th><?=$this ->lang->line('criteria')?></th>
								<th><?=$this ->lang->line('criteria_type')?></th>
								<th> <?=$this ->lang->line('action')?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($evaluation_criteria as $ec) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $ec['ec_name']?></td>
								<td>
									<?= $ec['ec_type']?>
								</td>
								<td> <a class="btn btn-xs btn-info btnEdit" href="<?php echo base_url(); ?>index.php/Evaluation_criteria/index/<?php echo $ec['id'];?>"><i class="fa fa-edit"></i></a></td>
							</tr>
						<?php $i++;} ?>
						</tbody>
						
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
