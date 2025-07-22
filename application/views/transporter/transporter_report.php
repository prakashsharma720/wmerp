<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
      <label class="card-title"><?=$this ->lang ->line('transporters_report')?></label>
       <div class="pull-right error_msg">
        <a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Transporters/createXLS"><?= $this->lang->line('export') ?></a>  
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
    <div class="table-responsive">
        <table  class="table table-bordered table-striped" >
          <thead>
            <tr >
              <th><?=$this ->lang->line('name')?> </th>
              <th> <?=$this ->lang->line('code')?> </th>
              <th style="white-space: nowrap;"> <?=$this ->lang->line('contact_person')?></th>
              <th><?=$this ->lang->line('email')?></th>
              <th><?=$this ->lang->line('mobile_no')?></th>
              <th><?=$this ->lang->line('website')?></th>
              <th style="white-space: nowrap;"> <?=$this ->lang->line('approval_category')?></th>
              <!-- <th style="white-space: nowrap;">Bank Name</th>
              <th> Account No</th>
              <th  style="white-space: nowrap;"> Service State</th>
              <th style="white-space: nowrap;">Approval Date</th>
              <th style="white-space: nowrap;"> Next Evalution</th> -->
            </tr>
          </thead>
          <tbody >
           <?php
          $i=1;foreach($transporters as $obj){ ?>
              <tr>
                <!-- <td><?php echo $i;?></td> -->
                <td><?php echo $obj['transporter_name']; ?></td>
                <td><?php echo $obj['vendor_code']; ?></td>
                <td><?php echo $obj['contact_person']; ?></td>
                <td><?php echo $obj['email']; ?></td>
                <td><?php echo $obj['mobile_no']; ?></td>
                <td><?php echo $obj['website']; ?></td>
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
<!-- <script type="text/javascript">

    var url="<?php //echo base_url();?>";
    alert(url);
    function delete(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
          window.location = url+"index.php/welcome/deletetransporter/"+id;
        else
          return false;
        } 
</script> -->