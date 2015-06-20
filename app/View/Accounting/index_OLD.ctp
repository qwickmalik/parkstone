<!-- Header starts here -->
<?php echo $this->element('header'); ?>
<!-- Header starts here -->

<!--<div id="panel_menu">

    <?php
//    $panel_menu = array(
//        $this->Html->link('Hire Purchase', '/Dashboard/', array('escape' => false)),
//        $this->Html->link('Company Accounts', '/companyAccounts/', array('escape' => false)),
//        $this->Html->link('Settings', '/Settings/', array('escape' => false)),
//    );
//    echo $this->Html->nestedList($panel_menu);
    ?>
</div>-->
    <h1>Company Accounts</h1>
    <div id="clearer"></div>
    <!-- Panels start here -->
    
    <div id="panel">
    <?php
    echo $this->Html->link($this->Html->image('expenses.png', array('width' => '90', 'height' => '90')), '/cashAccounts/', array('escape' => false));
    ?>
        <div id="panel_txt">
            <h2>Cash Accounts</h2>
            <p>Enter and update details expenses here e.g. salaries, utility bills, etc.</p>
        </div>
    </div>
    
    <div id="panel">
    <?php
    echo $this->Html->link($this->Html->image('manage_investments.png', array('width' => '90', 'height' => '90')), '/Investments/', array('escape' => false));
    ?>
        <div id="panel_txt">
            <h2>Investments</h2>
            <p>Manage investments into the company here.</p>
        </div>
    </div>
        
    <div id="panel">
<?php
echo $this->Html->link($this->Html->image('fixed_assets.png', array('width' => '90', 'height' => '90')), '/FixedAssets/', array('escape' => false));
?>

        <div id="panel_txt">
            <h2>Fixed Assets Register</h2>
            <p>Enter & Update Depreciation Details of Fixed Assets Here</p>
        </div>
    </div><!--
 second row of panels 
    <div id="panel">
<?php
// echo $this->Html->link($this->Html->image('creditors.png', array('width' => '100', 'height' => '100')), '/Creditors/', array('escape' => false));
?>
        <div id="panel_txt">
            <h2>Creditors</h2>
            <p>Check and update information about your creditors here</p>
        </div>
    </div>-->
    
<!--    <div id="panel">
<?php
//echo $this->Html->link($this->Html->image('reports.png', array('width' => '90', 'height' => '90')), '/Reports/', array('escape' => false));
?>

        <div id="panel_txt">
            <h2>Reports</h2>
            <p>View company's financial performance here e.g. general ledger, sales journal, financial statement, balance account, etc.</p>
        </div>
    </div>-->
    
    <!-- Panels end here -->
</div>
<!-- Sidebar starts here -->
<div id="sidebar">
    <?php
    echo $this->element('logo');
    ?>
</div>
<!-- Sidebar starts here -->
<!-- Footer starts here -->
        <?php echo $this->element('footer'); ?>
<!-- Footer starts here -->