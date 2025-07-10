<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($item_master);exit;
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
      <span class="card-title"><?php  echo $title; ?>
      </span>
       <div class="pull-right">
      
         <a class="btn btn-xs btn-primary " href="<?php echo base_url(); ?>index.php/Finish_goods/add">
          <i class="fa fa-plus"> Add New FG</i></a>
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
           <tr>
               <th><?= $this->lang->line('sr_no') ?></th>
<th><?= $this->lang->line('mineral_name') ?></th>
<th><?= $this->lang->line('grade_name') ?></th>
<th><?= $this->lang->line('packing_type') ?></th>
<th><?= $this->lang->line('packing') ?></th>
<th><?= $this->lang->line('action') ?></th>
              </tr>
          </thead>
          <tbody>
           <?php $i=1;foreach($items as $obj) { ?>
              <tr>
                <td><?= $i ?></td>
                <td><?= $obj['mineral_name'].' ('.$obj['hsn_code'].')'?></td>
                <?php 
                $voucher_no= $obj['fg_code'];
                if($voucher_no<10){
                $fg_code='FG000'.$voucher_no;
                }
                else if(($voucher_no>=10) && ($voucher_no<=99)){
                  $fg_code='FG00'.$voucher_no;
                }
                else if(($voucher_no>=100) && ($voucher_no<=999)){
                  $fg_code='FG0'.$voucher_no;
                }
                else{
                  $fg_code='FG'.$voucher_no;
                } ?>
                <td><?= $obj['grade_name'].' ('.$fg_code.')'?></td>
                <td><?= $obj['packing_type']?></td>
                <td><?= $obj['packing_size']?></td>
                <td >
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Finish_goods/edit/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
                </td>
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Finish_goods/deleteFG/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete  <b><?php echo $obj['grade_name'];?> </b>? </p>
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
<!-- <script type="text/javascript">

    var url="<?php //echo base_url();?>";
    alert(url);
    function delete(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
          window.location = url+"index.php/welcome/deleteSupplier/"+id;
        else
          return false;
        } 
</script> -->