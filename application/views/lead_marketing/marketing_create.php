<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title pull-left"><?= $page_title ?></h3>
		<!-- <?= $target?> -->
        <div class="pull-right ">
        	<label> Lead Unique Code : </label>
			<b style="color:#37b5fe;"> 
				<?= $lead_code?>
			</b>
		</div>
	      </div> <!-- /.card-body -->
	      	<div class="card-body">
		      	<div class="row">
		      		<div class="col-md-12">
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads_marketing/changestatus/<?= $id ?>">
				    			<input type="hidden" name="old_lead_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads_marketing/add_new_item">
				    			<?php } ?>

				    			<input type="hidden" name="lead_code" value="<?php echo $lead_code;?>">
									<?php 
										if(!empty($generation_date)) 
										{ 
											$date= date('d-m-Y',strtotime($generation_date)); 
										} else
										{ 
											$date=date('d-m-Y');
										} ;
									?>
					        	<div class="row col-md-12">
									<div class="col-md-4 col-sm-4">
						            <label class="control-label">Lead Generation Date </label> <span class="required">*</span>
						            <input  type="date"   data-date-formate="d-m-Y" name="generation_date" id="generation_date" class="form-control">
			            		</div>

					        	<div class="col-md-4 category_name">
					            	<label class="control-label"> Services</label> <span class="required">*</span>
									<?php echo form_dropdown('category_name', $categories, 'required="required"'); ?>
						        </div>
					        	 <div class="col-md-4">
						            	<label class="control-label"> Title</label><span class="required">*</span>
						                <input type="text"  placeholder="Enter Title" name="title" class="form-control" required >
						        </div>
						         <div class="col-md-4">
						            	<label class="control-label"> Contact Person Name <span class="required">*</span></label>
						                <input type="text"  placeholder="Enter Person Name" name="contact_person" class="form-control" required >
						        </div>
								
								
<!-- 								
									<div class="col-md-2 col-sm-2 ">
									<label class="control-label"> Country</label> <span class="required">*</span>
										
									</div> -->
									<div class="col-md-3 col-sm-2 ">
										<label class="control-label"> Mobile No <span class="required">*</span></label>
						               	<input type="text" placeholder="Enter mobile" name="mobile" class="form-control mobile" minlenght="10" maxlength="10" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   value="" required autofocus>
						        </div>

								<div class="col-md-3">
						            	<label class="control-label"> City <span class="required">*</span></label>
						                <input type="text"  placeholder="Enter city" name="city" class="form-control" required >
						        </div>
								<div class="col-md-4">
									<label class="control-label"> Email </label>
									<input type="text"  placeholder="Enter Email" name="email" class="form-control">
								</div>
									<div class="col-md-4">
									<label class="control-label"> Lead Source </label> <span class="required">*</span>
									<input type="text"  placeholder="Enter Source Name" name="lead_source" class="form-control" required >
								</div>
								
						        <div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> Description/Remark</label>
						               <textarea class="form-control description" rows="3" placeholder="Enter Description/Remark" name="description"> </textarea>
						         </div>
						         	<?php if(!empty($id)) {
										$pending ='';
										$approved ='';
										$inprocess ='';
										$converted ='';
										$rejected ='';
										if($lead_status == 'Pending'){
											$pending='selected';
										}else if($lead_status == 'Approved'){
											$approved='selected';
										}else if($lead_status == 'In Process'){
											$inprocess='selected';
										}else if($lead_status == 'Converted'){
											$converted='selected';
										}else if($lead_status == 'Rejected'){
											$rejected='selected';
										}
						          	?>
				           <div class="row col-md-12">
				        		<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label">Lead Status</label><span> (Take any action on lead)</span>
					               <select class="form-control" name="lead_status">
					               		<!-- <option value="Pending" <?= $pending ?>> Pending </option> -->
					               		<option value="Approved" <?= $approved ?>> Converted </option>
					               		<option value="In Process" <?= $inprocess ?>> In Progress</option>
					               		<!-- <option value="Converted" <?= $converted ?>> Converted</option> -->
					               		<option value="Rejected" <?= $rejected ?>> Declined</option>
					               </select>
					            </div>
				        	</div>
				        <?php } ?>
						      </div>

					        <span class="help-block"></span>
				           <div class="row col-md-12">
					            	<label class="control-label" style="visibility: hidden;"> Name</label><br>
					            	<button type="submit" class="btn btn-primary btn-block">Save</button>
					            </div>
				        </div>
			        </form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {

		// $( ".date-picker" ).datepicker({ minDate: 0});

		var base_url='<?php echo base_url() ;?>';
		//alert(base_url);
		$(document).on('change','.category_id',function(){
				var category_id = $('.category_id').find('option:selected').val();
				//var aa= base_url+"index.php/Meenus/rolewisedata/"+role_id;
				//alert(category_id);
				$.ajax({
	                type: "POST",
	                url:"<?php echo base_url('index.php/Grades/getGradeByCategory/') ?>"+category_id,
	                //data: {id:role_id},
	                dataType: 'html',
	                success: function (response) {
	                	//alert(response);
	                    $(".grades").html(response);
	                    $('.select2').select2();
	                }
            	});
			}); 
	});
</script> 
<script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#generation_date').attr('min',today);
		</script>
