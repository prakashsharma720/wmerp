<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page=current_url();
//$current_page='https://www.muskowl.com/chaudhary_minerals/index.php/Meenus/UserRights';
$data=explode('?', $current_page);
//print_r($data[0]);exit;
?>

<style type="text/css">
 
  .col-sm-6 ,.col-md-6{
      float: left;
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
      <span class="card-title"><?php  echo $title; ?></span>
       <div class="pull-right error_msg">

          <a href="<?php echo base_url(); ?>index.php/Transporters/add" class="btn btn-success" data-toggle="tooltip" title="New transporter"><i class="fa fa-plus"></i></a>

         <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

          <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-trash"></i></button>  
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <form method="get" id="filterForm">
      <div class="row">
              <div class="col-md-4 col-sm-4 ">
                <label  class="control-label">Name of Transporter <span class="required">*</span></label>
                <select name="transporter_id" class="form-control select2 transporters" >
                    <option value="0"> Select Transporter</option>
                    <?php
                         if ($all_transporters): ?> 
                          <?php 
                            foreach ($all_transporters as $value) : ?>
                              <?php 
                                  if ($value['id'] == $transporter_id): ?>
                                      <option value="<?= $value['id'] ?>" selected><?= $value['transporter_name'] ?></option>
                                  <?php else: ?>
                                      <option value="<?= $value['id'] ?>"><?= $value['transporter_name'] ?></option>
                                  <?php endif;   ?>
                                   <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0">No result</option>
                        <?php endif; ?>
                </select>
              </div>
               <div class="col-md-4 col-sm-4">
                    <label  class="control-label"> Category of Approval</label>
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
               <div class="row">
                  <div class="col-md-4 col-sm-4">
                      <label  class="control-label"> From Date</label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label  class="control-label"> Upto Date</label>
                      <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                </div>
                 <div class="col-md-4 col-sm-4 ">
                   <label  class="control-label" style="visibility: hidden;"> Grade</label><br>
                  <input type="submit" class="btn btn-primary" value="Search" /> 
                  <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
                  <a href="<?php echo $data[0]?>" class="btn btn-danger" > Reset</a>
              </div>
          </div>
        </form>
            <hr>
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th >Sr.No.</th>
              <th> Name </th>
           
              <th style="white-space: nowrap;"> Contact Person </th>
              <th> Mobile No</th>
             <!--  <th style="white-space: nowrap;">Approval Date</th>
              <th style="white-space: nowrap;"> Next Evalution</th> -->
              <th style="white-space: nowrap;width: 20%;"> Action Button</th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($transporters as $obj){ ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
                <td><?php
					$voucher_no= $obj['vendor_code']; 
                    if($voucher_no<10){
                    $transporter_id_code='TP000'.$voucher_no;
                    }
                    else if(($voucher_no>=10) && ($voucher_no<=99)){
                      $transporter_id_code='TP00'.$voucher_no;
                    }
                    else if(($voucher_no>=100) && ($voucher_no<=999)){
                      $transporter_id_code='TP0'.$voucher_no;
                    }
                    else{
                      $transporter_id_code='TP'.$voucher_no;
                    }
                    
				echo $obj['transporter_name'].' ('.$transporter_id_code.')'; ?></td>
                <td><?php echo $obj['contact_person']; ?></td>
                <td><?php echo $obj['mobile_no']; ?></td>
             <!--    <td><?php echo date('d-M-Y',strtotime($obj['date_of_approval'])); ?></td>
                <td><?php echo date('d-M-Y',strtotime($obj['date_of_evalution'])); ?></td> -->
                <td >
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a>
				 <!--  <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Transporters/print/<?php echo $obj['id'];?>"><i class="fa fa-print"></i></a> -->

                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Transporters/edit_transporter_view/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a>
                  
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
                <!--   <a href="<?php //echo base_url(); ?>index.php/welcome/deletetransporter/<?php echo $obj['id'];?>"
                   onclick="return confirm(\'Confirm Deletion.\')">Delete</a> -->
                </td>
                 <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?php echo $obj['transporter_name'];?> Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"> Vendor Code :</label>
                                    <span> <?php echo $obj['vendor_code'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"> Contact Person :</label>
                                      <span> <?php echo $obj['contact_person'];?></span>
                                  </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Email :</label>
                                    <span> <?php echo $obj['email'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                      <label class="control-label">Mobile :</label>
                                      <span> <?php echo $obj['mobile_no'];?></span>
                                  </div>
                                </div> 
                            </div> 
                             <div class="row">
                                <div class="col-md-12">
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"> Website :</label>
                                    <span> <?php echo $obj['website'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"> TDS :</label>
                                    <span> <?php echo $obj['tds'];?></span>
                                  </div>
                              </div>  
                            </div>  
                            <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">GST No :</label>
                                    <span> <?php echo $obj['gst_no'];?></span>
                                  </div>
                                 <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"> PAN No :</label>
                                    <span> <?php echo $obj['pan_no'];?></span>
                                  </div>
                              </div>                              
                          </div>
                           <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Approved On:</label>
                                    <span><?php echo date('d-M-Y',strtotime($obj['date_of_approval'])); ?></span>
                                  </div>
                                 <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Next Evaution Date:</label>
                                    <span> <?php echo date('d-M-Y',strtotime($obj['date_of_evalution'])); ?></span>
                                    
                                  </div>
                              </div>                              
                          </div>
                           <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Bank Name:</label>
                                    <span> <?php echo $obj['bank_name'];?></span>
                                  </div>
                                 <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Branch Name:</label>
                                    <span> <?php echo $obj['branch_name'];?></span>
                                  </div>
                              </div>                              
                          </div>
                           <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">IFSC Code:</label>
                                    <span> <?php echo $obj['ifsc_code'];?></span>
                                  </div>
                                 <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Account No:</label>
                                    <span> <?php echo $obj['account_no'];?></span>
                                  </div>
                              </div>                              
                          </div>
                           <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Service State :</label>
                                    <span> <?php echo $obj['states'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label">Category of Approval :</label>
                                    <span> <?php echo $obj['category_of_approval'];?></span>
                                  </div>
                              </div>    
                              </div> 
                              <div class="row">
                                <div class="col-md-12 col-sm-12 ">
                                   <div class="col-md-12 col-sm-12 ">
                                        <label class="control-label">Address :</label>
                                        <span> <?php echo $obj['address'];?></span>
                                    </div>
                              </div>                            
                            </div>
                           <!--  <div class="row col-md-12">
                                <div class="col-md-12">
                                  <label class="control-label">Address:</label>
                                   <span> <?php echo $obj['address'];?></span>
                             </div>                              
                          </div>      -->
                        </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/transporters/deletetransporter/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete transporter <b><?php echo $obj['transporter_name'];?> </b>? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary delete_submit"> Yes </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> No </button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    
              </tr>
            <?php  $i++;} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $( document ).ready(function() {
     
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
      WRN_PROFILE_DELETE = "Are you sure you want to delete all selected transporters?";  
      var check = confirm(WRN_PROFILE_DELETE);  
      if(check == true){  
        var join_selected_values = allVals.join(","); 
        $.ajax({   
          type: "POST",  
          url: "<?php echo base_url(); ?>index.php/Transporters/deletetransporter",  
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