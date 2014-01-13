<?php
if (isset($_POST['submit'])) {
    require_once 'modules/login/process/process_login.php';
    unset($_POST);
}
?>
<div class="intro">
    <div id="slides_files">
      
         <?php // include_once 'modules/login/slider/slider.php'; ?>
    </div>
</div>
<div class="login">
   <?php include_once 'modules/login/section/form.php'; ?>
</div>
<?php //js_media('before_login/basics'); ?>
<style>
    .ms {
        color:blue;
    }
</style>