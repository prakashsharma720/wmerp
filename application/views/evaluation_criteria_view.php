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
						        		<label class="control-label">  Criteria Type </label>
						        			<div class="form-check">
							               		<input class="form-check-input" type="radio" name="ec_type" value="Supplier" <?php echo $supplier; ?>> Supplier</input>
							               		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

							               		<input class="form-check-input" type="radio" name="ec_type" value="Service Provider" <?php echo $service_provider; ?> > Service Provider</input>
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

							               		<input class="form-check-input" type="radio" name="ec_type" value="Transporter" <?php echo $transporter; ?> > Transporter</input>
						            		</div>
						            	</div>
						            </div>
						      <div class="row col-md-12">
				        		<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label"> Criteria Name</label>
					                <input type="textarea" size="30"  placeholder="Enter criteria name" name="ec_name" class="form-control" value="<?= $ec_name?>" required autofocus>
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
					            <div class="col-md-12 col-sm-12	 ">
					            	<label class="control-label" style="visibility: hidden;"> Name</label><br>
					            	<button type="submit" class="btn btn-primary btn-block">Save</button>
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
								<th> Sr.No.</th>
								<th>Criteria</th>
								<th>Criteria Type</th>
								<th> Action</th>
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
