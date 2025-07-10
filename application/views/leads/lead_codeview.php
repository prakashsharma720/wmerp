<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title pull-left"><?= $page_title ?></h3>
        <div class="pull-right ">
        	<label> Lead Unique Code : </label><b style="color:#37b5fe;"> <?= $Sourcedetails['lead_code']?></b>

		</div>
	      </div> <!-- /.card-body -->
	      	<div class="card-body">
		      	<div class="row">
		      		<div class="col-md-12">
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads/edititem/<?= $id ?>">
				    			<input type="hidden" name="old_lead_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads/add_new_item">
				    			<?php } ?>

				    			<!-- <input type="hidden" name="lead_code" value="<?php echo $lead_code;?>"> -->
				    			<?php 
				    			if(!empty($generation_date)) 
				    			{ 
				    				$date= date('d-m-Y',strtotime($generation_date)); 
				    			} else
				    			{ 
				    				 $date=date('d-m-Y');
				    			} ;?>
							
					        <div class="row col-md-12">
											<div class="col-md-4 col-sm-4">
						            	<label class="control-label">Lead Generation Date </label> : 
										<?= $Sourcedetails['date']?>
			            			</div>
									
					        	<div class="col-md-4 category_name">
					            	<label class="control-label"> Services</label> :
									<?= $Sourcedetails['category_name']?>
						        </div>
					        	 <div class="col-md-4">
						            	<label class="control-label">Lead Title</label> :
						                <?= $Sourcedetails['lead_title']?>
						        </div>
						         <div class="col-md-4">
						            	<label class="control-label"> Contact Person Name </label> :
										<?= $Sourcedetails['contact_person']?>
						        </div>
								<div class="col-md-4">
						            	<label class="control-label"> Country Code</label> :
										<?= $Sourcedetails['country']?>
						        </div>
								
						         <div class="col-md-4">
						        		<label class="control-label"> Mobile No </label> :
										<?= $Sourcedetails['mobile']?>
			                </div>
							<div class="col-md-4">
						        		<label class="control-label">  City </label> :
										<?= $Sourcedetails['city']?>
			                </div>
							<div class="col-md-4">
						            	<label class="control-label"> Lead Status </label> :
										<?= $Sourcedetails['lead_status']?>
						        </div>
			                <div class="col-md-4">
						            	<label class="control-label"> Email </label> :
						                <?= $Sourcedetails['email']?>
						        	</div>
						        	 <div class="col-md-4">
						            	<label class="control-label"> Lead Source </label> :
										<?= $Sourcedetails['lead_source']?>
						        	</div>
						        	
						        <div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> Description/Remark</label> :
										<?= $Sourcedetails['work_description']?>
						         </div>
								
						          <?php if(!empty($id)) {
						          $pending ='';
						          $approved ='';
						          $inprocess ='';
						          $converted ='';
						          $rejected ='';
						          if($lead_status == 'Approved'){
			                  $pending='selected';

			                }else if($lead_status == 'Approved'){
			                  $approved='selected';

			                }else if($lead_status == 'In Process'){
			                  $inprocess='selected';

			                }else if($lead_status == 'Converted'){
			                  $converted='selected';

			                }
							
							else if($lead_status == 'Rejected'){
			                  $rejected='selected';

			                }

						          	?>
				           <div class="row col-md-12">
				        		<div class="col-md-12 col-sm-12 ">
					            	<label class="control-label">Lead Status</label><span> (Take any action on lead)</span>
					               <select class="form-control" name="lead_status">
								
					               		<option value="Pending" <?= $pending ?>> Pending </option>
											   

					               		<option value="Approved" <?= $approved ?>> Approved </option>
					               		<option value="In Process" <?= $inprocess ?>> In Process</option>
										   
					               		<option value="Converted" <?= $converted ?>> Converted</option>
					               		<option value="Rejected" <?= $rejected ?>> Rejected</option>
											   

					               </select>
					            </div>
				        	</div>
				        <?php } ?>
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
