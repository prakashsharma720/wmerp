<style>
.control-label {
	margin: 0.7rem
}
</style>
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
	  
<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10"><?= $this->lang->line('leave_module') ?></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('leave_types') ?>
                </li>
            </ul>
        </div>

        <div class="page-header-right ms-auto">
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
                                            class="avatar-text avatar-md" >
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




