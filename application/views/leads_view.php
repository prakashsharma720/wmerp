<?php
// echo "<pre>";print_r($leads_id);exit;
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page=current_url();
//$current_page='https://www.muskowl.com/chaudhary_minerals/index.php/Meenus/UserRights';
$data=explode('?', $current_page);
// echo "<pre>";print_r($leads);exit;
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
	  
	
		
	  <div class="pull-right" style="margin-left:20px;">
         <a class="btn btn-xs btn-danger " href="<?php echo base_url(); ?>uploads/Lead_SCV_import__MO_ERP.xlsx">
          <i class="fa fa-plus"></i> Download Csv Format</a>
      </div>
       <div class="pull-right">
         <a class="btn btn-xs btn-primary " href="<?php echo base_url(); ?>index.php/Leads/add">
          <i class="fa fa-plus"></i> Create New Lead</a>
      </div>
	  <!-- <div class="pull-right" style="margin-right:10px;">
	  <a class="btn btn-xs btn-danger btnEdit delete_submit" data-toggle="modal" data-target="#delete"  title="Assign Lead"><i style="color:#fff;"class="fa fa-trash"></i> </a> -->
			<!-- Delete Modal -->
								<!-- <div class="modal fade" id="delete" role="dialog">
									<div class="modal-dialog">
										<form class="form-horizontal" role="form" id="delete_form" method="post" action="<?php echo base_url(); ?>index.php/Leads/deleteItem">
										<div class="modal-content">
											<div class="modal-header">
													<h4 class="modal-title"> Delete Lead </h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>                           
											</div>
											<div class="modal-body">
											<input type="hidden" class="all_selected_ids" name="all_selected_ids" value="">
												<p>Are you sure, you want to delete Lead ? </p>
											</div>
											<div class="modal-footer"> -->
												<!-- <a href="#" class="btn btn-primary delete_submit" >Yes</a> -->
												<!-- <button type="submit" class="btn btn-primary delete_submit"> Yes </button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"> No </button>
											</div>
										</div>
										</form>
									</div>
								</div>  -->
								<!-- Delete Modal -->
								<!-- Assign Modal -->
	  <!-- </div> -->
    <!-- </div>  -->
	<!-- /.card-body -->
    <div class="card-body">
      
        <form action="<?php echo base_url(); ?>index.php/Leads/importdata" enctype="multipart/form-data" method="post" role="form">
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-6">
                  <label class="control-label"> Upload File</label><span class="required"> (Only Excel/CSV File Import. in given format)</span>
                  <input type="file" name="uploadFile" value="" required="required" />
              </div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-success" name="submit" value="submit">Upload Excel/CSV File Here</button>
            </div>

          </div> 
		
        </div>
		
      </form>

      <hr>

      <form method="get">
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
      </form>
	  <hr style="border-top:4px solid rgba(0,0,0,.1)">
	  <form method="get" action="<?php echo base_url(); ?>index.php/Leads/approveall">
    <div class="col-md-6" style="margin-left:-1%; ">
          <div class="col-md-4 col-sm-3">
            <label  class="control-label">Lead Actions </label>
				<select id="selectestimateid"  style="margin-left:-1px;  width: 206% !important;" name="approveaction"  class="form-control">
					<option  class="white" value="">Select Action</option>
					<option  class="white" value="Approved">Approve</option>
					<option  class="white" value="Rejected">Rejected</option>
					<option  class="white" value="delete_all">Delete</option>
				
            </select>
			</div>
            <div class="col-md-3 col-sm-3" style="margin-top:-55px;margin-left:60%;">
            <button type="submit" class="btn transparent_button bulk_action" style="font-size: 0.8125rem;">
							<b>Apply</b>
            </button>
			</div>
    </div>
				
     

      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
						<tr>
						<th><input type="checkbox" id="master"></th>

								<th > Sr.No.</th>
								<th > Duplicate Lead</th>
								<th> Status</th>
								<th> Code</th>
								<th> Date</th>
								<th> Services</th>
								<th> Title</th>
								<th style="white-space: nowrap;"> Client Name</th>
								
								<th> Mobile</th>
								<th> Email</th>
								<th > Action</th>
							</tr>
          </thead>
          <tbody> <?php 
		
		
		  if(!empty($leads)) { $i=1;foreach($leads as $obj) {
			
			?>
		 
              <tr>
			  <td><input type="checkbox" class="sub_chk"  name="sub_chk[]" value="<?php echo $obj['id']; ?>" /></td>
                <td> <?= $i ?> </td>
				<td>
					<?php 
						

						if($obj['is_duplicate']== 0){ ?>
							-
						<?php }
						else if($obj['is_duplicate']== 1){
							// print_r($leads_id);

							 ?>
							<p style='color:red';>Seems Like  Duplicate  as</p>
							<a href="<?php echo base_url(); ?>index.php/Leads/view/<?php echo $obj['duplicate_lead_code'];?>"><?php echo  $obj['duplicate_lead_code']?></a>
						<?php }?>
				
					
				</td>

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
                ?>

                <td>
									<button class="btn btn-sm <?php echo $btn_class; ?>"style="pointer-events: none;">
										<?= $obj['lead_status']?>
									</button>
								</td>

                <td>
					
				<?= $obj['lead_code']?></td>

                <td style="white-space: nowrap;">
									<?= date('d-M-Y',strtotime($obj['date']))?>
								</td>

                <td><?= $obj['category_name']?></td>

                <td style="max-width:250px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?= $obj['lead_title']?> </td>
                <td><?= $obj['contact_person']?></td>
          
                <td><a href="tel:<?= $obj['mobile']?>"><?= $obj['mobile']?></a></td>
                <td><a href="mailto:<?= $obj['email']?>"><?= $obj['email']?></a></td>
                <!-- <td><?= $obj['lead_source']?></td> -->

                <td > 

				<a class="btn btn-xs btn-warning btnEdit"  data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"  title=" view details"><i class="fa fa-eye"></i></a>
					<?php if($role_id!=='3') {?>
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Leads/add/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a>
                  <!-- <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i> </a> -->
                 
				  <?php }?>					
								</td>

 							
		 							 <div class="modal fade" id="assign<?php echo $obj['id'];?>" role="dialog">
									<div class="modal-dialog">
									
										<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads/assignto/">
										
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

 							

														
 <!-- view details -->	
								 <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
									<div class="modal-dialog">
									
										<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads/reminder/<?php echo $obj['id'];?>">
										
									<input type="hidden" name="lead_id" value="<?= $obj["id"]?>">
									
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title"> View Details </h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>                           
											</div></br>	

																		
											<div class="row col-md-12">
                               
								<div class="col-md-12">
										<label class="control-label"> Status : </label>
										<span>
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
                ?>
				<button class="btn btn-sm <?php echo $btn_class; ?>"style="pointer-events: none;">
										<?= $obj['lead_status']?>
									</button>
										</span>
								</div>
								<div class="col-md-12">
										<label class="control-label"> Code : </label>
								       	<span><?= $obj['lead_code']?></span>
								</div>
                                <div class="col-md-12">
                                      <label class="control-label"> Date: </label>
                                      <span><?= date('d-M-Y',strtotime($obj['date']))?></span>
																</div>
                                <div class="col-md-12">
                                      <label class="control-label"> Services : </label>
									  <?= $obj['category_name']?>															</div>
                                <div class="col-md-12">
                                      <label class="control-label"> Title: </label>
                                      <span><?= $obj['lead_title']?></span>
																</div>
                                
								<div class="col-md-12">
                                      <label class="control-label"> Contact Person : </label>
                                      <span><?= $obj['contact_person']?></span>
								</div>	
								
								<div class="col-md-12">
										<label class="control-label"> country	 : </label>
										<span>  <?= $obj['country']?></span>
								</div>	
								<div class="col-md-12">
                                      <label class="control-label"> Mobile: </label>
                                      <span> <?= $obj['mobile']?></span>
										</div>
								<div class="col-md-12">
										<label class="control-label"> Email : </label>
										<span> <?= $obj['email']?> </span>
								</div>		
								<div class="col-md-12">
										<label class="control-label"> Lead Source : </label>
										<span>  <?= $obj['lead_source']?></span>
								</div>		
									
								<div class="col-md-12">
										<label class="control-label"> Description: </label>
										<span>  <?= $obj['work_description']?> </span>
								</div>			
															</br>
                              
											<div class="modal-footer">
												<!-- <button type="submit" class="btn btn-primary"> Submit </button> -->
												<button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button>
											</div>
										</div>
										
										</form>
										
									</div>
								</div>
                    
              </tr>
            <?php  $i++;} }else{ ?>
              <tr>
                <td colspan="100"> <h5 style="text-align: center;"> No Leads Found</h5></td>
              </tr>
           <?php  }?>
          </tbody>
        </table>
			</form>
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
<script language="javascript">
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0');
var yyyy = today.getFullYear();

today = yyyy + '-' + mm + '-' + dd;
$this.closest('#gatepass_date').attr('min',today);
</script>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		var base_url='<?php echo base_url() ;?>';
		//alert(base_url);
		$(document).on('change','.category',function(){
				var category_id = $('.category').find('option:selected').val();
				//var aa= base_url+"index.php/Meenus/rolewisedata/"+role_id;
				//alert(category_id);
				$.ajax({
	                type: "POST",
	                url:"<?php echo base_url('index.php/Suppliers/getSupplierByCategory/') ?>"+category_id,
	                //data: {id:role_id},
	                dataType: 'html',
	                success: function (response) {
	                	//alert(response);
	                    $(".suppliers").html(response);
	                    $('.select2').select2();
	                }
            	});
			}); 

     jQuery('#master').on('click', function(e) {
    if($(this).is(':checked',true))  
    {
      $(".sub_chk").prop('checked', true);  
    }  
    else  
    {  
      $(".sub_chk").prop('checked',false);  
    }  
  });
  
    jQuery('.bulk_action').on('click', function(e) { 
    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
      allVals.push($(this).val());
    });  
    //alert(allVals.length); return false;  
    if(allVals.length <=0)  
    {  
      alert("Please select row.");  
	  return false;
    }  
    // else {  
    //   WRN_PROFILE_DELETE = "Are you sure you want to assign  selected records?";  
    //   var check = confirm(WRN_PROFILE_DELETE);  
    //   if(check == true){  
    //     var join_selected_values = allVals.join(","); 
      
    //     $(".all_selected_ids").val(join_selected_values);
        // $.ajax({   
        //   type: "POST",  
        //   url: "<?php echo base_url(); ?>index.php/Leads/assignto",  
        //   cache:false,  
        //   data: 'ids='+join_selected_values,  
        //   success: function(response)  
        //   {   
        //     $(".successs_mesg").html(response);
        //     location.reload();
        //   }   
        // });
           
      }  
    
  );


	});
	 jQuery('#delete').on('click', function(e) { 
    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
      allVals.push($(this).val());
    });  
    //alert(allVals.length); return false;  
    if(allVals.length <=0)  
    {  
      alert("Please select row.");  
	  return false;
    }  
    else {  
      WRN_PROFILE_DELETE = "Are you sure you want to delete  selected records?";  
      var check = confirm(WRN_PROFILE_DELETE);  
      if(check == true){  
        var join_selected_values = allVals.join(","); 
      
        $(".all_selected_ids").val(join_selected_values);
        // $.ajax({   
        //   type: "POST",  
        //   url: "<?php echo base_url(); ?>index.php/Leads/deleteItem",  
        //   cache:false,  
        //   data: 'ids='+join_selected_values,  
        //   success: function(response)  
        //   {   
        //     $(".successs_mesg").html(response);
        //     location.reload();
        //   }   
        // });
           
      }  }
	});
</script> 
