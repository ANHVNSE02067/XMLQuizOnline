<?php

require 'global.php';
if(!Auth::isUserAuth()) Auth::redirectToUserLoginPage ();
$authUser = Auth::getUserAuthIdentity();
loadModel('UserModel.php');
$userModel = new UserModel();
if (isset($_POST['update'])) {
    try {
        $oldpassword = trim(Request::get('oldpassword', null));
        $newpassword = trim(Request::get('newpassword', null));
        $repassword = trim(Request::get('repassword', null));
        $user = $userModel->getUserByEmail($authUser->getEmail());
        if(!$user) {
            throw new Exception('User not found!!');
        }

        if(empty($oldpassword)){
            throw new Exception('Old password cannot be blank');
        }

        if(md5($oldpassword) !== $user->getPassword()){
            throw new Exception('Wrong old password');
        }

        if(empty($newpassword)){
            throw new Exception('New Password cannot be blank');
        }

        if($repassword != $newpassword){
            throw new Exception('Password entered not match!');
        }

        // Update to database
        if($userModel->updatePassword($user->getUserID(), md5($newpassword))){
            // Success message
            echo 'Update success, <a href="logout.php">Re-login here</a>';
        }else{
            throw new Exception('Update password failed!');
        }
    } catch (Exception $e) {
        $message = $e->getMessage() . '<br><a href="update_pass.php">Try again!</a>';
        // Render error View
        $view = new View();
        $view->setLayout('user/layout.php');
        $view->setView('error.php');
        $view->setData('title', 'Invalid');
        $view->setData('message', $message);
        $view->render();
    }
} else {
    // Render register view
    $view = new View();
    $view->setLayout('user/layout.php');
    $view->setView('user/update_pass.php');
    $view->loadCss('public/css/user/update_pass.css');
    $view->setData('title', 'Update Password!');
    $view->render();
}
