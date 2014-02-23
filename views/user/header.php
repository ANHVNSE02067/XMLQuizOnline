<div id="header">
    <div id="headline">
<h1><a href="<?php echo SITE_URL; ?>">QuizOnline</a><?php if(isset($this->data['headline'])){?> - 
<?php echo $this->data['headline']; ?>
<?php } ?></h1>
    </div>
    <div id="welcome">
        <?php if (!Auth::isUserAuth()) { ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php } else { ?>
            Hello <?php echo Auth::getUserAuthIdentity()->getUsername(); ?>, <a href="logout.php">(logout)</a>
        <?php } ?>   
    </div>
</div>
