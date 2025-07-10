<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// echo"<pre>";
// print_r($leads_data);exit;
?>

<style type="text/css">
	.select2{
		height:45px !important;
		width: 100% !important;
	}
    .btnEdit{
		width: 25%;
		border-radius: 5px;
		margin: 1px;
		padding: 1px;
    }



</style>

<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible" >
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h5><i class="icon fa fa-check"></i> Success!</h5>
		<?php echo $this->session->flashdata('success'); ?>
    </div>
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
      		<span> Lead Title :</span><span class="card-title"> <b> <?= $lead_title ?> </b></span>
			
      		
			
			  <div class="pull-right d-flex">
			  <div>          
          <form method="post" action="<?php echo base_url(); ?>index.php/Lead_marketing/createXLS">
            <?php if(!empty($filtered_value)){ foreach ($filtered_value as $key => $value) { ?> 
                <input type="hidden" name="<?= $key ?>" value="<?=$value ?>"> <?php } }?>
				
            <button type="submit" class="btn btn-info"> Export </button>
          </form>
        </div>
			</div>
	    </div> <!-- /.card-header -->
	    <div class="card-body">
		    <div class="row">
		      	<div class="col-md-4">
				
				<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads_marketing/add_followup" enctype="multipart/form-data">
				
				<input type="hidden" value="<?= $leads_data['lead_status'];?>" name="old_lead_status">
			
					<input type="hidden" name="lead_id" value="<?= $id?>">
					
					<!-- <div class="form-group">
						<div class="row col-md-12">
							<div class="col-md-12 col-sm-12 ">
								<h3> Lead Title : <?= $followups['0']['title'] ?> </h3>
							</div>							
						</div>
					</div>-->

					<div class="form-group">
						<div class="row col-md-12 ">
							<div class="col-md-12 col-sm-12 ">
								<label class="control-label"> Write Your Answer <span class="required">*</span></label>
									<textarea class="form-control answer" rows="5" placeholder="Write Your Reply" name="answer" autofocus required></textarea>
							</div>							
						</div>
					</div>

					<div class="form-group"> 	
						<div class="row col-md-12">				        		
								<div class="col-md-12 col-sm-12 ">
								<label class="control-label" > Upload Media  <span class="required">*</span></label>
								<input type="file" name="photo" class="form-control upload" autofocus required >
							</div>
							<div class="col-md-12 col-sm-12 ">
								<img id="blah" src="#" alt="Your File"  class="hide" width="40%" autofocus required> 
							</div>
						</div>
					</div>

					<?php if(!empty($id)) {
						           $pending ='';
						          $approved ='';
						           $inprocess ='';
						           $converted ='';
						          $rejected ='';
						           if($lead_status == 'Pending'){
			                   $pending='selected';

			                 }
										if($lead_status == 'Approved'){
			                  $approved='selected';

			                }else if($lead_status == 'In Process'){
			                  $inprocess='selected';

			                }else if($lead_status == 'Converted'){
			                  $converted='selected';

			                }else if($lead_status == 'Rejected'){
			                  $rejected='selected';

			                }

						          	?>
						<div class="form-group">
				           <div class="row col-md-12">
				        		<div class="col-md-12 col-sm-12 dropdown">
					            	<label class="control-label">Lead Status</label><span> (Take any action on lead)</span>
					               <select class="form-control" name="lead_status" id="lead" onchange="changediv()">
								   		<option value="" > Select Action </option>
					             
					               		<option value="Approved" <?= $approved ?>> Converted </option>
					               		<option value="Rejected" <?= $rejected ?> >Declined</option>
										   <option value="In Process" <?= $inprocess ?>> In Progress</option>	
					               	
					               </select>
					            </div>
				        	</div></div>
							
							<div class="form-group">
							<div class="row col-md-12" >
							<div class="col-md-12 col-sm-12"  id="myDropdown" class="dropdown-content" style="display:none" >
								<select  class="form-control"  name="reject_reason"
									class="">
									<option value="">Select Reason</option>
									<option value="High prize">High Prize</option>
									<option value="No good response">No good Response</option>
									<option value="Other">other</option>
								</select>
							</div>
							</div>
						</div>
				        <?php } ?>
			

					<div class="row col-md-12">
						<div class="col-md-12 col-sm-12 ">
							<button type="submit" class="btn btn-primary btn-block"> Submit Your Answer</button>
						</div>
					</div>

					</form>
				</div>
				<div class="col-md-8">
					<div class="table-responsiveness">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th style="width: 2%;"> Sr.No.    </th>
									<th style="width: 48%;"> Follow Up </th>
									<th style="width: 10%;"> Document  </th>
									<th style="width: 40%;"> Time      </th>
									<th> Action                        </th>
								</tr>
							</thead>
							<tbody> <?php $i=1;foreach($followups as $followup) { ?>
								<tr>
									<td> <?= $i ?>                     </td>
									<td> <?= $followup['answer']?>     </td>
									<td> 
									<?php if(!empty($followup['file_path'])) { ?>
										<div style="height: 10%;width: 100%;">
										<a href="<?php echo base_url().'/uploads/lead_follow_up/'.$followup['file_path'];?>" target="_blank">
											View
											<!-- <img src="<?php echo base_url().'/uploads/lead_follow_up/'.$followup['file_path']; ?>"  width="80%;"/> -->
										</a>
										</div>
									<?php } ?>	
									</td>
									<td>
										<?= date('d-M-Y h:i:s a ',strtotime($followup['followup_time']))?>
									</td>
									<td> 
										<a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $followup['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i> </a>
									</td>
									<!-- delete model -->
									<div class="modal fade" id="delete<?php echo $followup['id'];?>" role="dialog">
										<div class="modal-dialog">
											<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads_marketing/deletefollowup/<?php echo $followup['id'];?>">
												<input type="hidden" name="lead_id" value="<?= $id?>">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title">Confirm Header </h4>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body">
														<p>Are you sure, you want to delete this Follow Up ? </p>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-primary delete_submit"> Yes </button>
														<button type="button" class="btn btn-danger" data-dismiss="modal"> No </button>
													</div>
												</div>
											</form>
										</div>
									</div>
									<!-- delete model -->
								</tr> <?php $i++;} ?>
							</tbody>									
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>


<script>
	function changediv() {
    if (document.getElementById("lead").value != "Rejected"){
        document.getElementById("myDropdown").style.display="none";
    }     
    else{
        document.getElementById("myDropdown").style.display = "block";
    }        
}

</script>
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
			// var fileType = file["type"];
			var size = parseInt(file["size"]/1024);
			// var validImageTypes = ["*"];
			// if ($.inArray(fileType, validImageTypes) < 0) 
			// {
			//     alert('Invalid file type , please select jpg/png file only !');
			//     $(this).val(''); 
			// }
			if (size > 5000) 
			{
			    alert('Image size exceed , please select < 5MB file only !');
			    $(this).val(''); 
			}
		  	readURL(this);
		});

	});
</script>
