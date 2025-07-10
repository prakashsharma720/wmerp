<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page=current_url();
$data=explode('?', $current_page);
/*echo $category_id=$_GET['categories_id'];
echo $supplier_id=$_GET['supplier_id'];
echo $category_of_approval=$_GET['category_of_approval'];*/
//print_r($conditions);
?>

<style type="text/css">
 
  .col-sm-6 ,.col-md-6{
      float: left;
  }

</style>

<?php // echo $data; exit; ?>
<div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <label class="card-title"><?php  echo $title; ?></label>
       <div class="pull-right error_msg">
        <form method="post" action="<?php echo base_url(); ?>index.php/Suppliers/createXLS">

          <?php 
          if(!empty($conditions)){
            foreach ($conditions as $key => $value) { ?>
            <input type="hidden" name="<?= $key ?>" value="<?=$value ?>">
          <?php } }?>
           <button type="submit" class="btn btn-info"> Export </button>
         </form>
        <!-- <a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Suppliers/createXLS">Export</a>   -->
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
        <form method="get" id="filterForm">
      <div class="row">
          <div class="col-md-4 col-sm-4 ">
                  <label  class="control-label">Supplier Category <span class="required">*</span></label>
                  <select name="categories_id" class="form-control select2 category" >
                     <option value="0">Select Category</option>
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
                </div>
              <div class="col-md-4 col-sm-4 ">
                <label  class="control-label">Name of Supplier <span class="required">*</span></label>
                <select name="supplier_id" class="form-control select2 suppliers" >
                    <option value="0"> Select Supplier</option>
                    <?php
                         if ($all_suppliers): ?> 
                          <?php 
                            foreach ($all_suppliers as $value) : ?>
                              <?php 
                                  if ($value['id'] == $supplier_id): ?>
                                      <option value="<?= $value['id'] ?>" selected><?= $value['supplier_name'] ?></option>
                                  <?php else: ?>
                                      <option value="<?= $value['id'] ?>"><?= $value['supplier_name'] ?></option>
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
        <table  class="table table-bordered table-striped" >
          <thead>
            <tr >
              <th> Name </th>
              <th style="white-space: nowrap;"> Registration Date </th>
              <th style="white-space: nowrap;"> Contact Person </th>
              <th> Email</th>
              <th> Mobile No</th>
              <th> website</th>
              <th> Category</th>
              <th style="white-space: nowrap;"> Approval Category</th>
              <!-- <th style="white-space: nowrap;">Bank Name</th>
              <th> Account No</th>
              <th  style="white-space: nowrap;"> Service State</th>
              <th style="white-space: nowrap;">Approval Date</th>
              <th style="white-space: nowrap;"> Next Evalution</th> -->
            </tr>
          </thead>
          <tbody >
           <?php
          $i=1;foreach($suppliers as $obj){ ?>
              <tr>
                <!-- <td><?php echo $i;?></td> -->
                <td><?php echo $obj['supplier_name'].' ('.$obj['vendor_code'].')'; ?></td>
                <td><?php echo date('d-M-Y',strtotime($obj['reg_date'])); ?></td>
                <td><?php echo $obj['contact_person']; ?></td>
                <td><?php echo $obj['email']; ?></td>
                <td><?php echo $obj['mobile_no']; ?></td>
                <td><?php echo $obj['website']; ?></td>
                <td><?php echo $obj['category']; ?></td>
                <td><?php echo $obj['category_of_approval']; ?></td>
                <!-- <td><?php echo $obj['bank_name']; ?></td>
                <td><?php echo $obj['account_no']; ?></td>
                <td><?php echo $obj['state']; ?></td>
                <td><?php echo date('d-M-Y',strtotime($obj['date_of_approval'])); ?></td>
                <td><?php echo date('d-M-Y',strtotime($obj['date_of_evalution'])); ?></td> -->
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
                      //$('.category').find('option:selected').prop('required',true);

                  }
              });
      }); 
  });
</script> 