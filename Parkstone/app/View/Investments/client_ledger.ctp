<?php
echo $this->Html->script('notification.js');
?>

<!-- Content starts here -->
<h3> Client Ledger</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
<?php
echo $this->Form->create('Investment', array('controller' => 'Investments', 'action' => "processTerminations"));
?>
        <table border="0" width="100%" cellspacing="5" cellpadding="0" align="left">

            <tr>
                <td align="left" width="200"><p style="font-size: 18px;">Investor ID: </p></td>
                <td align="left"><p style="font-size: 18px;"><?php
                        if (isset($investor_id)) {
                            echo $investor_id;
                        }
                        echo $this->Form->hidden('investor_id',array('value' =>(isset($investor_id)?$investor_id : '')));
                        
//                        echo $this->Form->hidden('investment_id',array('value' =>(isset($investment_id)?$investment_id : '')));
                        ?></p>
                    
                </td>
            </tr>
            <tr>
                <td align="left" width="200"><p style="font-size: 18px;">Investor Name: </p></td>
                <td align="left"><p style="font-size: 18px;"><?php
                        if (isset($investor_name)) {
                            echo $investor_name;
                        }
                        ?></p></td>
            </tr>
        </table>


        <table border="1" cellspacing="" cellpadding="3" width="100%" align="left" style="border: solid 2px gray;">
            <tr>
    <!--<td style="border-bottom: solid 2px dodgerblue;" width="30" align="left"><b><?php // echo $this->Paginator->sort('id', 'ID');   ?></b></td>-->
                <td style="border-bottom: solid 2px dodgerblue" align="right" style="border-bottom: solid 2px Gray;"><b><?php echo $this->Paginator->sort('date', 'Date'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left" style="border-bottom: solid 2px Gray;"><b>Voucher Number</b></td>
                <td style="border-bottom: solid 2px dodgerblue" align="right" style="border-bottom: solid 2px Gray;"><b><?php echo $this->Paginator->sort('debit', 'Debit'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue" align="right" style="border-bottom: solid 2px Gray;"><b><?php echo $this->Paginator->sort('credit', 'Credit'); ?></b></td>
              
                <td style="border-bottom: solid 2px dodgerblue;" align="left" style="border-bottom: solid 2px Gray;"><b>Description</b></td>
                


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

                        <td align="right" style="border-bottom: solid 1px Gray;"><?php
                            if (isset($each_item['LedgerTransaction']['date'])) {
                                echo date('d/m/Y',strtotime($each_item['LedgerTransaction']['date']));
                            }
                            ?></td>
                        <td align="right" style="border-bottom: solid 1px Gray;"><?php
                            if (isset($each_item['LedgerTransaction']['voucher'])) {
                                echo $each_item['LedgerTransaction']['voucher'];
                            }
                            ?></td>
                        <td align="left" style="border-bottom: solid 1px Gray;"><?php
                            if (isset($each_item['LedgerTransaction']['debit'])) {
                                echo $each_item['LedgerTransaction']['debit'];
                            }
                            ?></td>
                        <td align="left" style="border-bottom: solid 1px Gray;"><?php
                            if (isset($each_item['LedgerTransaction']['credit'])) {
                                echo $each_item['LedgerTransaction']['credit'];
                            }
                            ?></td>

                        <td align="right" style="border-bottom: solid 1px Gray;"><?php
                            if (isset($each_item['LedgerTransaction']['description'])) {
                                echo $each_item['LedgerTransaction']['description'];
                            }
                            ?></td>



                    <?php }
                }
                ?>
            </tr>
            <tr style="border-bottom: solid 1px Gray;">
                <td align="right" colspan="4"><p><b>Closing Balance</b></p>
                    </td>
                <td align="right" colspan="2"><b>
                    
                    <?php if(isset($data['ClientLedger']['available_cash'])){echo 'GH$ '.number_format($data['ClientLedger']['available_cash']); } ?>
               </b> </td>
            </tr>
        </table>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php
            echo $this->Html->link('Back', "/Investments/manageInvestments", array("class" => 'btn btn-info'));
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
