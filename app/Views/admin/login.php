<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Form</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/96b895edc6.js" crossorigin="anonymous"></script>
<link href="<?= base_url('css/style.css'); ?>" rel="stylesheet">


<style>
         body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        overflow: hidden;
    }
    .background-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        object-fit: cover;
    }
    .container {
        position: relative;
        z-index: 1;
        height: 100%;
    }
    .login-form-container {
        position: absolute;
        top: 65%; /* Adjust the value to center vertically */
        left: 50%; /* Adjust the value to center horizontally */
        width: 38%; /* Adjust the value according to the background square size */
        height: 50%;
        max-width: 550px;
        padding: 20px 20px 40px 20px;
        background-color: #f0f5f1;
        border-radius: 55px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        border: 2px solid #0c2854;
        transform: translate(-50%, -110%);


    }

    

    .card-body {
        padding-top: 60px; /* Adjust this padding to move the form contents down */
        border-radius: 55px;
        /* border: 2px solid #0c2854; */
    
    }

    .form-label {
        font-weight: bold; /* Make the label text bold */
    }

    ::placeholder {
        font-weight: bold; /* Make placeholder text bold */
        
    }



    .card{
        border-radius: 55px;
        background-color:#f0f5f1; 
      
       
       
      
    }

    
    .card-header.text-center {
         font-weight: bold; 
         border-radius: 55px; 
         margin-bottom: 20px; 
         border: 2px solid #0c2854;
    }
    .btn-custom {
        font-weight: bold; /* Make the button text bold */
        border-radius: 15px;
        border: 2px solid #0c2854;
    }

    .form-control {
        border-radius: 25px; /* Make the input fields rounded */
        border: 2px solid #0c2854;
    }

.navbar {
    overflow: hidden; /* Prevent overflow */
    padding: 15px 0; /* Add vertical padding for more space */
    height: 65px; /* Increase the height of the navbar */
    background-color:#346a88 !important;
}

.navbar-center {
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    width: auto; /* Ensure the container is the full width */
}

.navbar-brand {
    display: flex;
    align-items: center;
    justify-content: center;
    white-space: nowrap; /* Prevent the text from wrapping */
}

.navbar-brand img {
    max-height: 60px; /* Adjust as needed for larger logo */
    margin-right: 10px; /* Space between the logo and site name */
}

.container-fluid.px-0 {
    padding-left: 0;
    padding-right: 0;
}
    </style>
</head>
<body>
<img src="/images/image2.png" alt="Background Image" class="background-image">

<nav class="navbar navbar-light bg-light">
  <div class="container-fluid px-0">
    <div class="navbar-center mx-auto">
      <a class="navbar-brand" href="#">
        <img src="<?= base_url('images/logo.png') ?>" alt="Logo" height="40">
        <span>News Aggregator</span>
      </a>
    </div>
    <div class="ml-auto">
                    <a class="nav-link" href="<?= site_url('') ?>"> <i class="fa-solid fa-circle-left fa-xl" style="color: #ffffff;"></i> </a>
                </div>
  </div>
</nav>



<div class="container mt-5">
    <div class="login-form-container">
    <div class="card-header text-center">
                   Admin Login
                </div>

            <div class="card ">
                
                <?php 
                    if(session()->getFlashdata('success')){
                        echo "<div class='alert alert-success'>" . session()->getFlashdata('success') . "</div>";
                    } elseif(session()->getFlashdata('fail')){
                        echo "<div class='alert alert-danger'>" . session()->getFlashdata('fail') . "</div>";
                    }
                    ?>

                
                <div class="card-body">
                <form action="<?= base_url('admin/loginAdmin')?>"
                    method="post"

                class="form mb-3">
                    <div class="form-group mb-3">

                    <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control"  value="<?= set_value('username'); ?>"
                          id="username" name="username" placeholder="username Here">
                          <span class="text-danger text-sm"><?= session('errors.username') ?></span>
                         
                          
                         
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" value="<?= set_value('password'); ?>" id="password" name="password"  placeholder="Password Here">
                            <span class="text-danger text-sm"><?= session('errors.password') ?></span>
                        </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-custom">Login</button>
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
