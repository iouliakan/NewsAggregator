<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('css/style.css'); ?>" rel="stylesheet">
    <script src="https://kit.fontawesome.com/96b895edc6.js" crossorigin="anonymous"></script>
    <title>Read News</title>

    <style>
        .navbar {
    overflow: hidden; /* Prevent overflow */
    padding: 5px 0; /* Add vertical padding for more space */
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
    width: auto; /*  the container is the full width */
}

.navbar-brand {
    display: flex;
    align-items: center;
    justify-content: center;
    white-space: nowrap; /* Prevent the text from wrapping */
}

.navbar-brand img {
    max-height: 60px; /* for larger logo */
    margin-right: 10px; /* Space between the logo and site name */
}

.container-fluid.px-0 {
    padding-left: 0;
    padding-right: 0;
}
    </style>
</head>
<body>



<nav class="navbar navbar-light bg-light">
  <div class="container-fluid px-0">
    <div class="navbar-center mx-auto">
      <a class="navbar-brand" href="<?= base_url("/") ?>">
        <img src="<?= base_url('images/logo.png') ?> " alt="Logo" height="40">
        <span>News Aggregator</span>
      </a>
    </div>
    <div class="ml-auto">
                    <a class="nav-link" href="<?= site_url('') ?>"> <i class="fa-solid fa-circle-left fa-xl" style="color: #ffffff;"></i> </a>
                </div>
  </div>
</nav>


<div class="container mt-5 mb-5">
        <div class="p-2">
            <div class="d-flex flex-column align-items-center pb-2">
                <h5>News: <?= htmlspecialchars($newsItem['title']); ?></h5>
                
            </div>

            <div class="d-flex justify-content-center mt-5 mb-5">
                <div class="col-md-8">
                    <h6></h6>


                    <div class=" pt-2 pb-5 pl-5 pr-5 mb-3 text-center">
                        <a href="<?= esc($newsItem['Image']); ?>" target="_blank">
                            <img src="<?= esc($newsItem['Image']); ?>" alt="News Image" style="max-width: 100%; height: auto;">
                        </a>
                    </div>

                    <div class="border border-dark pt-2 pb-5 pl-5 pr-5  mb-3">
                        <?= $newsItem['html_content']; ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>