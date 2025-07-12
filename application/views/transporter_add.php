<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"> <?= $title ?></h3>
       <div class="pull-right error_msg">
			<?php //echo validation_errors();?>

			<?php if (isset($message_display)) {
			echo $message_display;
			} ?>
			<?php if (isset($error)) {
			echo $error;
			} ?>	
			<?php if (isset($success)) {
			echo $success;
			} ?>			
		</div>

      </div> <!-- /.card-body -->
      <div class="card-body">
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Transporters/add_new_transporter">

		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4">
		        			<label class="control-label"><?=$this ->lang->line('transporter_name')?></label>
		        			
				                  <input type="text" id="firstName" placeholder="Enter name" name="transporter_name" class="form-control" value="" required autofocus autocomplete="off" autocomplete="off" >
				              
			            </div>
						   	<div class="col-md-4 col-sm-4 ">
				        		<label class="control-label"> <?=$this ->lang->line('transporter_type')?> </label>
				        			<div class="form-check">
					               		<input class="form-check-input transporter_type" type="radio" name="transporter_type" value="New"  > New</input>
					               		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					               		<input class="form-check-input transporter_type" type="radio" name="transporter_type" value="Existing"  checked>Existing</input>
			            		</div>
			            	</div>
							 <div class="col-md-4 col-sm-4 category_of_approval">
			            	<label  class="control-label"> <?=$this ->lang->line('category_of_approval')?></label>
			            	<?php  $app_cat = array(
			            		 'No' => 'Select Option',
				                  'A' => 'A',
				                  'B' => 'B',
				                  'c' => 'C'
				                  );
			            		echo form_dropdown('category_of_approval', $app_cat)
			            	?>
			            </div>
			            
			           
		        	</div>
		        </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
					<div class="col-md-4 col-sm-4">
			            	<label  class="control-label"><?=$this ->lang->line('transporter_code')?></label>
			                  <input type="text"  name="tp_code" class="form-control" value="<?= $vendor_code?>"  autofocus readonly="readonly">
						      <input type="hidden" name="vendor_code" value="<?php echo $tp_code;?>">

							<span class="required">
						         <?php echo form_error('vendor_code'); ?>
						    </span>
			            </div>
						<div class="col-md-4 col-sm-4">
			            	<label class="control-label"> <?=$this ->lang->line('contact_person')?></label>
							<div class="input-group input-group-lg mb-12">
				                  <div class="input-group-prepend">
				                    <select name="prefix" >
					                <?php
					                 if ($prefix): ?> 
					                  <?php 
					                    foreach ($prefix as $value) : ?>
						                        <option value="<?= $value ?>"><?= $value ?></option>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="0"><?=$this ->lang->line('no_result')?></option>
					                <?php endif; ?>
					            </select>
			                <input type="text" id="firstName" placeholder="Enter contact person" name="contact_person" class="form-control" value=""  autofocus>
			                
							 </div>
				            </div>
			            </div>
		        		<div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> <?=$this ->lang->line('email')?></label>
			                <input type="email" id="lastName" placeholder="Enter email" name="email" class="form-control" value=""  autofocus>
			            </div>
		        		
			          
		        	</div>
		        </div>
		         <div class="form-group">
		        	<div class="row col-md-12">
		        <!-- 		<div class="col-md-4 col-sm-4 drop">
			            	<label class="control-label"> Category</label>
			            	<select name="categories_id" class="form-control select2 " >
					            <option value="0"> Select Category</option>
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
					             <span class="required">
						         <?php echo form_error('categories_id'); ?>
						    	</span>
			            </div> -->
						<div class="col-md-4 col-sm-4">
			            	<label class="control-label"><?=$this ->lang->line('mobile')?></label>
			                <input type="text" id="firstName" placeholder="Enter mobile" name="mobile_no" class="form-control mobile" value=""
			                maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
			                			  autofocus>
			            </div>
							<div class="col-md-4 col-sm-4">
			            	<label class="control-label"><?=$this ->lang->line('alternate_no')?></label>
			                <input type="text" id="firstName" placeholder="Enter Alternate Number" name="alternate_no" class="form-control mobile" value=""
			                maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
			                			  autofocus>
			                <span class="">
						         <?php echo form_error('alternate_no'); ?>
						    </span>
			            </div>

						  <div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> <?=$this ->lang->line('website')?></label>
			                <input type="text" id="lastName" placeholder="Enter website" name="website" class="form-control" value=""  autofocus>
			            </div>
			          </div>
		        </div>
				  <div class="form-group">
		        	<div class="row col-md-12">
		        		
			             <div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> Service for the state</label>
			            	<?php  
							   // $old_values=explode(',', $current[0]->states);
			            		//echo form_multiselect('states[]', $states,$current[0]->state)
								echo form_multiselect('states[]', $states)
			            	?>
			            	
			            </div>
		        		<div class="col-md-8 col-sm-8 ">
			        		<label class="control-label"> <?=$this ->lang->line('address')?></label>
			        		<textarea type="text" placeholder="Enter address" name="address" class="form-control" rows="3" value="" required autofocus style="resize: none;"></textarea>

			        		 <span class="required">
						         <?php echo form_error('address'); ?>
						   </span>
		        		</div>
		        	</div>
		        </div>
				  <div class="form-group">
		        	<div class="row col-md-12">
			            <div class="col-md-4 col-sm-4">
			            	<label  class="control-label"><?=$this ->lang->line('reg_date')?></label>
			            	  <input type="text" data-date-formate="dd-mm-yyyy" name="reg_date" class="form-control date-picker" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">

			            </div>
			            <div class="col-md-4 col-sm-4 ">
			        		<label class="control-label"> GST Registration Status </label>
			        			<div class="form-check">
				               		<input class="form-check-input gst_status" type="radio" name="gst_status" value="Yes" checked> <?=$this ->lang->line('yes')?></input>
				               		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				               		<input class="form-check-input gst_status" type="radio" name="gst_status" value="Un-registered Dealer"  > Un-registered Dealer/Person </input>
		            		</div>
		            	</div>
						<div class="col-md-4 col-sm-4 ">
				        		<label class="control-label"> No TDS Declaration</label>
				        			<div class="form-check">
					               		<input class="form-check-input supplier_type" type="radio" name="tds_declaration" value="Available"  > <?=$this ->lang->line('available')?></input>
					               		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					               		<input class="form-check-input supplier_type" type="radio" name="tds_declaration" value="Not-Available"  checked> <?=$this ->lang->line('not_available')?> </input>
			            		</div>
			            	</div>
		        	</div>
		        </div>
				
		         <div class="form-group">
		        	<div class="row col-md-12">
		        	    <div class="col-md-4 col-sm-4">
			            	<b> PAN </b> <span>(Parmanent Account No.) </span>
			                <input type="text" id="lastName" placeholder="Ex. ABCEDE2548K" name="pan_no" class="form-control pan_no" value="" autofocus autocomplete="off"  maxlength="10" minlength="10" >
			            </div>
		        		<div class="col-md-4 col-sm-4 ">
							<b><?=$this ->lang->line('transporter_id')?></b><span></span>
			            	<input type="text"  placeholder="Enter ID" name="gst_no" class="form-control " value=""autofocus autocomplete="off"    required="required">
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
			            	<label class="control-label"> <?=$this ->lang->line('bank_name')?></label>
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
			                <!--<input type="text" placeholder="Enter bank name" name="bank_name" class="form-control" value="" required autofocus>-->
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"><?=$this ->lang->line('branch_name')?></label>
			                <input type="text"  placeholder="Enter branch name" name="branch_name" class="form-control" value=""  autofocus>
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"><?=$this ->lang->line('ifsc_code')?></label>
			                <input type="text" id="firstName" placeholder="Enter IFSC Code" name="ifsc_code" class="form-control" value=""  autofocus>
			            </div>
		        	</div>
		        </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		 <div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> <?=$this ->lang->line('account_no')?></label>
			                <input type="text" id="firstName" placeholder="Enter account number" name="account_no" class="form-control" value=""  autofocus>
			            </div>
		        		<div class="col-md-4 col-sm-4 date_of_approval">
			            	<label class="control-label"><?=$this ->lang->line('date_of_approval')?></label>
			                <input type="text" data-date-formate="dd-mm-yyyy" name="date_of_approval" class="form-control date-picker" value="<?php echo date('d-m-Y') ?>" placeholder="dd-mm-yyyy"  autofocus>	
			            </div>
			            <div class="col-md-4 col-sm-4 date_of_evalution">
			            	<label  class="control-label"> <?=$this ->lang->line('date_of_next_evalution')?></label>
			                <input type="text" data-date-formate="dd-mm-yyyy" name="date_of_evalution" 
							class="form-control date-picker" value="<?php echo date('d-m-Y',strtotime('+1 year')); ?>" 
							placeholder="dd-mm-yyyy" required autofocus>
			            </div>
		        	</div>
		        </div>
		       
		        
		        <button type="submit" class="btn btn-primary btn-block"><?=$this ->lang->line('save')?></button>
		    </form> <!-- /form -->
		</div>
	</div>
</div>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		var base_url='<?php echo base_url() ;?>';
		//alert(base_url);
		$(document).on('blur','.transporter_code',function(){
				var transporter_code = $('.transporter_code').val();
				//var aa= base_url+"index.php/Transporters/CheckTrasnferCode/"+transporter_code;
				//alert(aa);
				$.ajax({
	                type: "POST",
	                url:"<?php echo base_url('index.php/Transporters/CheckTrasnferCode/') ?>"+transporter_code,

	                //data: {id:role_id},
	                dataType: 'html',
	                success: function (response) {
	                	//alert(response);
	                   if(response==1){
	                   	alert('This Trasnporter Code is already taken');
	                   	$('.transporter_code').val('');
	                   }
	                }
            	});
			}); 
			
		/*	$("input[type='radio']").click(function(){
            var transporter_type = $("input[name='transporter_type']:checked").val();
				if(transporter_type=='New'){
					$(".category_of_approval").hide();
					$(".date_of_evalution").addClass('hide');
					$(".date_of_approval").addClass('hide');
				}
				else {
					$(".category_of_approval").show();
                    $(".date_of_evalution").removeClass('hide');
                    $(".date_of_approval").removeClass('hide');
					//$(".category_of_approval").addClass('show');
				}
			});*/
			
		var transporter_type = $("input[name='transporter_type']:checked").val();
		  if(transporter_type=='New'){
					$(".category_of_approval").hide();
					$(".date_of_evalution").addClass('hide');
					$(".date_of_approval").addClass('hide');
					//$(".category_of_approval").removeClass('show');
				}
				else {
					$(".category_of_approval").show();
					$(".date_of_evalution").removeClass('hide');
                    $(".date_of_approval").removeClass('hide');
					//$(".category_of_approval").addClass('show');
				}

		 	$("input[type='radio']").click(function(){
            var transporter_type = $("input[name='transporter_type']:checked").val();
				if(transporter_type=='New'){
					$(".category_of_approval").hide();
					$(".date_of_evalution").addClass('hide');
					$(".date_of_approval").addClass('hide');
				}
				else {
					$(".category_of_approval").show();
                    $(".date_of_evalution").removeClass('hide');
                    $(".date_of_approval").removeClass('hide');
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
					$(".gstnumber").val('');
				}
		});
	});
</script> 