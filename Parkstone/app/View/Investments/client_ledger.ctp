<?php echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js');

if ($this->Session->check('shopCurrency')) {
    $shopCurrency = $this->Session->read('shopCurrency');
} else {
    $shopCurrency = "";
}?>

<!-- Content starts here -->
<h3> Client Ledger</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
<?php
echo $this->Form->create('Investment', array('controller' => 'Investments', 'action' => "processTerminations"));
?>
        <div class="inner_print">
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
                            echo 'CLIENT LEDGER'
                            ?></p>
                        <p align='left'>Generated on <?php echo date('jS F, Y'); ?></p>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        &nbsp;
                    </div>
                </div>
        <table border="0" width="100%" cellspacing="5" cellpadding="0" align="left">

            <tr>
                <td align="left" width="150"><p style="font-size: 18px;">Investor ID: </p></td>
                <td align="left"><p style="font-size: 18px;"><?php
                        if (isset($investor_id)) {
                            echo $investor_id;
                        }
                        echo $this->Form->hidden('investor_id',array('value' =>(isset($investor_id)?$investor_id : '')));
                        
//                        echo $this->Form->hidden('investment_id',array('value' =>(isset($investment_id)?$investment_id : '')));
                        ?></p>
                    
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="left" width="150"><p style="font-size: 18px;">Investor Name: </p></td>
                <td align="left"><p style="font-size: 18px;"><?php
                        if (isset($investor_name)) {
                            echo $investor_name;
                        }
                        ?></p></td>
                <td align="left" width="120"><?php
                        if (!empty($data['Investor']['in_trust_for'])) {?><p style="font-size: 18px;">In-Trust-For: </p></td>
                <?php }
                        ?><td align="left"><?php
                        if (!empty($data['Investor']['in_trust_for'])) {?><p style="font-size: 18px;"><?php
                        
                            echo $data['Investor']['in_trust_for'];
                       
                        ?></p><?php }
                        ?></td>
            </tr>
        </table>


            <table class="table table-striped">
            <tr>
    <!--<td style="border-bottom: solid 2px dodgerblue;" width="30" align="left"><b><?php // echo $this->Paginator->sort('id', 'ID');   ?></b></td>-->
                <td align="left"><b><?php echo $this->Paginator->sort('date', 'Date'); ?></b></td> <!-- not printer-friendly -->
                <td align="left"><b>Voucher Number</b></td>
                <td align="right"><b><?php echo $this->Paginator->sort('debit', 'Debit'); ?></b></td><!-- not printer-friendly -->
                <td align="right"><b><?php echo $this->Paginator->sort('credit', 'Credit'); ?></b></td><!-- not printer-friendly -->
                <td align="center"><b>Benchmark</b></td>
                <td align="center"><b>Management Fee</b></td>
                <td align="left"><b>Description</b></td>
                


            </tr>
            <?php if (isset($transactions)) {
                foreach ($transactions as $each_item) {
                    ?>
                    <tr>
        <!--                <td align="left"><?php
//                        if(isset($each_item['Investment']['id'])){
//                            echo $each_item['Investment']['id'];
//                        }
                        ?></td>-->

                        <td align="left"><?php
                            if (isset($each_item['LedgerTransaction']['date'])) {
                                echo date('d/m/Y',strtotime($each_item['LedgerTransaction']['date']));
                            }
                            ?></td>
                        <td align="left"><?php
                            if (isset($each_item['LedgerTransaction']['voucher'])) {
                                echo $each_item['LedgerTransaction']['voucher'];
                            }
                            ?></td>
                        <td align="right"><?php
                            if (isset($each_item['LedgerTransaction']['debit'])) {
                                echo $each_item['LedgerTransaction']['debit'];
                            }
                            ?></td>
                        <td align="right"><?php
                            if (isset($each_item['LedgerTransaction']['credit'])) {
                                echo $each_item['LedgerTransaction']['credit'];
                            }
                            ?></td>
                        <td align="center"><?php
                            if (isset($each_item['LedgerTransaction']['benchmark'])) {
                                echo $each_item['LedgerTransaction']['benchmark'];
                            }
                            ?></td>
                        <td align="center"><?php
                            if (isset($each_item['LedgerTransaction']['management_fee'])) {
                                echo $each_item['LedgerTransaction']['management_fee'];
                            }
                            ?></td>

                        <td align="left"><?php
                            if (isset($each_item['LedgerTransaction']['description'])) {
                                echo $each_item['LedgerTransaction']['description'];
                            }
                            ?></td>



                    <?php }
                }
                ?>
            </tr>
            <tr>
                <td align="right" colspan="6"><p><b>Closing Balance</b></p>
                    </td>
                <td align="left"><b>
                    
                    <?php if(isset($data['ClientLedger']['available_cash'])){echo 'GH$ '.number_format($data['ClientLedger']['available_cash']); } ?>
               </b> </td>
            </tr>
        </table>
    </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php
            echo $this->Html->link('Back', "/Investments/manageInvestments", array('style' => 'float: right;',"class" => 'btn btn-md btn-info'));
            echo $this->Html->link('Print', "javascript:void(0)", array('style' => 'float: right;', "class" => 'btn btn-md btn-warning', "id" => "print_receipt"));
//            echo $this->Html->link('Process', "#", array("class" => 'btn btn-success', 'style' => 'float: right;'));
//            echo $this->Form->button('Save', array("class" => 'btn btn-success', 'style' => 'float: right;'));
            ?>
            
        </div>

<?php
$this->Form->end();
?>
        <div id="clearer"></div>


    </div>
    <!-- Content ends here -->
<?php echo $this->element('footer'); ?>