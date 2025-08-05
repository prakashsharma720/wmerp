

<div class="nxl-content">
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('protective_equipments_master') ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
				</li>
				<li class="breadcrumb-item"><?= $this->lang->line('leave_history') ?>
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
	

	      	<div class="card-body p-3 bg-white" style="position: relative; top:15px;left:15px">
		      	<div class="row bg-white">
		      		<div class="col-md-4">
		      			<?php  //echo $title; exit; ?>
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Protective_equipments/editPM/<?= $id ?>">
				    			<input type="hidden" name="pm_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Protective_equipments/add_newPM">
				    			<?php } ?>
				        <div class="form-group">
				       <?=$this ->lang ->line('equipment_code')?> :  <label class="control-label"> <?= $bm_code_view ?></label>
				       <input type="hidden" name="code" value="<?= $bm_code_view ?>" > 
				        	<div class="row col-md-12">
					                <?php
					                 if ($categories): ?> 
					                  <?php 
					                    foreach ($categories as $value) : ?>
					                        <?php 
						                        if ($value['id'] == $categories_id): ?>
						                        	<input type="hidden" name="categories_id" value="<?= $value['id'] ?>" >
						                        <label class="control-label"> <?= $this->lang->line('protective_equipments'); ?><?=$this ->lang ->line('name')?> </label>
						                     
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
						   	
						    	<div class="row col-md-12">
									<label class="control-label"> <?=$this ->lang ->line('minimum_inventory_qty')?></label>
								<input type="text"  placeholder="<?=$this ->lang ->line('enter_minimum_inventory_qty')?>"
					            	 class="form-control" value="<?= $minimum_inventory_qty?>" required autofocus>

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
				        		
					            	<label class="control-label"> <?=$this ->lang ->line('description')?></label>
					                <textarea type="text"  placeholder="<?=$this ->lang ->line('enter_description')?>" name="description"
									class="form-control" value="<?= $description?>"  autofocus><?= $description ?></textarea>
					            </div>
					        <?php if(!empty($id)) { ?>
					        <div class="row col-md-12">
					            <label class="control-label"> <?=$this ->lang ->line('opening_stock_qty')?></label>
								<input type="text"  placeholder="<?=$this ->lang ->line('enter_opening_stock_qty')?>" name="opening_stock_qty" class="form-control" value="<?= $opening_stock_qty?>"  autofocus>
					        </div>
				           <div class="row col-md-12">
				        		
					            	<label class="control-label"><?=$this ->lang ->line('status')?></label>
					               <select class="form-control" name="flag">
					               		<option value="0"> <?=$this ->lang ->line('active')?></option>
					               		<option value="1"> <?=$this ->lang ->line('de_active')?></option>
					               </select>
					            </div>
				        <?php } ?>
				           <div class="row col-md-12">
					            
					            	<label class="control-label" style="visibility: hidden;"> <?=$this ->lang ->line('name')?></label><br>
					            	<button type="submit" class="btn btn-primary btn-block"><?=$this ->lang ->line('save')?></button>
					            </div>
				        </div>
				        </form>
					</div>
				 <!-- /form -->
				<div class="col-md-8 bg-white">
					<h5> <?=$this->lang->line('protective_equipments_list')?></h5>

					<div class="dataTables_wrapper dt-bootstrap5 no-footer shadow-sm p-3 mt-3 rounded" style="background-color: #fff;">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped dataTable no-footer align-middle" id="proposalList" aria-describedby="proposalList_info">
							<thead class="table-light">
							<tr>
								<th> <?=$this ->lang ->line('sr_no')?>.</th>
								<th> <?=$this ->lang ->line('name')?></th>
								<th> <?=$this ->lang ->line('code')?></th>
								<th> <?=$this ->lang ->line('description')?></th>
								<th> <?=$this ->lang ->line('action')?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($protective_equipments as $protective_equipment) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $protective_equipment['name'] ?></td>
								
								<td><?= $protective_equipment['code'] ?></td>
								<td><?= $protective_equipment['description'] ?></td>
								<td> <a class="btn btn-icon avatar-text avatar-md" href="<?php echo base_url(); ?>index.php/Protective_equipments/index/<?php echo $protective_equipment['id'];?>">
									<i class="feather feather-edit-3"></i></a></td>
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