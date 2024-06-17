<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/96b895edc6.js" crossorigin="anonymous"></script>
    <link href="<?= base_url('css/style.css'); ?>" rel="stylesheet">
   
    <title>Read News</title>
   
    <style>
  
  .navbar {
    padding: 0; /* Remove any padding from the navbar */
}

.navbar-brand {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%; /*  it takes the full height of the navbar */
    padding: 0; /* Remove any padding */
    margin: 0; /* Remove any margin */
}

.navbar-brand img {
  
    margin-right: 10px; /* Space between the logo and site name */
}

.navbar-logo {
    max-height: 100%; /* logo takes the full height of the navbar */
    margin-right: 5px; /* Space between the logo and site name */
}
        </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
    <div>
            <a href="<?= base_url("admin/dashboard") ?>">
                <i class="fa-solid fa-circle-left fa-2xl" style="color: #ffffff;"></i>
            </a>
        </div>
        <a class="navbar-brand mx-auto" href="<?= base_url("admin/dashboard") ?>">
            <img src="<?= base_url('images/logo.png') ?>" alt="Logo" height="40">
            <span>News Aggregator</span>
        </a>
   
</div>
</nav>




    <div class="container mt-5 mb-5">
        <div class="border border-5 p-2">
            <div class="border-bottom pb-2">
                <div class="row">
                    <div class="col-6">
                        <h5>News: <?= htmlspecialchars($newsItem['title']); ?> </h5>
                    </div>
                    <div class="col-6 text-end">
                        <p>Date/Time: <?= htmlspecialchars($newsItem['date_time']); ?> </p>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-5 mb-5">
                <div class="col-md-8">
                    <h6>Content: </h6>
                    <div class="border pt-2 pb-5 pl-5 pr-5 form-control mb-3">
                        <?= $newsItem['html_content']; ?>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</body>
</html>