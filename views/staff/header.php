<div id="header">
    <div id="headline">
<h1><a href="<?php echo STAFF_URL; ?>">QuizOnline Staff Panel</a><?php if(isset($this->data['headline'])){?> - 
<?php echo $this->data['headline']; ?>
<?php } ?></h1>
    </div>
    <div id="welcome">
        <?php if (!Auth::isStaffAuth()) { ?>
            <a href="login.php">Login</a>
        <?php } else { ?>
            Hello <span class="username"><?php echo Auth::getStaffAuthIdentity()->getUsername(); ?></span>, | <a href="update_pass.php">Change pass</a> | <a href="logout.php">Logout</a>
        <?php } ?>   
    </div>
</div>
