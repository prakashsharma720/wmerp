<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
      <?php if($this->session->flashdata('success')): ?>
         <div class="alert alert-success alert-dismissible" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> <?=$this ->lang ->line('success')?>!</h5>
                 <?php echo $this->session->flashdata('success'); ?>
               </div>
          <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
      <?php endif; ?>

      <?php if($this->session->flashdata('failed')): ?>
         <div class="alert alert-error alert-dismissible " >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> <?=$this ->lang ->line('alert')?>!</h5>
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
					                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
					                <?php endif; ?>
					            </div>
					        <div class="row col-md-12">
					            	<!-- <label class="control-label"> Name</label>  -->
					                <input type="text"  placeholder="<?=$this ->lang ->line('enter_name')?>" name="name" class="form-control" value="<?= $name?>" required autofocus>
					        </div>
						   	 <!--<div class="row col-md-12">
				        		<div class="col-md-12 col-sm-12 ">
								<label class="control-label"> Code</label>
						                <input type="text"  placeholder="Enter Code" name="code" class="form-control" value="<?= $code?>" required autofocus>
								</div>
								</div>-->
							<div class="row col-md-12">
								 <label class="control-label"> <?=$this ->lang ->line('type')?></label>
					                
						                <input type="text"  placeholder="<?=$this ->lang ->line('enter_type')?>" name="type" class="form-control" value="<?= $type?>"  autofocus>
								</div>
					        <span class="help-block"></span>
					            <div class="row col-md-12">
					            	<label class="control-label"> <?=$this ->lang ->line('size')?></label>
					                <input type="text"  placeholder="<?=$this ->lang ->line('enter_size')?>" name="bag_size" class="form-control" value="<?= $bag_size?>"  autofocus>
					            </div>
							<div class="row col-md-12">
					            	<label class="control-label"> <?=$this ->lang ->line('minimum_inventory_qty')?></label>
								<input type="text"  placeholder="<?=$this ->lang ->line('enter_minimum_inventory_qty')?>" name="minimum_inventory_qty" class="form-control" value="<?= $minimum_inventory_qty?>"  autofocus>
					            </div>
					        <div class="row col-md-12">
					        	<label class="control-label"><?=$this ->lang ->line('select_unit')?></label>
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

					         <span class="help-block"></span>
					            <div class="row col-md-12">
					            	<label class="control-label"> <?=$this ->lang ->line('description')?></label>
					                <textarea type="text"  placeholder="<?=$this ->lang ->line('enter_description')?>" name="description" class="form-control" value="<?= $description?>"  autofocus><?= $description ?></textarea>
					        </div>
					        <?php if(!empty($id)) { ?>
							<div class="row col-md-12">
					            <label class="control-label"> <?=$this ->lang ->line('opening_stock_qty')?></label>
								<input type="text"  placeholder="<?=$this ->lang ->line('enter_opening_stock_qty')?>" name="opening_stock_qty" class="form-control" value="<?= $opening_stock_qty?>" required autofocus>
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
				<div class="col-md-8">
					<h5> <?=$this ->lang ->line('plant_and_machinery(list)')?></h5>
					<div class="table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th> <?=$this ->lang ->line('sr_no')?>.</th>
								<th> <?=$this ->lang ->line('name')?></th>
								<th> <?=$this ->lang ->line('code')?></th>
								<th> <?=$this ->lang ->line('size')?></th>
								<th> <?=$this ->lang ->line('type')?></th>
								<!--<th> Description</th>-->
								<th> <?=$this ->lang ->line('action')?></th>
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