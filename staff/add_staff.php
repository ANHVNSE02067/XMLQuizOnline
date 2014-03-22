<?php
require '../global.php';
if (!Auth::isStaffAuth()) {
    Auth::redirectToStaffLoginPage ();
}
if (isset($_POST['addStaff'])) {
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

        // Load StaffModel
        loadModel('StaffModel.php');
        $staffModel = new StaffModel();
        // Check email exist
        $staff = $staffModel->getStaffByEmail($email);
        if ($staff) {
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
        $staff = new Staff(null, $email, $password, $fullname);
        $staffModel->addStaff($staff);
        // Succes
        Auth::redirect('staff.php');
    } catch (Exception $e) {
        $message = $e->getMessage() . '<br><a href="add_staff.php">Try again!</a>';
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
    $view->setView('staff/addstaff_view.php');
    $view->loadCss('public/css/staff/addstaff.css');
    $view->setData('title', 'Add Staff');
    $view->render();
}
