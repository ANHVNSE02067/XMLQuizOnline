<?php
require '../global.php';
if (!Auth::isStaffAuth()) {
    Auth::redirectToStaffLoginPage ();
}
// Render View
$view = new View();
$view->setLayout('staff/layout.php');
$view->setView('staff/user.php');
$view->loadCss('public/css/staff/user.css');
$view->setData('title', 'User Manager');
$view->setData('headline', 'User Manager');
// Set data
$view->render();
