<?php
$cakeDescription = __d('cake_dev', 'Parkstone Capital');
?>
<!DOCTYPE html>
<html class="fuelux" lang="en">
    <head>
        <!--<meta charset="utf-8">-->
        <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->

        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription ?>:
            <?php echo $title_for_layout; ?>
        </title>
        <!--<link rel="stylesheet" type="text/css" href="css/styles-less.css">-->
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,100italic,100,300italic,300,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
        <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <section class="content">

            <!-- Sidebar Start -->
            <div class="sidebar">

                <!-- Logo Start -->
                <a href="index.html">
                    <div class="logo-container" id="step1">
                        <h1><?php echo $this->Html->link($cakeDescription, '#'); ?></h1>
                        <h4>admin template</h4>
                    </div>
                </a>
                <!-- Logo End -->

                <!-- Sidebar User Profile Start -->
                <div class="sidebar-profile">
                    <div class="user-avatar">
                        <img src="http://www.placehold.it/60x60" alt="Samantha Lenna Wilson" />
                    </div>
                    <div class="user-info">
                        <a href="profile.html">Samantha Lenna Wilson</a>
                    </div>
                </div>

                <div class="responsive-menu">
                    <a href="#"><i class="fa fa-bars"></i></a>
                </div>
                <!-- Sidebar User Profile End -->

                <!-- Menu Start -->
                <ul class="menu">
                    <li class="lightblue">
                        <a href="index.html">
                            <span class="menu-icon"><i class="fa fa-home"></i></span>
                            <span class="menu-text">Dashboard</span>
                            <span class="notification">4</span>
                        </a>
                    </li>
                    <li class="parent purple">
                        <a href="">
                            <span class="menu-icon"><i class="fa fa-desktop"></i></span>
                            <span class="menu-text">Layouts</span>
                        </a>
                        <ul class="child">
                            <li>
                                <a href="index-fixed-sidebar.html">Fixed Sidebar</a>
                            </li>
                            <li>
                                <a href="index-collapsed-sidebar.html">Collapsed Sidebar</a>
                            </li>
                            <li>
                                <a href="index-fixed-header-bar.html">Fixed Header Bar</a>
                            </li>
                        </ul>
                    </li>
                    <li class="orange">
                        <a href="animated.html">
                            <span class="menu-icon"><i class="fa fa-css3"></i></span>
                            <span class="menu-text">Animated Elements</span>
                            <span class="notification lightgreen">62</span>
                        </a>
                    </li>
                    <li class="parent lightred active">
                        <a href="">
                            <span class="menu-icon"><i class="fa fa-windows"></i></span>
                            <span class="menu-text">Pages</span>
                        </a>
                        <ul class="child">
                            <li>
                                <a href="coming-soon.html">Coming Soon Page</a>
                            </li>
                            <li>
                                <a href="login.html">Login Page</a>
                            </li>
                            <li>
                                <a href="register.html">Register Page</a>
                            </li>
                            <li>
                                <a href="mail.html">Mail Page</a>
                            </li>
                            <li>
                                <a href="mail-compose.html">Mail Compose Page</a>
                            </li>
                            <li>
                                <a href="404.html">404 Error Page</a>
                            </li>
                            <li>
                                <a href="500.html">500 Error Page</a>
                            </li>
                            <li>
                                <a href="blank.html">Blank Page</a>
                            </li>
                            <li>
                                <a href="profile.html">Profile Page</a>
                            </li>
                        </ul>
                    </li>
                    <li class="parent lightyellow">
                        <a href="support.html">
                            <span class="menu-icon"><i class="fa fa-users"></i></span>
                            <span class="menu-text">Support Center</span>
                        </a>
                        <ul class="child">
                            <li>
                                <a href="support.html">Ticket Archive</a>
                            </li>
                            <li>
                                <a href="ticket.html">Ticket Response</a>
                            </li>
                        </ul>
                    </li>
                    <li class="parent green">
                        <a href="">
                            <span class="menu-icon"><i class="fa fa-rocket"></i></span>
                            <span class="menu-text">UI Elements</span>
                        </a>
                        <ul class="child">
                            <li>
                                <a href="modals.html">Modals & Alerts</a>
                            </li>
                            <li>
                                <a href="modals.html">ToolTips</a>
                            </li>
                            <li>
                                <a href="general.html">General</a>
                            </li>
                            <li>
                                <a href="buttons.html">Buttons</a>
                            </li>
                            <li>
                                <a href="grid.html">Grids</a>
                            </li>
                            <li>
                                <a href="calendar.html">Calendar</a>
                            </li>
                            <li>
                                <a href="tocify.html">Tocify</a>
                            </li>
                            <li>
                                <a href="tables.html">Tables</a>
                            </li>
                        </ul>
                    </li>
                    <li class="blue">
                        <a href="icons.html">
                            <span class="menu-icon"><i class="fa  fa-asterisk"></i></span>
                            <span class="menu-text">Icons</span>
                            <span class="notification purple">7</span>
                        </a>
                    </li>
                    <li class="parent lightblue">
                        <a href="">
                            <span class="menu-icon"><i class="fa fa-map-marker"></i></span>
                            <span class="menu-text">Maps</span>
                            <span class="notification lightblue">21</span>
                        </a>
                        <ul class="child">
                            <li>
                                <a href="google-maps.html">Google Maps</a>
                            </li>
                            <li>
                                <a href="vector-maps.html">Vector Maps</a>
                            </li>
                        </ul>
                    </li>
                    <li class="lightorange">
                        <a href="progress-bars.html">
                            <span class="menu-icon"><i class="fa fa-signal"></i></span>
                            <span class="menu-text">Progress Bars</span>
                        </a>
                    </li>
                    <li class="parent lightyellow">
                        <a href="">
                            <span class="menu-icon"><i class="fa fa-book"></i></span>
                            <span class="menu-text">Forms</span>
                        </a>
                        <ul class="child">
                            <li>
                                <a href="general-forms.html">General Form Elements</a>
                            </li>
                            <li>
                                <a href="smart-forms.html">Smart Form Elements</a>
                            </li>
                            <li>
                                <a href="form-wizards.html">Form Wizards</a>
                            </li>
                        </ul>
                    </li>
                    <li class="pink">
                        <a href="settings.html">
                            <span class="menu-icon"><i class="fa fa-cogs"></i></span>
                            <span class="menu-text">Settings</span>
                            <span class="notification blue">2</span>
                        </a>
                    </li>
                    <li class="cream">
                        <a href="pricing-tables.html">
                            <span class="menu-icon"><i class="fa fa-table"></i></span>
                            <span class="menu-text">Pricing Tables</span>
                            <span class="notification green">2</span>
                        </a>
                    </li>
                    <li class="marine">
                        <a href="tabs.html">
                            <span class="menu-icon"><i class="fa fa-bars"></i></span>
                            <span class="menu-text">Tabs & Accordions</span>
                        </a>
                    </li>
                    <li class="darkblue">
                        <a href="projects.html">
                            <span class="menu-icon"><i class="fa fa-folder-open-o"></i></span>
                            <span class="menu-text">Projects</span>
                        </a>
                    </li>
                    <li class="lightyellow">
                        <a href="tasks.html">
                            <span class="menu-icon"><i class="fa fa-file-text-o"></i></span>
                            <span class="menu-text">Tasks</span>
                        </a>
                    </li>
                    <li class="purple">
                        <a href="invoice.html">
                            <span class="menu-icon"><i class="fa fa-money"></i></span>
                            <span class="menu-text">Invoice</span>
                        </a>
                    </li>
                </ul>
                <!-- Menu End -->

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
                                <li>
                                    <a href="#" class="user"><i class="fa fa-user"></i></a>
                                    <ul class="dropdown">
                                        <li><a href="settings.html"><i class="fa fa-cogs"></i>Settings</a></li>
                                        <li><a href="profile.html"><i class="fa fa-user"></i>My Profile</a></li>
                                        <li><a href="login.html"><i class="fa fa-sign-out"></i>Sign Out</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#" class="email">
                                        <i class="fa fa-envelope-o"></i>
                                        <div class="notify">13</div>
                                    </a>
                                    <ul class="dropdown">
                                        <li><a href="#"><i class="fa fa-envelope-o"></i>Inbox</a></li>
                                        <li><a href="#"><i class="fa fa-reply-all"></i>Send</a></li>
                                        <li><a href="#"><i class="fa fa-folder"></i>Draft</a></li>
                                        <li><a href="#"><i class="fa fa-pencil-square-o"></i>Compose</a></li>
                                    </ul>
                                </li>
                                <li>
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
                                </li>
                                <li>
                                    <a href="#" class="settings"><i class="fa fa-cog"></i></a>
                                </li>
                                <li>
                                    <a href="#" class="lock"><i class="fa fa-lock"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Header Bar End -->


                    <!-- Breadcrumbs Start -->
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
                            <h3>Blank Page</h3>
                            <div class="boxed">
                                <div class="inner">

                                    <?php echo $this->Session->flash(); ?>

                                    <?php echo $this->fetch('content'); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->element('footer'); ?>
                </div>
            </div>

        </section>


    </body>
</html>
