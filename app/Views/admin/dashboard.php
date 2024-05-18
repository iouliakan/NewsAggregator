<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('css/style.css'); ?>" rel="stylesheet">
    <script src="https://kit.fontawesome.com/96b895edc6.js" crossorigin="anonymous"></script>
    <title>Admin Dashboard</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fa-solid fa-bars" style="color: #000000;"></i> News Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('naftemporiki/index'); ?>"> <i class="fa-sharp fa-solid fa-circle-play" style="color: #000000;"></i> Naftemporiki</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('kathimerini/index'); ?>"><i class="fa-sharp fa-solid fa-circle-play" style="color: #000000;"></i> Kathimerini</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="fa-solid fa-plus " style="color: #000000;"></i> Create News
                        </a>

                    </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                    <a class="nav-link" href="">
                    <i class="fa-solid fa-right-from-bracket fa-2x" style="color: #000000;"></i> 
                    </a>
                </ul>
            </div>
        </div>
    </nav>

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

    <div class="container mt-5">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date/Time</th>
                        <th>Category</th>
                        <th>ImageAndUrl</th>
                        <th>Summary</th>
                        <th>Tags</th>
                        <th>Url</th>
                        <th>Content</th>
                        <th>Action</th>
                    
                    </tr>
                </thead>
                <tbody>
                <?php if (isset($news) && is_array($news) && !empty($news)): ?>
                 <?php foreach ($news as $item): ?>
                   <tr>
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



