<?php
require '../global.php';
if (Auth::isStaffAuth()) {
    Auth::redirect(STAFF_URL); 
}
if (isset($_POST['login'])) {
    try {
        $email = trim(Request::get('email', null));
        $password = trim(Request::get('password', null));
        if (!$email) {
            throw new Exception('Staffname cannot be blank');
        }
        
        // Password
        if (!$password) {
            throw new Exception('Password cannot be blank');
        } else {
            $password = md5($password);
        }
        
        // Check staffname exist
        loadModel('StaffModel.php');
        $staffModel = new StaffModel();
        $staff = $staffModel->getStaffByEmail($email);
        if (!$staff) {
            throw new Exception('Email does not exist!');
        } else {
            // Compare password
            if ($staff->getPassword() == $password) {
                // Login success
                $authUser = new AuthUser();
                $authUser->setUserId($staff->getStaffID());
                $authUser->setUsername($staff->getFullname());
                $authUser->setEmail($staff->getEmail());
                $authUser->setRole(AuthUser::STAFF);
                Auth::setStaffAuthIdentity($authUser);
                Auth::redirect(STAFF_URL);
            } else {
                throw new Exception('Password is not correct!');
            }
        }

    } catch (Exception $e) {
        $message = $e->getMessage() . '<br><a href="login.php">Try again!</a>';
        // Render error View
        $view = new View();
        $view->setLayout('staff/layout.php');
        $view->setView('error.php');
        $view->setData('title', 'Invalid');
        $view->setData('message', $message);
        $view->render();
    }
} else {
    // Render view
    $view = new View();
    $view->setLayout('staff/layout.php');
    $view->setView('staff/login_view.php');
    $view->loadCss('public/css/staff/login.css');
    $view->setData('title', 'Login');
    $view->render();
}

