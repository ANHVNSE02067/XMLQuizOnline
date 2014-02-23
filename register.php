<?php

require 'global.php';
if (isset($_POST['register'])) {
    try {
        $username = trim(Request::get('username', null));
        $password = trim(Request::get('password', null));
        $email = trim(Request::get('email', null));
        if (strlen($username) < 5 || strlen($username) > 32) {
            throw new Exception('Username must be from 5 to 32 characters!');
        }

        // Check email exist
        $user = null; // Get user
        if($user){
        }else{
            throw new Exception('Email has existed!');
        }
        // Password
        if (strlen($password) < 5 || strlen($password) > 32) {
            throw new Exception('Password must be from 5 to 32 characters!');
        }else{
            $password = md5($password);
        }


        // Register to database

        // Success message
        echo 'Register success, <a href="login.php">login here</a>';
    } catch (Exception $e) {
        $message = $e->getMessage() . '<br><a href="register.php">Try again!</a>';
        // Render error View
        $view = new View();
        $view->setLayout('user/layout.php');
        $view->setView('error.php');
        $view->setData('title', 'Invalid');
        $view->setData('message', $message);
        $view->render();
    }
} else {
    // Render register view
    $view = new View();
    $view->setLayout('user/layout.php');
    $view->setView('user/register_view.php');
    $view->loadCss('public/css/user/register.css');
    $view->setData('title', 'Register');
    $view->render();
}
