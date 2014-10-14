<?php
echo $this->element('header');
echo $this->Html->script('notification.js');

?>

<!-- Content starts here -->
<div id="content">
    <h1>Hire Purchase Rates</h1>
    <div id="content_menu">
        
    </div>
    <div id="clearer"></div>


</div>
<!-- Content ends here -->
<!-- Sidebar starts here -->
     <div id="sidebar">
         <?php 
         echo $this->element('logo');
         echo $this->element('settings_sidebar'); //Mini Dashboard
          ?>
    </div>
<!-- Sidebar starts here -->

<!-- Footer starts here -->
<?php echo $this->element('footer'); ?>
<!-- Footer starts here -->
