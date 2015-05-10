<?php
$cakeDescription = __d('cake_dev', 'Parkstone Capital');
        $userType = $this->Session->read('userDetails.usertype_id');
    
?>
<!DOCTYPE html>
<html class="fuelux" lang="en">
    <head>
        <!--<meta charset="utf-8">-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription; ?>
            <?php // echo $title_for_layout; ?>
        </title>
        <!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>-->
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('bootstrap.css');
        echo $this->Html->css('bootstrap.min.css');
        echo $this->Html->css('font-awesome.min.css');
        echo $this->Html->css('menu-effects.css');
        echo $this->Html->css('jquery-ui-1.10.3.custom.css');
        echo $this->Html->css('jquery.dataTables.css');
//Theme
        echo $this->Html->css('responsive.css');
        echo $this->Html->css('animate.css');
        echo $this->Html->css('demo.css');
        echo $this->Html->css('template.css');
        echo $this->Html->css('styles-less.css');
        echo $this->Html->css('style.less');
        echo $this->Html->css('style.css');
        echo $this->Html->css('icheck/flat/_all.css');
//Javascript
        echo $this->Html->script('jquery-1.9.1.min.js');
        echo $this->Html->script('nowloading.js');
        echo $this->Html->script('min-height.js');
        echo $this->Html->script('jquery.nicescroll.min.js');
        echo $this->Html->script('bootstrap.min.js');
        echo $this->Html->script('all-pages.js');
        echo $this->Html->script('jquery.validate.js');
        echo $this->Html->script('notification.js');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
<?php
$username = "Unknown";
if ($this->Session->check('userData')) {
    $username = $this->Session->read('userData');
    $username = ucwords(strtolower($username));
} else {
    $username = "Unknown";
    $username = ucwords(strtolower($username));
}

date_default_timezone_set('Africa/Accra');
$date = date('g:ia');
?>

    <body>
        <section class="content">

            <!-- Sidebar Start -->
            <div class="sidebar">
                <!-- Logo Start -->
                <a href="index.html">
                    <div class="logo-container" id="step1">
                        <h1><?php echo $this->Html->link($cakeDescription, '#'); ?></h1>
                    </div>
                </a>
                <!-- Logo End -->

                <!-- Sidebar User Profile Start -->
                <div class="sidebar-profile">
                    <div class="user-avatar">
                        <?php
                        echo $this->Element('logo');
                        ?>
                    </div>
                    <div class="user-info">
                        <span style="font-size: 11px; color: #eaeaea;"><i>Growth with stability</i></span>
                    </div>
                </div>

                <div class="responsive-menu">
                    <a href="#"><i class="fa fa-bars"></i></a>
                </div>
                <!-- Sidebar User Profile End -->
                <?php echo $this->element('sidebar'); ?>
            </div>
            <!-- Sidebar End -->

            <div class="content-liquid-full">
                <div class="container">

                    <!-- Header Bar Start -->
                    <div class="row header-bar" id="step2">

                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 hidden-xs hidden-sm">
                            <ul class="left-icons">
                                <li><a href="#" class="collapse-sidebar"><i class="fa fa-bars"></i></a></li>
                                <li><input type="text" class="search" placeholder="Input your search..." /></li>
                                <li><a href="#"><i class="fa fa-refresh"></i></a></li>
                            </ul>
                        </div>

                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <ul class="right-icons" id="step3">
                                <!--                                <li>
                                                                    <a href="#" class="user"><i class="fa fa-user"></i></a>
                                                                    <ul class="dropdown">
                                                                        <li><a href="settings.html"><i class="fa fa-cogs"></i>Settings</a></li>
                                                                        <li><a href="profile.html"><i class="fa fa-user"></i>My Profile</a></li>
                                                                        <li><a href="login.html"><i class="fa fa-sign-out"></i>Sign Out</a></li>
                                                                    </ul>
                                                                </li>-->
                                <?php
                                if ($userType == 1) {
            
        
                                if ($this->Session->check('public_unapproved_investors')) {
                                    $public_unapproved_investors = $this->Session->read('public_unapproved_investors');

                                    if ($public_unapproved_investors > 0) { 
                                        ?>
                                        <li>
                                            <a href="<?php echo $this->Html->url('/Investments/approveInvestors', true); ?>" class="dark" alt="Unapproved Investors" title="Unapproved Investors">
                                                <i class="fa fa-users"></i>
                                               <div class="notify">
                                                    <?php echo $public_unapproved_investors; ?>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                    } else {
                                        ?>
                                        <li>
                                            <a href="<?php echo $this->Html->url('/Investments/approveInvestors', true); ?>" class="dark" alt="Unapproved Investors" title="Unapproved Investors">
                                                <i class="fa fa-users"></i>
                                                <div class="notify green">
                                                    <?php echo $public_unapproved_investors; ?>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                if ($this->Session->check('public_termination_req')) {
                                    $public_termination_req = $this->Session->read('public_termination_req');

                                    if ($public_termination_req > 0) {
                                        ?>
                                        <li>
                                            <a href="<?php echo $this->Html->url('/Investments/approveTerminations', true); ?>" class="dark" alt="Unapproved Terminations" title="Unapproved Terminations">
                                                <i class="fa fa-times"></i>
                                                <div class="notify">
                                                    <?php echo $public_termination_req; ?>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                    } else {
                                        ?>
                                        <li>
                                            <a href="<?php echo $this->Html->url('/Investments/approveTerminations', true); ?>" class="dark" alt="Unapproved Terminations" title="Unapproved Terminations">
                                                <i class="fa fa-times"></i>
                                                <div class="notify green">
                                                    <?php echo $public_termination_req; ?>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                if ($this->Session->check('public_payment_req')) {
                                    $public_payment_req = $this->Session->read('public_payment_req');

                                    if ($public_payment_req > 0) {
                                        ?>
                                        <li>
                                            <a href="<?php echo $this->Html->url('/Investments/approvePayments', true); ?>" class="dark" alt="Unapproved Payments" title="Unapproved Payments">
                                                <i class="fa fa-money"></i>
                                                <div class="notify">
                                                    <?php echo $public_payment_req; ?>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                    } else {
                                        ?>
                                        <li>
                                            <a href="<?php echo $this->Html->url('/Investments/approvePayments', true); ?>" class="dark" alt="Unapproved Payments" title="Unapproved Payments">
                                                <i class="fa fa-money"></i>
                                                <div class="notify green">
                                                    <?php echo $public_payment_req; ?>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                                }
                                ?>

                                <li>
                                    <a href="#" class="user" alt="Support" title="Support">
                                        <i class="fa fa-info"></i>
                                        <!--    <div class="notify">
                                        
                                                </div>-->
                                    </a>
                                    <ul class="dropdown">
                                        <li><a href="#"><i class="fa fa-pencil-square-o"></i>Contact Support</a></li>
                                        <li><a href="<?php echo $this->Html->url('/Information/aboutUs', true); ?>" ><i class="fa fa-info"></i>About Us</a></li>
                                        <li><a href="<?php echo $this->Html->url('/Information/myHelp', true); ?>" ><i class="fa fa-question"></i>Help</a></li>
                                    </ul>
                                </li>

                                <!--                            <li>
                                                                    <a href="#" class="info">
                                                                        <i class="fa fa-info"></i>
                                                                        <div class="notify">2</div>
                                                                    </a>
                                                                    <ul class="dropdown big">
                                                                        <li>
                                                                            <a href="#">
                                                                                <i class="fa fa-check-circle green"></i>
                                                                                Uploaded successfully
                                                                                <span class="description">1 minute ago</span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#">
                                                                                <i class="fa fa-comments blue"></i>
                                                                                Jenna commented on your link
                                                                                <span class="description">1 hour ago</span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#">
                                                                                <i class="fa fa-calendar orange"></i>
                                                                                Jason invited you on a event
                                                                                <span class="description">3 hours ago</span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </li>-->
                                <!--                                <li>
                                                                    <a href="#" class="settings" alt="Settings" title="Settings"><i class="fa fa-cog"></i></a>
                                                                </li>-->
                                <li>
                                    
                                    <a href="<?php echo $this->Html->url('/Users/logout', true); ?>" class="lock" alt="Logout" title="Logout"><i class="fa fa-lock"></i></a>
                                  <?php //  echo $this->Html->link('<i class="fa fa-lock"></i>', 
//                                          "/Users/logout/", 
//                                          array("alt"=>"Logout","class" => 'lock',"title" => "Logout"));

                                    ?>
                                </li>
                                <li>
                                    <?php echo '<span style="font-size: 10px;"><b>'. $username .'</b> is logged in</span>'; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Header Bar End -->
                    <!-- Notifications start here -->
                    <?php
                    if ($this->Session->check('bmsg')) {
                        $errorMessage = $this->Session->read('bmsg');
                        ?>
                        <div class="alert alert-warning">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Notice!</h4>
                            <?php echo $errorMessage; ?>
                        </div>
                        <?php
                        $this->Session->delete('bmsg');
                    } else if ($this->Session->check('emsg')) {
                        $errorMessage = $this->Session->read('emsg');
                        ?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Warning/Error!</h4>
                            <?php echo $errorMessage; ?>
                        </div>
                        <?php
                        $this->Session->delete('emsg');
                    } else if ($this->Session->check('smsg')) {
                        $Message = $this->Session->read('smsg');
                        ?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Success!</h4>
                            <?php echo $Message; ?>
                        </div>
                        <?php
                        $this->Session->delete('smsg');
                    } else if ($this->Session->check('imsg')) {
                        $Message = $this->Session->read('imsg');
                        ?>
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Info!</h4>
                            <?php echo $Message; ?>
                        </div>
                        <!-- Notifications end here -->
                        <?php
                        $this->Session->delete('imsg');
                    }
                    ?>

                    <!-- Breadcrumbs Start 
                    <div class="row breadcrumbs">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <ul class="breadcrumbs">
                                <li><a href="#"><i class="fa fa-home"></i></a></li>
                                <li><a href="#">Pages</a></li>
                                <li><a href="#">Blank Page</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Breadcrumbs End -->

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!-- MOVED INTO INDIVIDUAL VIEW FILES
                                                        <h3>Blank Page</h3>
                            <div class="boxed">
                                <div class="inner"> -->





