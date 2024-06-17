<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/96b895edc6.js" crossorigin="anonymous"></script>
    <link href="<?= base_url('css/style.css'); ?>" rel="stylesheet">
    <title>Create News</title>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <style>
  
  .navbar {
    padding: 0; 
}

.navbar-brand {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%; 
    padding: 0; 
    margin: 0; 
}

.navbar-brand img {
  
    margin-right: 10px; /* Space between the logo and site name */
}

.navbar-logo {
    max-height: 100%; /*  the logo takes the full height of the navbar */
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

    <form method="post" action="<?= base_url('admin/createNews') ?>" enctype="multipart/form-data">
        <div class="container mt-5 mb-5">
            <div class="border border-5 p-3">
                <div class="border-bottom pb-3 mb-3">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label"><strong>Enter Title:</strong></label>
                            <input type="text" name="title" class="form-control" id="title" />
                        </div>
                        <div class="col-md-6">
                            <label for="date_time" class="form-label"><strong>Enter Date/Time:</strong></label>
                            <input type="text" name="date_time" class="form-control" id="date_time" />
                        </div>
                    </div>
                </div>
                <div class="mb-3">

                <label for="summary" class="form-label"><strong>Summary:</strong></label>
                    <textarea name="summary" class="form-control" id="summary" rows="5" ></textarea>
                </div>
    
                <div class="mb-3">
                    <label for="html_content" class="form-label"><strong>Content:</strong></label>
                    <textarea name="html_content" class="form-control" id="html_content" rows="10" ></textarea>
                    <script>
                            CKEDITOR.replace('html_content');
                        </script>
                </div>

                <div class="mb-3">
                    <label for="modelType" class="form-label"><strong>Select Newspaper:</strong></label>
                    <select name="modelType" class="form-control" id="modelType" >
                        <option value="kathimerini">Kathimerini</option>
                        <option value="naftemporiki">Naftemporiki</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label"><strong>Category:</strong></label>
                    <textarea name="category" class="form-control" id="category" rows="1" ></textarea>
                </div>
                <div class="mb-3">
                    <label for="tags" class="form-label"><strong>Tags:</strong></label>
                    <textarea name="tags" class="form-control" id="tags" rows="1" ></textarea>
                </div>


                <div class="mb-3">
                        <label for="imageFile" class="form-label"><strong>Image:</strong></label>
                        <input type="file" name="imageFile" class="form-control" id="imageFile"/>
                    </div>
                    





                <div class="text-center">
                    <button type="submit" class="btn btn-secondary">Create</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>