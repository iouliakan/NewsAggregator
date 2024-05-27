<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('css/style.css'); ?>" rel="stylesheet">
    <script src="https://kit.fontawesome.com/96b895edc6.js" crossorigin="anonymous"></script>
    <title>News Aggregator</title>
    <style>
        .navbar-center {
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
}

.navbar-brand {
    display: flex;
    align-items: center;
    justify-content: center;
}

.navbar-brand img {
    max-height: 40px; /* Adjust as needed */
    margin-right: 10px; /* Space between the logo and site name */
}

.container-fluid.px-0 {
    padding-left: 0;
    padding-right: 0;
}
        </style>
    </head>


    <body>
    <div class="container-fluid px-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
        <div class="container-fluid px-0">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav"> 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-bars fa-2xl" style="color: #fffff;"></i>   
                        </a>
                        <div class="dropdown-menu p-3" aria-labelledby="navbarDropdownMenuLink">
                            <div class="row">
                                <a class="dropdown-item col-4" href="#">World</a>
                                <a class="dropdown-item col-4" href="#">Culture</a>
                                <a class="dropdown-item col-4" href="#">Society</a>
                                <a class="dropdown-item col-4" href="#">Economy</a>
                                <a class="dropdown-item col-4" href="#">Life</a>
                                <a class="dropdown-item col-4" href="#">Politics</a>
                                <a class="dropdown-item col-4" href="#">History</a>
                                <a class="dropdown-item col-4" href="#">Athletics</a>
                                <a class="dropdown-item col-4" href="#">Business</a>
                                <a class="dropdown-item col-4" href="#">Technology</a>
                                <a class="dropdown-item col-4" href="#">Music</a>
                                <a class="dropdown-item col-4" href="#">Shipping</a>
                                <a class="dropdown-item col-4" href="#">Events</a>
                                <a class="dropdown-item col-4" href="#">International</a>
                                <a class="dropdown-item col-4" href="#">Theatre</a>
                                <a class="dropdown-item col-4" href="#">Opinions</a>
                                <a class="dropdown-item col-4" href="#">Nature</a>
                                <a class="dropdown-item col-4" href="#">Health</a>
                                <a class="dropdown-item col-4" href="#">Museums</a>
                                <a class="dropdown-item col-4" href="#">Cinema</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="navbar-center mx-auto">
                <a class="navbar-brand" href="#">
                    <img src="<?= base_url('images/logo.png') ?>" alt="Logo" height="40">
                    <span>News Aggregator</span>
                </a>
            </div>
        </div>
    </nav>
</div>
    
<div class="container">
        <!-- Main Content -->
        <main>
          
            <div class="section-title">
                <h2>More from Digital Transformation</h2>
            </div>
            <p class="section-description">
                Microsoft customers and partners are using technology in innovative, disruptive, and transformative ways. These are their stories.
            </p>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="path/to/image1.jpg" class="card-img-top" alt="Image 1">
                        <div class="card-body">
                            <h5 class="card-title">At Mathnasium, decimals, diameters and a dedication to humanity</h5>
                            <p class="card-text">Digital Transformation</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="path/to/image2.jpg" class="card-img-top" alt="Image 2">
                        <div class="card-body">
                            <h5 class="card-title">‘Innovation happens here’: A novel program helps Microsoft customers create solutions they once thought unreachable</h5>
                            <p class="card-text">Digital Transformation</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="path/to/image3.jpg" class="card-img-top" alt="Image 3">
                        <div class="card-body">
                            <h5 class="card-title">One step at a time, people are finding their footing at FYZICAL</h5>
                            <p class="card-text">Digital Transformation</p>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" class="btn btn-link">View all</a>

          
            <div class="section-title">
                <h2>More from Sustainability</h2>
            </div>
            <p class="section-description">
                Microsoft is accelerating progress toward a more sustainable future by working to reduce our environmental footprint, helping our customers build sustainable solutions, and advocating for policies that benefit the environment.
            </p>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="path/to/image4.jpg" class="card-img-top" alt="Image 4">
                        <div class="card-body">
                            <h5 class="card-title">Discoveries in weeks, not years: How AI and high-performance computing are speeding up scientific discovery</h5>
                            <p class="card-text">Sustainability</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="path/to/image5.jpg" class="card-img-top" alt="Image 5">
                        <div class="card-body">
                            <h5 class="card-title">With carbon capture on an industrial scale, Norway plans for a greener future</h5>
                            <p class="card-text">Sustainability</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="path/to/image6.jpg" class="card-img-top" alt="Image 6">
                        <div class="card-body">
                            <h5 class="card-title">Entrepreneurs are bringing new ideas and technologies to preserve the planet</h5>
                            <p class="card-text">Sustainability</p>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" class="btn btn-link">View all</a>

      
            <div class="section-title">
                <h2>More from Work & Life</h2>
            </div>
            <p class="section-description">
                Learn how we’re helping people stay connected, engaged, and productive — at work, at school, at home, and at play.
            </p>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="path/to/image7.jpg" class="card-img-top" alt="Image 7">
                        <div class="card-body">
                            <h5 class="card-title">A dAI in the life: Simple AI tricks for getting more out of each day</h5>
                            <p class="card-text">Work & Life</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="path/to/image8.jpg" class="card-img-top" alt="Image 8">
                        <div class="card-body">
                            <h5 class="card-title">People in desperate situations get legal help from an unexpected source</h5>
                            <p class="card-text">Work & Life</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="path/to/image9.jpg" class="card-img-top" alt="Image 9">
                        <div class="card-body">
                            <h5 class="card-title">Inside the fight against hackers who disrupted hospitals and jeopardized lives</h5>
                            <p class="card-text">Work & Life</p>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" class="btn btn-link">View all</a>
        </main>
    </div>
</div>

    <!-- Bootstrap JS -->
  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>