<?php
require '../global.php';
if (!Auth::isStaffAuth()) {
    Auth::redirectToStaffLoginPage ();
}
// Render View
$view = new View();
$view->setLayout('staff/layout.php');
$view->setView('staff/staff.php');
$view->loadCss('public/css/staff/staff.css');
$view->setData('title', 'Staff Manager');
$view->setData('headline', 'Staff Manager');
// Set data
$view->render();
