<?php echo $this->element('header'); ?>

<!-- Content starts here -->
<h3>Approve Payments Step 2: Client Ledger</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
<?php
echo $this->Form->create('Investment', array('controller' => 'Investments', 'action' => "processPayments2"));
?>
        <table border="0" width="100%" cellspacing="5" cellpadding="0" align="left">

            <tr>
                <td align="left" width="200"><p style="font-size: 18px;">Investor ID: </p></td>
                <td align="left"><p style="font-size: 18px;"><?php
                        if (isset($investor_id)) {
                            echo $investor_id;
                        }
                        echo $this->Form->hidden('investor_id',array('value' =>(isset($investor_id)?$investor_id : '')));
                        
                        echo $this->Form->hidden('investment_id',array('value' =>(isset($investment_id)?$investment_id : '')));
                   
                       
                        ?></p></td>
                <td  align="right" >
                   &nbsp;
                </td>
            </tr>
            <tr>
                <td align="left" width="200"><p style="font-size: 18px;">Investor Name: </p></td>
                <td align="left"><p style="font-size: 18px;"><?php
                        if (isset($investor_name)) {
                            echo $investor_name;
                        }
                        ?></p></td>
                <td align="right">
                   &nbsp;
                </td>
            </tr>
            <tr>
                <td align="left" width="200"><p style="font-size: 18px;">Instructions: </p></td>
                <td align="left"><p style="font-size: 18px;"><?php
                        if (isset($instructions)) {
                            echo $instructions;
                        }
                        ?></p></td>
                <td align="right">
                     <fieldset >
                                <legend style="display: none;">Instructions</legend>
                                <input id="ApproveInvestmentsInstructions0" required="required" type="radio" value="None" name="data[ApproveInvestments][instructions]">
                                <label for="ApproveInvestmentsInstructions0">None</label>
                                
                                <input id="ApproveInvestmentsInstructions0" type="radio" value="Pay Principal" name="data[ApproveInvestments][instructions]">
                                <label for="ApproveInvestmentsInstructions0">Pay Principal</label>
                                <input id="ApproveInvestmentsInstructions1" type="radio" value="Pay Interest" name="data[ApproveInvestments][instructions]">
                                <label for="ApproveInvestmentsInstructions1">Pay Interest</label>
                                <input id="ApproveInvestmentsInstructions2" type="radio" value="Pay Principal & Interest" name="data[ApproveInvestments][instructions]">
                                <label for="ApproveInvestmentsInstructions2">Pay Both</label>
                            </fieldset>
                </td>
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
<!--                <td align="right" colspan="4">Cash at hand</td>
                <td align="right">0000.00</td>
                <td align="right"></td>
                <td align="right" colspan="3">
                    <fieldset>
                                <legend style="display: none;">Approvals</legend>
                                <input id="ApproveInvestmentsApprovals0" type="radio" value="0" name="data[ApproveInvestments][approvals]">
                                <label for="ApproveInvestmentsApprovals0">Reject</label>
                                <input id="ApproveInvestmentsApprovals1" type="radio" value="1" name="data[ApproveInvestments][approvals]">
                                <label for="ApproveInvestmentsApprovals1">Approve</label>
                                <input id="ApproveInvestmentsApprovals2" type="radio" value="2" name="data[ApproveInvestments][approvals]" checked="checked">
                                <label for="ApproveInvestmentsApprovals2">Pending Approval</label>
                            </fieldset>
                    
                </td>-->
                    <td align="right" colspan="2"><p><b>Approve Payments</b></p>
                    <fieldset>
                                <legend style="display: none;">Approvals</legend>
                                <input id="ApproveInvestmentsApprovals0" type="radio" value="0" name="data[ApproveInvestments][approvals]">
                                <label for="ApproveInvestmentsApprovals0">Reject</label>
                                <input id="ApproveInvestmentsApprovals1" type="radio" value="1" name="data[ApproveInvestments][approvals]">
                                <label for="ApproveInvestmentsApprovals1">Approve</label>
                                <input id="ApproveInvestmentsApprovals2" type="radio" value="2" name="data[ApproveInvestments][approvals]" checked="checked">
                                <label for="ApproveInvestmentsApprovals2">Pending Approval</label>
                            </fieldset></td>
                <td align="right"></td>
                <td align="right">Closing Balance</td>
                <td align="right" colspan="2">
                    
                    <?php if(isset($data['ClientLedger']['available_cash'])){echo 'GH$ '.number_format($data['ClientLedger']['available_cash']); } ?>
                </td>
            </tr>
        </table>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php
            echo $this->Html->link('Back', "/Investments/approvePayments", array("class" => 'btn btn-info'));
//            echo $this->Html->link('Process', "#", array("class" => 'btn btn-success', 'style' => 'float: right;'));
            echo $this->Form->button('Save', array("class" => 'btn btn-success', 'style' => 'float: right;'));
            ?>
        </div>

<?php
$this->Form->end();
?>
        <div id="clearer"></div>


    </div>
    <!-- Content ends here -->
<?php echo $this->element('footer'); ?>