<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo $grid_number;exit;
//$this->load->model('notifications_model');
$current_page=current_url();
$data=explode('?', $current_page);
get_instance()->load->helper('MY_array');

$allnotifications = $this->dynamic_menu->getReminder();
  // echo "<pre>";print_r($allnotifications);exit;

?>
<style>

.btn{
  display: inline-block !important;
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

      <?php if($this->session->flashdata('failed')): ?>3
         <div class="alert alert-error alert-dismissible " >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> Alert!</h5>
                 <?php echo $this->session->flashdata('failed'); ?>
               </div>
      <?php endif; ?>


  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title?></h3>

        <div class="button-group float-right">

        <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

          <button class="btn btn-danger delete_all"  data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-trash"></i></button>
    </div>

        <div class="pull-right error_msg">
			<?php echo validation_errors();?>

			<?php if (isset($message_display)) {
			echo $message_display;
			} ?>		
		</div>
    
      </div> <!-- /.card-body -->
      <div class="card-body">
					  <div class="table-responsive">
                 <table id="example1" class="table table-bordered table-striped">
                  <thead>
                        <tr>
                        <th><input type="checkbox" id="master"></th>
                          <th >Sr.No.</th>
                          <th>  Lead id</th>
                          <th >Reminder Title </th>
                          <th >Reminder Date </th>
                          <th >Reminder Time </th>
                          <th > Status</th>
                          <th> Action</th>
                        </tr>
                    </thead>
                      <tbody>
                         <?php $i=1; foreach ($allnotifications as $key => $value) { ?>
                          <tr>
                          <td><input type="checkbox" class="sub_chk" value="<?php echo $value['id']; ?>" /></td>
                            <td> <?= $i ?></td>
                                <td> 
                                <?php
                              
                              $voucher_no= $value['lead_id'];
                      
                              if($voucher_no<10){
                                $rs_id_code='MUSK000'.$voucher_no;
                              } else if(($voucher_no>=10) && ($voucher_no<=99)){
                                $rs_id_code='MUSK00'.$voucher_no;
                              } else if(($voucher_no>=100) && ($voucher_no<=999)){
                                $rs_id_code='MUSK0'.$voucher_no;
                              } else{
                                $rs_id_code='MUSK'.$voucher_no;
                              }
                      
                              $data['reminder_code']=$rs_id_code;	
                        
                              ?>
                                <?=  $data['reminder_code']?></td>
                                <td>
                                
                                  <!-- <b><?php echo"Reminder set by".$value['creator']?> </b>  -->
                                    <?= $value['reminder_title']?> 
                                

                                
                                </td>
                                <td>
                                  <?= $value['reminder_date']?>
                                </td>
                                <td>
                                  <?= $value['reminder_time']?>
                                </td>
                                <td style="color:green;font-weight:700;">
                                  <?= $value['status']?>
                                </td>
                              <td>
                              <?php 
            //  echo "<pre>"
             if((date('Y-m-d') >= $value['reminder_date'] || date('H:i:s') >= $value['reminder_time']) && ($value['status']=='Active')){?> 
              
             <center>
             <a class="btn  btn-success"  href="<?php echo base_url(); ?>index.php/Leads/complete/<?php echo $value['id'];?>"><i class="fa fa-check"></i>&nbsp;Complete</a>
              <a class="btn  btn-warning " data-toggle="modal"  data-target="#snooze<?php echo $value['id'];?>" title=" Edit Reminder">
              <i class="fa fa-edit"></i>&nbsp;Snooze</a>
            </center>

            <?php }?>


            	<!-- Reminder Modal -->
							<div class="modal fade" id="snooze<?php echo $value['id'];?>" role="dialog">
									<div class="modal-dialog">
									
										<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads/reminderedit/<?php echo $value['id'];?>">
										
									<input type="hidden" name="lead_id" value="<?= $value["id"]?>">
									
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title"> Edit Reminder </h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>                           
											</div>
											<div class="row col-md-12">
											
																	
											<div class="col-md-6">
												<label class="control-label">Select Date </label> <span class="required">*</span>
												
												<input type="date" class="form-control reminder" id="rdate" name="reminder_date" value="<?php echo $value['reminder_date'];?>" required="required">
											</div>
											<div class="col-md-6">
												<label class="control-label"> Time</label><span class="required">*</span>
												
												<input type="time" id="reminder_time" name="reminder_time" min="10`:00" max="18:00" class="form-control" value="<?php echo  $value['reminder_time']?>" required="required">
											</div>

											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-success"> Snooze </button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button>
											</div>
										</div>
                  
										</form>
                    
									</div>
								</div>
                
                              </td>


                                <!-- <td>
                                  <span class="float-right " >
                                    <?php
                                      $curr_time=$value['datetime'];
                                      $timea=strtotime($curr_time);
                                      echo  time_Ago($timea); 
                                      ?>
                                    </span>
                                </td> -->
                                 <!--  <td>
                                   <a class="btn btn-xs btn-defaul btnEdit" data-toggle="modal" data-target="#delete<?= $value['id']?>"><b style="color:#0c6ed8;"> Clear notification</b></a>

                                    <div class="modal fade" id="delete<?= $value['id']?>" role="dialog">
                                    <div class="modal-dialog">
                                      <form class="form-horizontal" role="form" method="post" action="<?php //echo base_url(); ?>index.php/Notifications/deleteNotification/<?= $value['id']?>">
                                      
                                      <div class="modal-content">
                                        <div class="modal-header">
                                           <h4 class="modal-title">Confirm Header </h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                         
                                        </div>
                                        <div class="modal-body">
                                          <p>Are you sure, you want to Clear this notification ? </p>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary delete_submit"> Yes </button>
                                          <button type="button" class="btn btn-danger" data-dismiss="modal"> No </button>
                                        </div>
                                      </div>
                                      </form>
                                    </div>
                                  </div>
                              </td> -->




                              

                          </tr>
                         
                           <?php  $i++; } ?> 

                      </tbody>
                    </table>
                 </div>
              </div>
		</div>
	</div>
</div>
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
  
    jQuery('.delete_all').on('click', function(e) { 
    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
      allVals.push($(this).val());
    });  
    //alert(allVals.length); return false;  
    if(allVals.length <=0)  
    {  
      alert("Please select row.");  
    }  
    else {  
      WRN_PROFILE_DELETE = "Are you sure you want to delete  selected records?";  
      var check = confirm(WRN_PROFILE_DELETE);  
      if(check == true){  
        var join_selected_values = allVals.join(","); 
        $.ajax({   
          type: "POST",  
          url: "<?php echo base_url(); ?>index.php/Notifications/deleteReminder",  
          cache:false,  
          data: 'ids='+join_selected_values,  
          success: function(response)  
          {   
            $(".successs_mesg").html(response);
            location.reload();
          }   
        });
           
      }  
    }  
  });


	});
</script> 








