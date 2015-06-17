<?php echo $this->element('header'); ?>

<!-- Content starts here -->
<h3>SETTINGS: Defaulting Rates</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>
            
    <?php echo $this->Form->create('DefaultingRate', array("url" => array('controller' => 'Settings', 'action' => 'defaultingRates'), "inputDefaults" => array('div' => false))); ?>
    
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
            <?php 
                echo $this->Form->input('monthly_rate', array("label" => "Monthly Default Rate (%)",'value' => isset($default_rates['DefaultingRate']['monthly_rate'])?$default_rates['DefaultingRate']['monthly_rate']:''));
                echo $this->Form->hidden('id', array('value' => isset($default_rates['DefaultingRate']['id'])?$default_rates['DefaultingRate']['id']:''));
                echo $this->Form->input('early_termination_fee', array('value' => isset($default_rates['DefaultingRate']['early_termination_fee'])?$default_rates['DefaultingRate']['early_termination_fee']:'', 'placeholder' => '0.00')); 
            ?>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
            <?php 
                echo $this->Form->input('expired_rate', array("label" => "Order Expired Rate (%)", 'value' => isset($default_rates['DefaultingRate']['expired_rate'])?$default_rates['DefaultingRate']['expired_rate']:'')); 
                echo $this->Form->button('Save', array("type" => "submit", "id" => "defaultBtn", "class" => "btn btn-md btn-success", 'style' => 'float: right;')); 
            ?>
        </div>
    </div>

            <br /><br /><br /><br /><br />
    <?php
    echo $this->Form->end();
    ?>
    <div id="clearer"></div>

</div>
<!-- Content ends here -->

<?php echo $this->element('footer'); ?>