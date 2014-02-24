<?php

require 'global.php';
if(Auth::isUserAuth()) Auth::redirect (SITE_URL); 
if (isset($_POST['login'])) {
    try {
        $email = trim(Request::get('email', null));
        $password = trim(Request::get('password', null));
        if (!$email) {
            throw new Exception('Username cannot be blank');
        }
        
        // Password
        if (!$password) {
            throw new Exception('Password cannot be blank');
        }else{
            $password = md5($password);
        }
        
        // Check email exist
        loadModel('UserModel.php');
        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);
        if(!$user){
            throw new Exception('Email does not exist!');
        }else{
            // Compare password
            if($user->getPassword() == $password){
                // Login success
                $authUser = new AuthUser();
                $authUser->setUserId($user->getUserID());
                $authUser->setUsername($user->getFullname());
                $authUser->setEmail($user->getEmail());
                $authUser->setRole(AuthUser::USER);
                Auth::setUserAuthIdentity($authUser);
                Auth::redirect(SITE_URL);
            } else{
                throw new Exception('Password is not correct!');
            }
        }

    } catch (Exception $e) {
        $message = $e->getMessage() . '<br><a href="login.php">Try again!</a>';
        // Render error View
        $view = new View();
        $view->setLayout('user/layout.php');
        $view->setView('error.php');
        $view->setData('title', 'Invalid');
        $view->setData('message', $message);
        $view->render();
    }
} else {
    // Render view
    $view = new View();
    $view->setLayout('user/layout.php');
    $view->setView('user/login_view.php');
    $view->loadCss('public/css/user/login.css');
    $view->setData('title', 'Login');
    $view->setData('headline', 'Login');
    $view->render();
}

