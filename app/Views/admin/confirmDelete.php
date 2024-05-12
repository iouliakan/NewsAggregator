<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('css/style.css'); ?>" rel="stylesheet">
    <title>Confirm Delete</title>
</head>
<body>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="border p-5 border-white">
                    <div class="text-center mb-4">
                        <p>Are you sure you want to delete this news item:"<?= esc($newsItem['title']); ?>"? </p>
                        <form action="<?= base_url('admin/delete/' . $newsItem['Id']); ?>" method="post">
                    </div>
                    <div class="d-flex justify-content-center">
                      
                   
                    <button type="submit" class="btn btn-danger">Yes, Delete It</button>
                    
                    </form>
                    
                    <a href="<?= base_url('admin/dashboard'); ?>" class="btn btn-secondary">No, Go Back</a>

                    </div>

                     
                    
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>