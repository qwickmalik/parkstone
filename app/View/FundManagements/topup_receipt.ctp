<?php
 echo $this->element('header');
 
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js');
?>

<h3>Fixed Investment Top-up Receipt</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <div class="inner_print">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                            echo 'NEW TOP-UP RECEIPT'
                            ?></p>
                        <p align='left'>Generated on <?php echo date('jS F, Y'); ?></p>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <hr>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <p>Client Name: <?php echo $data2['Investor']['fullname']; ?></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <p>Client ID: <?php echo $data2['Investor']['id']; ?></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <p>Client Type: <?php echo $data2['InvestorType']['investor_type']; ?></p>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <p>Investment Code: <?php echo $data2['Investment']['investment_no'].' '.$data2['Investment']['investment_no']; ?></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <p>Total Tenure: <?php echo $data2['Investment']['total_tenure'].' '.$data2['Investment']['investment_period']; ?></p>
            </div>
                
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <hr>
            </div>
            <?php 
            if (isset($data)) {
            ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                
                <table class="table table-striped">
                    <tr>
                        <td align="left" valign="top" ><b>Top-up Date</b></td>
                        <td align="right" valign="top" ><b>Amount</b></td>
                        <td align="left" valign="top" ><b>Receipt No.</b></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top"><?php echo date('d-m-Y',strtotime($data['InvestorDeposit']['deposit_date'])); ?></td>
                        <td align="right" valign="top"><?php echo $data['InvestorDeposit']['amount']; ?></td>
                        <td align="left" valign="top"><?php echo $data['InvestorDeposit']['receipt_no']; ?></td>

                    </tr>
                </table>
            </div>
            
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <?php }; ?>
            </div>
            <?php 
            echo "<p>&nbsp;</p>";
            echo $this->Html->link('Print', "javascript:void(0)", array('style' => 'float: right;', "class" => 'btn btn-lg btn-warning', "id" => "print_receipt"));
            echo $this->Html->link('Return', "/Investments/manageFixedInvestments/".$investor_id."/".$investor_name, array('style' => 'float: right;', 'class' => 'btn btn-lg btn-info'));
           
            ?>
        </div>
        <!-- Content end here -->
<?php echo $this->element('footer'); ?>
