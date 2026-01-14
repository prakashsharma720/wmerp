<?php 
$language = $this->session->userdata('site_language') ?? 'english';
$language_label = ucfirst($language);
  
/*$this->load->model('notifications_model');
$this->notifications_model->totalCount(); 
echo $totalCount;exit;*/
$CI =& get_instance(); // get global CI instance

$CI->load->model('Employee'); // load your user model

$allnotifications = $this->dynamic_menu->getNoti();

$user_id = $this->session->userdata['logged_in']['id'];
$role_id = $this->session->userdata['logged_in']['role_id'];
// echo $user_id;
// echo "<pre>";print_r($allnotifications);exit;
// echo count($allnotifications); exit;
get_instance()->load->helper('MY_array');
?>
<?php
if (isset($this->session->userdata['logged_in'])) {

    $userData = $CI->Employee->getById($user_id); // fetch fresh user data

$user_id = $userData['id'];
$username = $userData['username'];
$username = $userData['username'];
$email = $userData['email'];
$name = $userData['name'];
$role_id = $userData['role_id'];
$designation = $userData['designation'];
$photo = $userData['photo'];
// $username = $this->session->userdata['logged_in']['username'];
// $email = $this->session->userdata['logged_in']['email'];
// $name = $this->session->userdata['logged_in']['name'];
// $role_id = $this->session->userdata['logged_in']['role_id'];
// $role = $this->session->userdata['logged_in']['designation'];
// $photo = $this->session->userdata['logged_in']['photo'];

// echo $photo;exit;

}

 
 
?>
<style type="text/css">
.dropdown-menu-lg {
    min-width: 400px !important;
    width: 400px !important;
}

.profilebox {
    border: 1px solid #d2d2d26e;
    padding: 3px;
    background: #efefef52;
}

.profilebox:hover {
    background: #e3f6f9;
}

.img-size-50 {
    width: 40px;
}
</style>

<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav" style="margin-left:3%;width:90%;">
        <li class="nav-item">
            <div class="row">
                <?php
                $login_id=$this->session->userdata['logged_in']['id'];
                $data['role_id']=$this->session->userdata['logged_in']['role_id'];
                //Target Lead
                $this->db->select('target');
                $this->db->from('employees');
                $this->db->where(['id'=>$login_id]);
                $count=$this->db->get()->row_array();
                // print_r($count);exit;
              //TodayLead
                $this->db->select('*');
                $this->db->from('lead_csv');
                $this->db->where(['date'=>date('Y-m-d')]);
                  
                $toodayLeads=$this->db->get()->num_rows();	
            //Duplicate Lead
                 $this->db->select('id');
                $this->db->from('lead_csv');
                $this->db->where(['is_duplicate'=>1,'date'=>date('Y-m-d')]);
              
                $duplicateLeads=$this->db->get()->num_rows();	

                //Followups
                  $this->db->select('*');
                  $this->db->from('lead_followups');
                
                  
                  
                  $this->db->group_by('lead_id');
                  $this->db->where(['date'=>date('Y-m-d'),'followup_by'=>$login_id]);		
                  $followups=$this->db->get()->num_rows();

                  //ApproveFollowups
                  $this->db->select('id');
                $this->db->from('lead_csv');
                $this->db->where(['assign_to'=>$login_id,'approve_date'=>date('Y-m-d'),'lead_status'=>'Approved']);
                $approve=$this->db->get()->num_rows();	

                //PendingFollowups
                $this->db->select('id');
                $this->db->from('lead_csv');
                $this->db->where(['assign_to'=>$login_id,'date'=>date('Y-m-d'),'lead_status'=>'Pending']);
              
                $pending=$this->db->get()->num_rows();

                //RejectFollowups
                $this->db->select('id');
                $this->db->from('lead_csv');
                $this->db->where(['assign_to'=>$login_id,'reject_date'=>date('Y-m-d'),'lead_status'=>'Rejected']);
              
                $reject=$this->db->get()->num_rows();
              
                //AssignLead
                $this->db->select('id');
                $this->db->from('lead_csv');
                $this->db->where(['assign_to'=>$login_id,'assign_date'=>date('Y-m-d')]);
                $AssignLead=$this->db->get()->num_rows();
                ?>
                <div>

                <Label style="color:red;"><?= $this->lang->line('target') ?> :</Label><span style="color:red;"> <?php echo $target  ?> <span
                        style="border-right:1px solid black;"></span></span> &nbsp;
                <label style="color:red;"><?= $this->lang->line('goal_achieved') ?> :</label><span style="color:red;">
                    <?php echo $toodayLeads  ?> <span style="border-right:1px solid black;"></span></span>&nbsp;
                <label style="color:red;">Duplicate: </label><span style="color:red;">
                    <?php echo $duplicateLeads  ?></span>&nbsp;
                </div>

                <div>
                    <Label style="color:red;"> Total Assign :</Label><span style="color:red;">
                        <?php echo $AssignLead  ?> <span style="border-right:1px solid black;"></span></span> &nbsp;
                    <Label style="color:red;">Followups :</Label><span style="color:red;"> <?php echo $followups  ?>
                        <span style="border-right:1px solid black;"></span></span> &nbsp;
                    <label style="color:red;">Pending :</label><span style="color:red;"> <?php echo $pending  ?> <span
                            style="border-right:1px solid black;"></span></span>&nbsp;
                    <label style="color:red;">Approve: </label><span style="color:red;"> <?php echo $approve  ?> <span
                            style="border-right:1px solid black;"></span></span>&nbsp;
                    <label style="color:red;">Rejected: </label><span style="color:red;"> <?php echo $reject  ?> </span>
                </div>

            </div>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto d-flex align-items-center gap-3 pr-3">
        <li class="nav-item dropdown" style="width: 75px;">
            <select class="form-control" onchange="location = this.value;" style="width: 100%;">
                <option value="<?= site_url('AdminController/change_language/english') ?>" <?= ($language_label == 'English') ? 'selected' : '' ?>>En</option>
                <option value="<?= site_url('AdminController/change_language/bulg') ?>" <?= ($language_label == 'Bulg') ? 'selected' : '' ?>>Bg</option>
                <option value="<?= site_url('AdminController/change_language/hindi') ?>" <?= ($language_label == 'Hindi') ? 'selected' : '' ?>>Hi</option>
            </select>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fa fa-cog" style="font-size: 30px;"></i>
            </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3" style="min-width: 300px;">
                <h6 class="dropdown-header"><?= $this->lang->line('customize_theme') ?></h6>
            <label>Primary Theme Color</label>
            <input type="color" id="primaryColor" class="form-control mb-2" value="#007bff">

            <label>Navbar Color</label>
            <input type="color" id="navbarColor" class="form-control mb-2" value="#007bff">


            <label>Secondary Theme Color</label>
            <input type="color" id="secondaryColor" class="form-control mb-2" value="#6c757d">

            <button class="btn btn-sm btn-primary btn-block mt-2" onclick="applyCustomTheme()">Apply Theme</button>

            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fa fa-bell-o" style="font-size: 30px;"></i>
                <span class="badge badge-danger navbar-badge"><?php echo count($allnotifications)?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <?php
            if(!empty($allnotifications)){
          
          foreach ($allnotifications as $key => $allnotification) { 
            if(($key <5))
            { 
            ?>
                <?php if(($role_id == 4) || ($role_id == 5)) { ?>
                <?php if($allnotification['employee_id'] == $user_id) { ?>
                <a href="<?php echo base_url(); ?>index.php/<?= $allnotification['page_url']?>" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="<?php echo base_url()?><?php echo $allnotification['creator_photo']?>"
                            alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                <?= $allnotification['creator']?>
                                <!-- <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span> -->
                            </h3>
                            <p class="text-sm"><?= $allnotification['message']?></p>
                            <p class="text-sm text-muted text-right"><i class="fa fa-clock-o mr-1"></i>
                                <?php
                      $curr_time=$allnotification['datetime'];
                      $timea=strtotime($curr_time);
                      echo time_Ago($timea); 
                      ?>
                            </p>

                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>

                <?php } else if($allnotification['created_by'] == $user_id) { ?>
                <a href="<?php echo base_url(); ?>index.php/<?php echo $allnotification['page_url']?>"
                    class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="<?php echo base_url()?><?php echo $allnotification['creator_photo']?>"
                            alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                You
                                <!-- <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span> -->
                            </h3>
                            <p class="text-sm"><?= $allnotification['message']?></p>
                            <p class="text-sm text-muted text-right"><i class="fa fa-clock-o mr-1"></i>
                                <?php
                        $curr_time=$allnotification['datetime'];
                        $timea=strtotime($curr_time);
                        echo time_Ago($timea); 
                        ?>
                            </p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <?php } ?>

                </a>
                <div class="dropdown-divider"></div>
                <?php }else{ 
            ?>
                <a href="<?php echo base_url(); ?>index.php/<?php echo $allnotification['page_url']?>"
                    class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="<?= get_avatar_url($allnotification['creator_photo']);?>"
                            alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                <?= $allnotification['creator']?>
                                <!-- <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span> -->
                            </h3>
                            <?php if($allnotification['type'] == 'leave-action'){?>
                            <p class="text-sm"><?= $allnotification['message']?> Of
                                <?php echo $allnotification['employee']?></p>
                            <?php } else {?>
                            <p class="text-sm"><?= $allnotification['message']?></p>
                            <?php } ?>
                            <p class="text-sm text-muted text-right"><i class="fa fa-clock-o mr-1"></i>
                                <?php
                                    $curr_time=$allnotification['datetime'];
                                    $timea=strtotime($curr_time);
                                    echo time_Ago($timea); 
                                ?>
                            </p>
                        </div>
                    </div>
                    <!-- Message End -->

                    <?php } } } }
                    else{?>
                    <tr>
                        <td colspan="100">
                            <h5 style="text-align: center;"> No Notifications</h5>
                        </td>
                    </tr>
                    <?php }?>
                    <a href="<?php echo base_url(); ?>index.php/Notifications/index"
                        class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        &nbsp;
        <li class="nav-item dropdown d-flex align-items-center">
            <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
            <img src="<?= get_avatar_url($photo) ?>" class="img-circle mr-2" alt="User Image" style="width: 32px; height: 32px; object-fit: cover;" />
            <span class="text-dark font-weight-bold">
                <?php echo strlen($name) > 8 ? substr($name, 0, 6).'' : $name; ?>
            </span>
            <i class="fa fa-angle-down ml-2 text-dark"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                <span class="dropdown-header text-dark font-weight-bold"> Account Setting</span>
                <div class="dropdown-divider"></div>
                <a href="<?php echo base_url();?>index.php/Employees/edit/<?= $user_id ?>" class="dropdown-item">
                    <i class="fa fa-cog mr-2"></i> My Account
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo base_url();?>index.php/User_authentication/MyPasswordChangeView" class="dropdown-item">
                    <i class="fa fa-lock mr-2"></i> Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo base_url();?>index.php/User_authentication/logout" class="dropdown-item text-danger">
                    <i class="fa fa-sign-out mr-2"></i> Sign Out
                </a>
            </div>
        </li>
    </ul>

</nav>


<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #fff !important;color:#000">
    <!-- <span class="brand-text font-weight-bold" style="font-size: 20px !important;padding: 20px;"> Pyrotech Workspace Admin </span> -->
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="<?php echo base_url(); ?>uploads/mo.png" alt="AdminLTE Logo" class="brand-image img-square">
        <span class="brand-text font-weight-bold" style="font-size: 20px !important;color:#000;"> Muskowl  ERP</span>
    </a>