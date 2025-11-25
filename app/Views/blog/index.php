<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
        }
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
            margin-bottom: 40px;
        }
        .post-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            transition: transform 0.3s ease;
            overflow: hidden;
        }
        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        .post-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        .post-title {
            color: #667eea;
            font-weight: bold;
            margin-top: 15px;
        }
        .post-meta {
            color: #6c757d;
            font-size: 0.9rem;
        }
        .btn-read {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
        }
        .btn-read:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="container text-center">
            <h1><i class="fas fa-blog"></i> My Awesome Blog</h1>
            <p class="lead">Discover amazing stories and cute dog pictures</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php if (empty($posts)): ?>
                <div class="col-12 text-center">
                    <p class="text-muted">No posts published yet. Check back soon!</p>
                </div>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card post-card">
                            <?php if ($post['dog_image']): ?>
                                <img src="<?= esc($post['dog_image']) ?>" class="post-image" alt="<?= esc($post['title']) ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="post-title"><?= esc($post['title']) ?></h5>
                                <p class="post-meta">
                                    <i class="far fa-calendar"></i> <?= date('F d, Y', strtotime($post['created_at'])) ?>
                                </p>
                                <p class="card-text">
                                    <?= esc(substr($post['content'], 0, 150)) ?>...
                                </p>
                                <a href="<?= base_url('blog/view/' . $post['id']) ?>" class="btn btn-read">
                                    Read More <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <footer class="text-center py-4 mt-5">
        <p class="text-muted">&copy; 2025 My Blog. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
