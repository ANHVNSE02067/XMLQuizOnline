<!--
    QuizOnline - XML Project - Class 0631
Member:
- Vu Nhat Anh
- Tran Trung Hieu
- Phan Ngoc Huan
- Vo Tuan Trung
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo isset($this->data['title']) ? $this->data['title'] : ''; ?> - Quiz Online System</title>
        <!-- css -->
        <link type="text/css" rel="stylesheet" href="<?php echo SITE_URL; ?>public/lib/fancybox/jquery.fancybox-1.3.4.css">
        <link type="text/css" rel="stylesheet" href="<?php echo SITE_URL; ?>public/css/user/layout.css">
        <?php foreach ($this->css as $css) { ?>
            <link type="text/css" rel="stylesheet" href="<?php echo SITE_URL . $css; ?>">
        <?php } ?>
        <!-- js -->
        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/js/jquery-1.8.0.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/lib/fancybox/jquery.fancybox-1.3.4.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>public/js/const.js"></script>
        <?php foreach ($this->js as $js) { ?>
        <script type="text/javascript" src="<?php echo SITE_URL . $js; ?>"></script>
        <?php } ?>
    </head>
    <body>
        <?php require VIEW_DIR.'user/header.php'; ?>
        <div id="main">
            <?php if($this->view) require $this->view; ?>
        </div>
        <?php require VIEW_DIR.'user/footer.php'; ?>
    </body>
</html>
