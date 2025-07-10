<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"> <?= $title ?></h3>
        <div class="pull-right error_msg">
			<?php echo validation_errors();?>

			<?php if (isset($message_display)) {
			echo $message_display;
			} ?>		
		</div>

      </div> <!-- /.card-body -->
      <div class="card-body">
      	<?php //echo $id; ?>
		    		<?php if(!empty($id)) { ?>
			    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Service_providers/editService_provider/<?= $id?>">
			    			<?php echo form_hidden('id',$id);  ?>	
			    			<?php } else { ?>
						<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Service_providers/add_new_service_provider">
			    	<?php } ?>

		    	

		        <div class="form-group">
		        	<div class="row col-md-12">
					<div class="col-md-4 col-sm-4 drop">
			            	<label class="control-label"> Category</label>
			            	<select name="categories_id" class="form-control select2 " required>
					                <?php
					                 if ($categories): ?> 
					                  <?php 
					                    foreach ($categories as $value) : ?>
					                        <?php 
												if ($value['id'] == $current[0]->categories_id): ?>
						                            <option value="<?= $value['id'] ?>" selected><?= $value['category_name'] ?></option>
						                        <?php else: ?>
						                            <option value="<?= $value['id'] ?>"><?= $value['category_name'] ?></option>
						                        <?php endif;   ?>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="0">No result</option>
					                <?php endif; ?>
					            </select>
			            	<!-- <?php  
			            		$old_values=explode(',', $current[0]->products);
			               		echo form_multiselect('products[]', $categories,$old_values) 
			               ?> -->
			            </div>
							<div class="col-md-4 col-sm-4 ">
				        		<label class="control-label"> Service Provider Type </label>
				        			<div class="form-check">
					               		<input class="form-check-input service_provider_type" type="radio" name="service_provider_type" value="New"  > New</input>
					               		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					               		<input class="form-check-input service_provider_type" type="radio" name="service_provider_type" value="Existing"  checked> Existing </input>
			            		</div>
			            	</div>
							 <div class="col-md-4 col-sm-4 category_of_approval">
			            	<label  class="control-label" > Category of Approval</label>
			            	<?php  $app_cat = array(
			            		 'No' => 'Select Option',
				                  'A' => 'A',
				                  'B' => 'B',
				                  'c' => 'C'
				                  );
			            		echo form_dropdown('category_of_approval', $app_cat )
			            	?>
			            </div>
		        		
					</div>
		        </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
					<div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> Registration Date</label>
			            	  <input type="text" data-date-formate="dd-mm-yyyy" name="reg_date" class="form-control date-picker" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">

			            </div>
						<div class="col-md-4 col-sm-4">
			            	<label class="control-label">Service Provider Name</label>
			                <input type="text" id="firstName" placeholder="Enter name" name="service_provider_name" class="form-control" value="" autofocus>
			            </div>
			            <div class="col-md-4 col-sm-4">
			            	<label  class="control-label">Service Provider Code</label>
			               <input type="text"  name="sp_code" class="form-control" value="<?= $service_provider_code?>"  autofocus readonly="readonly">
						                <input type="hidden" name="service_provider_code" value="<?php echo $sp_code;?>">
			            </div>
			           
			            
		        	</div>
		        </div>
				<div class="form-group">
		        	<div class="row col-md-12">
						<div class="col-md-4 col-sm-4">
			            	<label class="control-label"> Contact Person</label>
							<div class="input-group input-group-lg mb-12">
				                <div class="input-group-prepend">
				                    <select name="prefix"  required="required">
					                <?php
					                 if ($prefix): ?> 
					                  <?php 
					                    foreach ($prefix as $value) : ?>
						                        <option value="<?= $value ?>"><?= $value ?></option>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="0">No result</option>
					                <?php endif; ?>
					            </select>
			                    <input type="text" id="firstName" placeholder="Enter contact person" name="contact_person" class="form-control" value="" autofocus required>
								</div>
							</div>
					   </div>
					<div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> Email</label>
			                <input type="email" id="lastName" placeholder="Enter email" name="email" class="form-control" value=""  autofocus>
			            </div>
		        		<div class="col-md-4 col-sm-4 ">
								<label class="control-label"> Mobile No </label>
								<input type="text" placeholder="Enter mobile" name="mobile_no" class="form-control mobile" minlenght="10" maxlength="10" 
								oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   value="" autofocus>
							</div>
						</div>
				</div>
		         <div class="form-group">
		        	<div class="row col-md-12">
							
			              	<div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> Country</label>
			            	<?php  
			            		echo form_dropdown('country_id', $countries)
			            	?>	

			            </div>
			             <div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> State</label>
			            	<?php  
			            		echo form_dropdown('state_id', $states)
			            	?>

			            </div>
			             <div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> City</label>
			            	<?php  
			            		echo form_dropdown('city_id', $cities)
			            	?>

			            </div>
		        	</div>
		        </div>		
				 <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			        		<label class="control-label"> Service Provider Address</label>
			        		<textarea type="text" placeholder="Enter address" name="address" class="form-control" rows="3" value="" required autofocus style="resize: none;"></textarea>
		        		</div>
		        		 <div class="col-md-4 col-sm-4 ">
			        		<label class="control-label"> GST Registration Status </label>
			        			<div class="form-check">
				               		<input class="form-check-input gst_status" type="radio" name="gst_status" value="Yes" checked> Yes</input>
				               		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				               		<input class="form-check-input gst_status" type="radio" name="gst_status" value="Un-registered Dealer"  > Un-registered Dealer/Person </input>
		            		</div>
		            	</div>
						<div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> Website</label>
			                <input type="text" id="lastName" placeholder="Enter website" name="website" class="form-control" value="" autofocus>
			            </div>
			           
		        	</div>
		        </div>
		        
		      <div class="form-group">
		        	<div class="row col-md-12">
		        	    <div class="col-md-4 col-sm-4">
			            	<b> PAN </b> <span>(Parmanent Account No.) </span>
			                <input type="text" id="lastName" placeholder="Ex. ABCEDE2548K" name="pan_no" class="form-control pan_no" value="" autofocus autocomplete="off"  maxlength="10" minlength="10" >
			            </div>
		        		<div class="col-md-4 col-sm-4 gst_div">
							<b>GSTIN</b><span>( Ex. : 08ABCDE1234K1AZ)</span>
			            	<input type="text"  placeholder="Ex. 08ABCDE12341AZ" name="gst_no" class="form-control gstnumber" value=""autofocus autocomplete="off"   maxlength="15" minlength="15"  >
						</div>
			            <div class="col-md-4 col-sm-4">
			            	<b> TAN </b> <span>(Tax Deduction Account No.) </span>
			                <input type="text" id="firstName" placeholder="Ex. ABCD12345A" name="tds" class="form-control tan_number" value="" autofocus autocomplete="off"   maxlength="10" minlength="10"  >
			            </div>
		        	</div>
		        </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> Bank Name</label>
							<?php
							$bank_nm =array('No' => 'Select Option',
							'Allahabad Bank' => 'Allahabad Bank',      
							'Andhra Bank' => 'Andhra Bank',
							'Axis Bank' => 'Axis Bank',
							'Bank of Baroda - Corporate Banking' => 'Bank of Baroda - Corporate Banking',
							'Bank of Baroda - Retail Banking' => 'Bank of Baroda - Retail Banking',
							'Bank of India' => 'Bank of India',
							'Bank of Maharashtra' => 'Bank of Maharashtra',
							'Canara Bank' => 'Canara Bank',
							'Central Bank of India' => 'Central Bank of India',
							'City Union Bank' => 'City Union Bank',
							'Corporation Bank' => 'Corporation Bank',
							'Development Credit Bank' => 'Development Credit Bank',
							'Dhanlaxmi Bank' => 'Dhanlaxmi Bank',
							'ICICI Bank' => 'ICICI Bank',
							'IDBI Bank' => 'IDBI Bank',
							'Indian Bank' => 'Indian Bank',
							'Indian Overseas Bank' => 'Indian Overseas Bank',
							'IndusInd Bank' => 'IndusInd Bank',
							'ING Vysya Bank' => 'ING Vysya Bank',
							'Jammu and Kashmir Bank' => 'Jammu and Kashmir Bank',
							'Karnataka Bank Ltd' => 'Karnataka Bank Ltd',
							'Karur Vysya Bank' => 'Karur Vysya Bank',
							'Kotak Bank' => 'Kotak Bank',
							'Laxmi Vilas Bank' => 'Laxmi Vilas Bank',
							'Oriental Bank of Commerce' => 'Oriental Bank of Commerce',
							'Punjab National Bank - Corporate Banking' => 'Punjab National Bank - Corporate Banking',
							'Punjab National Bank - Retail Banking' => 'Punjab National Bank - Retail Banking',
							'Punjab & Sind Bank' => 'Punjab & Sind Bank',
							'Shamrao Vitthal Co-operative Bank' => 'Shamrao Vitthal Co-operative Bank',
							'South Indian Bank' => 'South Indian Bank',
							'State Bank of Bikaner & Jaipur' =>'State Bank of Bikaner & Jaipur',
							'State Bank of Hyderabad' => 'State Bank of Hyderabad',
							'State Bank of India' => 'State Bank of India',
							'State Bank of Mysore' => 'State Bank of Mysore',
							'State Bank of Patiala' => 'State Bank of Patiala',
							'State Bank of Travancore' => 'State Bank of Travancore',
							'Syndicate Bank' => 'Syndicate Bank',
							'Tamilnad Mercantile Bank Ltd.' => 'Tamilnad Mercantile Bank Ltd.',
							'UCO Bank' => 'UCO Bank',
							'Union Bank of India' => 'Union Bank of India',
							'United Bank of India' => 'United Bank of India',
							'Vijaya Bank' => 'Vijaya Bank',
							'Yes Bank Ltd' => 'Yes Bank Ltd'
							);
							echo form_dropdown('bank_name', $bank_nm)
							?>
			                <!--<input type="text" placeholder="Enter bank name" name="bank_name" class="form-control" value="" autofocus required>-->
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Branch Name/Address</label>
			                <input type="text"  placeholder="Enter branch name" name="branch_name" class="form-control" value="" autofocus required>
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> IFSC Code</label>
			                <input type="text" id="firstName" placeholder="Enter IFSC Code" name="ifsc_code" class="form-control" value="" autofocus required>
			            </div>
		        	</div>
		        </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		 <div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> Account Number</label>
			                <input type="text" id="firstName" placeholder="Enter account number" name="account_no" class="form-control" value="" autofocus required>
			            </div>
		        		<div class="col-md-4 col-sm-4 date_of_approval_div">
			            	<label class="control-label"> Date of Approval</label>
			                <input type="text" data-date-formate="dd-mm-yyyy" name="date_of_approval" class="form-control date-picker date_of_approval" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-yyyy" autofocus required>
			            </div>
			            <div class="col-md-4 col-sm-4 date_of_evalution_div">
			            	<label  class="control-label"> Date of Next Evalution</label>
			                <input type="text" data-date-formate="dd-mm-yyyy" name="date_of_evalution" 
							class="form-control date-picker date_of_evalution" value="<?php echo date('d-m-Y',strtotime('+1 year')); ?> " 
							placeholder="dd-mm-yyyy" autofocus>
			            </div>
		        	</div>
		        </div>
		        
		        
		        <button type="submit" class="btn btn-primary btn-block"> Save</button>
		    </form> <!-- /form -->
		</div>
	</div>
</div>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		//alert(base_url);
		$(document).on('blur','.service_provider_code',function(){
				var service_provider_code = $('.service_provider_code').val();
				//var aa= base_url+"index.php/Transporters/CheckTrasnferCode/"+service_provider_code;
				//alert(aa);
				$.ajax({
	                type: "POST",
	                url:"<?php echo base_url('index.php/service_providers/Checkservice_providerCode/') ?>"+service_provider_code,

	                //data: {id:role_id},
	                dataType: 'html',
	                success: function (response) {
	                	//alert(response);
	                   if(response==1){
	                   	alert('This service_provider Code is already taken');
	                   	$('.service_provider_code').val('');
	                   }
	                }
            	});
			}); 
			$("input[type='radio']").click(function(){
            var service_provider_type = $("input[name='service_provider_type']:checked").val();
				if(service_provider_type=='New'){
					$(".category_of_approval").hide();
					$(".date_of_evalution_div").addClass('hide');
					$(".date_of_approval_div").addClass('hide');
					$(".date_of_evalution").removeAttr('required');
					$(".date_of_approval").removeAttr('required');
					
				}
				else {
					$(".category_of_approval").show();
                    $(".date_of_evalution_div").removeClass('hide');
                    $(".date_of_approval_div").removeClass('hide');
                    $(".date_of_approval").attr('required', 'required');
                    $(".date_of_evalution").attr('required', 'required');

					//$(".category_of_approval").addClass('show');
				}
			});

			$("input[type='radio']").click(function(){
            var gst_status = $("input[name='gst_status']:checked").val();
				if(gst_status=='Yes'){
					$(".gst_div").css('visibility', 'visible');
					$(".gstnumber").attr('required', 'required');
				}
				else {
					$(".gst_div").css('visibility', 'hidden');
					$(".gstnumber").removeAttr('required');
				}
			});
	});
</script> 