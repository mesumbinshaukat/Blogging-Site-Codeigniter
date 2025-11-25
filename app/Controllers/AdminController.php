<?php

namespace App\Controllers;

use App\Models\UserModel;

class AdminController extends BaseController
{
    public function login()
    {
        if (session()->get('admin_logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('admin/login');
    }
    
    public function authenticate()
    {
        log_message('info', 'Authenticate called - POST data: ' . json_encode($this->request->getPost()));
        
        $users = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        log_message('info', 'Username: ' . $username);
        
        $user = $users->getUserByUsername($username);
        
        if ($user && $users->verifyPassword($password, $user['password'])) {
            session()->set([
                'admin_id' => $user['id'],
                'admin_username' => $user['username'],
                'admin_logged_in' => true
            ]);
            log_message('info', 'Login successful, redirecting to dashboard');
            return redirect()->to(base_url('dashboard'));
        }
        log_message('info', 'Login failed');
        session()->setFlashdata('error', 'Invalid username or password');
        return redirect()->to(base_url('admin/login'));
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('admin/login'));
    }
}
