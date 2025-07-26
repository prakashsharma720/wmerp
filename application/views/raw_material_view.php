

<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h5><i class="icon fa fa-check"></i><?= $this->lang->line('success') ?> !</h5>
		<?php echo $this->session->flashdata('success'); ?>
	</div>
	<!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
<?php endif; ?>

<?php if ($this->session->flashdata('failed')): ?>
	<div class="alert alert-error alert-dismissible ">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h5><i class="icon fa fa-check"></i> <?= $this->lang->line('alert') ?>!</h5>
		<?php echo $this->session->flashdata('failed'); ?>
	</div>
<?php endif; ?>

<div class="nxl-content">
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('raw_material_master') ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
				</li>
				<!-- <li class="breadcrumb-item"><?= $this->lang->line('leave_history') ?> -->
				</li>
			</ul>
		</div>

		<div class="page-header-right ms-auto">
			<div class="page-header-right-items">

			</div>

			<!-- Mobile Toggle -->
			<div class="d-md-none d-flex align-items-center">
				<a href="javascript:void(0)" class="page-header-right-open-toggle">
					<i class="feather-align-right fs-20"></i>
				</a>
			</div>
		</div>
	</div>
	


  
	      
	      	<div class="card-body p-3">
		      	<div class="row">
		      		<div class="col-md-4">
		      			<?php  //echo $title; exit; ?>
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Raw_material/editPM/<?= $id ?>">
				    			<input type="hidden" name="pm_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Raw_material/add_newPM">
				    			<?php } ?>
				        <div class="form-group">
				        	<?= $this->lang->line('new_material_code') ?> :  <label class="control-label"> <?= $rm_code_view ?></label>
						<div class="row col-md-12">
			          		<label  class="control-label"><?=$this ->lang ->line('name_of_supplier')?> <span class="required">*</span></label>
							<select name="supplier_id" class="form-control select2 suppliers" required="required">
							<option selected><?=$this ->lang ->line('select_supplier')?></option>
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
						                        	<input type="hidden" name="code" value="<?= $rm_code_view ?>" >
						                        <label class="control-label"> <?= $value['category_name'] ?> Name & Code </label>
						                     
						                        <?php endif;   ?>
					                    <?php  endforeach;  ?>
					                <?php else: ?>
					                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
					                <?php endif; ?>
					         </div>
					        <div class="row col-md-12">
					            	<!-- <label class="control-label"> Name</label>  -->
					                <input type="text"  placeholder="<?=$this ->lang ->line('enter_name')?>" name="name" class="form-control" value="<?= $name?>" required autofocus>
					        </div>
						  <!--  	<div class="row col-md-12">
				        		<div class="col-md-12 col-sm-12 ">
								<label class="control-label"> Code</label>
						                <input type="text"  placeholder="Enter Code" name="code" class="form-control" value="<?= $code?>" required autofocus>
								</div>
							</div> -->
								<div class="row col-md-12">
									<label class="control-label"><?=$this ->lang ->line('classification')?></label>
						            	<select name="grade_id" class="form-control select2 grades" required="required">
											<option value=""><?=$this ->lang ->line('select_classification')?></option>
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
														<option value=""><?=$this ->lang ->line('no_result')?></option>
													<?php endif; ?>
											   
										</select>
										
								</div>

					        <div class="row col-md-12">
					            	<label class="control-label"> <?=$this ->lang ->line('grade')?></label>
								<input type="text"  placeholder="<?=$this ->lang ->line('enter_grade_name')?>" name="grade_name" class="form-control" value="<?= $grade_name?>" required autofocus>
					        </div>
					        <div class="row col-md-12">
					        	<label class="control-label"> <?=$this ->lang ->line('select_unit')?></label>
						         <select name="unit_name" class="form-control select2" required="required">
					        		 <option value=""><?=$this ->lang ->line('select')?></option>
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
						                    <option value=""><?=$this ->lang ->line('no_result')?></option>
						                <?php endif; ?>
						            </select>
						     </div>
							 <div class="row col-md-12">
					            <label class="control-label"><?=$this ->lang ->line('minimum_inventory_qty')?> </label>
								<input type="text"  placeholder="<?= $this->lang->line('enter_minimum_inventory_qty') ?>"name="minimum_inventory_qty" class="form-control" value="<?= $minimum_inventory_qty?>" autofocus>
					        </div>
					        <?php if(!empty($id)) { ?>
					        	
					        <div class="row col-md-12">
					            <label class="control-label"> <?=$this ->lang ->line('opening_stock_qty')?></label>
								<input type="text"  placeholder="<?=$this ->lang ->line('enter_opening_stock_qty')?>" name="opening_stock_qty" class="form-control" value="<?= $opening_stock_qty?>"  autofocus>
					        </div>

								<!--<div class="row col-md-12">
					            	<label class="control-label">Status</label>
					               <select class="form-control" name="flag">
					               		<option value="0"> Active</option>
					               		<option value="1"> De-active</option>
					               </select>
					            </div>-->
				        <?php } ?>
				           <div class="row col-md-12">
					            <label class="control-label" style="visibility: hidden;"> <?=$this ->lang ->line('name')?></label><br>
					            <button type="submit" class="btn btn-primary btn-block"><?=$this ->lang ->line('save')?></button>
					        </div>
				        </div>
				        </form>
					</div>
				 <!-- /form -->
				<div class="col-md-8">
					<h5> <?=$this ->lang ->line('raw_material')?>l</h5>
					<div class="table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th> <?=$this ->lang ->line('sr_no')?>.</th>
								<th style="white-space: nowrap;"><?=$this ->lang ->line('supplier_name')?></th>
								<th> <?=$this ->lang ->line('name')?></th>
							<!--	<th> Code</th>-->
								<th><?=$this ->lang ->line('classification')?></th>
								<th><?=$this ->lang ->line('grade')?> </th>
								<th> <?=$this ->lang ->line('action')?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($raw_materials as $raw_material) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $raw_material['supplier'] ?></td>
								<td><?= $raw_material['name'] ?></td>
					            <td><?= $raw_material['grade'] ?></td>
								<td><?= $raw_material['grade_name'] ?></td>
								<td> <a class="border rounded bg-light shadow-sm text-dark px-1 py-0" style="padding: 2px 3px;" href="<?php echo base_url(); ?>index.php/Raw_material/index/<?php echo $raw_material['id'];?>"><i class="feather feather-edit-3"></i></a></td>
							</tr>
						<?php $i++; } ?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
