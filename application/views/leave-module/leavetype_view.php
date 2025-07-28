<style>
.control-label {
	margin: 0.7rem
}
</style>
	  
<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
               <h5> <a href="<?php echo base_url('index.php/Leave/types'); ?>"><?= $this->lang->line('leave_module') ?></a></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('leave_types') ?>
                </li>
            </ul>
        </div>
      <?php $this->load->view('layout/alerts'); ?>

        <div class="page-header-right ms-auto">
			<div class="page-header-right-items">
          <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper hstack">
             <form method="post" action="<?php echo base_url(); ?>index.php/Leave/createXLS">
                            <?php if (!empty($filtered_value)) {
                                foreach ($filtered_value as $key => $value) { ?>
                                    <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"> <?php }
                            } ?>
                            <button type="submit" class="btn btn-icon btn-light-brand"> 
                                    <i class="feather feather-download "></i> 
                            </button>
                        </form> &nbsp;
                        <div>
                           <a href="<?php echo base_url('index.php/Leave/create'); ?>" class="btn btn-icon btn-light-brand">
                                <i class="feather feather-plus"></i>
                                <!-- <span><?= $this->lang->line('apply_for_leave') ?>  -->
                                </span>
                            </a>
                        </div>
        </div>
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
                    <div class="col-lg-6">
<?php  //echo $title; exit; ?>
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leave/editLeavetype/<?= $id ?>">
				    			<input type="hidden" name="category_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leave/add_new_leavetype/">
				    			<?php } ?>
				        <div class="form-group">			        		  	
						      <div class="row col-md-12">
				        		<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label"> <?= $this->lang->line('leave_type') ?></label>
					                <input type="text"  placeholder="<?= $this->lang->line('enter_leave_type') ?> " name="leave_type" class="form-control" value="<?= $leave_type ?>" required autofocus>
					            </div>
								<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label"> <?= $this->lang->line('leave_balance') ?></label>
					                <input type="text"  placeholder="<?= $this->lang->line('enter_leave_balance') ?>" name="leave_balance" class="form-control" value="<?= $leave_balance ?>" required autofocus>
					            </div>
					            <?php 
					             if(!empty($date))
					             { 
					             	$holiday_date = date('d-m-Y',strtotime($date)); 
					             }
					              else { 
					              	$holiday_date = date('d-m-Y');
					              }; 
					             ?>
							<div class="col-md-12 col-sm-12" hidden>
							<label  class="control-label"> Date</label>
							<input type="text" value="<?= $holiday_date ?>" data-date-formate="dd-mm-yyyy" name="holiday_date" class="form-control date-picker" placeholder="dd-mm-yyyy"  autocomplete="off" autocomplete="off">
					</div>
					        </div>
					        <span class="help-block"></span>
					        <?php if(!empty($id)) { ?>
				           <div class="row col-md-12">
				        		<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label"> <?= $this->lang->line('status') ?> </label>
					               <select class="form-control" name="flag">
					               		<option value="0"> <?= $this->lang->line('active') ?> </option>
					               		<option value="1"> <?= $this->lang->line('de_active') ?> </option>
					               </select>
					            </div>
				        	</div>
				        <?php } ?>
				           <div class="row col-md-12">
					            <div class="col-md-12 col-sm-12 ">
					            	<label class="control-label" style="visibility: hidden;"> <?= $this->lang->line('name') ?></label><br>
					            	<button type="submit"  class="btn btn-primary btn-block" > <?= $this->lang->line('submit') ?></button>
					            </div>
					        </div>
				        </div>
				        </form>
					</div>
                        <div class="col-lg-6">
<h5> <?= $this->lang->line('leave_list') ?></h5>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th> <?= $this->lang->line('sr_no') ?></th>
								<th style="width: 90%;"> <?= $this->lang->line('leave_type') ?></th>
								<th >  <?= $this->lang->line('leave_balance') ?></th>
                                <th>  <?= $this->lang->line('action') ?></th>
								
								
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach($types as $category) { ?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $category['leave_type']?></td>
								<td><?= $category['leave_balance']?></td>
								<td> 
 										<a href="<?php echo base_url(); ?>index.php/Leave/types/<?php echo $category['id']; ?>" 
                                            class="btn btn-icon avatar-text avatar-md" >
                                            <i class="feather feather-edit-3 "></i>
                                        </a>								
								</td>
							</tr>
						<?php $i++;} ?>
						</tbody>
						
					</table>                    </div>
                </div>
            </div>
        </div>
    </div>	
</div>




