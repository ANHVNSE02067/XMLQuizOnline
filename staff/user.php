<?php
require '../global.php';
if (!Auth::isStaffAuth()) {
    Auth::redirectToStaffLoginPage ();
}
// Get list users
loadModel('UserModel.php');
$userModel = new UserModel();

// Delete User
if (Request::get('delete_user')) {
    $userId = Request::get('user_id');
    if ($userId) {
        $userModel->deleteUserById($userId);
    }
}


$users = $userModel->getAllUsers();
// Render View
$view = new View();
$view->setLayout('staff/layout.php');
$view->setView('staff/user.php');
$view->loadCss('public/css/staff/user.css');
$view->loadJs('public/js/jquery.uitablefilter.js');
$view->loadJs('public/js/staff/user.js');
$view->setData('title', 'User Manager');
$view->setData('headline', 'User Manager');
$view->setData('users', $users);
// Set data
$view->render();
