<?php
echo $this->Html->css('template.css');

echo $this->Html->script('jquery-1.9.1.min.js');

echo $this->Html->script('nowloading.js');
?>
<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
<?php
echo $this->Html->script('custompopup/custom.js');
echo $this->Html->css('style.css');
echo $this->Html->css('bootstrap.css');
echo $this->Html->script('bootstrap.js');
?>
<!-- Notifications start here -->
<?php
if ($this->Session->check('bmsg')) {
    $errorMessage = $this->Session->read('bmsg');
    ?>
    <div class="alert alert-block">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4>Notice!</h4>
    <?php echo $errorMessage; ?>
    </div>
        <?php
        $this->Session->delete('bmsg');
    } else if ($this->Session->check('emsg')) {
        $errorMessage = $this->Session->read('emsg');
        ?>
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4>Warning!</h4>
    <?php echo $errorMessage; ?>
    </div>
    <?php
    $this->Session->delete('emsg');
} else if ($this->Session->check('smsg')) {
    $Message = $this->Session->read('smsg');
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4>Info</h4>
    <?php echo $Message; ?>
    </div>
    <?php
    $this->Session->delete('smsg');
} else if ($this->Session->check('imsg')) {
    $Message = $this->Session->read('imsg');
    ?>
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4>Warning!</h4>
    <?php echo $Message; ?>
    </div>
    <!-- Notifications end here -->
    <?php
    $this->Session->delete('imsg');
}
?>

<div>
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
    <!--    <div id="content_top">-->
    <div id="top_menu">
    <?php
    $panel_menu = array(
        $this->Html->link('HOME', '/Dashboard/', array('escape' => false, "class" => "logout")),
        $this->Html->link('Cash Sales', '/Sales/', array('escape' => false)),
        $this->Html->link('Hire Purchase', '/HirePurchase/', array('escape' => false)),
        $this->Html->link('Stocks', '/Stocks/stock_dashboard/', array('escape' => false)),
        $this->Html->link('Company Accounts', '/companyAccounts/', array('escape' => false)),
        $this->Html->link('Reports', '/Reports/', array('escape' => false)),
        $this->Html->link('Settings', '/Settings/', array('escape' => false)),
        $this->Html->link('Logout', '/Users/logout', array("class" => "logout")),
        '<span style="color: #fff; margin-left: 30px;"><b>' . $username . '</b> is logged in</span>',
        '<span style="color: #fff; margin-left: 30px;"><b>Page accessed at </b>' . $date . '</span>'
    );
    echo $this->Html->nestedList($panel_menu);
    ?>
    </div>
    <!--    </div>-->
    <div id="content_body" >
        <div id="container">



