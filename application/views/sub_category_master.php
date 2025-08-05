

<div class="nxl-content">
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('sub_category_master') ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
				</li>
				<li class="breadcrumb-item"><?= $this->lang->line('sub_category_master') ?>
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
		      		<div class="col-md-6">
		      			<?php  //echo $title; exit; ?>
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Sub_category/editsub_category/<?= $id ?>">
				    			<input type="hidden" name="sub_category_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Sub_category/add_new_sub_category">
				    			<?php } ?>
				        <div class="form-group">
						<div class="row col-md-12 mt-2">
							<div class="col-md-8 col-sm-8 ">
								<label class="control-label"> <?=$this ->lang ->line('category')?></label>
								<select name="categories_id" class="form-control select2 " >
										<?php
					                 if ($categories): ?> 
					                  <?php 
					                    foreach ($categories as $value) : ?>
					                        <?php 
												if ($value['id'] == $categories_id): ?>
						                            <option value="<?= $value['id'] ?>" selected><?= $value['category_name'] ?></option>
						                        <?php else: ?>
						                            <option value="<?= $value['id'] ?>"><?= $value['category_name'] ?></option>
						                        <?php endif;   ?>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
					                <?php endif; ?>
					            </select>
								</div>
					        </div>
					        <span class="help-block"></span>
				        	<div class="row col-md-12 mt-2">
				        		<div class="col-md-8 col-sm-8 ">
					            	<label class="control-label"><?=$this ->lang ->line('sub_category_name')?></label>
					                <input type="text"  placeholder="<?=$this ->lang ->line('enter_sub_category_name')?>" name="sub_category_name" class="form-control" value="<?= $sub_category_name?>" required autofocus>
					            </div>
					        </div>
							
					        <?php if(!empty($id)) { ?>
				           <div class="row col-md-12 mt-2">
				        		<div class="col-md-8 col-sm-8 ">
					            	<label class="control-label"><?=$this ->lang ->line('status')?></label>
					               <select class="form-control" name="flag">
					               		<option value="0"><?=$this ->lang ->line('active')?></option>
					               		<option value="1"> <?=$this ->lang ->line('de-active')?></option>
					               </select>
					            </div>
				        	</div>
				        <?php } ?>
				           <div class="row col-md-12 mt-2">
					            <div class="col-md-8 col-sm-8 ">
					            	<label class="control-label" style="visibility: hidden;"> <?=$this ->lang ->line('name')?></label><br>
					            	<button type="submit" class="btn btn-primary btn-block"><?=$this ->lang ->line('save')?></button>
					            </div>
					        </div>
				        </div>
				        </form>
					</div>
				 <!-- /form -->
				
				<div class="col-md-6">
				<h5><?= $this->lang->line('sub_category_list') ?></h5>
				<div class="dataTables_wrapper dt-bootstrap5 no-footer shadow-sm p-3 mt-3 rounded" style="background-color: #fff;">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped dataTable no-footer align-middle" id="proposalList" aria-describedby="proposalList_info">
							<thead class="table-light">
								<tr>
									<th><?= $this->lang->line('sr_no') ?>.</th>
									<th><?= $this->lang->line('sub_category') ?></th>
									<th><?= $this->lang->line('action') ?></th>
								</tr>
							</thead>
							<tbody>
						
							<?php $i=1;foreach($sub_categories as $sub_category) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $sub_category['sub_category_name']?></td>
								<td> <a class="border rounded bg-light shadow-sm text-dark px-1 py-0" href="<?php echo base_url(); ?>index.php/Sub_category/index/<?php echo $sub_category['id'];?>"><i class="feather feather-edit-3"></i></a></td>
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
