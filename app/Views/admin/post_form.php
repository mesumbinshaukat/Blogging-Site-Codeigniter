<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $action === 'create' ? 'Create Post' : 'Edit Post' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            font-weight: 600;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .dog-preview {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark mb-4">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">
                <i class="fas fa-blog"></i> Blog Dashboard
            </span>
            <div>
                <span class="text-white me-3">Welcome, <?= session()->get('admin_username') ?></span>
                <a href="<?= base_url('admin/logout') ?>" class="btn btn-light btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-edit"></i> <?= $action === 'create' ? 'Create New Post' : 'Edit Post' ?>
            </div>
            <div class="card-body">
                <form action="<?= $action === 'create' ? base_url('dashboard/store') : base_url('dashboard/update/' . $post['id']) ?>" method="post">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="<?= $post ? esc($post['title']) : '' ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="8" required><?= $post ? esc($post['content']) : '' ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="dog_image" class="form-label">Dog Image URL</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="dog_image" name="dog_image" 
                                   value="<?= $post ? esc($post['dog_image']) : '' ?>" readonly>
                            <button type="button" class="btn btn-primary" id="fetchDogBtn">
                                <i class="fas fa-dog"></i> Get Random Dog
                            </button>
                        </div>
                        <div id="dogPreview"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="draft" <?= ($post && $post['status'] === 'draft') ? 'selected' : '' ?>>Draft</option>
                            <option value="published" <?= ($post && $post['status'] === 'published') ? 'selected' : '' ?>>Published</option>
                        </select>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Post
                        </button>
                        <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('fetchDogBtn').addEventListener('click', function() {
            fetch('<?= base_url('dashboard/fetchDogImage') ?>')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('dog_image').value = data.image;
                        document.getElementById('dogPreview').innerHTML = 
                            '<img src="' + data.image + '" class="dog-preview" alt="Dog">';
                    } else {
                        alert('Failed to fetch dog image');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to fetch dog image');
                });
        });

        const currentImage = document.getElementById('dog_image').value;
        if (currentImage) {
            document.getElementById('dogPreview').innerHTML = 
                '<img src="' + currentImage + '" class="dog-preview" alt="Dog">';
        }
    </script>
</body>
</html>
