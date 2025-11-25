<?php

namespace App\Controllers;

use App\Models\PostModel;

class ApiController extends BaseController
{
    protected $postModel;
    
    public function __construct()
    {
        $this->postModel = new PostModel();
    }
    
    public function posts()
    {
        $posts = $this->postModel->getPublishedPosts();
        
        return $this->response->setJSON([
            'status' => 'success',
            'total' => count($posts),
            'data' => $posts
        ]);
    }
}
