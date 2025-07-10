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
		
		</div>
	      </div> <!-- /.card-body -->
	      	<div class="card-body">
		      	<div class="row">
		      		<div class="col-md-4">
		      			<?php  //echo $title; exit; ?>
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Plant_and_machinery/editPM/<?= $id ?>">
				    			<input type="hidden" name="pm_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Plant_and_machinery/add_newPM">
				    			<?php } ?>
				        <div class="form-group">
				        		New P & M/c  Code :  <label class="control-label"> <?= $pt_code_view ?></label>
				        	<div class="row col-md-12">					            	
					                <?php
					                 if ($categories): ?> 
					                  <?php 
					                    foreach ($categories as $value) : ?>
					                        <?php 
						                        if ($value['id'] == $categories_id): ?>
						                        	<input type="hidden" name="categories_id" value="<?= $value['id'] ?>" >
						                        	<input type="hidden" name="code" value="<?= $pt_code_view ?>" >
						                        <label class="control-label"> <?= $value['category_name'] ?> Name</label>
						                     
						                        <?php endif;   ?>
					                    <?php  endforeach;  ?>
					                <?php else: ?>
					                    <option value="0">No result</option>
					                <?php endif; ?>
					            </div>
					        <div class="row col-md-12">
					            	<!-- <label class="control-label"> Name</label>  -->
					                <input type="text"  placeholder="Enter  name" name="name" class="form-control" value="<?= $name?>" required autofocus>
					        </div>
						   	 <!--<div class="row col-md-12">
				        		<div class="col-md-12 col-sm-12 ">
								<label class="control-label"> Code</label>
						                <input type="text"  placeholder="Enter Code" name="code" class="form-control" value="<?= $code?>" required autofocus>
								</div>
								</div>-->
							<div class="row col-md-12">
								 <label class="control-label"> Type</label>
					                
						                <input type="text"  placeholder="Enter Type" name="type" class="form-control" value="<?= $type?>"  autofocus>
								</div>
					        <span class="help-block"></span>
					            <div class="row col-md-12">
					            	<label class="control-label"> Size</label>
					                <input type="text"  placeholder="Enter size" name="bag_size" class="form-control" value="<?= $bag_size?>"  autofocus>
					            </div>
							<div class="row col-md-12">
					            	<label class="control-label"> Minimum Inventory Quantity</label>
								<input type="text"  placeholder="Enter Minimum Inventory Quantity" name="minimum_inventory_qty" class="form-control" value="<?= $minimum_inventory_qty?>"  autofocus>
					            </div>
					        <div class="row col-md-12">
					        	<label class="control-label"> Select Unit</label>
						        <select name="unit_name" class="form-control select2" required="required">
					        		 <option value="">Select</option>
						                <?php
						                 if ($units): ?> 
						                  <?php 
						                    foreach ($units as $value) : ?>
						                    		<?php 
														if ($value['unit_name'] == $unit_name): ?>
							                            <option value="<?= $value['unit_name'] ?>" selected ><?= $value['unit_name'] ?></option>
							                           <?php else: ?>
							                             <option value="<?= $value['unit_name'] ?>"><?= $value['unit_name'] ?></option>
							                             <?php endif;   ?>
						                    <?php   endforeach;  ?>
						                <?php else: ?>
						                    <option value="">No result</option>
						                <?php endif; ?>
						            </select>
						     </div>

					         <span class="help-block"></span>
					            <div class="row col-md-12">
					            	<label class="control-label"> Description</label>
					                <textarea type="text"  placeholder="Enter description" name="description" class="form-control" value="<?= $description?>"  autofocus><?= $description ?></textarea>
					        </div>
					        <?php if(!empty($id)) { ?>
							<div class="row col-md-12">
					            <label class="control-label"> Opening Stock Quantity</label>
								<input type="text"  placeholder="Enter Opening Stock Qty" name="opening_stock_qty" class="form-control" value="<?= $opening_stock_qty?>" required autofocus>
					        </div>

				           <div class="row col-md-12">
					            	<label class="control-label">Status</label>
					               <select class="form-control" name="flag">
					               		<option value="0"> Active</option>
					               		<option value="1"> De-active</option>
					               </select>
					            </div>
				        <?php } ?>
				           <div class="row col-md-12">
					            	<label class="control-label" style="visibility: hidden;"> Name</label><br>
					            	<button type="submit" class="btn btn-primary btn-block">Save</button>
					        </div>
				        </div>
				        </form>
					</div>
				 <!-- /form -->
				<div class="col-md-8">
					<h5> Plant and Machinery List</h5>
					<div class="table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th> Sr.No.</th>
								<th> Name</th>
								<th> Code</th>
								<th> Size</th>
								<th> Type</th>
								<!--<th> Description</th>-->
								<th> Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($plant_and_machineries as $plant_and_machinery) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $plant_and_machinery['name'] ?></td>
								<td><?= $plant_and_machinery['code'] ?></td>
								<td><?= $plant_and_machinery['bag_size'] ?></td>
								<td><?= $plant_and_machinery['type'] ?></td>
								<!--<td><?= $plant_and_machinery['description'] ?></td>-->
								<td> <a class="btn btn-xs btn-info btnEdit" href="<?php echo base_url(); ?>index.php/Plant_and_machinery/index/<?php echo $plant_and_machinery['id'];?>"><i class="fa fa-edit"></i></a></td>
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