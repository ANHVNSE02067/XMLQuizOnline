<?php
require '../global.php';
if (!Auth::isStaffAuth()) {
    Auth::redirectToStaffLoginPage ();
}
$authStaff = Auth::getStaffAuthIdentity();
loadModel('StaffModel.php');
$staffModel = new StaffModel();
if (isset($_POST['update'])) {
    try {
        $oldpassword = trim(Request::get('oldpassword', null));
        $newpassword = trim(Request::get('newpassword', null));
        $repassword = trim(Request::get('repassword', null));
        $staff = $staffModel->getStaffByEmail($authStaff->getEmail());
        if (!$staff) {
            throw new Exception('Staff not found!!');
        }

        if (empty($oldpassword)) {
            throw new Exception('Old password cannot be blank');
        }

        if (md5($oldpassword) !== $staff->getPassword()) {
            throw new Exception('Wrong old password');
        }

        if (empty($newpassword)) {
            throw new Exception('New Password cannot be blank');
        }

        if ($repassword != $newpassword) {
            throw new Exception('Password entered not match!');
        }

        // Update to database
        if ($staffModel->updatePassword($staff->getStaffID(), md5($newpassword))) {
            // Success message
            $message = 'Update success, <a href="logout.php">Re-login here</a>';
            $view = new View();
            $view->setLayout('staff/layout.php');
            $view->setView('info.php');
            $view->setData('title', 'Invalid');
            $view->setData('message', $message);
            $view->render();
        } else {
            throw new Exception('Update password failed!');
        }
    } catch (Exception $e) {
        $message = $e->getMessage() . '<br><a href="update_pass.php">Try again!</a>';
        // Render error View
        $view = new View();
        $view->setLayout('staff/layout.php');
        $view->setView('error.php');
        $view->setData('title', 'Invalid');
        $view->setData('message', $message);
        $view->render();
    }
} else {
    // Render register view
    $view = new View();
    $view->setLayout('staff/layout.php');
    $view->setView('staff/update_pass.php');
    $view->loadCss('public/css/staff/update_pass.css');
    $view->setData('title', 'Update Password!');
    $view->render();
}
