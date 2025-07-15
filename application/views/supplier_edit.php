<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"> Edit Supplier</h3>
        <div class="pull-right error_msg">
			<?php echo validation_errors();?>

			<?php if (isset($message_display)) {
			echo $message_display;
			} ?>		
		</div>
      </div> <!-- /.card-body -->
      <div class="card-body">
		    	<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Suppliers/editSupplier/<?= $old_id?>">
		    	<?php echo form_hidden('id',$old_id);  ?>
		    	<div class="form-group">
		        	<div class="row col-md-12">
					<div class="col-md-4 col-sm-4">
			            <label class="control-label"> <?=$this ->lang ->line('category')?></label>
			            	<select name="categories_id" class="form-control select2 " >
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
					                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
					                <?php endif; ?>
					            </select>
			            </div>
							<?php 
	    						$new='';
	    						$existing='';
	    						if(!empty($current[0]->supplier_type)) {
	    							if($current[0]->supplier_type=='New'){
	    								$new='checked';
	    							}else{
	    								$existing='checked';
	    							}

	    						}
	        				?>
					        <div class="col-md-4 col-sm-4 ">
				        		<label class="control-label"> <?=$this ->lang ->line('supplier_type')?> </label>
				        			<div class="form-check">
					               		<input class="form-check-input supplier_type" type="radio" name="supplier_type" value="New" <?php echo $new; ?> > <?=$this ->lang ->line('new')?></input>
					               		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					               	<input class="form-check-input supplier_type" type="radio" name="supplier_type" value="Existing" <?php echo $existing; ?> > <?=$this ->lang ->line('existing')?></input>
			            		</div>
			            	</div>
					
			            <div class="col-md-4 col-sm-4 category_of_approval">
			            	<label  class="control-label"><?=$this ->lang ->line('category_of_approval')?></label>
			            	<?php  $app_cat = array(
			            		 'No' => 'Select Option',
				                  'A' => 'A',
				                  'B' => 'B',
				                  'c' => 'C'
				                  );
			            		echo form_dropdown('category_of_approval', $app_cat,$current[0]->category_of_approval)
			            	?>
			            </div>
		        	</div>
		        </div> 
		        <div class="form-group">
		        	<div class="row col-md-12">
						<div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> <?=$this ->lang ->line('reg_date')?></label>
			            	 <input type="text" data-date-formate="dd-mm-yyyy" name="reg_date" class="form-control date-picker" value="<?php echo date('d-m-Y',strtotime($current[0]->reg_date)); ?>" placeholder="dd-mm-yyyy" autofocus  required autocomplete="off">
			            </div>
		        		<div class="col-md-4 col-sm-4">
		        			<label class="control-label"><?=$this ->lang ->line('supplier_name')?></label>
				            <input type="text" id="firstName" placeholder="<?=$this ->lang ->line('enter_name')?>" name="supplier_name" class="form-control" value="<?php echo $current[0]->supplier_name; ?>"  required autofocus autocomplete="off" autocomplete="off">
			            </div>
			            <div class="col-md-4 col-sm-4">
			            	<label  class="control-label"><?=$this ->lang ->line('supplier_code')?></label>
							<input type="text" name="s_code" class="form-control" value="<?= $vendor_code?>"  autofocus readonly="readonly">
						    <input type="hidden" name="vendor_code" value="<?php echo $s_code;?>">		            
						</div>
				    </div>
		        </div>
				    <div class="form-group">
		        	<div class="row col-md-12">
			           	<div class="col-md-4 col-sm-4">
						<label class="control-label"><?=$this ->lang ->line('contact_person')?></label>
						<div class="input-group input-group-lg">
				            <div class="input-group-prepend">
				                  <select name="prefix"  required="required">
					                <?php
					                 if ($prefix): ?> 
					                  <?php 
					                    foreach ($prefix as $value) : ?>
					                        <?php 
												if ($value == $current[0]->prefix): ?>
						                            <option value="<?= $value?>" selected><?= $value ?></option>
						                        <?php else: ?>
						                            <option value="<?= $value ?>"><?= $value ?></option>
						                        <?php endif;   ?>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
					                <?php endif; ?>
					            </select>
			                    <input type="text" id="firstName" placeholder="<?=$this ->lang ->line('enter_contact_person')?>" name="contact_person" class="form-control" value="<?php echo $current[0]->contact_person; ?>" autofocus  required autocomplete="off">
			                    </div>
				            </div>
						</div>

		        
		        		<div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> <?=$this ->lang ->line('email')?></label>
			                <input type="email" id="lastName" placeholder="<?=$this ->lang ->line('enter_email')?>" name="email" class="form-control email" value="<?php echo $current[0]->email; ?>" autofocus  autocomplete="off">
			            </div>
			            <div class="col-md-4 col-sm-4">
			            	<label class="control-label"> <?=$this ->lang ->line('mobile')?></label>
			                <input type="text" id="firstName" placeholder="<?=$this ->lang ->line('enter_mobile')?>" name="mobile_no" class="form-control mobile" value="<?php echo $current[0]->mobile_no; ?>" required  autofocus autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="10" minlength="10">
			            </div>
		        	</div>
		        </div>
		         <div class="form-group">
		        	<div class="row col-md-12">
						<!-- Country State City Dropdowns -->
			          	<div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> <?=$this ->lang ->line('country')?></label>
			            	<?php  
			            		echo form_dropdown('country_id', $countries,$current[0]->country_id)
			            	?>

			            </div>
			             <div class="col-md-4 col-sm-4">
			            	<label  class="control-label"><?=$this ->lang ->line('state')?></label>
			            	<?php  
			            		echo form_dropdown('state_id', $states,$current[0]->state_id)
			            	?>

			            </div>
			             <div class="col-md-4 col-sm-4">
			            	<label  class="control-label"><?=$this ->lang ->line('city')?></label>
			            	<?php  
			            		echo form_dropdown('city_id', $cities,$current[0]->city_id)
			            	?>

			            </div>
		        	</div>
		        </div>
				  <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4">
			            	<label  class="control-label"><?=$this ->lang ->line('website')?></label>
			                <input type="text" id="lastName" placeholder="<?=$this ->lang ->line('enter_website')?>" name="website" class="form-control" value="<?php echo $current[0]->website; ?>" autofocus  autocomplete="off">
			            </div>
			            <?php 
	    						$new='';
	    						$existing='';
	    						if(!empty($current[0]->gst_status)) {
	    							if($current[0]->gst_status=='Yes'){
	    								$new='checked';
	    							}else{
	    								$existing='checked';
	    							}

	    						}
	        				?>
			               <div class="col-md-4 col-sm-4 ">
			        		<label class="control-label"> <?=$this ->lang ->line('gst_status')?> </label>
			        			<div class="form-check">
				               		<input class="form-check-input gst_status" type="radio" name="gst_status" value="Yes" <?= $new ?> > <?=$this ->lang ->line('yes')?></input>
				               		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				               		<input class="form-check-input gst_status" type="radio" name="gst_status" value="Un-registered Dealer" <?= $existing ?> > Un-registered Dealer/Person </input>
		            		</div>
		            	</div>
			            <div class="col-md-4 col-sm-4 gst_div">
			            	<b>GSTIN</b><span>( Ex. : 08ABCDE1234K1AZ)</span>
			            		<input type="text"  placeholder="Ex. 08ABCDE12341AZ" name="gst_no" class="form-control gstnumber" value="<?php echo $current[0]->gst_no; ?>" autofocus autocomplete="off"   maxlength="15" minlength="15" >
						</div>
		        	</div>
		        </div>
		        
		        <div class="form-group">
		        	<div class="row col-md-12">
						<div class="col-md-4 col-sm-4">
			            	<b> PAN </b> <span>(Parmanent Account No.) </span>
			                <input type="text" id="lastName" placeholder="<?=$this ->lang ->line('enter_pan')?>" name="pan_no" class="form-control pan_no" value="<?php echo $current[0]->pan_no; ?>" autofocus   autocomplete="off" maxlength="10" minlength="10" >
			            </div>
		        		
			            <div class="col-md-4 col-sm-4">
			            	<b> TAN </b> <span>(Tax Deduction Account No.) </span>
			                <input type="text" id="firstName" placeholder="<?=$this ->lang ->line('enter_tin_no')?>." name="tds" class="form-control tan_number" value="<?php echo $current[0]->tds; ?>" autofocus   autocomplete="off"   maxlength="10" minlength="10">
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			        		<label class="control-label"><?=$this ->lang ->line('supplier_address')?></label>
			        		<textarea type="text" placeholder="<?=$this ->lang ->line('enter_address')?>" name="address" class="form-control" rows="3" value="<?php echo $current[0]->ifsc_code; ?>" autofocus  required autocomplete="off" style="resize: none;"><?php echo $current[0]->address; ?></textarea>
		        		</div>
		        	</div>
		        </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> <?=$this ->lang ->line('bank_name')?></label>
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
							echo form_dropdown('bank_name', $bank_nm,$current[0]->bank_name)
							?>
			               <!-- <input type="text" placeholder="Enter bank name" name="bank_name" class="form-control" value="<?php echo $current[0]->bank_name; ?>" autofocus  required autocomplete="off">-->
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"><?=$this ->lang ->line('branch_name')?></label>
			                <input type="text"  placeholder="<?=$this ->lang ->line('branch_name')?>" name="branch_name" class="form-control" value="<?php echo $current[0]->branch_name; ?>" autofocus   autocomplete="off">
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"><?=$this ->lang ->line('ifsc_code')?></label>
			                <input type="text" id="firstName" placeholder="<?=$this ->lang ->line('ifsc_code')?>" name="ifsc_code" class="form-control" value="<?php echo $current[0]->ifsc_code; ?>" autofocus   autocomplete="off">
			            </div>
		        	</div>
		        </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		 <div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"><?=$this ->lang ->line('account_number')?></label>
			                <input type="text" id="firstName" placeholder="<?=$this ->lang ->line('enter_account_no')?>" name="account_no" class="form-control" value="<?php echo $current[0]->account_no; ?>" autofocus   autocomplete="off">
			            </div>
		        		<div class="col-md-4 col-sm-4 date_of_approval">
			            	<label class="control-label"> <?=$this ->lang ->line('date_of_approval')?></label>
			                <input type="text" data-date-formate="dd-mm-yyyy" name="date_of_approval" class="form-control date-picker" value="<?php echo date('d-m-Y',strtotime($current[0]->date_of_approval)); ?>" placeholder="dd-mm-yyyy" autofocus   autocomplete="off">
			            </div>
			            <div class="col-md-4 col-sm-4 date_of_evalution">
			            	<label  class="control-label"><?=$this ->lang ->line('date_of_next_evalution')?></label>
			                <input type="text" data-date-formate="dd-mm-yyyy" name="date_of_evalution" class="form-control date-picker" value="<?php echo date('d-m-Y',strtotime($current[0]->date_of_evalution)); ?> " placeholder="dd-mm-yyyy" autofocus  autocomplete="off">
			            </div>
		        	</div>
		        </div>
		       
		        <button type="submit" class="btn btn-primary btn-block"> <?=$this ->lang ->line('save')?></button>
		    </form> <!-- /form -->
		</div>
	</div>
</div>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		var base_url='<?php echo base_url() ;?>';
		//alert(base_url);
		$(document).on('blur','.supplier_code',function(){
				var supplier_code = $('.supplier_code').val();
				//var aa= base_url+"index.php/Transporters/CheckTrasnferCode/"+supplier_code;
				//alert(aa);
				$.ajax({
	                type: "POST",
	                url:"<?php echo base_url('index.php/Suppliers/CheckSupplierCode/') ?>"+supplier_code,

	                //data: {id:role_id},
	                dataType: 'html',
	                success: function (response) {
	                	//alert(response);
	                   if(response==1){
	                   	alert('This Supplier Code is already taken');
	                   	$('.supplier_code').val('');
	                   }
	                }
            	});
			}); 
		  var supplier_type1 = $("input[name='supplier_type']:checked").val();
		  if(supplier_type1=='New'){
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
            var supplier_type = $("input[name='supplier_type']:checked").val();
				if(supplier_type=='New'){
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
		 	var gst_status1 = $("input[name='gst_status']:checked").val();
		 	if(gst_status1=='Yes'){
					$(".gst_div").show();
					$(".gstnumber").attr('required', 'required');
				}
				else {
					$(".gst_div").hide();
                    $(".gstnumber").removeAttr('required');
					//$(".category_of_approval").addClass('show');
				}


			$("input[type='radio']").click(function(){
            var gst_status = $("input[name='gst_status']:checked").val();
				if(gst_status=='Yes'){
					$(".gst_div").show();
					$(".gstnumber").attr('required', 'required');
				}
				else {
					$(".gst_div").hide();
					$(".gstnumber").removeAttr('required');
				}
			});
	});
</script> 