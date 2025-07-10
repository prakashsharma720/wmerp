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
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Mechanical_items/editPM/<?= $id ?>">
				    			<input type="hidden" name="pm_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Mechanical_items/add_newPM">
				    			<?php } ?>
				        <div class="form-group">
				        	  Item Code :  <label class="control-label"> <?= $mi_code_view ?></label>
				       <input type="hidden" name="code" value="<?= $mi_code_view ?>" > 
				        	<div class="row col-md-12">
					                <?php
					                 if ($categories): ?> 
					                  <?php 
					                    foreach ($categories as $value) : ?>
					                        <?php 
						                        if ($value['id'] == $categories_id): ?>
						                        	<input type="hidden" name="categories_id" value="<?= $value['id'] ?>" >
						                        <label class="control-label"> Mechanical Item Name</label>
						                     
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
						  							<!-- <div class="row col-md-12">
				        		
                                          <label class="control-label">Grade</label>
						            	<select name="grade_id" class="form-control select2 grades" required="required">
											<option value=""> Select Grade</option>
												
													<?php
													 if ($grades): ?> 
													  <?php 
														foreach ($grades as $value) : ?>
															<?php 
																if ($value['id'] == $grade_id): ?>
																	<option value="<?= $value['id'] ?>" selected><?= $value['grade'] ?></option>
																<?php else: ?>
																	<option value="<?= $value['id'] ?>"><?= $value['grade'] ?></option>
																<?php endif;   ?>
														<?php   endforeach;  ?>
													<?php else: ?>
														<option value="">No result</option>
													<?php endif; ?>
											   
										</select>
								</div>
								</div>	--> 
								
					            <div class="row col-md-12">
					            	<label class="control-label"> Size</label>
					                <input type="text"  placeholder="Enter size" name="bag_size" class="form-control" value="<?= $bag_size?>" required autofocus>
					            </div>
							<div class="row col-md-12">
					            	<label class="control-label"> Minimum Inventory Quantity</label>
								<input type="text"  placeholder="Enter Minimum Inventory Quantity" name="minimum_inventory_qty" class="form-control" value="<?= $minimum_inventory_qty?>" required autofocus>

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
					            	<label class="control-label"> Description</label>
					                <textarea type="text"  placeholder="Enter description" name="description" 
									class="form-control" value="<?= $description?>" autofocus><?= $description ?></textarea>
					            </div>
					        <?php if(!empty($id)) { ?>
					        <div class="row col-md-12">
					            <label class="control-label"> Opening Stock Quantity</label>
								<input type="text"  placeholder="Enter Opening Stock Qty" name="opening_stock_qty" class="form-control" value="<?= $opening_stock_qty?>"  autofocus>
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
					<h5> Mechanical Items List</h5>
					<div class="table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th> Sr.No.</th>
								<th> Name</th>
								<th> Size</th>
								<th> Unit </th>
								<th> Description</th>
								<th> Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($mechanical_items as $mechanical_item) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $mechanical_item['name'] ?></td>
								<td><?= $mechanical_item['bag_size'] ?></td>
								<td><?= $mechanical_item['unit_name'] ?></td>
								<td><?= $mechanical_item['description'] ?></td>
								<td> <a class="btn btn-xs btn-info btnEdit" href="<?php echo base_url(); ?>index.php/Mechanical_items/index/<?php echo $mechanical_item['id'];?>"><i class="fa fa-edit"></i></a></td>
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