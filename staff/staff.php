<?php
require '../global.php';
if (!Auth::isStaffAuth()) {
    Auth::redirectToStaffLoginPage ();
}

// Get list staffs
loadModel('StaffModel.php');
$staffModel = new StaffModel();
$staffs = $staffModel->getAllStaffs();

// Render View
$view = new View();
$view->setLayout('staff/layout.php');
$view->setView('staff/staff.php');
$view->loadCss('public/css/staff/staff.css');
$view->loadJs('public/js/jquery.uitablefilter.js');
$view->loadJs('public/js/staff/staff.js');
$view->setData('title', 'Staff Manager');
$view->setData('headline', 'Staff Manager');
$view->setData('staffs', $staffs);
// Set data
$view->render();
