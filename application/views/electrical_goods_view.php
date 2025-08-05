
<style>
    .table td, .table th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }
</style>
<div class="nxl-content">
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('electrical_goods') ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
				</li>
				<li class="breadcrumb-item"><?= $this->lang->line('electrical_goods_master') ?>
				</li>
			</ul>
		</div>

		<div class="page-header-right ms-auto">
			<div class="page-header-right-items">
<?php $this->load->view('layout/alerts'); ?>
			</div>

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
		      		<div class="col-md-4">
		      			<?php  //echo $title; exit; ?>
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Electrical_goods/editPM/<?= $id ?>">
				    			<input type="hidden" name="pm_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Electrical_goods/add_newPM">
				    			<?php } ?>
				        <div class="form-group">
				      <?=$this ->lang ->line('item_code')?>    :  <label class="control-label"> <?= $service_code_view ?></label>
				        	<div class="row col-md-12 mt-2">
					                <?php
					                 if ($categories): ?> 
					                  <?php 
					                    foreach ($categories as $value) : ?>
					                        <?php 
						                        if ($value['id'] == $categories_id): ?>
						                        	<input type="hidden" name="categories_id" value="<?= $value['id'] ?>" >

						                        	<input type="hidden" name="code" value="<?= $service_code_view ?>" >

						                        <label class="control-label"><?=$this ->lang ->line('electrical_goods')?> <?=$this ->lang ->line('name')?></label>
						                     
						                        <?php endif;   ?>
					                    <?php  endforeach;  ?>
					                <?php else: ?>
					                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
					                <?php endif; ?>
					            </div>
					        <div class="row col-md-12 mt-2 ">
				        		
					            	<!-- <label class="control-label"> Name</label>  -->
					                <input type="text"  placeholder="<?=$this ->lang ->line('enter_name')?>" name="name" class="form-control" value="<?= $name?>" required autofocus>
					            </div>
						   	 <!--<div class="row col-md-12">
				        		
								<label class="control-label"> Code</label>
						                <input type="text"  placeholder="Enter Code" name="code" class="form-control" value="<?= $code?>" required autofocus>
								</div>
								</div>-->
								<!--<div class="row col-md-12">
				        		
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
								</div>-->
									 <div class="row col-md-12 mt-2">
				        		
								 <label class="control-label"> <?=$this ->lang ->line('company_name')?></label>
						                <input type="text"  placeholder="<?=$this ->lang ->line('enter_company_name')?>" name="company_name" class="form-control" value="<?= $company_name ?>" required autofocus>
								</div>
								<div class="row col-md-12 mt-2">
				        		
					            	<label class="control-label"> <?=$this ->lang ->line('minimum_inventory_qty')?></label>
								<input type="text"
								  placeholder="<?=$this ->lang ->line('enter_minimum_inventory_qty')?>" name="minimum_inventory_qty" class="form-control" value="<?= $minimum_inventory_qty?>" required autofocus>

					        </div>
					         <div class="row col-md-12 mt-2">
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
					         
					            <div class="row col-md-12 mt-2">
					            	<label class="control-label"> <?=$this ->lang ->line('description')?></label>
					                <textarea type="text"  placeholder="<?=$this ->lang ->line('enter_description')?>" name="description" class="form-control" 
									value="<?= $description?>"  autofocus><?= $description ?></textarea>
					        </div>
					        <?php if(!empty($id)) { ?>
					        <div class="row col-md-12 mt-2">
					            <label class="control-label"> <?=$this ->lang ->line('opening_stock_qty')?></label>
								<input type="text"  placeholder="<?=$this ->lang ->line('enter_opening_stock_qty')?>" name="opening_stock_qty" class="form-control" value="<?= $opening_stock_qty?>" required autofocus>
					        </div>

				           <div class="row col-md-12 mt-2">
					            	<label class="control-label"><?=$this ->lang ->line('status')?></label>
					               <select class="form-control" name="flag">
					               		<option value="0"> <?=$this ->lang ->line('active')?></option>
					               		<option value="1"> <?=$this ->lang ->line('de_active')?></option>
					               </select>
				        	</div>
				        <?php } ?>
				           <div class="row col-md-12 mt-2">
					            
					            	<label class="control-label" style="visibility: hidden;"> <?=$this ->lang ->line('name')?></label><br>
					            	<button type="submit" class="btn btn-primary btn-block"><?=$this ->lang ->line('save')?></button>
					            </div>
					        </div>
				        </form>
					</div>
				 <!-- /form -->
				<div class="col-md-8">
					<h5> <?=$this ->lang ->line('electrical_goods')?></h5>
					
						<div class="dataTables_wrapper dt-bootstrap5 no-footer shadow-sm p-3 mt-3 rounded" style="background-color: #fff;">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped dataTable no-footer align-middle" id="proposalList" aria-describedby="proposalList_info">
							<thead class="table-light">
							<tr>
								<th> <?=$this ->lang ->line('sr_no')?></th>
								<th> <?=$this ->lang ->line('name')?></th>
								
								<th> <?=$this ->lang ->line('code')?></th>
								<th> <?=$this ->lang ->line('company_name')?></th>
								
								<th> <?=$this ->lang ->line('description')?></th>
								<th> <?=$this ->lang ->line('action')?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($electrical_goods as $electrical_good) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $electrical_good['name'] ?></td>
								<td><?= $electrical_good['code'] ?></td>
								<td><?= $electrical_good['company_name'] ?></td>
								<td><?= $electrical_good['description'] ?></td>
								<td> <a class="btn btn-icon avatar-text avatar-md" href="<?php echo base_url(); ?>index.php/Electrical_goods/index/<?php echo $electrical_good['id'];?>"><i class="feather feather-edit-3"></i></a></td>
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
