<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
      		<span> <?= $this->lang->line('task_history_description') ?>:</span>
        	<h3 class="card-title"> <b> <?= @$followups['0']['title'] ?> </b></h3>
        	<div class="pull-right">
				
			</div>
	    </div> <!-- /.card-header -->
	    <div class="card-body">
		    <div class="row">
		      	<div class="col-md-4">
					<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Dailytasks/add_task_history" enctype="multipart/form-data">

					<input type="hidden" name="task_id" value="<?= $id?>">
					
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
								<label class="control-label"><?= $this->lang->line('work_description') ?> <span class="required">*</span></label>
									<textarea class="form-control answer" rows="5" placeholder="<?= $this->lang->line('write_your_reply') ?> " name="answer" required></textarea>
							</div>
							<div class="col-md-12 col-sm-12">
							<label class="control-label"><?= $this->lang->line('reference') ?> </label>
					                <input type="text"  placeholder="<?= $this->lang->line('reference_name') ?> " name="reference" class="form-control" required autofocus>
							</div>	
							<div class="col-md-12 col-sm-12">
								<label for="time-taken"><?= $this->lang->line('time_taken') ?> </label>
								 <input type="text"  placeholder="<?= $this->lang->line('how_much_time_take') ?> " name="time_taken" class="form-control" required >
								 
							</div>						
						</div>
					</div>

					<div class="form-group"> 	
						<div class="row col-md-12">				        		
								<div class="col-md-12 col-sm-12 ">
								<label class="control-label"> <?= $this->lang->line('upload_photo') ?>  </label>
								<input type="file" name="photo" class="form-control upload" autofocus>
							</div>
							<div class="col-md-12 col-sm-12 ">
								<img id="blah" src="#" alt="your image"  class="hide" width="40%" > 
							</div>
						</div>
					</div>

					<!--  <div class="form-group"> 	
						<div class="row col-md-12">				        		
							<div class="col-md-8 col-sm-8 ">
								<label class="control-label"> Giver Name </label>
								<?php //echo form_dropdown('giver_id', $employees,'','required=="required"') ?>
							</div>							
						</div>
					</div> -->

					<div class="row col-md-12">
						<div class="col-md-12 col-sm-12 ">
							<button type="submit"  class="btn btn-primary btn-block"> <?= $this->lang->line('submit_your_answer') ?> </button>
						</div>
					</div>

					</form>
				</div>
				<div class="col-md-8">
					<div class="table-responsiveness">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th style="width: 2%;"> <?= $this->lang->line('sr_no') ?>     </th>
									<th style="width: 48%;"> <?= $this->lang->line('work_description') ?></th>
									<th style="width: 30%;"> <?= $this->lang->line('reference') ?>  </th>
									<th style="width: 10%;"> <?= $this->lang->line('time_taken') ?>  </th>


									<th style="width: 10%;"> <?= $this->lang->line('document') ?>   </th>
									<th style="width: 10%;"> <?= $this->lang->line('followup_time') ?>   </th>

									
									<th>   <?= $this->lang->line('action') ?>                      </th>
								</tr>
							</thead>
							<tbody> <?php $i=1;foreach($followups as $followup) { ?>
								<tr>
									<td> <?= $i ?>                     </td>
									<td> <?= $followup['answer']?>     </td>
									<td> <?= $followup['reference']?>     </td>
									<td> <?= $followup['time_taken']?>     </td>

									<td> 
									<?php if(!empty($followup['file_path'])) { ?>
										<div style="height: 10%;width: 100%; ">
										<a href="<?php echo base_url().'/uploads/task_follow_up/'.$followup['file_path']; ?>" target="_blank">
										View
											<!-- <img src="<?php echo base_url().'/uploads/task_follow_up/'.$followup['file_path']; ?>"  width="80%;"style="border-radius:80%;"/> -->
										</a>
										</div>
									<?php } ?>	
									</td>
									<td>
										<?= date('d-M-Y H:i A',strtotime($followup['followup_time']))?>
									</td>
									<td> 
										<a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $followup['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i> </a>
									</td>
									<!-- delete model -->
									<div class="modal fade" id="delete<?php echo $followup['id'];?>" role="dialog">
										<div class="modal-dialog">
											<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Dailytasks/deletetaskhistory/<?php echo $followup['id'];?>">
												<input type="hidden" name="task_id" value="<?php echo $followup['task_id'];?>">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title"><?= $this->lang->line('confirm_header') ?></h4>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body">
														<p>  <?= $this->lang->line('delete_task_history_confirm') ?>   </p>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-primary delete_submit">  <?= $this->lang->line('yes') ?></button>
														<button type="button" class="btn btn-danger" data-dismiss="modal"> <?= $this->lang->line('no') ?> </button>
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
			var validImageTypes = ["image/jpeg", "image/png"];
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
