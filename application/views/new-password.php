<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
	.select2{
		height:45px !important;
		width: 100% !important;
	}
 

</style>
        
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Customers</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">View</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <div class="d-flex d-md-none">
                            <a href="javascript:void(0)" class="page-header-right-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                            <a href="javascript:void(0);" class="btn btn-icon btn-light-brand successAlertMessage">
                                <i class="feather-star"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-icon btn-light-brand">
                                <i class="feather-eye me-2"></i>
                                <span>Follow</span>
                            </a>
                            <a href="customers-create.html" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Create Customer</span>
                            </a>
                        </div>
                    </div>
                    <div class="d-md-none d-flex align-items-center">
                        <a href="javascript:void(0)" class="page-header-right-open-toggle">
                            <i class="feather-align-right fs-20"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row">
                    <div class="col-xxl-4 col-xl-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="mb-4 text-center">
                                    <div class="wd-150 ht-150 mx-auto mb-3 position-relative">
                                        <div class="avatar-image wd-150 ht-150 border border-5 border-gray-3">
                                            <img src="assets/images/avatar/1.png" alt="" class="img-fluid">
                                        </div>
                                        <div class="wd-10 ht-10 text-success rounded-circle position-absolute translate-middle" style="top: 76%; right: 10px">
                                            <i class="bi bi-patch-check-fill"></i>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <a href="javascript:void(0);" class="fs-14 fw-bold d-block"> <?= $name?></a>
                                        <a href="javascript:void(0);" class="fs-12 fw-normal text-muted d-block"><?= $designation?></a>
                                    </div>
                                    <div class="fs-12 fw-normal text-muted text-center d-flex flex-wrap gap-3 mb-4">
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">28.65K</h6>
                                            <p class="fs-12 text-muted mb-0">Followers</p>
                                        </div>
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">38.85K</h6>
                                            <p class="fs-12 text-muted mb-0">Following</p>
                                        </div>
                                        <div class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                            <h6 class="fs-15 fw-bolder">43.67K</h6>
                                            <p class="fs-12 text-muted mb-0">Engagement</p>
                                        </div>
                                    </div>
                                </div>
                              <ul class="list-unstyled mb-4">
    <li class="d-flex justify-content-between align-items-start mb-4">
        <span class="text-muted fw-medium d-flex gap-2 align-items-start">
            <i class="feather-map-pin mt-1"></i>
            Location
        </span>
        <a href="javascript:void(0);" class="text-end text-break ms-3 flex-shrink-1" style="max-width: 60%;">
            <?= $address ?>
        </a>
    </li>
    <li class="d-flex justify-content-between align-items-start mb-4">
        <span class="text-muted fw-medium d-flex gap-2 align-items-start">
            <i class="feather-phone mt-1"></i>
            Phone
        </span>
        <a href="javascript:void(0);" class="text-end text-break ms-3 flex-shrink-1" style="max-width: 60%;">
            +<?= $mobile_no ?>
        </a>
    </li>
    <li class="d-flex justify-content-between align-items-start mb-0">
        <span class="text-muted fw-medium d-flex gap-2 align-items-start">
            <i class="feather-mail mt-1"></i>
            Email
        </span>
        <a href="javascript:void(0);" class="text-end text-break ms-3 flex-shrink-1" style="max-width: 60%;">
            <?= $email ?>
        </a>
    </li>
</ul>

                                <div class="d-flex gap-2 text-center pt-4">
                                    <a href="javascript:void(0);" class="w-50 btn btn-light-brand">
                                        <i class="feather-trash-2 me-2"></i>
                                        <span>Delete</span>
                                    </a>
                                    <a href="javascript:void(0);" class="w-50 btn btn-primary">
                                        <i class="feather-edit me-2"></i>
                                        <span>Edit Profile</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-xxl-8 col-xl-6">
                        <div class="card border-top-0">
                            <div class="card-header p-0">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link " data-bs-toggle="tab" data-bs-target="#overviewTab" role="tab">Overview</a>
                                    </li>
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link active" data-bs-toggle="tab" data-bs-target="#securityTab" role="tab">Security</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade  p-4" id="overviewTab" role="tabpanel">
                                    <div class="about-section mb-5">
                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Profile About:</h5>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Updates</a>
                                        </div>
                                        <p>John Doe is a frontend developer with over 5 years of experience creating high-quality, user-friendly websites and web applications. He has a strong understanding of web development technologies and a keen eye for design.</p>
                                        <p>John is proficient in languages such as HTML, CSS, and JavaScript, and is experienced in using popular frontend frameworks such as React and Angular. He is also well-versed in user experience design and uses his knowledge to create engaging and intuitive user interfaces.</p>
                                        <p>Throughout his career, John has worked on a wide range of projects for clients in various industries, including e-commerce, healthcare, and education. He takes a collaborative approach to development and enjoys working closely with clients and other developers to bring their ideas to life.</p>
                                    </div>
                                    <div class="profile-details mb-5">
                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Profile Details:</h5>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Edit Profile</a>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Full Name:</div>
                                            <div class="col-sm-6 fw-semibold">Alexandra Della</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Surname:</div>
                                            <div class="col-sm-6 fw-semibold">Della</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Company:</div>
                                            <div class="col-sm-6 fw-semibold">theme_ocean</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Date of Birth:</div>
                                            <div class="col-sm-6 fw-semibold">26 May, 2000</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Mobile Number:</div>
                                            <div class="col-sm-6 fw-semibold">+01 (375) 5896 3214</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Email Address:</div>
                                            <div class="col-sm-6 fw-semibold">alex.della@outlook.com</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Location:</div>
                                            <div class="col-sm-6 fw-semibold">California, United States</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Joining Date:</div>
                                            <div class="col-sm-6 fw-semibold">20 Dec, 2023</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Country:</div>
                                            <div class="col-sm-6 fw-semibold">United States</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Communication:</div>
                                            <div class="col-sm-6 fw-semibold">Email, Phone</div>
                                        </div>
                                        <div class="row g-0 mb-4">
                                            <div class="col-sm-6 text-muted">Allow Changes:</div>
                                            <div class="col-sm-6 fw-semibold">YES</div>
                                        </div>
                                        <div class="row g-0">
                                            <div class="col-sm-6 text-muted">Website:</div>
                                            <div class="col-sm-6 fw-semibold">https://theme_ocean.com</div>
                                        </div>
                                    </div>
                                    <div class="alert alert-dismissible mb-4 p-4 d-flex alert-soft-warning-message profile-overview-alert" role="alert">
                                        <div class="me-4 d-none d-md-block">
                                            <i class="feather feather-alert-triangle fs-1"></i>
                                        </div>
                                        <div>
                                            <p class="fw-bold mb-1 text-truncate-1-line">Your profile has not been updated yet!!!</p>
                                            <p class="fs-10 fw-medium text-uppercase text-truncate-1-line">Last Update: <strong>26 Dec, 2023</strong></p>
                                            <a href="javascript:void(0);" class="btn btn-sm bg-soft-warning text-warning d-inline-block">Update Now</a>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                    <div class="project-section">
                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0">Projects Details:</h5>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">View Alls</a>
                                        </div>
                                        <div class="row">
                                            <div class="col-xxl-6 col-xl-12 col-md-6">
                                                <div class="border border-dashed border-gray-5 rounded mb-4 md-lg-0">
                                                    <div class="p-4">
                                                        <div class="d-sm-flex align-items-center">
                                                            <div class="wd-50 ht-50 p-2 bg-gray-200 rounded-2">
                                                                <img src="assets/images/brand/github.png" class="img-fluid" alt="">
                                                            </div>
                                                            <div class="ms-0 mt-4 ms-sm-3 mt-sm-0">
                                                                <a href="javascript:void(0);" class="d-block">Mailbox Platform Github</a>
                                                                <div class="fs-12 d-block text-muted">Development</div>
                                                            </div>
                                                        </div>
                                                        <div class="my-4 text-muted text-truncate-2-line">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias dolorem necessitatibus temporibus nemo commodi eaque dignissimos itaque unde hic, sed rerum doloribus possimus minima nobis porro facilis voluptatum atque asperiores perspiciatis saepe laboriosam rem cupiditate libero sit.</div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="img-group lh-0 ms-3">
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Janette Dalton">
                                                                    <img src="assets/images/avatar/2.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Michael Ksen">
                                                                    <img src="assets/images/avatar/3.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Socrates Itumay">
                                                                    <img src="assets/images/avatar/4.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Marianne Audrey">
                                                                    <img src="assets/images/avatar/5.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Marianne Audrey">
                                                                    <img src="assets/images/avatar/6.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-text avatar-sm bg-soft-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Explorer More">
                                                                    <i class="feather feather-more-horizontal"></i>
                                                                </a>
                                                            </div>
                                                            <div class="badge bg-soft-primary text-primary">Inprogress</div>
                                                        </div>
                                                    </div>
                                                    <div class="px-4 py-3 border-top border-top-dashed border-gray-5 d-flex justify-content-between gap-2">
                                                        <div class="w-75 d-none d-md-block">
                                                            <small class="fs-11 fw-medium text-uppercase text-muted d-flex align-items-center justify-content-between">
                                                                <span>Progress</span>
                                                                <span>80%</span>
                                                            </small>
                                                            <div class="progress mt-1 ht-3">
                                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 80%"></div>
                                                            </div>
                                                        </div>
                                                        <span class="mx-2 text-gray-400 d-none d-md-block">|</span>
                                                        <a href="javascript:void(0);" class="fs-12 fw-bold">View &rarr;</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-6 col-xl-12 col-md-6">
                                                <div class="border border-dashed border-gray-5 rounded">
                                                    <div class="p-4">
                                                        <div class="d-sm-flex align-items-center">
                                                            <div class="wd-50 ht-50 p-2 bg-gray-200 rounded-2">
                                                                <img src="assets/images/brand/figma.png" class="img-fluid" alt="">
                                                            </div>
                                                            <div class="ms-0 mt-4 ms-sm-3 mt-sm-0">
                                                                <a href="javascript:void(0);" class="d-block">Chatting Platform Figme</a>
                                                                <div class="fs-12 text-muted">Design</div>
                                                            </div>
                                                        </div>
                                                        <div class="my-4 text-muted text-truncate-2-line">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias dolorem necessitatibus temporibus nemo commodi eaque dignissimos itaque unde hic, sed rerum doloribus possimus minima nobis porro facilis voluptatum atque asperiores perspiciatis saepe laboriosam rem cupiditate libero sit.</div>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="img-group lh-0 ms-3">
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Janette Dalton">
                                                                    <img src="assets/images/avatar/2.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Michael Ksen">
                                                                    <img src="assets/images/avatar/3.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Socrates Itumay">
                                                                    <img src="assets/images/avatar/4.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Marianne Audrey">
                                                                    <img src="assets/images/avatar/5.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-image avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Marianne Audrey">
                                                                    <img src="assets/images/avatar/6.png" class="img-fluid" alt="image">
                                                                </a>
                                                                <a href="javascript:void(0);" class="avatar-text avatar-sm bg-soft-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Explorer More">
                                                                    <i class="feather feather-more-horizontal"></i>
                                                                </a>
                                                            </div>
                                                            <div class="badge bg-soft-success text-success">Completed</div>
                                                        </div>
                                                    </div>
                                                    <div class="px-4 py-3 border-top border-top-dashed border-gray-5 d-flex justify-content-between gap-2">
                                                        <div class="w-75 d-none d-md-block">
                                                            <small class="fs-10 fw-medium text-uppercase text-muted d-flex align-items-center justify-content-between">
                                                                <span>progress</span>
                                                                <span>100%</span>
                                                            </small>
                                                            <div class="progress mt-1 ht-3">
                                                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                                            </div>
                                                        </div>
                                                        <span class="mx-2 text-gray-400 d-none d-md-block">|</span>
                                                        <a href="javascript:void(0);" class="fs-12 fw-bold">View &rarr;</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade p-4 show active" id="securityTab" role="tabpanel">

                                   <form action="<?php echo base_url() ;?>index.php/User_authentication/UserPasswordChange" method="post" >
					    	            <input type="hidden" name="emp_id" value="<?= $this->session->userdata['logged_in']['id']; ?>">
                                        <div class="p-4 mb-4 border border-dashed border-gray-3 rounded-1">
                                            <h6 class="fw-bolder"><a href="javascript:void(0);">Change Password</a></h6>
                                            <div class="my-4 py-2">
                                                <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
                                            </div>
                                            <div class="my-4 py-2">
                                                <input type="password" class="form-control" placeholder="Enter Confirm password" name="confirm_password" required>
                                            </div>
                                            <div class="my-4 py-2">
                                                <button type="submit" class="w-100 btn btn-primary"> Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <?php if ($this->session->flashdata('success')): ?>
                                        <div class="alert alert-dismissible mb-4 p-4 d-flex alert-soft-success-message" role="alert">
                                            <div class="me-4 d-none d-md-block">
                                                <i class="feather feather-check text-success fs-1"></i>
                                            </div>
                                            <div>
                                                <p class="fw-bold mb-0 text-truncate-1-line"><?php echo $this->session->flashdata('success'); ?>
                                                </p>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    <?php endif; ?>


                                <?php if($this->session->flashdata('failed')): ?>
                                    <div class="alert alert-dismissible mb-4 p-4 d-flex alert-soft-danger-message" role="alert">
                                        <div class="me-4 d-none d-md-block">
                                            <i class="feather feather-alert-triangle text-danger fs-1"></i>
                                        </div>
                                        <div>
                                            <p class="fw-bold mb-0 text-truncate-1-line"><?php echo $this->session->flashdata('failed'); ?>
                                            </p>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                 
                                    <!-- <hr class="my-5"> -->
                                    
                                    <!-- <div class="card mt-5">
                                        <div class="card-body">
                                            <h6 class="fw-bold">Delete Account</h6>
                                            <p class="fs-11 text-muted">Go to the Data & Privacy section of your profile Account. Scroll to "Your data & privacy options." Delete your Profile Account. Follow the instructions to delete your account:</p>
                                            <div class="my-4 py-2">
                                                <input type="password" class="form-control" placeholder="Enter your password">
                                                <div class="mt-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="acDeleteDeactive">
                                                        <label class="custom-control-label c-pointer" for="acDeleteDeactive">I confirm my account deletations or deactivation.</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-sm-flex gap-2">
                                                <a href="javascript:void(0);" class="btn btn-danger" data-action-target="#acSecctingsActionMessage">Delete Account</a>
                                                <a href="javascript:void(0);" class="btn btn-warning mt-2 mt-sm-0 successAlertMessage">Deactiveted Account</a>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
   

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {
		
	$('#close').on('click', function(e) { 
  	 $(this).parent('.error_mesg').remove(); 
 	});
    $(document).on('blur','.cpassword', function (){
        var cpassword = $('.cpassword').val();
        var password = $('.password').val();
        //var confirmPassword = document.getElementById("txtConfirmPassword").value;
        if(password!='')
        {
          if (password != cpassword) {
              alert("Passwords do not match.");
              //$(this).val();
              $('.cpassword').val('');
          }
        }
    });

     $(document).on('blur','.password', function (){
        var cpassword = $('.cpassword').val();
        var password = $('.password').val();
        //var confirmPassword = document.getElementById("txtConfirmPassword").value;
        if(cpassword!='')
        {
          if (password != cpassword) {
              alert("Passwords do not match.");
              //$(this).val();
              $('.password').val('');
          }
        }
    });
	});
</script>