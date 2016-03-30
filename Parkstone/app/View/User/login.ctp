<?php
$cakeDescription = __d('cake_dev', 'Parkstone Capital Login');
?>
<!DOCTYPE html>
<html class="fuelux" lang="en">
    <head>
        <!--<meta charset="utf-8">-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription ?>:
            <?php // echo $title_for_layout; ?>
        </title>
<?php
        echo $this->Html->css('bootstrap.css');
        echo $this->Html->css('bootstrap.min.css');
        echo $this->Html->css('font-awesome.min.css');
        echo $this->Html->css('responsive.css');
        echo $this->Html->css('animate.css');
        echo $this->Html->css('style.css');
        
        echo $this->Html->script('jquery-1.9.1.min.js');
        echo $this->Html->script('jquery.min.js');
        echo $this->Html->script('bootstrap.min.js');
        echo $this->Html->script('jquery.flippy.min.js');

        echo $this->Html->meta('icon');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
  <!-- Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lato:400,300,700,700italic,900,100' rel='stylesheet' type='text/css'>

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
  
</head>

<body class="login-page">

<section class="content login-page">

  <div class="content-liquid">
    <div class="container">

      <div class="row">

        <div class="login-page-container">

          <div class="boxed animated flipInY">
            <div class="inner">

              <div class="login-title text-center">
                  <?php echo $this->Html->image('parkstone_logo.png', array('align'=>'center', 'width' => 150)); ?>
                <h5>Login to your account</h5>
              </div>

              <?php echo $this->Form->create('login', array('url' => array('controller' => 'Users', 'action' => 'login'),'name' => 'login')); ?>	
                        
              <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                <!--<input type="text" class="form-control" placeholder="Username" />-->
                <?php echo $this->Form->input('username', array('label' => false, 'name' => 'username', 'placeholder'=>'Username', 'class' => 'form-control','autocomplete' => "off")); ?>
              </div>

              <div class="input-group">
                <span class="input-group-addon"><i></i></span>
                <!--<input type="password" class="form-control" placeholder="Password" />-->
                <?php echo $this->Form->input('password', array('label' => false, 'name' => 'password', 'placeholder'=>'Password', 'class' => 'form-control','autocomplete' => "off")); ?>
              </div>

              <!--<input type="submit" class="btn btn-lg btn-success" value="Login to your account" name="submit" id="submit" />-->
                <?php echo $this->Form->button('Proceed',array("type" => "submit","class" => "btn btn-lg btn-success","id" => "login-link", "escape"=>false, 'style' => 'float: right;')); ?>
                
                    <?php echo $this->Form->end(); ?>
                
              <p class="footer">&nbsp;</p>
              
            </div>
          </div>

        </div>

      </div>
      
    </div>
  </div>

</section>

<!-- Javascript -->
<?php

?>


<script type="text/javascript">
  jQuery(document).ready(function($){

    var min_height = jQuery(window).height();
    jQuery('div.login-page-container').css('min-height', min_height);
    jQuery('div.login-page-container').css('line-height', min_height + 'px');

    //$(".inner", ".boxed").fadeIn(500);
  });
</script>
</body>
</html>