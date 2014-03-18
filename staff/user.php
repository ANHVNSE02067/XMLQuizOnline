<?php
require '../global.php';
if (!Auth::isStaffAuth()) {
    Auth::redirectToStaffLoginPage ();
}
// Get list users
loadModel('UserModel.php');
$userModel = new UserModel();
$users = $userModel->getAllUsers();
// Render View
$view = new View();
$view->setLayout('staff/layout.php');
$view->setView('staff/user.php');
$view->loadCss('public/css/staff/user.css');
$view->setData('title', 'User Manager');
$view->setData('headline', 'User Manager');
$view->setData('users', $users);
// Set data
$view->render();
