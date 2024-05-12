<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Form</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url('css/style.css'); ?>" rel="stylesheet">

</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
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
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
