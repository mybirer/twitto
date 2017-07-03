<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
    <div class="pull-left image">
        <img src="assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
        <p><?php echo $_SESSION['fullname']; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> <?php echo T::__('Online'); ?></a>
    </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
    <li class="header"><?php echo T::__('NAVIGATION'); ?></li>
    <li class="<?php echo Functions::isActive('dashboard'); ?> treeview">
        <a href="index.php">
        <i class="fa fa-dashboard"></i> <span><?php echo T::__('Dashboard'); ?></span>
        </a>
    </li>
    <li class="<?php echo Functions::isActive('users'); ?> treeview">
        <a href="index.php?controller=module&action=users">
            <i class="fa fa-files-o"></i>
            <span><?php echo T::__('Users'); ?></span>
        </a>
    </li>
    <li class="<?php echo Functions::isActive('twitter_users'); ?> treeview">
        <a href="index.php?controller=module&action=twitter_users">
            <i class="fa fa-files-o"></i>
            <span><?php echo T::__('Twitter Users'); ?></span>
        </a>
    </li>
    <li class="<?php echo Functions::isActive('cron_jobs'); ?> treeview">
        <a href="index.php?controller=module&action=cron_jobs">
            <i class="fa fa-files-o"></i>
            <span><?php echo T::__('Cron Jobs'); ?></span>
        </a>
    </li>
    </ul>
</section>
<!-- /.sidebar -->