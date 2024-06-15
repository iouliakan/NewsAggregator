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
                                <i class="fa-solid fa-bars fa-2xl" style="color: #000;"></i>
                            </a>
                            <div class="dropdown-menu p-3" aria-labelledby="navbarDropdownMenuLink">
                                <div class="row">
                                <?php foreach ($categoryMapping as $displayCategory => $dbCategories): ?>
                                        <a class="dropdown-item col-4" href="<?= base_url('category/' . urlencode($displayCategory)) ?>"><?= $displayCategory ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="navbar-center mx-auto">
                    <a class="navbar-brand" href="<?= base_url("/") ?>">
                        <img src="<?= base_url('images/logo.png') ?>" alt="Logo" height="40">
                        <span>News Aggregator</span>
                    </a>
                </div>
                <div class="ms-auto">
                    <a class="nav-link" href="<?= site_url('admin/login') ?>"> <i class="fa-solid fa-right-to-bracket fa-lg" style="color: #000000;"></i> Login</a>
                </div>
            </div>
        </nav>
    </div>

    <div class="container mt-4">
        <?php if (isset($groupedNews) && !empty($groupedNews)): ?>
            <?php foreach ($groupedNews as $category => $newsItems): ?>
                <div class="section-title">
                    <h2>More from <?= esc($category) ?></h2>
                </div>
                <div class="row">
                    <?php foreach ($newsItems as $news): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="<?= esc($news['Image']) ?>" class="card-img-top" alt="<?= esc($news['title']) ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= esc($news['title']) ?></h5>
                                    <p class="card-text"><?= esc($category) ?></p>
                                    <a href="<?= base_url('read/' . $news['Id']) ?>" class="btn btn-primary">Read more</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
            <?php endforeach; ?>
        <?php else: ?>
            <p>No news found.</p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</body>
</html>