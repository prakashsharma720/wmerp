<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php //echo base_url(); exit;?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Registration Form </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <!-- <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>css/login.css"> -->
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    font-family: 'Source Sans Pro', sans-serif;
    }

    body {
        background-color: #c1e0ca;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        font-weight:500;
    }
 span{
  font-size:24px;

}
    .container {
        display: flex;
        max-width: 75%;
        width: 100%;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .left-panel {
        background-color: #e7f6ef;
        padding: 40px;
        width: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .left-panel img {
        max-width: 450px;
        margin-bottom: 30px;
    }

    .left-panel h2 {
        color: #2b3e2f;
        margin-bottom: 10px;
    }

    .left-panel p {
        color: #555;
        font-size: 14px;
        text-align: center;
    }

    .right-panel {
        padding: 60px 40px;
        width: 50%;
    }

    .right-panel .heading {
        text-align: center;
    }

    .logo {
        font-size: 24px;
        font-weight: 600;
        color: #2b3e2f;
        margin-bottom: 30px;
        text-align: center;
    }

    .logo span {
        color: #5cbf96;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 20px;
        margin-bottom: 5px;
        color: #333;
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
    }

    .form-options {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    .form-options a {
        font-size: 18px;
        color: #5cbf96;
        text-decoration: none;
    }

    .btn {
        width: 100%;
        padding: 12px;
        background-color: #2b3e2f;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        cursor: pointer;
    }

    .divider {
        text-align: center;
        margin: 20px 0;
        position: relative;
    }

    .divider::before,
    .divider::after {
        content: "";
        height: 1px;
        background: #ccc;
        position: absolute;
        top: 50%;
        width: 40%;
    }

    .divider::before {
        left: 0;
    }

    .divider::after {
        right: 0;
    }

    .divider span {
        color: #777;
        font-size: 18px;
        background: #fff;
        padding: 0 10px;
        position: relative;
        z-index: 1;
    }

    .google-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        background-color: #fff;
    }

    .google-btn img {
        width: 18px;
        margin-right: 10px;
    }

    .signup-link {
        text-align: center;
        font-size: 18px;
        margin-top: 20px;
    }

    .signup-link a {
        color: #5cbf96;
        text-decoration: none;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }

        .left-panel,
        .right-panel {
            width: 100%;
            padding: 30px;
        }
    }

        .toast {
    position: fixed;
    top: 25px;
    right: 30px;
    z-index: 9999;
    border-radius: 12px;
    background: #fff;
    padding: 20px 35px 20px 25px;
    box-shadow: 0 6px 20px -5px rgba(0, 0, 0, 0.1);
    transform: translateX(calc(100% + 30px));
    transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
    overflow: hidden; /* ✅ ensures contents stay within box */
}
.toast .progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    width: 100%;
    overflow: hidden; /* ✅ add this too */
}



.toast.active {
    transform: translateX(0%);
}

.toast-content {
    display: flex;
    align-items: center;
}

.toast-content .check {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 35px;
    min-width: 35px;
    background-color:rgb(255, 2, 2);
    color: #fff;
    font-size: 20px;
    border-radius: 50%;
}

.toast-content .message {
    display: flex;
    flex-direction: column;
    margin: 0 20px;
}

.message .text {
    font-size: 16px;
    font-weight: 400;
    color: #666;
}

.message .text.text-1 {
    font-weight: 600;
    color: #333;
}

.toast .close {
    position: absolute;
    top: 10px;
    right: 15px;
    padding: 5px;
    cursor: pointer;
    opacity: 0.7;
}

.toast .close:hover {
    opacity: 1;
}

.toast .progress:before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    background-color:rgb(255, 0, 0);
    transform-origin: left;
}

.progress.active:before {
    animation: progressBar 5s linear forwards;
}

@keyframes progressBar {
    100% {
        width: 0%; /* ✅ instead of right: 100% */
    }
}
    </style>

</head>

<body>
    <div class="container">
        <div class="left-panel">
            <img src="<?php echo base_url() ;?>uploads/rgf.jpg">
            <h2>MUSKOWL LLP</h2>
            <p>Create You Account To Get Enroll !</p>
        </div>
        <?php echo validation_errors();?>

        

        <div class="right-panel">
            <div class="logo"><img src="<?php echo base_url() ;?>uploads/mo.png" style="width:110px"></div>
            <div class="mb-12 heading">
              <span>Enter</span>
              <span style="color:#8cd2a1"> Details</span></div>
            </br>
          <form action="<?php echo base_url() ;?>index.php/User_authentication/new_user_registration" method="post">
            <div class="form-group">
                    <label> 
                      Username</label>
                    <input type="text" placeholder="Enter Username" name="username" />
                </div>
                <div class="form-group">
                    <label> 
                      Email</label>
                    <input type="email" placeholder="Enter Registered Email" name="email_value" />
                </div>
               <div class="form-group">
                    <label>Password</label>
                    <input type="password" placeholder="••••••••" name="password" />
                </div>
                
                <button class="btn" type="submit">Sign Up</button>
            </form>
            <div class="divider"><span>or</span></div>

          

            <div class="signup-link">
               Return To  <?php echo anchor('User_authentication/index', 'Login Page', 'title="Back to login Page" style="color:#8cd2a1;font-weight:500;"') ?>
            </div>

        </div>
    </div>


<!-- Toast Notification -->
    <div class="toast" id="ciToast">
        <div class="toast-content">
            <i class="fas fa-solid fa-check check" id="toastIcon"></i>
            <div class="message">
                <span class="text text-1" id="toastTitle">Success</span>
                <span class="text text-2" id="toastMessage">Your action was successful</span>
            </div>
        </div>
        <i class="fa-solid fa-xmark close" onclick="closeToast()"></i>
        <div class="progress" id="toastProgress"></div>
    </div>
    
    <script>
    function showToast(type, message) {
        const toast = document.getElementById("ciToast");
        const toastTitle = document.getElementById("toastTitle");
        const toastMessage = document.getElementById("toastMessage");
        const toastIcon = document.getElementById("toastIcon");
        const toastProgress = document.getElementById("toastProgress");

        toast.classList.add("active");
        toastProgress.classList.add("active");

        // Set icon & color based on type
        if (type === "success") {
            toastTitle.innerText = "Success";
            toastMessage.innerText = message;
            toastIcon.className = "fas fa-check check";
            toastIcon.style.backgroundColor = "#28a745"; // green
            toastIcon.style.color = "#fff";
        } else {
            toastTitle.innerText = "Error";
            toastMessage.innerText = message;
            toastIcon.className = "fas fa-times check";
            toastIcon.style.backgroundColor = "#dc3545"; // red
            toastIcon.style.color = "#fff";
        }

        // Auto hide
        setTimeout(() => {
            toast.classList.remove("active");
        }, 5000);

        setTimeout(() => {
            toastProgress.classList.remove("active");
        }, 5300);
    }

    function closeToast() {
        const toast = document.getElementById("ciToast");
        const toastProgress = document.getElementById("toastProgress");
        toast.classList.remove("active");
        toastProgress.classList.remove("active");
    }
    </script>
<!-- Flashdata Toast Trigger -->
<?php if($this->session->flashdata('success')): ?>
<script>
    showToast("success", "<?php echo $this->session->flashdata('success'); ?>");
</script>
<?php endif; ?>

<?php if($this->session->flashdata('failed')): ?>
<script>
    showToast("error", "<?php echo $this->session->flashdata('failed'); ?>");
</script>
<?php endif; ?>
</body>

</html>