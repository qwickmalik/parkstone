<?php
echo $this->element('header');

echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');
echo $this->Html->script('print.js');
?>
<!-- Content starts here -->
<h3>Statement of Liquid Funds</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
<p ><i style="font-size: 14px;">Please select the desired date</i></p>

<?php echo $this->Form->create('LiquidFunds', array("url" => array('controller' => 'Reports', 'action' => 'liquidFunds'))); ?>
<div class="row" style="background: #eaeaea; padding: 10px 0px 5px 0px;">
    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
        <?php echo $this->Form->input('start_date', array('label' => 'Start Date*', 'type' => 'date', 'value' => date('d-m-Y'), 'dateFormat' => 'DMY', 'class' => 'form-control', 'div' => array('class' => 'form-inline'))); ?>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
        <?php //echo $this->Form->input('end_date', array('label' => 'End Date*', 'type' => 'date', 'value' => date('d-m-Y'), 'dateFormat' => 'DMY', 'class' => 'form-control', 'div' => array('class' => 'form-inline'))); ?>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <?php echo $this->Form->button('View', array("type" => "submit", "class" => "btn btn-md btn-success")); ?>
    </div>
</div>
<?php echo $this->Form->end(); ?>

<div id="clearer"></div>

<?php
if (isset($statement_date)) {
    ?>
    <table id="report_content">
        <tr>
            <td>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        &nbsp;
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php 
                        echo $this->Html->image('parkstone_logo2.png', array('style' => 'float: left; margin-right: 20px;','width' => 120, 'alt' => $this->Session->read('shopName')));
                        ?>
                        <p style='font-weight: bold; font-size: 14px; text-align: left;'>
                            <?php 
                            echo $this->Session->read('shopName').'<br />'; 
                            echo 'STATEMENT OF LIQUID FUNDS as at '.$statement_date;
                            ?></p>
                        <p align='left'>Generated on <?php echo date('jS F, Y'); ?></p>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                    </div>
                
                </div>



                <table class="table table-striped">
                    <tr>
                        <td align="left">&nbsp;</td>
                        <td align="right" width="150" style="font-weight: bold;"><?php echo date('Y-m-d', strtotime($statement_date)); ?></td>
                    </tr>
                    <tr>
                        <td align="left">Shareholders Funds as per Balance Sheet</td>
                        <td align="right">100,000.00</td>
                    </tr>
                    <tr>
                        <td align="left">&nbsp;</td>
                        <td align="right">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left">Deduct</td>
                        <td align="right">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left">Value of all fixed assets</td>
                        <td align="right">(18,846.00)</td>
                    </tr>
                    <tr>
                        <td align="left">Value of all unsecured loans</td>
                        <td align="right">-</td>
                    </tr>
                    <tr>
                        <td align="left">Value of all Amounts Due From Director Etc. </td>
                        <td align="right">100,000.00</td>
                    </tr>
                    <tr>
                        <td align="left">Value of all Amounts Doubtful Of Collection </td>
                        <td align="right">100,000.00</td>
                    </tr>
                    <tr>
                        <td align="left">Deferred Expenses & Intangible Assets </td>
                        <td align="right">100,000.00</td>
                    </tr>
                    <tr>
                        <td align="left">15% of the Stated (Book) Value of all other Securities Excluding</td>
                        <td align="right">(30,000.00)</td>
                    </tr>
                    <tr>
                        <td align="left">&nbsp;</td>
                        <td align="right">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left"><b>Net Liquidity</b></td>
                        <td align="right">51,154.00</td>
                    </tr>
                    <tr>
                        <td align="right" valign="top" colspan="2">
                            <p style="font-style: italic;">Generated on <?php echo date('d-m-Y'); ?></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <?php
    echo "<p>&nbsp;</p>";
    echo $this->Html->link('Print', "javascript:void(0)", array("class" => 'btn btn-md btn-danger', "id" => "print_report", 'style' => 'float: right;'));
    echo $this->Html->link('Return', "/Reports/", array('style' => 'float: right;', 'class' => 'btn btn-md btn-info'));
}
?>
<div id="clearer"></div>
<div id="clearer"></div>
</div>
<!-- Content ends here -->

<!-- Footer starts here -->
<?php echo $this->element('footer'); ?>
<!-- Footer starts here -->