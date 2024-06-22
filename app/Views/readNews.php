<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('css/style.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('css/readNews.css'); ?>" rel="stylesheet">
    <script src="https://kit.fontawesome.com/96b895edc6.js" crossorigin="anonymous"></script>
    <title>Read News</title>

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
            <div class="d-flex flex-column align-items-center pb-2 three">
                <h1><?= htmlspecialchars($newsItem['title']); ?></h1>
                
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
                           
                        
                        <div class="d-flex justify-content-center ">
                        <p class="text-center font-weight-bold custom-date-time">Date/Time: <?= htmlspecialchars($newsItem['date_time']); ?> </p>

                    </div>
                    </div>
          
                    </div>
            </div>
        </div>
</div>

<!-- Sidebar for latest news -->
<div class="latest-news">
  <h3>Latest News</h3>
  <?php if (isset($latestNews) && !empty($latestNews)): ?>
    <?php foreach ($latestNews as $news): ?>
      <div class="latest-news-item mb-4">
        <div class="card border-dark">
          <img src="<?= esc($news['Image']) ?>" class="card-img-top" alt="<?= esc($news['title']) ?>">
          <div class="card-body text-center">
            <h5 class="card-title"><?= esc($news['title']) ?></h5>
            <a href="<?= base_url('read/' . $news['Id']) ?>" class="btn btn-primary btn-sm">Read more</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No latest news found.</p>
  <?php endif; ?>
</div>

<!-- Sidebar for related news -->
<div class="related-news">
          <h3>Related News</h3>
          <?php if (isset($relatedNews) && !empty($relatedNews)): ?>
            <?php foreach ($relatedNews as $news): ?>
              <div class="related-news-item mb-4">
                <div class="card border-dark">
                  <img src="<?= esc($news['Image']) ?>" class="card-img-top" alt="<?= esc($news['title']) ?>">
                  <div class="card-body text-center">
                    <h5 class="card-title"><?= esc($news['title']) ?></h5>
                    <a href="<?= base_url('read/' . $news['Id']) ?>" class="btn btn-primary btn-sm">Read more</a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No related news found.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>


</body>
</html>