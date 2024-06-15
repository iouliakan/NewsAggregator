<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('css/style.css'); ?>" rel="stylesheet">
    <title>Update News</title>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
</head>

<body>
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

    <?php if ($item): ?>
        <form method="post" action="<?= base_url('admin/updateNews') ?>"  enctype="multipart/form-data">
            <div class="container mt-5 mb-5">
                <div class="border border-5 p-3">
                    <div class="border-bottom pb-3 mb-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="title" class="form-label"><strong>Enter Title:</strong></label>
                                <input type="text" name="title" value="<?= $item->title ?>" class="form-control" id="title"/>
                            </div>
                            <div class="col-md-6">
                                <label for="date_time" class="form-label"><strong>Enter Date/Time:</strong></label>
                                <input type="text" name="date_time" value="<?= $item->date_time ?>" class="form-control" id="date_time"/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="html_content" class="form-label"><strong>Content:</strong></label>
                        <textarea name="html_content" class="form-control" id="html_content" rows="10"><?= htmlspecialchars($item->html_content) ?></textarea>
                        <script>
                            CKEDITOR.replace('html_content');
                        </script>
                    </div>

                    <div class="mb-3">
                        <label for="summary" class="form-label"><strong>Summary:</strong></label>
                        <textarea name="summary" class="form-control" id="summary" rows="4"><?= $item->summary ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tags" class="form-label"><strong>Tags:</strong></label>
                        <textarea name="tags" class="form-control" id="tags" rows="1"><?= $item->tags ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label"><strong>Category:</strong></label>
                        <textarea name="category" class="form-control" id="category" rows="1"><?= $item->category ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imageFile" class="form-label"><strong>Upload New Image:</strong></label>
                        <input type="file" name="imageFile" class="form-control" id="imageFile"/>
                    </div>
                    <div class="mb-3">
                        <label for="Image" class="form-label"><strong>Current Image:</strong></label>
                        <input type="text" name="Image" class="form-control" id="Image" value="<?= $item->Image ?>" readonly/>
                    </div>




                    <input type="hidden" name="Id" value="<?= $item->Id ?>"/>
                    <input type="hidden" name="modelType" value="<?= $modelType ?>"/> 
                    <div class="text-center">
                        <button type="submit" class="btn btn-secondary">Update</button>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>
</body>
</html>