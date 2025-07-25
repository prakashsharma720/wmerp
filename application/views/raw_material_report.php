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
        <form method="post" action="<?php echo base_url(); ?>index.php/Raw_material/createXLS">
			
		<input type="hidden" value="1" name="categories_id">
           <button type="submit" class="btn btn-info"> <?=$this ->lang ->line('export')?></button>
         </form>
        <!-- <a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Suppliers/createXLS">Export</a>   -->
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
	
	
            <hr>

      <div class="table-responsive">
        <table  class="table table-bordered table-striped" >
          <thead>
            <tr >
              <th> <?=$this ->lang ->line('supplier_name')?> </th>
			   <th> <?=$this ->lang ->line('name')?> </th>
              <th> <?=$this ->lang ->line('code')?> </th>
              <th> <?=$this ->lang ->line('classification')?></th>
              <th> <?=$this ->lang ->line('grade')?></th>
              
      
              <!-- <th style="white-space: nowrap;">Bank Name</th>
              <th> Account No</th>
              <th  style="white-space: nowrap;"> Service State</th>
              <th style="white-space: nowrap;">Approval Date</th>
              <th style="white-space: nowrap;"> Next Evalution</th> -->
            </tr>
          </thead>
          <tbody >
           <?php
          $i=1;foreach($rawmaterials as $obj){ ?>
              <tr>
                <!-- <td><?php echo $i;?></td> -->
                <td><?php echo $obj['supplier']; ?></td>
                <td><?php echo $obj['name']; ?></td>
                <td><?php echo $obj['code']; ?></td>
                <td><?php echo $obj['grade']; ?></td>
                <td><?php echo $obj['grade_name']; ?></td>
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