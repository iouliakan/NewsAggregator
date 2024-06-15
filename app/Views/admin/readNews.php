<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('css/style.css'); ?>" rel="stylesheet">
   
    <title>Read News</title>
   
</head>
<body>
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