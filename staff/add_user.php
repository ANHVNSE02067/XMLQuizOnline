<?php
require '../global.php';
if (!Auth::isStaffAuth()) {
    Auth::redirectToStaffLoginPage ();
}
if (isset($_POST['addUser'])) {
    try {
        $email = trim(Request::get('email', null));
        $password = trim(Request::get('password', null));
        $fullname = trim(Request::get('fullname', null));

        if (empty($email)) {
            throw new Exception('Email cannot be blank');
        }

        if (empty($password)) {
            throw new Exception('Password cannot be blank');
        }

        if (empty($fullname)) {
            throw new Exception('Fullname cannot be blank');
        }

        // Load UserModel
        loadModel('UserModel.php');
        $userModel = new UserModel();
        // Check email exist
        $user = $userModel->getUserByEmail($email);
        if ($user) {
            throw new Exception('Email has existed!');
        } else {
        }
        // Password
        if (strlen($password) < 4 || strlen($password) > 32) {
            throw new Exception('Password must be from 4 to 32 characters!');
        } else {
            $password = md5($password);
        }

        // Register to database
        $user = new User(null, $email, $password, $fullname);
        $userModel->addUser($user);
        // Succes
        Auth::redirect('user.php');
    } catch (Exception $e) {
        $message = $e->getMessage() . '<br><a href="add_user.php">Try again!</a>';
        // Render error View
        $view = new View();
        $view->setLayout('staff/layout.php');
        $view->setView('error.php');
        $view->setData('title', 'Error adding staf');
        $view->setData('message', $message);
        $view->render();
    }
} else {
    // Render register view
    $view = new View();
    $view->setLayout('staff/layout.php');
    $view->setView('staff/adduser_view.php');
    $view->loadCss('public/css/staff/adduser.css');
    $view->setData('title', 'Add User');
    $view->render();
}
