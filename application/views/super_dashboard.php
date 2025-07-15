<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<?php 
   $monthdata=[];

   $date=[];
      foreach($getAll as $all){
        $monthdata[]= $all['date'];
        
            // $data=implode(',',$monthdata);
          $result="'".date('M',strtotime($all['date']))."'";
          $hh=implode(',',(array)$result);
         
        }
        // print_r ($hh);
         
       
      
        
        // echo implode(",",$monthdata);

          //  echo date('M',strtotime($all[$key]['date']));
          // print_r($id);
        

   
   ?>
<style>
#my-pie-chart-container {
    display: flex;
    align-items: center;
}

#my-pie-chart {
    background: conic-gradient(brown 0.00%, black 0.00% 0.55%, blue 0.55% 6.08%, green 6.08% 13.68%, yellow 13.68% 23.27%, orange 23.27% 40.47%, red 40.47%);
    border-radius: 50%;
    width: 150px;
    height: 150px;
}

#legenda {
    margin-left: 20px;
    background-color: #f1ecec;
    padding: 5px;
}

.entry {
    display: flex;
    align-items: center;
}

.entry-color {
    height: 10px;
    width: 30px;
}

.entry-text {
    margin-left: 5px;
    white-space: nowrap;
}

#color-red {
    background-color: red;
}

#color-orange {
    background-color: #f39c12;
}

#color-yellow {
    background-color: yellow;
}

#color-green {
    background-color: #00a65a;
}

#color-blue {
    background-color: #00c0ef;
}

#color-black {
    background-color: #3c8dbc;
}

#color-brown {
    background-color: red;
}

.leadcurrent {

    border-bottom: 1px solid black;
    width: 168px;
    margin-left: 81px;
}

.card1:hover {
    background-color: #555;
}

.btn {
    display: inline-block !important;
}

.btn-tool {
    background-color: #777;
    color: white;
    cursor: pointer;


    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
}

.space {
    margin: 10px;
    padding: 10px;
}

.btn-tool:hover {
    background-color: green;
}

.widget-user .widget-user-header {
    padding: 14px;
    height: 54px;
}

@keyframes blink {

    0%,
    100% {
        opacity: 1;
    }

    50% {
        opacity: 0;
    }
}

.fa-bullhorn {
    display: inline-block;
    animation: blink 1s infinite;
}

/* @keyframes slideDown {
    from { transform: translateY(-100%); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.mark-as-read {
    display: inline-block;
    animation: slideDown 5s infinite ease-in-out;
} */

.unread-message {
    background-color: #ffeeba;
    /* Light yellow background */
    border-left: 5px solid #ffc107;
    /* Yellow border */
    font-weight: bold;
}

.read-message {
    background-color: #f8f9fa;
    /* Light grey background */
    color: #6c757d;
    /* Muted text */
}

.hide {
    display: none !important;
}
</style>

<script>
var coll = document.getElementsByClassName("btn-tool");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
            content.style.display = "none";
        } else {
            content.style.display = "block";
        }
    });
}
</script>
<?php if($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> Success!</h5>
    <?php echo $this->session->flashdata('success'); ?>
</div>
<!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
<?php endif; ?>

<?php if($this->session->flashdata('failed')): ?>
<div class="alert alert-error alert-dismissible ">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> Alert!</h5>
    <?php echo $this->session->flashdata('failed'); ?>
</div>
<?php endif; ?>


<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><?= $title ?> </h3>
                <div class="pull-right ">

                </div>
            </div>
            <div class="card-body">

                <div class="container">
                    <div class="row">
                        <div class="col-8 col-sm-12 col-md-12">
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-danger text-white d-flex align-items-center">
                                    <i class="fa fa-bullhorn mr-2"></i>
                                    <span class="font-weight-bold"><?= $this->lang->line('urgent_announcements') ?></span>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-widget="collapse">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-widget="remove">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body bg-white">
                                    <?php foreach ($broadcasts as $index => $broadcast): ?>
                                    <?php $isRead = $broadcast['is_read'] ? 'read-message' : 'unread-message'; ?>

                                    <div class="alert p-3 <?= $isRead; ?>">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="broadcast_box"><strong>🔴
                                                    <?= htmlspecialchars($broadcast['message']); ?></strong></span>
                                            <button
                                                class="btn btn-sm btn-warning mark-as-read <?= $broadcast['is_read'] ? 'hide' : ''; ?>"
                                                data-id="<?= $broadcast['id']; ?>"><?= $this->lang->line('mark_as_read') ?></button>
                                        </div>
                                        <!-- Date/Time at Bottom -->
                                        <p class="text-sm text-muted mt-2 mb-0">
                                            <i class="fa fa-clock-o mr-1"></i>
                                            <?php $timeAgo = strtotime($broadcast['date_time']); echo time_Ago($timeAgo); ?>
                                        </p>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if ($role_id=='3'){?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <h5 style="float:left;margin-right: 338px;"> 
                                            <?= $this->lang->line('todays_assigned_leads_to_followups') ?> :
                                            <?= $todaytarget ?></h5>
                                    </h5>

                                    <div class="card-tools" style="margin-top:19px;">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"><i
                                        class="fa fa-google-plus"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"><?= $this->lang->line('followups') ?></span>
                                    <span class="info-box-number"><?php echo $leadsFollowups;?></span>
                                </div>

                            </div>

                        </div>

                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i
                                        class="fa fa-shopping-cart"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Approved</span>
                                    <span class="info-box-number"><?php echo $ApprovedLeads?></span>
                                </div>

                            </div>

                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Rejected</span>
                                    <span class="info-box-number"><?php echo $RejectedLeads;?></span>
                                </div>

                            </div>

                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"><i
                                        class="fa fa-google-plus"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Pending</span>
                                    <span class="info-box-number"><?php echo $pendingLeads;?></span>
                                </div>

                            </div>

                        </div>

                    </div>





                    <div class="row">


                        <?php 
										if($role_id=='2'||$role_id=="1") {
                        
                    ?>

                        <div class="col-md-6">

                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="card card-widget widget-user" style="width:205%">
                                <div class="widget-user-header bg-info-active">
                                    <center>
                                        <h2 class="widget-user-username"><b> <?= $this->lang->line('leads') ?></b></h2>
                                    </center>

                                </div>

                                <div class="card-footer">
                                    <div class="row">

                                        <div class="col-sm-4 border-right">

                                            <div class="description-block">
                                                <!-- (<?php echo $totalleads  ?>) -->
                                                <center class="leadcurrent">
                                                    <label><?= $this->lang->line('current') ?></label>&nbsp;<label>(<?php echo $todayleads  ?>)</label>
                                                </center>

                                                <span>( <?= $this->lang->line('not_review') ?>)</span>
                                                <div style="margin-top: 7px;">
                                                    <div class="border-right" style=" margin-left:10px;">
                                                        <!-- <h5 class="info-box-number">  <?php echo $totalleads-$duplicatelead  ?></h5> -->
                                                        <h5 class="info-box-number">
                                                            <?php echo  $actuallead= $todayleads - $isduplicateleads  ?>
                                                        </h5>
                                                        <!-- <span class="info-box-number"> <?php echo $totalleads-$duplicatelead  ?></span> -->

                                                        <span class="info-box-text"><?= $this->lang->line('actual') ?> &nbsp;&nbsp;</span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                        <h5 class="info-box-number"><?php echo $isduplicateleads  ?>
                                                        </h5>
                                                        <!-- <h5 class="info-box-number"> <?php echo $duplicatelead  ?></h5> -->
                                                        <span class="info-box-text"> <?= $this->lang->line('duplicate') ?></span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                         <?php
                                                            $sort=0;
                                                            $sortlead=$actuallead +$isduplicateleads; 
                                                        ?>
                                                        <?php foreach($target as $tar){?>
                                                        
                                                      <h5 class="info-box-number"><?php  $shortlead=$tar['target']-$sortlead;?></h5>
                                                      <h5 class="info-box-number"><?php $todayshotlead=$shortlead+$sort;?></h5>
                                                    
                                                      <?php }?>
                                                      <h5 class="info-box-number"><?php echo $todayshotlead?></h5>
                                                        <span class="info-box-text"> <?= $this->lang->line('target_short') ?></span> 
                                                    </div>
                                                    <div style="margin-left:10px; margin-bottom:-20px;">
                                                        <h5 class="info-box-number"><?php echo $todayleads  ?></h5>
                                                        <!-- <h5 class="info-box-number"> <?php echo $duplicatelead  ?></h5> -->
                                                        <span class="info-box-text"> <?= $this->lang->line('total') ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <center class="leadcurrent">
                                                    <label>Yesterday</label>&nbsp;<label>(<?php echo $yesterdayLeads  ?>)</label>
                                                </center>
                                                <div style="margin-top: 7px;">
                                                    <div class="border-right" style="margin-left:10px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo  $yesterdayactual= $yesterdayLeads - $yesterdayduplicateLeads  ?>
                                                        </h5>
                                                        <span class="info-box-text"><?= $this->lang->line('actual') ?> &nbsp;&nbsp;</span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo $yesterdayduplicateLeads  ?></h5>
                                                        <span class="info-box-text"> <?= $this->lang->line('duplicate') ?></span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                        <?php 
                                                            $sort=0;
                                                            $yesterdaysort=$yesterdayactual+$yesterdayduplicateLeads;
                                                            ?>
                                                        <?php foreach($target as $tar){?>
                                                        <?php $ysort=$tar['target']- $yesterdaysort ?>
                                                        <h5 class="info-box-number"><?php $yshortleads= $ysort+$sort ?>
                                                        </h5>
                                                        <?php }?>
                                                        <h5 class="info-box-number"><?php echo $yshortleads?></h5>
                                                        <span class="info-box-text"> <?= $this->lang->line('target_short') ?></span>
                                                    </div>
                                                    <div style="margin-left:10px; margin-bottom:-20px;">
                                                        <h5 class="info-box-number"><?php echo $yesterdayLeads  ?></h5>
                                                        <span class="info-box-text"> <?= $this->lang->line('total') ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-sm-4">

                                            <div class="description-block">
                                                <center class="leadcurrent"> <label>
                                                        <?= $this->lang->line('month') ?></label>&nbsp;<label>(<?php echo $thismonthleads  ?>)</label>
                                                </center>
                                                <div style="margin-top: 7px;">
                                                    <div class="border-right" style=" margin-left: 10px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo $monthctual=$thismonthleads-$thismonthduplicate  ?>
                                                        </h5>
                                                        <span class="info-box-text">Actual &nbsp;&nbsp;</span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                        <h5 class="info-box-number"><?php echo $thismonthduplicate  ?>
                                                        </h5>
                                                        <span class="info-box-text"> <?= $this->lang->line('duplicate') ?></span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                        <?php 
                          $sort=0;
                          $monthsort=$monthctual+$thismonthduplicate;
                          ?>
                                                        <?php foreach($target as $tar){?>
                                                        <?php  $msort=$tar['target']-$monthsort;  ?>
                                                        <h5 class="info-box-number"><?php $msortlead= $msort+$sort;  ?>
                                                        </h5>

                                                        <?php }?>
                                                        <h5 class="info-box-number"><?php echo $msortlead  ?></h5>
                                                        <span class="info-box-text"> <?= $this->lang->line('target_short') ?></span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                        <h5 class="info-box-number"><?php echo $thismonthleads  ?></h5>
                                                        <span class="info-box-text"> <?= $this->lang->line('total') ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>


                    <?php }} else if($role_id=='2' ||$role_id=='1' || $role_id=='4'){?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <h5 style="float:left;margin-right: 309px;"> <?= $this->lang->line('todays_assigned_leads_to_followups') ?>
                                            : <?= $assignLeads ?></h5>
                                    </h5>
                                    <h5 class="card-title">

                                        <h5 style="color:yellow;"><a
                                                href="<?php echo base_url()?>index.php/Leads_marketing/Nofollowupsview"
                                                data-bs-placement="top"
                                                title="Click Here to view about No Followups Taken"> <?= $this->lang->line('last_update_on_days') ?> : <?= $datedifference ?></a></h5>
                                    </h5>
                                    <div class="card-tools" style="margin-top:19px;">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <?php if($role_id=='1'||$role_id=='2'||$role_id=='3') {?>


                    <div class="row">


                        <div class="col-md-6">

                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="card card-widget widget-user" style="width:200%">
                                <div class="widget-user-header bg-info-active">
                                    <center>
                                        <h2 class="widget-user-username"><b> <?= $this->lang->line('leads') ?></b></h2>
                                    </center>

                                </div>

                                <div class="card-footer">
                                    <div class="row">

                                        <div class="col-sm-4 border-right">

                                            <div class="description-block">
                                                <!-- (<?php echo $totalleads  ?>) -->
                                                <center class="leadcurrent">
                                                    <label><?= $this->lang->line('current') ?></label>&nbsp;<label>(<?php echo $todayleads  ?>)</label>
                                                </center>

                                                <span>( <?= $this->lang->line('not_review') ?>)</span>
                                                <div style="margin-top: 7px;">
                                                    <div class="border-right" style=" margin-left:10px;">
                                                        <!-- <h5 class="info-box-number">  <?php echo $totalleads-$duplicatelead  ?></h5> -->
                                                        <h5 class="info-box-number">
                                                            <?php echo  $actuallead= $todayleads - $isduplicateleads  ?>
                                                        </h5>
                                                        <!-- <span class="info-box-number"> <?php echo $totalleads-$duplicatelead  ?></span> -->

                                                        <span class="info-box-text"><?= $this->lang->line('actual') ?> &nbsp;&nbsp;</span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                        <h5 class="info-box-number"><?php echo $isduplicateleads  ?>
                                                        </h5>
                                                        <!-- <h5 class="info-box-number"> <?php echo $duplicatelead  ?></h5> -->
                                                        <span class="info-box-text"> <?= $this->lang->line('duplicate') ?></span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                         <?php
                                                        $sort=0;
                                                        $sortlead=$actuallead +$isduplicateleads; 
                                                        ?>
                                                        <?php foreach($target as $tar){?>
                                                        
                                                      <h5 class="info-box-number"><?php  $shortlead=$tar['target']-$sortlead;?></h5>
                                                      <h5 class="info-box-number"><?php $todayshotlead=$shortlead+$sort;?></h5>
                                                    
                                                      <?php }?>
                                                      <h5 class="info-box-number"><?php echo $todayshotlead?></h5>
                                                        <span class="info-box-text"> <?= $this->lang->line('target_short') ?></span> 
                                                    </div>
                                                    <div style="margin-left:10px; margin-bottom:-20px;">
                                                        <h5 class="info-box-number"><?php echo $todayleads  ?></h5>
                                                        <!-- <h5 class="info-box-number"> <?php echo $duplicatelead  ?></h5> -->
                                                        <span class="info-box-text"> <?= $this->lang->line('total') ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <center class="leadcurrent">
                                                    <label><?= $this->lang->line('yesterday') ?></label>&nbsp;<label>(<?php echo $yesterdayLeads  ?>)</label>
                                                </center>
                                                <div style="margin-top: 7px;">
                                                    <div class="border-right" style="margin-left:10px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo  $yesterdayactual= $yesterdayLeads - $yesterdayduplicateLeads  ?>
                                                        </h5>
                                                        <span class="info-box-text"><?= $this->lang->line('actual') ?> &nbsp;&nbsp;</span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo $yesterdayduplicateLeads  ?></h5>
                                                        <span class="info-box-text"> <?= $this->lang->line('duplicate') ?></span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                        <?php 
                                                          $sort=0;
                                                          $yesterdaysort=$yesterdayactual+$yesterdayduplicateLeads;
                                                          $yshortleads=0;
                                                          ?>
                                                        <?php foreach($target as $tar){?>
                                                        <?php $ysort=$tar['target']- $yesterdaysort ?>
                                                        <h5 class="info-box-number"><?php $yshortleads= $ysort+$sort ?>
                                                        </h5>
                                                        <?php }?>
                                                        <h5 class="info-box-number"><?php echo $yshortleads?></h5>


                                                        <span class="info-box-text"> <?= $this->lang->line('target_short') ?></span>
                                                    </div>
                                                    <div style="margin-left:10px; margin-bottom:-20px;">
                                                        <h5 class="info-box-number"><?php echo $yesterdayLeads  ?></h5>
                                                        <span class="info-box-text"> <?= $this->lang->line('total') ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-sm-4">

                                            <div class="description-block">
                                                <center class="leadcurrent"> <label>
                                                <?= $this->lang->line('month') ?></label>&nbsp;<label>(<?php echo $thismonthleads  ?>)</label>
                                                </center>
                                                <div style="margin-top: 7px;">
                                                    <div class="border-right" style=" margin-left: 10px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo $monthctual=$thismonthleads-$thismonthduplicate  ?>
                                                        </h5>
                                                        <span class="info-box-text"><?= $this->lang->line('actual') ?> &nbsp;&nbsp;</span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                        <h5 class="info-box-number"><?php echo $thismonthduplicate  ?>
                                                        </h5>
                                                        <span class="info-box-text"> <?= $this->lang->line('duplicate') ?></span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                        <?php 
                                                          $sort=0;
                                                          $monthsort=$monthctual+$thismonthduplicate;
                                                           $msortlead=0;

                                                                  ?>
                                                        <?php foreach($target as $tar){?>
                                                        <?php  $msort=$tar['target']-$monthsort;  ?>
                                                        <h5 class="info-box-number"><?php $msortlead= $msort+$sort;  ?>
                                                        </h5>

                                                        <?php }?>
                                                        <h5 class="info-box-number"><?php echo $msortlead  ?></h5>

                                                        <span class="info-box-text"> <?= $this->lang->line('target_short') ?></span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                        <h5 class="info-box-number"><?php echo $thismonthleads  ?></h5>
                                                        <span class="info-box-text"> <?= $this->lang->line('total') ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <?php }?>
                    <?php   if($role_id=='2' ||$role_id=='1'||$role_id=='4'){?>
                    <div class="row">


                        <div class="col-md-6">

                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="card card-widget widget-user" style="width:205%">
                                <div class="widget-user-header bg-info-active">
                                    <center>
                                        <h2 class="widget-user-username"><b> <?= $this->lang->line('lead_marketing') ?></b></h2>
                                    </center>

                                </div>

                                <div class="card-footer">
                                    <div class="row">

                                        <div class="col-sm-4 border-right">

                                            <div class="description-block">
                                                <!-- (<?php echo $totalleads  ?>) -->
                                                <center class="leadcurrent">
                                                    <label>Current</label>&nbsp;<label>(<?php echo $todayMarketingleads  ?>)</label>
                                                </center>

                                                <span>( Not Review)</span>
                                                <div style="margin-top: 7px;">
                                                    <div class="border-right" style=" margin-left:10px;">

                                                        <h5 class="info-box-number">
                                                            <?php echo  $NoactionmarketingLead  ?></h5>


                                                        <span class="info-box-text">No Action &nbsp;&nbsp;</span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo $inProgressMarketingLeads  ?></h5>

                                                        <span class="info-box-text">Inprogress</span>
                                                    </div>
                                                    <!-- <div  style="margin-left:10px;">
                        
                       <h5 class="info-box-number"><?php echo $todayleads-$sortlead?></h5>
                     
                        <span class="info-box-text">Last Update</span>
                       </div>  -->
                                                    <div style="margin-left:10px; margin-bottom:-20px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo $DeclinedMarketingLeads  ?></h5>

                                                        <span class="info-box-text">Declined</span>
                                                    </div>
                                                    <div style="margin-left:10px; margin-top:20px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo $ConvertedMarketingLeads  ?></h5>

                                                        <span class="info-box-text">Converted</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <center class="leadcurrent">
                                                    <label>Yesterday</label>&nbsp;<label>(<?php echo $yesterdayMarketingLeads  ?>)</label>
                                                </center>
                                                <div style="margin-top: 7px;">
                                                    <div class="border-right" style="margin-left:10px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo $yesterdayNoactionmarketingLead  ?></h5>
                                                        <span class="info-box-text">No Action &nbsp;&nbsp;</span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo $inProgressYesterdayMarketingLeads  ?></h5>
                                                        <span class="info-box-text">Inprogress</span>
                                                    </div>
                                                    <!-- <div  style="margin-left:10px;">
                          <h5 class="info-box-number"><?php echo $yesterdayLeads-($yesterdayactual+$yesterdayduplicateLeads)  ?></h5>
                          <span class="info-box-text">Last Update</span>
                        </div>  -->
                                                    <div style="margin-left:10px; margin-bottom:-20px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo $DeclinedYesterdayMarketingLeads  ?></h5>
                                                        <span class="info-box-text">Declined</span>
                                                    </div>
                                                    <div style="margin-left:10px; margin-top:40px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo $ConvertedYesterdayMarketingLeads  ?></h5>

                                                        <span class="info-box-text"> Converted</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-sm-4">

                                            <div class="description-block">
                                                <center class="leadcurrent"> <label>
                                                        Month</label>&nbsp;<label>(<?php echo $thismonthMarketingleads  ?>)</label>
                                                </center>
                                                <div style="margin-top: 7px;">
                                                    <div class="border-right" style=" margin-left: 10px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo $thismonthNoActionMarketingLeads  ?></h5>
                                                        <span class="info-box-text"><?= $this->lang->line('no_action') ?> &nbsp;&nbsp;</span>
                                                    </div>
                                                    <div style="margin-left:10px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo $thismonthinProgressMarketingLeads  ?></h5>
                                                        <span class="info-box-text">Inprogress</span>
                                                    </div>
                                                    <!-- <div  style="margin-left:10px;">
                           <h5 class="info-box-number"><?php echo $thismonthleads-($monthctual+$thismonthduplicate)  ?></h5>
                           <span class="info-box-text">Last Update</span>
                       </div>  -->
                                                    <div style="margin-left:10px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo $thismonthinDeclinedMarketingLeads  ?></h5>
                                                        <span class="info-box-text"><?= $this->lang->line('declined') ?></span>
                                                    </div>
                                                    <div style="margin-left:10px; margin-top:20px;">
                                                        <h5 class="info-box-number">
                                                            <?php echo $thismonthConvertedMarketingLeads  ?></h5>

                                                        <span class="info-box-text"> <?= $this->lang->line('converted') ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>



                        </div>

                        <?php } ?>




                        <?php 
										if($role_id =='4') {
                        
                    ?>
                        <div class="table-responsive">

                            <table id="example" class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th colspan="6" style="background-color:#c7c6c6;">
                                            <center>
                                                <h2>Scheduled Reminder</h2>
                                            </center>
                                        </th>
                                    </tr>
                                    <tr style="text-align:center;">


                                        <th> <?= $this->lang->line('sr_no') ?>.</th>
                                        <th> <?= $this->lang->line('lead_id') ?></th>
                                        <th> <?= $this->lang->line('title') ?></th>
                                        <th> <?= $this->lang->line('schedule_time') ?></th>
                                        <th> <?= $this->lang->line('status') ?></th>

                                        <th> <?= $this->lang->line('action') ?></th>


                                    </tr>
                                </thead>
                                <tbody> <?php
         
          if(!empty($getReminder)) 
          { 
            $i=1;foreach($getReminder as $key=>$obj) 
            {
              if(($key <5))
              { 
            ?>
                                    <tr style="text-align:center;">
                                        <td> <?= $i ?> </td>
                                        <td>
                                            <?php
          
              $voucher_no= $obj['lead_id'];
      
              if($voucher_no<10){
                $rs_id_code='MUSK000'.$voucher_no;
              } else if(($voucher_no>=10) && ($voucher_no<=99)){
                $rs_id_code='MUSK00'.$voucher_no;
              } else if(($voucher_no>=100) && ($voucher_no<=999)){
                $rs_id_code='MUSK0'.$voucher_no;
              } else{
                $rs_id_code='MUSK'.$voucher_no;
              }
      
              $datacode=$rs_id_code;	
         
              ?>


                                            <?=  $datacode?></td>
                                        <td><?= $obj['reminder_title']?></td>
                                        <td><?= $obj['reminder_date']?>&nbsp;<?= $obj['reminder_time']?></td>
                                        <td style="color:green;font-weight:700;"><?=$obj['status']
              
             ?>

                                        </td>
                                        <td>
                                            <?php 
            //  echo "<pre>"
             if((date('Y-m-d') >= $obj['reminder_date'] || date('H:i:s') >= $obj['reminder_time']) && ($obj['status']=='Active')){?>

                                            <center>
                                                <a class="btn  btn-success"
                                                    href="<?php echo base_url(); ?>index.php/Leads/complete/<?php echo $obj['id'];?>"><i
                                                        class="fa fa-check"></i>&nbsp;Complete</a>
                                                <a class="btn  btn-warning " data-toggle="modal"
                                                    data-target="#snooze<?php echo $obj['id'];?>"
                                                    title=" Edit Reminder">
                                                    <i class="fa fa-edit"></i>&nbsp;Snooze</a>
                                            </center>

                                            <?php }?>

                                            <!-- Reminder Modal -->
                                            <div class="modal fade" id="snooze<?php echo $obj['id'];?>" role="dialog">
                                                <div class="modal-dialog">

                                                    <form class="form-horizontal" role="form" method="post"
                                                        action="<?php echo base_url(); ?>index.php/Leads/reminderedit/<?php echo $obj['id'];?>">

                                                        <input type="hidden" name="lead_id" value="<?= $obj["id"]?>">

                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"> <?= $this->lang->line('edit_remainder') ?> </h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="row col-md-12">


                                                                <div class="col-md-6">
                                                                    <label class="control-label"><?= $this->lang->line('select_date') ?> </label>
                                                                    <span class="required">*</span>

                                                                    <input type="date" class="form-control reminder"
                                                                        id="rdate" name="reminder_date"
                                                                        value="<?php echo $obj['reminder_date'];?>"
                                                                        required="required">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="control-label"> <?= $this->lang->line('time') ?></label><span
                                                                        class="required">*</span>

                                                                    <input type="time" id="reminder_time"
                                                                        name="reminder_time" min="10`:00" max="18:00"
                                                                        class="form-control"
                                                                        value="<?php echo  $obj['reminder_time']?>"
                                                                        required="required">
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success"> <?= $this->lang->line('snooze') ?>
                                                                </button>
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal"> <?= $this->lang->line('cancel') ?> </button>
                                                            </div>
                                                        </div>

                                                    </form>

                                                </div>
                                            </div>

                                        </td>


                                    </tr>
                                    <?php  $i++;}}
          }
          else{ ?>


                                    <tr>
                                        <td colspan="100">
                                            <h5 style="text-align: center;"> No Leads Found</h5>
                                        </td>
                                    </tr>
                                    <?php }?>
                                    <tr>
                                        <td colspan="6" style="text-align:right">
                                            <a href="<?php echo base_url(); ?>index.php/Notifications/allreminder"
                                                class="dropdown-item dropdown-footer"><label style="color:#cb1629">See
                                                    All Reminders</label></a>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>



                        </div>

                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ($auth_id=='1'||$auth_id=='2'||$auth_id=='3'){?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- AREA CHART -->
                <div class="card card-primary" style="display:none;">
                    <div class="card-header">
                        <h3 class="card-title">Area Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="areaChart" style="height:250px"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- DONUT CHART -->
                <div class="card card-danger">
                    <div class="card-header ">
                        <h3 class="card-title"> Today's Lead </h3>


                    </div>

                </div>
            </div>
            <div class="card-body">
                <div>

                    <div id="my-pie-chart-container" style="margin-left:151px;">

                        <div id="legenda">
                            <div class="entry">
                                <div id="color-brown" class="entry-color"></div>
                                <div class="entry-text">Target Short</div>
                            </div>
                            <div class="entry">
                                <div id="color-black" class="entry-color"></div>
                                <div class="entry-text">Total Leads</div>
                            </div>
                            <div class="entry">
                                <div id="color-blue" class="entry-color"></div>
                                <div class="entry-text">Today Lead</div>
                            </div>
                            <div class="entry">
                                <div id="color-green" class="entry-color"></div>
                                <div class="entry-text">Actual Lead</div>
                            </div>
                            <div class="entry">
                                <div id="color-orange" class="entry-color"></div>
                                <div class="entry-text">Duplicate Lead</div>
                            </div>

                        </div>
                    </div>
                </div>
                <canvas id="pieChart"
                    style="width:70% !important;height:50% !important;margin-top: -145px;margin-left: 174px;"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->



        <!-- /.col (LEFT) -->
        <div class="row">
            <div class="col-md-12">
                <!-- LINE CHART -->
                <div class="card card-info" style="display:none">
                    <div class="card-header">
                        <h3 class="card-title">Line Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="lineChart" style="height:250px"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- BAR CHART -->
                <div class="card card-success">
                    <div class="card-header ">
                        <h3 class="card-title">Month Wise Leads</h3>

                        <!-- <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div> -->
                    </div>
                    <div class="card-body">
                        <div id="my-pie-chart-container" style="margin-left:315;">

                            <div id="legenda" style='margin-top: -353px; margin-right:300px;margin-left:115px;'>
                                <div class="entry">
                                    <div id="color-brown" class="entry-color"></div>
                                    <div class="entry-text">Target Short</div>
                                </div>
                                <div class="entry">
                                    <div id="color-blue" class="entry-color"></div>
                                    <div class="entry-text">Month Total Lead</div>
                                </div>
                                <div class="entry">
                                    <div id="color-green" class="entry-color"></div>
                                    <div class="entry-text">Actual Lead</div>
                                </div>
                                <div class="entry">
                                    <div id="color-orange" class="entry-color"></div>
                                    <div class="entry-text">Duplicate Lead</div>
                                </div>

                            </div>
                            <div class="chart">
                                <canvas id="barChart" style="width:600px !important;height:600px !important;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col (RIGHT) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
</section>
<!-- /.content -->
<?php }?>
<?php 
                          $sort=0;
                          $monthsort=$monthctual+$thismonthduplicate;
                          ?>
<?php foreach($target as $tar){?>
<?php  $msort=$tar['target']-$monthsort;  ?>
<?php }?>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/chartjs-old/Chart.min.js"></script>
<script>
$(document).ready(function() {
    $(".mark-as-read").click(function() {
        var button = $(this);
        var broadcastId = $(this).data("id");
        var userId = "<?= $this->session->userdata['logged_in']['id'];?>"; // Get logged-in user ID

        $.ajax({
            url: "<?= base_url('index.php/Broadcast/mark_as_read'); ?>",
            type: "POST",
            data: {
                broadcast_id: broadcastId,
                user_id: userId
            },
            success: function(response) {
                if (response == "success") {
                    button.closest(".alert").removeClass("unread-message").addClass(
                        "read-message");
                    button.remove(); // Remove "Mark as Read" button
                    alert("Marked as read!");
                    location.reload(); // Refresh UI
                } else {
                    alert("Failed to mark as read.");
                }
            }
        });
    });
});
</script>


<script>
$(function() {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart = new Chart(areaChartCanvas)

    var areaChartData = {
        labels: [<?php echo $hh?>],
        datasets: [{
                label: 'Electronics',
                fillColor: ' #00c0ef',
                strokeColor: ' #00c0ef',
                pointColor: ' #00c0ef',
                pointStrokeColor: ' #00c0ef',
                pointHighlightFill: ' #00c0ef',
                pointHighlightStroke: ' #00c0ef',
                data: [<?php echo $thismonthleads?>]
            },
            {
                label: 'Digital Goods',
                fillColor: 'rgba(60,141,188,1)',
                strokeColor: 'rgba(60,141,188,1)',
                pointColor: 'rgba(60,141,188,1)',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: 'rgba(60,141,188,1)',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [<?php echo $monthctual=$thismonthleads-$thismonthduplicate?>]
            },
            {
                label: ' Goods',
                fillColor: 'rgb(243,156,18)',
                strokeColor: 'rgb(243,156,18)',
                pointColor: 'rgb(243,156,18)',
                pointStrokeColor: 'rgb(243,156,18)',
                pointHighlightFill: 'rgb(243,156,18)',
                pointHighlightStroke: 'rgb(243,156,18)',
                data: [<?php echo $thismonthduplicate ?>]
            },
            {
                label: ' profit',
                fillColor: 'red',
                strokeColor: 'red',
                pointColor: 'red',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [<?php echo $msort+$sort?>]
            }
        ]
    }

    var areaChartOptions = {
        //Boolean - If we should show the scale at all
        showScale: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: false,
        //String - Colour of the grid lines
        scaleGridLineColor: 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - Whether the line is curved between points
        bezierCurve: true,
        //Number - Tension of the bezier curve between points
        bezierCurveTension: 0.3,
        //Boolean - Whether to show a dot for each point
        pointDot: false,
        //Number - Radius of each point dot in pixels
        pointDotRadius: 4,
        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth: 1,
        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius: 20,
        //Boolean - Whether to show a stroke for datasets
        datasetStroke: true,
        //Number - Pixel width of dataset stroke
        datasetStrokeWidth: 2,
        //Boolean - Whether to fill the dataset with a color
        datasetFill: true,
        //String - A legend template
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChart = new Chart(lineChartCanvas)
    var lineChartOptions = areaChartOptions
    lineChartOptions.datasetFill = false
    lineChart.Line(areaChartData, lineChartOptions)

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart = new Chart(pieChartCanvas)
    var PieData = [{
            value: <?php echo $todayleads?>,
            color: '#00c0ef',
            highlight: '#00c0ef',
            label: 'Today Lead'
        },
        {
            value: <?php echo  $actuallead= $todayleads - $isduplicateleads  ?>,
            color: '#00a65a',
            highlight: '#00a65a',
            label: 'Today Actual'
        },
        {
            value: <?php echo $isduplicateleads  ?>,
            color: '#f39c12',
            highlight: '#f39c12',
            label: 'today Duplicate'
        },
        {
            value: <?php $sortlead=$actuallead +$isduplicateleads; 
                           ?>
            <?php foreach($target as $tar){?>
            <?php }?>
            <?php echo $tar['target']-$sortlead;?>,
            color: 'red',
            highlight: 'red',
            label: 'Target Short'
        },
        {
            value: <?php echo $todayleads?>,
            color: '#3c8dbc',
            highlight: '#3c8dbc',
            label: 'Total'
        },

    ]
    var pieOptions = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: '#fff',
        //Number - The width of each segment stroke
        segmentStrokeWidth: 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: 'easeOutBounce',
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //String - A legend template
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)


    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChart = new Chart(barChartCanvas)
    var barChartData = areaChartData
    barChartData.datasets[1].fillColor = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor = '#00a65a'
    var barChartOptions = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: true,
        //String - Colour of the grid lines
        scaleGridLineColor: 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - If there is a stroke on each bar
        barShowStroke: true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth: 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing: 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing: 1,
        //String - A legend template
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to make the chart responsive
        responsive: true,
        maintainAspectRatio: true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
})
</script>