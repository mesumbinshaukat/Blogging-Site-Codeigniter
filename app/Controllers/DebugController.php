<?php

namespace App\Controllers;

class DebugController extends BaseController
{
    public function info()
    {
        $data = [
            'base_url' => base_url(),
            'current_url' => current_url(),
            'server_info' => [
                'HTTP_HOST' => $_SERVER['HTTP_HOST'] ?? 'N/A',
                'SERVER_NAME' => $_SERVER['SERVER_NAME'] ?? 'N/A',
                'REQUEST_URI' => $_SERVER['REQUEST_URI'] ?? 'N/A',
                'SCRIPT_NAME' => $_SERVER['SCRIPT_NAME'] ?? 'N/A',
            ],
            'env_base_url' => env('app.baseURL'),
        ];
        
        return $this->response->setJSON($data);
    }
}
