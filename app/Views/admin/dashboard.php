<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('css/style.css'); ?>" rel="stylesheet">
    <title>Admin Dashboard</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">News Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('naftemporiki/index'); ?>">Scrape Naftemporiki</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url(''); ?>">Scrape Kathimerini</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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
                     <td><a href="<?= esc($item['url']); ?>" class="btn btn-light ">Site</a></td> 
                     <td><a href="<?= base_url('admin/read/' . $item['Id']); ?>" class="btn btn-dark">Read</a></td>
                 </td>
                 <td><button type="button" class="btn btn-secondary">Update</button></td>
                 <td><a href="<?= base_url('admin/confirmDelete/' . $item['Id']); ?>" class="btn btn-danger">Delete</a>
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



