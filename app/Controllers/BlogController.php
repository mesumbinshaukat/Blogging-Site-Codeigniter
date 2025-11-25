<?php

namespace App\Controllers;

use App\Models\PostModel;

class BlogController extends BaseController
{
    protected $postModel;
    
    public function __construct()
    {
        $this->postModel = new PostModel();
    }
    
    public function index()
    {
        $data['posts'] = $this->postModel->getPublishedPosts();
        return view('blog/index', $data);
    }
    
    public function view($id)
    {
        $data['post'] = $this->postModel->getPostById($id);
        
        if (!$data['post'] || $data['post']['status'] !== 'published') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        return view('blog/single', $data);
    }
}
