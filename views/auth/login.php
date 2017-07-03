<?php ViewHelper::getHeader(); ?>
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b><?php echo ViewHelper::getTitle(); ?></b></a>
  </div>
  <div class="login-box-body">
    <?php echo MessageHelper::getMessageHTML(); ?>
    <p class="login-box-msg"><?php T::__("Please fill the form and login"); ?></p>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <div class="col-xs-4">
          <button type="submit" name="login_form" class="btn btn-primary btn-block btn-flat"><?php T::__("Login"); ?></button>
        </div>
      </div>
    </form>
    <a href="index.php?controller=page&action=forgotpassword"><?php T::__("I forgot my password"); ?></a><br>
    <a href="index.php?controller=page&action=register" class="text-center"><?php T::__("Register a new membership"); ?></a>
  </div>
</div>
<?php ViewHelper::getFooter(); ?>