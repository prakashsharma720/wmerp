<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
	.select2{
		height:45px !important;
		width: 100% !important;
	}
 

</style>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      	<div class="card-header">
        	<h3 class="card-title"><?= $title ?></h3>
			<div class="pull-right error_msg">
				<?php echo validation_errors();?>

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
		      	<div class="row">
		      		<div class="col-md-12">
		      			<?php  //echo $title; exit; ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Enquiries/add_new_record" enctype="multipart/form-data">
				    		
					        <div class="form-group">
					        	<div class="row col-md-12">
					        		  <div class="col-md-4 col-sm-4">
						            	<label class="control-label"> Loan Date <span class="required">*</span> </label>
						                <input type="text" data-date-formate="dd-mm-yyyy" name="loan_date" class="form-control date-picker" value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-yyyy" required >	
			            			</div>
					        		<div class="col-md-4 col-sm-4 ">
						            	<label class="control-label">Customer Name <span class="required">*</span></label>
						                <input type="text"  placeholder="Enter customer name" name="customer_name" class="form-control"  required >
						            </div>
					        		<div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> Mobile No <span class="required">*</span></label>
						               	<input type="text" placeholder="Enter mobile" name="mobile_no" class="form-control mobile" minlenght="10" maxlength="10" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   value="" required >
						            </div>
						         
				        		</div>
				        	</div>
						       
					        <div class="form-group"> 
						        <div class="row col-md-12">
						        	   <div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> Product Description <span class="required">*</span></label>
						                <textarea class="form-control product_description" rows="3" placeholder="Enter product description" name="product_description" value="" style="resize: none;"></textarea>
						            </div>
					        		<div class="col-md-8 col-sm-8 ">
						            	<label class="control-label"> Address</label>
						               <textarea class="form-control address" rows="3" placeholder="Enter Address" name="address" value="" style="resize: none;"></textarea>
						            </div>
						        </div>
					        </div>
					       <div class="form-group">
					        	<div class="row col-md-12">
					        		<div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> Loan Amount <span class="required">*</span></label>
						               	<input type="text" placeholder="Enter loan amount" name="loan_amount" class="form-control loan_amount" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   value="" required >
						            </div>
						            <div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> File Charge <span class="required">*</span></label>
						               	<input type="text" placeholder="Enter file Charge" name="file_charge" class="form-control file_charge" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   value="" required >
						            </div>
						            <div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> Total Amount <span class="required">*</span></label>
						               	<input type="text" placeholder="Total Amount" name="total_amount" class="form-control total_amount" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   value="" required readonly="readonly" >
						            </div>
						             <div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> No of Installment <span class="required">*</span></label>
						               	<input type="text" placeholder="No Of Installment " name="no_of_installment" class="form-control no_of_installment" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   value="" required >
						            </div>
						             <div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> Installment Amount <span class="required">*</span></label>
						               	<input type="text" placeholder="Installment Amount" name="installment_amount" class="form-control installment_amount" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   value="" required readonly="readonly">
						            </div>
					        		  <div class="col-md-4 col-sm-4">
						            	<label class="control-label"> First Installment Date <span class="required">*</span> </label>
						                <input type="text" data-date-formate="dd-mm-yyyy" name="first_installment_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy"required >
			            			</div>
					        		
				        		</div>
				        	</div>
				           <div class="row col-md-12">
					            <div class="col-md-12 col-sm-12 ">
					            	<label class="control-label" style="visibility: hidden;"> Name</label><br>
					            	<button type="submit" class="btn btn-primary btn-block">Save</button>
					            </div>
					        </div>
					        </form>
				        </div>
				 <!-- /form -->
				
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {
		function readURL(input) {

		  if (input.files && input.files[0]) {
		    var reader = new FileReader();

		    reader.onload = function(e) {
		    	$('#blah').removeClass('hide');
		    	$('#blah').addClass('show');
		      $('#blah').attr('src', e.target.result);
		    }

		    reader.readAsDataURL(input.files[0]);
		  }
		}
		$(".upload").change(function() {
			var file = this.files[0];
			var fileType = file["type"];
			var size = parseInt(file["size"]/1024);
			//alert(size);
			var validImageTypes = ["image/jpeg", "image/png"];
			if ($.inArray(fileType, validImageTypes) < 0) 
			{
			    alert('Invalid file type , please select jpg/png file only !');
			    $(this).val(''); 
			}
			if (size > 5000) 
			{
			    alert('Image size exceed , please select < 5MB file only !');
			    $(this).val(''); 
			}

		  readURL(this);
		});

		$("input[type='radio']").click(function(){
            var medical_status = $("input[name='medical_status']:checked").val();
				if(medical_status=='Yes'){
					$(".report_div").css('visibility', 'visible');
					$(".report_no").attr('required', 'required');
				}
				else {
					$(".report_div").css('visibility', 'hidden');
					$(".report_no").removeAttr('required');
				}
			});

		$(document).on('keyup','.file_charge,.loan_amount,.no_of_installment',function(){
			//alert();
			calculate_total();
	    });

	    function calculate_total()
        {

           
            var file_charge =  $('.file_charge').val();
            var loan_amount =  $('.loan_amount').val();
            var actual_price=parseFloat(loan_amount)+parseFloat(file_charge);
            //var loan_amount =  $('.loan_amount').val();
            if(isNaN(file_charge)){file_charge =0;}
            if(isNaN(loan_amount)){loan_amount =0;}
            //alert(actual_price);
            $('.total_amount').val(actual_price.toFixed(2));
            var no_of_installment =  $('.no_of_installment').val();
            var total_amount =  $('.total_amount').val();
            var inst_amt=parseFloat(total_amount)/parseInt(no_of_installment);
            $('.installment_amount').val(Math.round(inst_amt.toFixed(2)));
        }

	});
</script>

