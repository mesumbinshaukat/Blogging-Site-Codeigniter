<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'content', 'dog_image', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    public function getPublishedPosts()
    {
        return $this->where('status', 'published')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
    
    public function getAllPosts()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }
    
    public function getPostById($id)
    {
        return $this->find($id);
    }
    
    public function savePost($data)
    {
        return $this->save($data);
    }
    
    public function removePost($id)
    {
        return $this->delete($id);
    }
}
