<?php

namespace App\Controllers;

use App\Models\PostModel;

class DashboardController extends BaseController
{
    protected $postModel;
    
    public function __construct()
    {
        $this->postModel = new PostModel();
        helper('auth');
    }
    
    public function index()
    {
        checkAuth();
        
        $data['posts'] = $this->postModel->getAllPosts();
        return view('admin/dashboard', $data);
    }
    
    public function create()
    {
        checkAuth();
        
        $data['post'] = null;
        $data['action'] = 'create';
        return view('admin/post_form', $data);
    }
    
    public function store()
    {
        checkAuth();
        
        $postData = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'dog_image' => $this->request->getPost('dog_image'),
            'status' => $this->request->getPost('status'),
        ];
        
        $this->postModel->savePost($postData);
        session()->setFlashdata('success', 'Post created successfully');
        
        return redirect()->to(base_url('dashboard'));
    }
    
    public function edit($id)
    {
        checkAuth();
        
        $data['post'] = $this->postModel->getPostById($id);
        $data['action'] = 'edit';
        return view('admin/post_form', $data);
    }
    
    public function update($id)
    {
        checkAuth();
        
        $postData = [
            'id' => $id,
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'dog_image' => $this->request->getPost('dog_image'),
            'status' => $this->request->getPost('status'),
        ];
        
        $this->postModel->savePost($postData);
        session()->setFlashdata('success', 'Post updated successfully');
        
        return redirect()->to(base_url('dashboard'));
    }
    
    public function delete($id)
    {
        checkAuth();
        
        $this->postModel->removePost($id);
        session()->setFlashdata('success', 'Post deleted successfully');
        
        return redirect()->to(base_url('dashboard'));
    }
    
    public function fetchDogImage()
    {
        $client = \Config\Services::curlrequest();
        
        try {
            $response = $client->get('https://dog.ceo/api/breeds/image/random');
            $data = json_decode($response->getBody(), true);
            
            return $this->response->setJSON([
                'success' => true,
                'image' => $data['message']
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to fetch dog image'
            ]);
        }
    }
}
