<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
    <div class="card card-primary card-outline">
		<div class="card-header">
			<h3 class="card-title pull-left"><?= $page_title ?></h3>
			<div class="pull-right ">

			</div>
	    </div> <!-- /.card-body -->
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<form action="<?php echo base_url(); ?>index.php/Leads/importdata" enctype="multipart/form-data" method="post" role="form">
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6">
									<label class="control-label"> Upload File</label><span class="required"> (Only Excel/CSV File Import.)</span>
									<input type="file" class="form-control" name="uploadFile" value="" required="required" />
								</div>
								<div class="col-md-8">
									<button type="submit" class="btn btn-success" name="submit" value="submit">Upload Lead File</button>
								</div>
							</div>  
						</div>
					</form>
					<hr>
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
