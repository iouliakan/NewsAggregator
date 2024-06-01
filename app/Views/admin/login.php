<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Form</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 55px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        border: 2px solid #0c2854;
        transform: translate(-50%, -110%);


    }

    

    .card-body {
        padding-top: 60px; /* Adjust this padding to move the form contents down */
        border-radius: 45px; 
    }

    .form-label {
        font-weight: bold; /* Make the label text bold */
    }

    ::placeholder {
        font-weight: bold; /* Make placeholder text bold */
    }

    .card-header {
        font-weight: bold; /* Make the card header text bold */
    }
    .btn-custom {
        font-weight: bold; /* Make the button text bold */
    }
    </style>
</head>
<body>
<img src="/images/image2.png" alt="Background Image" class="background-image">
<div class="container mt-5">
    <div class="login-form-container">
            <div class="card ">
                <div class="card-header text-center">
                   Admin Login
                </div>
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
