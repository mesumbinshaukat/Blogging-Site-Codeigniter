<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($post['title']) ?> - My Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .post-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 40px;
            margin: 40px auto;
            max-width: 900px;
        }
        .post-title {
            color: #667eea;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .post-meta {
            color: #6c757d;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }
        .post-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .post-content {
            line-height: 1.8;
            font-size: 1.1rem;
            color: #333;
        }
        .btn-back {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('blog') ?>">
                <i class="fas fa-blog"></i> My Awesome Blog
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="post-container">
            <h1 class="post-title"><?= esc($post['title']) ?></h1>
            <div class="post-meta">
                <i class="far fa-calendar"></i> Published on <?= date('F d, Y', strtotime($post['created_at'])) ?>
            </div>
            
            <?php if ($post['dog_image']): ?>
                <img src="<?= esc($post['dog_image']) ?>" class="post-image" alt="<?= esc($post['title']) ?>">
            <?php endif; ?>
            
            <div class="post-content">
                <?= nl2br(esc($post['content'])) ?>
            </div>
            
            <div class="mt-5">
                <a href="<?= base_url('blog') ?>" class="btn btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Blog
                </a>
            </div>
        </div>
    </div>

    <footer class="text-center py-4 mt-5">
        <p class="text-muted">&copy; 2025 My Blog. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
