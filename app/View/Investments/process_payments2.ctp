<?php echo $this->element('header'); ?>

<!-- Content starts here -->
<h3>Process Payments Step 2: Client Ledger</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
<?php
$this->Form->create('ApproveInvestments', array('controller' => 'Investments', 'action' => "processPayments2"));
?>
        <table border="0" width="100%" cellspacing="5" cellpadding="0" align="left">

            <tr>
                <td align="left" width="200"><p style="font-size: 18px;">Investor ID: </p></td>
                <td align="left"><p style="font-size: 18px;"><?php
                        if (isset($investor_id)) {
                            echo $investor_id;
                        }
                        ?></p></td>
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
                <td style="border-bottom: solid 2px dodgerblue" width="60" align="right" style="border-bottom: solid 2px Gray;"><b><?php echo $this->Paginator->sort('investment_date', 'Inv. Date'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue" width="60" align="right" style="border-bottom: solid 2px Gray;"><b><?php echo $this->Paginator->sort('due_date', 'Due Date'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left" style="border-bottom: solid 2px Gray;"><b>Voucher Number</b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left" style="border-bottom: solid 2px Gray;"><b>Description</b></td>
                <td style="border-bottom: solid 2px dodgerblue" align="right" style="border-bottom: solid 2px Gray;"><b><?php echo $this->Paginator->sort('debit', 'Debit'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue" align="right" style="border-bottom: solid 2px Gray;"><b><?php echo $this->Paginator->sort('credit', 'Credit'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="center" style="border-bottom: solid 2px Gray;"><b>Action</b></td>
                <td style="border-bottom: solid 2px dodgerblue" align="center" style="border-bottom: solid 2px Gray;"><b><?php echo $this->Paginator->sort('status', 'Status'); ?></b></td>



            </tr>
            <?php if (isset($data)) {
                foreach ($data as $each_item) {
                    ?>
                    <tr>
        <!--                <td align="left"><?php
//                        if(isset($each_item['Investment']['id'])){
//                            echo $each_item['Investment']['id'];
//                        }
                        ?></td>-->

                        <td align="right" style="border-bottom: solid 1px Gray;"><?php
                            if (isset($each_item['Investment']['investment_date'])) {
                                echo $each_item['Investment']['investment_date'];
                            }
                            ?></td>
                        <td align="right" style="border-bottom: solid 1px Gray;"><?php
                            if (isset($each_item['Investment']['due_date'])) {
                                echo $each_item['Investment']['due_date'];
                            }
                            ?></td>
                        <td align="left" style="border-bottom: solid 1px Gray;"><?php
                            if (isset($each_item['Portfolio']['voucher'])) {
                                echo $each_item['Portfolio']['voucher'];
                            }
                            ?></td>
                        <td align="left" style="border-bottom: solid 1px Gray;"><?php
                            if (isset($each_item['Portfolio']['payment_name'])) {
                                echo $each_item['Portfolio']['payment_name'];
                            }
                            ?></td>

                        <td align="right" style="border-bottom: solid 1px Gray;"><?php
                            if (isset($each_item['Investment']['amount_due'])) {
                                echo $each_item['Investment']['amount_due'];
                            }
                            ?></td>
                        <td align="right" style="border-bottom: solid 1px Gray;"><?php
                            if (isset($each_item['Investment']['amount_due'])) {
                                echo $each_item['Investment']['amount_due'];
                            }
                            ?></td>
                        <td align="center" style="border-bottom: solid 1px Gray;">

                            <?php
                            if (isset($each_item['Investment']['status']) && $each_item['Investment']['status'] == 'Cancelled') {
                                echo $this->Html->Link('Re-instate', '/Investments/ReinstateInvestment/' . "/" . (isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' ) . "/" . (isset($each_item['Investment']['investor_id']) ? $each_item['Investment']['investor_id'] : '' ) . "/" . (isset($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : '' ), array('escape' => false));
                            } elseif (isset($each_item['Investment']['status']) && $each_item['Investment']['status'] == 'Paid') {
                                echo "No-Action Necessary";
                            } else {
                                echo $this->Html->Link('Pay', '/Investments/payInvestor/' . "/" . (isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' ), array('escape' => false));
                                ?> | <?php echo $this->Html->Link('Rollover', '/Investments/rollover/' . "/" . (isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' ) . "/" . (isset($each_item['Investment']['investor_id']) ? $each_item['Investment']['investor_id'] : '' ) . "/" . (isset($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : '' ), array('escape' => false)); ?> | <?php
                                echo $this->Html->Link('Terminate', '/Investments/cancelInvestment/' . "/" . (isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' ) . "/" . (isset($each_item['Investment']['investor_id']) ? $each_item['Investment']['investor_id'] : '' ) . "/" . (isset($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : '' ), array('escape' => false));
                            }
                            ?></td>
                        <td align="center" style="border-bottom: solid 1px Gray;"><?php
                            if (isset($each_item['Investment']['status'])) {
                                echo $each_item['Investment']['status'];
                            }
                            ?></td>
                        



                    <?php }
                }
                ?>
            </tr>
            <tr style="border-bottom: solid 1px Gray;">
                <td align="right" colspan="4">Cash at hand</td>
                <td align="right">0000.00</td>
                <td align="right"></td>
                <td align="right" colspan="3">
                    
                </td>
            </tr>
        </table>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php
            echo $this->Html->link('Back', "/Investments/processPayments", array("class" => 'btn btn-info'));
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
