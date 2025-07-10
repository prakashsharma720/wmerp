<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($item_master);exit;
?>

<style type="text/css">
 
  .col-sm-6 ,.col-md-6{
      float: left;
  }
</style>

<?php //  echo $data; exit; ?>
<div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <span class="card-title"><?php  echo $title; ?>
      </span>
       <div class="pull-right">
        <?php if($this->session->flashdata('success')): ?>
          <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span>
        <?php endif; ?>

        <?php if($this->session->flashdata('failed')): ?>
            <span class="error_mesg"><?php echo $this->session->flashdata('failed'); ?></span>
        <?php endif; ?>

         <a class="btn btn-xs btn-primary " href="<?php echo base_url(); ?>index.php/Raw_material/add">
          <i class="fa fa-plus"> Add New Raw Material</i></a>
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
           <tr>
                <th > Sr.No.</th>
                <th>Raw Material Name</th>
                
                <th> Grade</th>
				<th> Code</th>
                <th> Unit</th>
               
                <th> Action</th>
              </tr>
          </thead>
          <tbody>
           <?php $i=1;foreach($rms as $obj) { ?>
              <tr>
                <td><?= $i ?></td>
               
                <td><?= $obj['rm_name'].' ('.$obj['code'].')'?></td>
                <td><?= $obj['grade']?></td>
                <td><?= $obj['code']?></td>
                <td><?= $obj['unit']?></td>
                
                
                <td >
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Raw_material/add/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
                </td>
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Raw_material/deleterm/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete Raw Material <b><?php echo $obj['rm_name'];?> </b>? </p>
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