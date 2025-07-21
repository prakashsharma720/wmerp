<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    .control-label {
margin: 0.7rem
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
        <h3 class="card-title"><?= $this->lang->line('holidays_master') ?></h3>
        <div class="pull-right ">
            

                <!-- <span class="error_mesg"><?php echo $this->session->flashdata('failed'); ?></span> -->
        </div>
		
          </div> <!-- /.card-body -->
		  
            <div class="card-body">
				
                <div class="row">
					
            <?php
              if($designation_id=='1' )
              { ?>
                    <div class="col-md-6">
                        <?php  //echo $title; exit; ?>
                        <?php if(!empty($id)) { ?>
                            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leave/editHoliday/<?= $id ?>">
                                <input type="hidden" name="category_id" value="<?= $id?>">
                                <?php } else { ?>
                            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leave/add_new_leave">
                                <?php } ?>
                        <div class="form-group">                                
                              <div class="row col-md-12">
                                <div class="col-md-12 col-sm-12 ">
                                    <label class="control-label "><?= $this->lang->line('title_name') ?></label>
                                    <input type="text"  placeholder="<?= $this->lang->line('enter_title_name') ?>" name="title" class="form-control" value="<?= $title?>" required autofocus>
                                </div>
                                <?php 
                                 if(!empty($date))
                                 { 
                                    $holiday_date = date('d-m-Y',strtotime($date)); 
                                 }
                                  else { 
                                    $holiday_date = date('d-m-Y');
                                  }; 
                                 ?>
								 
                            <div class="col-md-12 col-sm-12">
                            <label  class="control-label"> <?= $this->lang->line('date') ?></label>
                            <input type="text" value="<?= $holiday_date ?>" data-date-formate="dd-mm-yyyy" name="holiday_date" class="form-control date-picker" placeholder="dd-mm-yyyy"  autocomplete="off" autocomplete="off">
                    </div>
                            </div>
                            <span class="help-block"></span>
                            <?php if(!empty($id)) { ?>
                           <div class="row col-md-12">
                                <div class="col-md-12 col-sm-12 ">
                                    <label class="control-label"> <?= $this->lang->line('status') ?> </label>
                                   <select class="form-control" name="flag">
                                        <option value="0"> Active</option>
                                        <option value="1"> De-active</option>
                                   </select>
                                </div>
                            </div>
                        <?php } ?>
                           <div class="row col-md-12">
                                <div class="col-md-12 col-sm-12 ">
                                    <label class="control-label" style="visibility: hidden;"> <?= $this->lang->line('name') ?></label><br>
                                    <button type="submit"  class="btn btn-primary btn-block" ><?= $this->lang->line('submit') ?></button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <?php }?>
                 <!-- /form -->
                    <?php
              if($designation_id=='1' )
              { ?>
                <div class="col-md-6">
                <?php } else {?>
            <div class="col-md-12">
                <?php } ?>
                    <h5><?= $this->lang->line('holiday_list') ?></h5>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> <?= $this->lang->line('sr_no') ?></th>
                                <th style="width:70%;"> <?= $this->lang->line('title') ?></th>
                                <th style="width:30%;"><?= $this->lang->line('date') ?></th>
                                <?php if(($role_id !='5') && ($role_id !='4')) { ?>
                                <th> <?= $this->lang->line('action') ?></th>
                                <?php }?>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;foreach($categories as $category) {{ ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $category['title']?></td>
                                <td><?= $category['date']?></td>
                                <?php if(($role_id !='5') && ($role_id !='4')) { ?>
                                <td>
                                <div class="hstack gap-2 justify-content-end">
                                 <a href="<?php echo base_url(); ?>index.php/Leave/holidays/<?php echo $category['id']; ?>" 
                                            class="avatar-text avatar-md" >
                                            <i class="feather feather-edit-3 "></i>
                                            </a>
                                <a class="avatar-text avatar-md" data-bs-toggle="offcanvas" data-bs-target="#deleteHoliday<?php echo $category['id']; ?>">
                                    <i class="feather feather-trash"></i>
                                </a>
                            <?php }?>
                            </td>
                                <?php }?>
        

        </a>
     
    </div>
</td>

                            </tr>
                            <div class="offcanvas offcanvas-end" tabindex="-1" id="deleteHoliday<?php echo $category['id']; ?>">
    <form method="post" action="<?php echo base_url(); ?>index.php/Leave/deleteHoliday/<?php echo $category['id']; ?>">
        <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
            <h2 class="fs-16 fw-bold"><?= $this->lang->line('confirm') ?></h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <p><?= $this->lang->line('confirm_delete') ?>: <b><?= $category['title'] ?></b>?</p>
        </div>
        <div class="px-4 gap-2 d-flex align-items-center ht-80 border-top border-gray-2 ">
            <button type="submit" class="btn btn-primary w-50 "> <?= $this->lang->line('yes') ?> </button>
            <a href="javascript:void(0);" class="btn btn-danger w-50 " data-bs-dismiss="offcanvas"> <?= $this->lang->line('cancel') ?></a>
        </div>
        
    </form>
</div>

                        <?php $i++;} ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


