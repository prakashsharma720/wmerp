<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
      <div class="nxl-content">
  <div class="page-header d-flex justify-content-between align-items-center">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('general_plant_chemical_master') ?></h5>
      </div>
      <ul class="breadcrumb d-flex align-items-center mb-0 ms-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>
        <li class="breadcrumb-item"> <?= $this->lang->line('') ?></li>
      </ul>
    </div>

    <!-- Add New Button -->
    <div class="page-header-right d-flex align-items-center gap-2">
      <?php $this->load->view('layout/alerts'); ?>
      

      <!-- Mobile Toggle -->
      <div class="d-md-none d-flex align-items-center">
        <a href="javascript:void(0)" class="page-header-right-open-toggle">
          <i class="feather-align-right fs-20"></i>
        </a>
      </div>
    </div>
  </div>
  
   <div class="main-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="card stretch stretch-full">
	      	<div class="card-body">
		      	<div class="row">
		      		<div class="col-md-4">
		      			<?php  //echo $title; exit; ?>
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/General_plant_chemicals/editPM/<?= $id ?>">
				    			<input type="hidden" name="pm_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/General_plant_chemicals/add_newPM">
				    			<?php } ?>
				        <div class="form-group">
<strong style="border: 1px solid #ccc; padding:8px">
				        	 <?= $this->lang->line('new_item_code'); ?>:  <label class="control-label"> <?= $bm_code_view ?></label></strong>
				       <input type="hidden" name="code" value="<?= $bm_code_view ?>" > 
				        	<div class="row col-md-12 mt-2">
					                <?php
					                 if ($categories): ?> 
					                  <?php 
					                    foreach ($categories as $value) : ?>
					                        <?php 
						                        if ($value['id'] == $categories_id): ?>
						                        	<input type="hidden" name="categories_id" value="<?= $value['id'] ?>" >
						                        <label class="control-label"> <?= $this->lang->line('general_plant_equipments_chemicals'); ?> <?=$this ->lang ->line('name')?></label>
						                     
						                        <?php endif;   ?>
					                    <?php  endforeach;  ?>
					                <?php else: ?>
					                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
					                <?php endif; ?>
					            </div>
					        <div class="row col-md-12 mt-2">
					            	<!-- <label class="control-label"> Name</label>  -->
					                <input type="text"  placeholder="<?=$this ->lang ->line('enter_name')?>" name="name" class="form-control" value="<?= $name?>" required autofocus>
					            </div>
					 
							<div class="row col-md-12 mt-2">
					            <label class="control-label"> <?=$this ->lang ->line('company_name')?></label>
								<input type="text"  placeholder="<?=$this ->lang ->line('enter_company_name')?>" name="company_name" 
								class="form-control" value="<?= $company_name?>"  autofocus>

					        </div> 
							<div class="row col-md-12 mt-2">
								  <label class="control-label"> <?=$this ->lang ->line('minimum_inventory_qty')?></label>
								<input type="text"  placeholder="<?=$this ->lang ->line('enter_minimum_inventory_qty')?>" 

								name="minimum_inventory_qty" class="form-control" value="<?= $minimum_inventory_qty?>" required autofocus>

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
					                <textarea type="text"  placeholder="<?=$this ->lang ->line('enter_description')?>" name="description" 
									class="form-control" value="<?= $description?>"  autofocus><?= $description ?></textarea>
					            </div>
					        <?php if(!empty($id)) { ?>

					        <div class="row col-md-12 mt-2">
					            <label class="control-label"> <?=$this ->lang->line('opening_stock_qty')?></label>
								<input type="text"  placeholder="<?=$this ->lang->line('enter_opening_stock_qty')?>" name="opening_stock_qty" class="form-control" value="<?= $opening_stock_qty?>"  autofocus>
					        </div>

				           <div class="row col-md-12 mt-2">
				        		
					            	<label class="control-label"> <?=$this ->lang ->line('status')?></label>
					               <select class="form-control" name="flag">
					               		<option value="0">  <?=$this ->lang ->line('active')?></option>
					               		<option value="1"> <?=$this ->lang ->line('de_active')?></option>
					               </select>
					            </div>
				        <?php } ?>
				           <div class="row col-md-12 mt-2">
					            
					            	<label class="control-label" style="visibility: hidden;">  <?=$this ->lang ->line('name')?></label><br>
					            	<button type="submit" class="btn btn-primary btn-block">  <?=$this ->lang ->line('save')?></button>
					        </div>
				        </div>
				        </form>
					</div>
				 <!-- /form -->
				<div class="col-md-8">
					<h5>  <?=$this ->lang ->line('green_plant_chemicals_list')?></h5>
						<div class="main-content ">
    <div class="card card-primary card-outline">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped" id="proposalList">
                <thead>
                  <tr>
								<th>  <?=$this ->lang ->line('sr_no')?>.</th>
								<th>  <?=$this ->lang ->line('name')?></th>
								<th>  <?=$this ->lang ->line('company_name')?></th>
								<th>  <?=$this ->lang ->line('description')?></th>
								<th>  <?=$this ->lang ->line('action')?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($general_plant_chemicals as $general_plant_chemical) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $general_plant_chemical['name'] ?></td>
								
								<td><?= $general_plant_chemical['company_name'] ?></td>
								<td><?= $general_plant_chemical['description'] ?></td>
								<td> <a class="btn btn-icon avatar-text avatar-md" href="<?php echo base_url(); ?>index.php/General_plant_chemicals/index/<?php echo $general_plant_chemical['id'];?>"><i class="feather feather-edit-3"></i></a></td>
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