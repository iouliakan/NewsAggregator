<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('css/style.css'); ?>" rel="stylesheet">
    <script src="https://kit.fontawesome.com/96b895edc6.js" crossorigin="anonymous"></script>
    <title>Admin Dashboard</title>
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
    max-height: 40px; 
    margin-right: 10px; /* Space between the logo and site name */
}

.container-fluid.px-0 {
    padding-left: 0;
    padding-right: 0;
}
        </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        <div class="navbar-center mx-auto">
                    <a class="navbar-brand" href="<?= base_url("admin/dashboard") ?>">
                        <img src="<?= base_url('images/logo.png') ?>" alt="Logo" height="40">
                        <span>News Aggregator</span>
                    </a>
                </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <!-- The data-url attribute stores the URL for form action -->
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#scrapeModal" data-url="<?= site_url('naftemporiki/index'); ?>">
                        <i class="fa-sharp fa-solid fa-circle-play" style="color: #000000;"></i> Naftemporiki
                    </a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#scrapeModal" data-url="<?= site_url('kathimerini/index'); ?>"><i class="fa-sharp fa-solid fa-circle-play" style="color: #000000;"></i> Kathimerini</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('admin/create'); ?>">
                            <i class="fa-solid fa-plus " style="color: #000000;"></i> Create News
                        </a>

                    </li>
                    </ul>
                    <!-- log-out -->
                    <ul class="navbar-nav ms-auto">
                    <a class="nav-link" href="<?= site_url('admin/logout'); ?>">
                    <i class="fa-solid fa-right-from-bracket fa-2x" style="color: #000000;"></i> 
                    </a>
                </ul>
           </div>
        </div>
     
    </nav>
  <!-- Modal structure -->
<div class="modal fade" id="scrapeModal" tabindex="-1" aria-labelledby="scrapeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrapeModalLabel"><i class="fa-solid fa-file-circle-plus" style="color: #000000;"></i> Pages</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="scrapeForm" method="post">
                    <div class="form-group">
                        <label for="numPages">How many pages would you like to scrape?</label>
                        <input type="number" class="form-control" id="numPages" name="numPages" min="1" value="1">
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <!-- Close button -->
                <button type="button" class="icon-button" data-bs-dismiss="modal">
                    <i class="fa-solid fa-circle-xmark" style="color: #000000;"></i>
                </button>
                <!-- Run button -->
                <button type="button" class="icon-button" id="runScrape">
                    <i class="fa-solid fa-circle-check" style="color: #000000;"></i>
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set the form action when the modal is shown
        var scrapeModal = document.getElementById('scrapeModal');
        scrapeModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var url = button.getAttribute('data-url'); // Extract info from data-* attributes
            var form = document.getElementById('scrapeForm');
            form.setAttribute('action', url);
        });

        // Handle form submission
        var runButton = document.getElementById('runScrape');
        runButton.addEventListener('click', function() {
            var form = document.getElementById('scrapeForm');
            form.submit();
        });
    });
</script>

    <div class="container mt-3">
        <?php if (!empty(session()->getFlashdata('success'))): ?>
            <div class="alert alert-success w-auto mx-auto">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php elseif (!empty(session()->getFlashdata('fail'))): ?>
            <div class="alert alert-danger w-auto mx-auto">
                <?= session()->getFlashdata('fail') ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="container-fluid mt-5 px-custom">
        <div class="table-responsive">
            <table class="table  table-striped">
                <thead class="custom-thead">
                    <tr>
                        <th><i class="fa-solid fa-arrow-down-wide-short" style="color: #000000;"></i></th>
                        <th>Newspaper</th>
                        <th>Title</th>
                        <th>Date/Time</th>
                        <th>Category</th>
                        <th>ImageAndUrl</th>
                        <th>Summary</th>
                        <th>Tags</th>
                        <th>Url</th>
                        <th>Content</th>
                        <th>Update</th>
                        <th>Delete</th>
                    
                    </tr>
                </thead>
                <tbody>
                <?php if (isset($news) && is_array($news) && !empty($news)): ?>
                    <?php $counter = 1; // Initialize the counter ?>
                 <?php foreach ($news as $item): ?>
                    
                   <td><?= $counter; ?> </td> 
                   <td><?= isset($item['source']) ? esc($item['source']) : session()->get('source'); ?></td>
                     <td><?= esc($item['title']); ?></td>
                     <td><?= esc($item['date_time']); ?></td>
                     <td><?= esc($item['category']); ?></td>
                     <td>
                <a href="<?= esc($item['Image']); ?>" target="_blank">
                    <img src="<?= esc($item['Image']); ?>" alt="News Image" style="width:100px;">
                </a>
            </td>
                     <td><?= esc($item['summary']); ?></td>
                     <td><?= esc($item['tags']); ?></td>
                     <!-- link for the site-->
                     <td><a href="<?= esc($item['url']); ?>" > <i class="fa-solid fa-link fa-lg" style="color: #000000;"></i></a></td> 
                     <!-- Read -->
                     <td><a href="<?= base_url('admin/read/' . $item['Id']); ?>" ><i class="fa-brands fa-readme fa-2x" style="color: #000000;"></i> </a></td>
                 </td>
                 <!-- Update -->
                 <td>  
                 <a href="<?= base_url('admin/edit/'.$item['Id']); ?>" ><i class="fa-solid fa-wrench fa-2x" style="color: #000000;"></i> </a>
                </td>
                 <!-- Delete -->
                 <td><a href="<?= base_url('admin/confirmDelete/' . $item['Id']); ?>"> <i class="fa-solid fa-trash fa-2x" style="color: #000000;"></i> </a>
                </td>
              
         </tr>
         <?php $counter++; // Increment the counter ?>
              <?php endforeach; ?>
       <?php else: ?>
      <tr><td colspan="8">No news found.</td></tr>
      <?php endif; ?>
            </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



