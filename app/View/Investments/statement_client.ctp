<?php echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js'); ?>
<h3>Client Statement</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        &nbsp;
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php 
                        echo $this->Html->image('parkstone_logo2.png', array('style' => 'float: left; margin-right: 20px;','width' => 120, 'alt' => $this->Session->read('shopName')));
                        ?>
                        <p style='font-weight: bold; font-size: 16px; text-align: left;'>
                            <?php 
                            echo $this->Session->read('shopName').'<br />'; 
                            echo 'CLIENT STATEMENT'; 
                            ?></p>
                        <p align='left'>Generated on <?php echo date('jS F, Y'); ?></p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table class="table table-striped">
                    <tr>
                        <th align="left">Date</th>
                        <th align="left">Inv. Number</th>
                        <th align="left">Inv. Amount</th>
                        <th align="left">Interest Rate</th>
                        <th align="left">Maturity Date</th>
                        <th align="left">Accrued Days</th>
                        <th align="left">Accrued Interest</th>
                        <th align="left">Principal Plus Interest</th>
                        <th align="left">Receipts/Payments</th>
                        <th align="left">Balance Due</th>
                    </tr>
                    <?php if(isset($data)){ foreach ($data as $each_item): ?>
                       <tr>
                            <td align="left"><?php echo $each_item['InvestmentStatement']['date']; ?></td>
                            <td align="left"><?php echo $each_item['InvestmentStatement']['investment_id']; ?></td>
                            <td align="left"><?php echo $each_item['InvestmentStatement']['principal']; ?></td>
                            <td align="left"><?php echo $each_item['InvestmentStatement']['interest_rate']; ?></td>
                            <td align="left"><?php echo $each_item['InvestmentStatement']['maturity_date']; ?></td>
                            <td align="left"><?php echo $each_item['InvestmentStatement']['accrued_days']; ?></td>
                            <td align="left"><?php echo $each_item['InvestmentStatement']['interest']; ?></td>
                            <td align="left"><?php echo $each_item['InvestmentStatement']['total']; ?></td>
                            <td align="left"><?php echo $each_item['InvestmentStatement']['payment']; ?></td>
                            <td align="left"><?php echo $each_item['InvestmentStatement']['total']-$each_item['InvestmentStatement']['payment']; ?></td>
                       </tr>
                    <?php endforeach;
                       }
                    ?>
                    <tr>
                        <td align="left"></td>
                    </tr>
                    
                </table>
            </div>
            <?php
            echo "<p>&nbsp;</p>";
            echo $this->Html->link('Print', "javascript:void(0)", array('style' => 'float: right;', "class" => 'btn btn-lg btn-warning', "id" => "print_receipt"));
            echo $this->Html->link('Return', "/Reports/", array('style' => 'float: right;', 'class' => 'btn btn-lg btn-info'));
            ?>
        </div>
    </div>
    <!-- Content end here -->
<?php echo $this->element('footer'); ?>

