<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
	.select2{
		height:45px !important;
		width: 100% !important;
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
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
       		<div class="button-group float-right">
		      
	      </div>
	    </div> 
		<!-- /.card-body -->
      	<div class="card-body">
      		<div class="row">
      			<div class="col-md-3">
      				<span>
      					<img src="<?php echo base_url().$result['photo']; ?>" class="img-circle " alt="User Image" style="width: 100%;height: 100%;">
      				</span>
      			</div>
	      		<div class="col-md-9 table-responsive">
				        <table class="table">
				        	<tr>
								<th>  Name </th>
								<td> <?= $result['name'] ?></td>
								<th> Designation </th>
								<td> <?= $result['role'] ?></td>
							</tr>	
							<tr>
								<th> Email </th>
								<td> <?= $result['email'] ?></td>
								<th> Mobile </th>
								<td> <?= $result['mobile_no'] ?></td>
							</tr>	
							<tr>
								<th> Username </th>
								<td> <?= $result['username'] ?></td>
								<th> Address </th>
								<td> <?= $result['address'] ?></td>
							</tr>
							<tr>
								<td colspan="4">
									<a  href="<?php echo base_url(); ?>index.php/Employees/edit/<?php echo $result['id'];?>" class="btn btn-success" data-toggle="tooltip" title="Edit Profile"><i class="fa fa-edit"> </i> Edit Profile</a>
								</td>
								
							</tr>					        					        	
				        </table>
				</div>
			</div>
		</div>
	</div>
</div>

