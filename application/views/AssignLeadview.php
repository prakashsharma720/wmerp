<?php
	// echo print_r($leads['assign_to']);
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
				<span class="card-title"><?php  echo $title; ?></span>
				<div class="pull-right" style="margin-right:5px;">
				<?php if($role_id!=='3') {?>
				<a class="btn btn-sm btn-success btnEdit bulk_assign" data-toggle="modal" data-target="#bulk_assign" title="Assign Lead"><span style="color:white;font-weight:600;">Assign Lead</span> <i class="fa fa-arrow-right"></i></a>
					<!-- Assign Modal -->
						<div class="modal fade" id="bulk_assign" role="dialog">
							<div class="modal-dialog">
							
								<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads/assignto">
							
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title"> Assign Lead </h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>                           
									</div>
									<div class="modal-body">
									<div class="col-md-8 col-sm-8 ">
												<input type="hidden" class="all_selected_ids" name="all_selected_ids" value="">
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
					<?php }?>
					<!-- Assign Modal -->
				</div>
			</div>

				<!-- <hr> -->
				<hr style="border-top:4px solid rgba(0,0,0,.1)">
				<div class="table-responsive">
				<table id="example1" class="table table-bordered table-striped">
				<thead>
								<tr>
								<th><input type="checkbox" id="master"></th>
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
										<th> Assign By</th>
										<th > Action</th>
									</tr>
				</thead>
				
				<tbody> <?php if(!empty($leads)) { $i=1;foreach($leads as $obj) { 
					
					?>
					<tr>
						<?php 	if($obj['assign_to'] == '0'){?>
					<td><input type="checkbox" class="sub_chk"  name="sub_chk[]" value="<?php echo $obj['id']; ?>" /></td>
					<?php }else {?>
						<td> # </td>
						<?php }?>
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
						if($obj['assign_to'] !='0'){?>
							<td>
							<button class="btn btn-sm " style="pointer-events: none;">
							<span class="btn   btn-sm  btn-warning">Assigned</span>
							</button>
							</td>
						<?php } else{?>
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
						<?php } ?>
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
						<!-- <td><?= $obj['lead_source']?></td> -->

						<td > 
						<a class="btn btn-xs btn-warning btnEdit"  data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"  title=" view details"><i class="fa fa-eye"></i></a>
						
							
										</td>
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
											<label class="control-label"> Assign to : </label>
											<span><?= $obj['person_name']?></span>
										</div>                                                                
										
										<div class="col-md-12">
											<label class="control-label"> Contact Person : </label>
											<span><?= $obj['contact_person']?></span>
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
												<label class="control-label"> country	 : </label>
												<span>  <?= $obj['country']?></span>
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
  
    jQuery('.bulk_assign').on('click', function(e) { 
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
      WRN_PROFILE_DELETE = "Are you sure you want to assign  selected records?";  
      var check = confirm(WRN_PROFILE_DELETE);  
      if(check == true){  
        var join_selected_values = allVals.join(","); 
      
        $(".all_selected_ids").val(join_selected_values);
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
    }  
  });


	});
</script> 
