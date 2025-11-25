<?php

if (!function_exists('checkAuth')) {
    function checkAuth()
    {
        if (!session()->get('admin_logged_in')) {
            header('Location: ' . base_url('admin/login'));
            exit();
        }
    }
}
