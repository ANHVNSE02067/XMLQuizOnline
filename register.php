<?php

require 'global.php';
if (isset($_POST['register'])) {
    try {
        $email = trim(Request::get('email', null));
        $password = trim(Request::get('password', null));
        $fullname = trim(Request::get('fullname', null));

        if(empty($email)){
            throw new Exception('Email cannot be blank');
        }

        if(empty($password)){
            throw new Exception('Password cannot be blank');
        }

        if(empty($fullname)){
            throw new Exception('Fullname cannot be blank');
        }

        // Load UserModel
        loadModel('UserModel.php');
        $userModel = new UserModel();
        // Check email exist
        $user = $userModel->getUserByEmail($email);
        if($user){
            throw new Exception('Email has existed!');
        }else{
        }
        // Password
        if (strlen($password) < 4 || strlen($password) > 32) {
            throw new Exception('Password must be from 4 to 32 characters!');
        }else{
            $password = md5($password);
        }

        // Register to database
        $user = new User(null, $email, $password, $fullname);
        $userModel->addUser($user);
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
