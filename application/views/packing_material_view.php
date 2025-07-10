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
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Packing_materials/editPM/<?= $id ?>">
				    			<input type="hidden" name="pm_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Packing_materials/add_newPM">
				    			<?php } ?>
				        <div class="form-group">
				        	New Material Code :  <label class="control-label"> <?= $pm_code_view ?></label>
						 <div class="row col-md-12">
			          <label  class="control-label">Name of Supplier <span class="required">*</span></label>
							<select name="supplier_id" class="form-control select2 suppliers" >
							<option selected>Select supplier</option>
							<?php 
						            foreach ($suppliers as $value) : ?>
						                <?php 
											if ($value['id'] == $supplier_id): ?>
						                        <option value="<?= $value['id'] ?>" selected><?= $value['supplier_name'] ?></option>
						                    <?php else: ?>
											
						                        <option value="<?= $value['id'] ?>"><?= $value['supplier_name'] ?></option>
						                    <?php endif;   ?>
						            <?php   endforeach;  ?>
						    </select>
			            	</div>
				        	<div class="row col-md-12">					            	
					                <?php
					                 if ($categories): ?> 
					                  <?php 
					                    foreach ($categories as $value) : ?>
					                        <?php 
						                        if ($value['id'] == $categories_id): ?>
						                        	<input type="hidden" name="categories_id" value="<?= $value['id'] ?>" >
						                        	<input type="hidden" name="code" value="<?= $pm_code_view ?>" >
						                        <label class="control-label"> <?= $value['category_name'] ?> Name</label>
						                     
						                        <?php endif;   ?>
					                    <?php  endforeach;  ?>
					                <?php else: ?>
					                    <option value="0">No result</option>
					                <?php endif; ?>
					            </div>
					        <div class="row col-md-12">
					            <!-- <label class="control-label"> Name</label>  -->
					            <input type="text"  placeholder="Enter name" name="name" class="form-control" value="<?= $name?>" required autofocus>
					        </div>
						    <!-- <div class="row col-md-12">
				            	<label class="control-label"> Code <span class="required">*</span></label>
				                <input type="text"  name="pm_code" class="form-control" value="<?= $pm_code_view?>"  autofocus readonly="readonly">
				                <input type="hidden" name="code" value="<?php echo $pm_code;?>" required>
						     </div> -->
					        <div class="row col-md-12">
					            <label class="control-label"> Bag Packing</label>
					            <input type="text"  placeholder="Enter bag packing" name="bag_packing" class="form-control" value="<?= $bag_packing?>"  autofocus>
					        </div>
				            <div class="row col-md-12">
				            	<label class="control-label"> Bag Size</label>
				                <input type="text"  placeholder="Enter bag size" name="bag_size" class="form-control" value="<?= $bag_size?>"  autofocus>
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

							<div class="row col-md-12">
					            <label class="control-label"> Minimum Inventory Quantity</label>
								<input type="text"  placeholder="Enter Minimum Inventory Quantity" name="minimum_inventory_qty" class="form-control" value="<?= $minimum_inventory_qty?>"  autofocus>
					        </div>
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
					<h5> Packing Material List</h5>
					<div class="table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th> Sr.No.</th>
								<th>Supplier Name</th>
								<th> Name</th>
								<th style="white-space: nowrap;"> Bag Packing</th>
								<th> Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($packing_materials as $packing_material) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $packing_material['supplier']?></td>
								<td><?= $packing_material['name']  ?></td>
								<td><?= $packing_material['bag_packing']?></td>
								<td> <a class="btn btn-xs btn-info btnEdit" href="<?php echo base_url(); ?>index.php/Packing_materials/index/<?php echo $packing_material['id'];?>"><i class="fa fa-edit"></i></a></td>
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