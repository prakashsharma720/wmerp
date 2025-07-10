<?php
// echo"<pre>";print_r($leads);exit;
date_default_timezone_set("Asia/Kolkata");
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page=current_url();
//$current_page='https://www.muskowl.com/chaudhary_minerals/index.php/Meenus/UserRights';
$data=explode('?', $current_page);
get_instance()->load->helper('MY_array');
?>
<style type="text/css">
  .col-md-6{
    float: left;
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
      <span class="card-title"><?php  echo $title; ?>
      </span>
	  <!-- <div class="pull-right" style="margin-left:20px;">
         <a class="btn btn-xs btn-danger " href="<?php echo base_url(); ?>uploads/Lead_SCV_import__MO_ERP_-_Sheet1_(2)18.xlsx">
          <i class="fa fa-plus"></i> Download Csv Format</a>
      </div> -->
       <!-- <div class="pull-right">
         <a class="btn btn-xs btn-primary " href="<?php echo base_url(); ?>index.php/Leads_marketing/add">
          <i class="fa fa-plus"></i> Create New Lead</a>
      </div> -->
    </div> <!-- /.card-body -->
    <div class="card-body">
      
        <form action="<?php echo base_url(); ?>index.php/Leads/importdata" enctype="multipart/form-data" method="post" role="form">
        <div class="row">
          <!-- <div class="col-md-12">
              <div class="col-md-6">
                  <label class="control-label"> Upload File</label><span class="required"> (Only Excel/CSV File Import. in given format)</span>
                  <input type="file" name="uploadFile" value="" required="required" />
              </div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-success" name="submit" value="submit">Upload Excel/CSV File Here</button>
              </div>
          </div>   -->
        </div>
      </form>

      <hr>

	  <!-- <form method="get">
				<div class="row" id="filter_hide">
					<div class="col-md-4 col-sm-4 ">
						<label  class="control-label">Search By Services</label>
						<select name="category_name" class="form-control select2 suppliers" >
								<option value=""> Select Services</option>
								<?php
											if ($categories): ?> 
											<?php 
												foreach ($categories as $value) : ?>
													<?php 
															if ($value['category_name'] == @$filtered_value['category_name']): ?>
																	<option value="<?= $value['category_name'] ?>" selected><?= $value['category_name'] ?></option>
															<?php else: ?>
																	<option value="<?= $value['category_name'] ?>"><?= $value['category_name'] ?></option>
															<?php endif;   ?>
																<?php   endforeach;  ?>
										<?php else: ?>
												<option value="">No result</option>
										<?php endif; ?>
						</select>
					</div>
					<div class="col-md-4 col-sm-4 ">
							<label  class="control-label">Search By Id </label>
							<select name="lead_code" class="form-control select2 " >
								<option value="">Select Lead Id</option>
									<?php
										if ($leads): ?> 
										<?php 
											foreach ($leads as $value) : ?>
													<?php 
														if ($value['lead_code'] == @$filtered_value['lead_code']): ?>
																<option value="<?= $value['lead_code'] ?>" selected><?= $value['lead_code'] ?></option>
														<?php else: ?>
																<option value="<?= $value['lead_code'] ?>"><?= $value['lead_code'] ?></option>
														<?php endif;   ?>
											<?php   endforeach;  ?>
									<?php else: ?>
											<option value="">No result</option>
									<?php endif; ?>
							</select>
					</div>

					<div class="col-md-4 col-sm-4">
						<label  class="control-label">Search By Status </label>
						<select name="lead_status" class="form-control select2" >
							<option value="">Select Status</option>
							<option value="Pending" > Pending </option>
							<option value="Approved" > Approved </option>
							<option value="In Process" > In Process</option>
							<option value="Converted" > Converted</option>
							<option value="Rejected" > Rejected</option>
							<option value="Hot Lead" > Hot Lead</option>
							<option value="Cold Lead" > Cold Lead</option>
						</select>
					</div>
					<div class="col-md-4 col-sm-4 ">
               
			   <label  class="control-label">Search By Employee </label>
			   <select name="employee_id" class="form-control select2 " >
                     <option value="">Select employee</option>
                        <?php
                         if ($employees): ?> 
                          <?php 
                            foreach ($employees as $value) : ?>
                                <?php 
                                  if ($value['id'] == $filtered_value['employee_id']): ?>
                                      <option value="<?= $value['id'] ?>" selected>
                                        <?= $value['name'] ?>
                                      </option>
                                  <?php else: ?>
                                      <option value="<?= $value['id'] ?>">
                                        <?= $value['name'] ?>
                                      </option>
                                  <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">No result</option>
                        <?php endif; ?>
                    </select>
				  </div>

						<?php if(!empty($filtered_value['from_date'])) 
							{ 
								$date = date('d-m-Y',strtotime($filtered_value['from_date'])); 
							}
							else{ 
								$date = date('d-m-Y',strtotime('-7 day')); 
							}
						?>

					<div class="col-md-4 col-sm-4">
							<label  class="control-label"> From Date</label>
							<input type="text" value="<?php if(!empty($filtered_value['from_date'])) { echo date('d-m-Y',strtotime($filtered_value['from_date']));} ?>" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" placeholder="dd-mm-yyyy"  autocomplete="off" autocomplete="off">
					</div>
					<div class="col-md-4 col-sm-4">
							<label  class="control-label"> Upto Date</label>
							<input type="text" value="<?php if(!empty($filtered_value['from_date'])) { echo date('d-m-Y',strtotime($filtered_value['upto_date']));} ?>" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" placeholder="dd-mm-yyyy"  autocomplete="off" autocomplete="off">
					</div>
					<div class="col-md-1 col-sm-1">
								<label  class="control-label" style="visibility: hidden;"> Grade</label>
								<input type="submit" class="btn btn-xs btn-primary" value="Search" />
					</div>
					<div class="col-md-1 col-sm-1">
								<label  class="control-label" style="visibility: hidden;"> Grade</label>
								<a href="<?php echo $data[0]?>" class="btn btn-danger" > Reset</a>
					</div>
				</div>
      </form> -->
				
      <hr style="border-top:4px solid rgba(0,0,0,.1)">

      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
						<tr>
								<th > Sr.No.</th>
								<!-- <th > Duplicate Lead</th> -->
								<th> Status</th>
								<th> Code</th>
								<th> Date</th>
								<th> Services</th>
								<th> Title</th>
								<th style="white-space: nowrap;"> Contact Person</th>
								<th> Mobile</th>
								<th> Email</th>
								<th> Assign To</th>
								
								<th> Assign by</th>
								
								
								
								
							</tr>
          </thead>
		
          <tbody> <?php if(!empty($leads)) { $i=1;foreach($leads as $obj) { ?>
              <tr>
                <td> <?= $i ?> </td>
				<!-- <td>
					<?php  
						if($obj['is_duplicate']== 0){
							echo "-";
						}
						else if($obj['is_duplicate']== 1){
							echo "<p style='color:red';>Seems Like  Duplicate </p>";
						}
					?>
				</td> -->
					
                <?php 
									if($obj['lead_status'] == 'Pending'){
										$btn_class='btn-pending';

									}else if($obj['lead_status'] == 'Approved'){
										$btn_class='btn-approved';

									}else if($obj['lead_status'] == 'In Process'){
										$btn_class='btn-inprocess';

									}else if($obj['lead_status'] == 'Converted'){
										$btn_class='btn-converted';

									}else if($obj['lead_status'] == 'Rejected'){
										$btn_class='btn-rejected';
										
										
									}
									else if($obj['lead_status'] == 'Approve but no action'){
										$btn_class='btn-converted';
									}
                ?>

                <td>
									<button class="btn btn-sm <?php echo $btn_class; ?>"style="pointer-events: none;">
										<?php
										if($obj['lead_status'] == 'Approved'){?>
										<span <?php echo $btn_class; ?>>Converted</span>
										<?php  } else if($obj['lead_status'] == 'Rejected') { ?>
											<span <?php echo $btn_class; ?>>Declined</span>
											<?php }
											else if($obj['lead_status']=='In Process'){?>
												<span <?php echo $btn_class; ?>>Inprocess</span>
											<?php }
											else {
												echo $obj['lead_status'];
												?>

												<?php }?>
									</button>
								</td>

                <td><?= $obj['lead_code']?></td>

                <td style="white-space: nowrap;">
									<?= date('d-M-Y',strtotime($obj['date']))?>
								</td>

                <td><?= $obj['category_name']?></td>

                <td style="max-width:250px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?= $obj['lead_title']?> </td>
                <td><?= $obj['contact_person']?></td>
                <td><a href="tel:<?= $obj['mobile']?>"><?= $obj['mobile']?></a></td>
                <td><a href="mailto:<?= $obj['email']?>"><?= $obj['email']?></a></td>
				<td> <?= $obj['person_name']?></td>
				<td> <?= $obj['assign_name']?></td>
				
				

                <!-- <td >  -->
				
                  <!-- <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Leads_marketing/add/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a> -->
                  <!-- <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i> </a> -->
                  <!-- <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Leads_marketing/followups/<?php echo $obj['id'];?>"  title=" Lead Followup"><i class="fa fa-comment"></i></a> -->
				  <!-- <a class="btn btn-xs btn-warning btnEdit"  data-toggle="modal" data-target="#reminder<?php echo $obj['id'];?>"  title=" Reminder Alert"><i class="fa fa-bell"></i></a> -->
				  <!-- <a class="btn btn-xs btn-primary btnEdit" data-toggle="modal" data-target="#assign<?php echo $obj['id'];?>" title="Assign Lead"><i style="color:#fff;"class="fa fa-user"></i> </a> -->
								
								<!-- </td> -->

 								<!-- Delete Modal -->
								<div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
									<div class="modal-dialog">
										<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads_marketing/deleteItem/<?php echo $obj['id'];?>">
										<div class="modal-content">
											<div class="modal-header">
													<h4 class="modal-title"> Delete Lead </h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>                           
											</div>
											<div class="modal-body">
												<p>Are you sure, you want to delete Lead <b><?php echo $obj['lead_code'];?> </b>? </p>
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary delete_submit"> Yes </button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"> No </button>
											</div>
										</div>
										</form>
									</div>
								</div>
								<!-- Delete Modal -->
 								<!-- Assign Modal -->
								<div class="modal fade" id="assign<?php echo $obj['id'];?>" role="dialog">
									<div class="modal-dialog">
									
										<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads_marketing/assignto/<?php echo $obj['id'];?>">
										
										<input type="hidden" name="lead_id" value="<?=  $obj['id']?>">
									
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title"> Assign Lead </h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>                           
											</div>
											<div class="modal-body">
											<div class="col-md-8 col-sm-8 ">
														
														<label  class="control-label">Search By Employee </label>
														<select name="employee_id" class="form-control select2 " >
															<option value="">Select employee</option>
																<?php
																if ($employees): ?> 
																<?php 
																	foreach ($employees as $value) : ?>
																		<?php 
																		if ($value['id'] == $filtered_value['employee_id']): ?>
																			<option value="<?= $value['id'] ?>" selected>
																				<?= $value['name'] ?>
																			</option>
																		<?php else: ?>
																			<option value="<?= $value['id'] ?>">
																				<?= $value['name'] ?>
																			</option>
																		<?php endif; ?>
																	<?php endforeach; ?>
																<?php else: ?>
																	<option value="">No result</option>
																<?php endif; ?>
															</select>
															</div>
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary"> Submit </button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button>
											</div>
										</div>
										</form>
									</div>
								</div>
								 <!-- Assign Modal -->
								 	<!-- Reminder Modal -->
							<div class="modal fade" id="reminder<?php echo $obj['id'];?>" role="dialog">
									<div class="modal-dialog">
									
										<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads_marketing/reminder/<?php echo $obj['id'];?>">
										
									<input type="hidden" name="lead_id" value="<?= $obj["id"]?>">
									
										<div class="modal-content">
											<div class="modal-header">  
												<h4 class="modal-title"> Set Reminder </h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>                           
											</div>
											<div class="row col-md-12">
											<div class="col-md-12">
												<label class="control-label">Reminder Title </label><span class="required">*</span>
												
												
												<input type="text" class="form-control reminder" name="reminder_title"  required="required" value="">
											</div>
																	
											<div class="col-md-6">
												<label class="control-label">Select Date </label> <span class="required">*</span>
												<input type="date" class="form-control reminder" id="gatepass_date" name="reminder_date" value="">
												<!-- <input type="date" class="form-control reminder" id="reminder_date" name="reminder_date" required="required"> -->
											</div>
											<div class="col-md-6">
												<label class="control-label"> Time</label><span class="required">*</span>
												
												<input type="time" id="reminder_time" name="reminder_time" min="10`:00" max="18:00" class="form-control" required="required">
											</div>

											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary"> Submit </button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button>
											</div>
										</div>
										
										</form>
										
									</div>
								</div>
								 <!-- Reminder Modal -->		
                    
              </tr>
            <?php  $i++;} }else{ ?>
              <tr>
                <td colspan="100"> <h5 style="text-align: center;"> No Leads Found</h5></td>
              </tr>
           <?php  }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$("#filter_hide").hide();
	
		$(document).ready(function () {

		$(".content").hide();
		$(".show_hide").on("click", function () {
			var txt = $(".content").is(':visible') ? 'Read More' : 'Read Less';
			$(".show_hide").text(txt);
			$(this).next('.content').slideToggle(200);
		});

		$(".filter_show").on("click", function () {
			$("#filter_hide").show();
		});

	});
</script>
