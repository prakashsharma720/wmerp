

<div class="nxl-content">
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('finish_goods_list'); ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
				</li>
				<!-- <li class="breadcrumb-item"><?= $this->lang->line('leave_history') ?> -->
				</li>
			</ul>
		</div>

		<div class="page-header-right ms-auto">
			<div class="page-header-right-items">
          <?php $this->load->view('layout/alerts'); ?>
			</div>

			<!-- Mobile Toggle -->
			<div class="d-md-none d-flex align-items-center">
				<a href="javascript:void(0)" class="page-header-right-open-toggle">
					<i class="feather-align-right fs-20"></i>
				</a>
			</div>
		</div>
	</div>
	<div class="card-body p-3 bg-white">
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
               <td>
  <div class="d-flex gap-1">
    <a class="border rounded bg-light shadow-sm text-dark px-1 py-0" href="<?php echo base_url(); ?>index.php/Finish_goods/edit/<?php echo $obj['id']; ?>">
      <i class="feather feather-edit-3"></i>
    </a>
    <a class="border rounded bg-light shadow-sm text-dark px-1 py-0" data-toggle="modal" data-target="#delete<?php echo $obj['id']; ?>">
      <i class="fa fa-trash"></i>
    </a>
  </div>
</td>


                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Finish_goods/deleteFG/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?= $this->lang->line('confirm_header') ?>r </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p><?= $this->lang->line('confirm_delete') ?>  <b><?php echo $obj['grade_name'];?> </b>? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary delete_submit"> <?= $this->lang->line('yes') ?> </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> <?= $this->lang->line('no') ?> </button>
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















