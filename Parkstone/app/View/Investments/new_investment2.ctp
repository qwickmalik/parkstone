<?php
//echo $this->Html->script('notification.js');
?>

<?php
$shopCurrency = "";
if ($this->Session->check('shopCurrency')) {
    $shopCurrency = $this->Session->read('shopCurrency');
}
?>
<!-- Content starts here -->
<h3>New Investment - Step 2</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">

            <tr>
                <td align="left" valign="top" colspan="3" style="font-size: 18px; color: gray; font-weight: bold;">Investor Details</td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="3">
                    <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
                        <tr>
                            <td style="border-bottom: solid 2px dodgerblue;" align="left">
                                <b>ID</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue;" align="left">
                                <b>Surname</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" align="left">
                                <b>Other Names</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" width="200" align="left">
                                <b>Phone Number</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" align="left">
                                <b>Email</b>
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                <?php
                                if (isset($investor['Investor']['id'])) {
                                    echo $investor['Investor']['id'];
                                } else {
                                    echo '';
                                }
                                ?>
                            </td>
                            <td align="left">
                                <?php
                                if (isset($investor['Investor']['surname'])) {
                                    echo $investor['Investor']['surname'];
                                } else {
                                    echo '';
                                }
                                ?>
                            </td>
                            <td align="left">
                                <?php
                                if (isset($investor['Investor']['other_names'])) {
                                    echo $investor['Investor']['other_names'];
                                } else {
                                    echo '';
                                }
                                ?>
                            </td>
                            <td align="left">
                                <?php
                                if (isset($investor['Investor']['phone'])) {
                                    echo $investor['Investor']['phone'];
                                } else {
                                    echo '';
                                }
                                ?>
                            </td>
                            <td align="left">
                                <?php
                                if (isset($investor['Investor']['email'])) {
                                    echo $investor['Investor']['email'];
                                } else {
                                    echo '';
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="left" valign="top" style="border-bottom: dotted 1px gray;">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="3">

                    <!-- Step Investment Details Start -->
                    <?php
                                echo $this->Form->create('Investment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'process'), "inputDefaults" => array('div' => false)));
                                ?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <?php echo $this->Form->input('inv_amount', array('label' => 'Investment Amount', 'value' => (isset($investor['Investor']['inv_amount']) ? $investor['Investor']['inv_amount'] : '' ))); ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <?php echo $this->Form->input('currency_id', array('label' => 'Currency', 'empty' => "--Please Select a Currency--")); ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <?php echo $this->Form->input('inv_freq', array('label' => 'Frequency', 'value' => (isset($investor['Investor']['inv_freq']) ? $investor['Investor']['inv_freq'] : '' ))); ?>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <?php echo $this->Form->input('investmentterm_id', array('label' => 'Investment Term', 'empty' => "--Please Select--")); ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <?php echo $this->Form->input('paymentschedule_id', array('label' => 'Payment Schedule', 'empty' => "--Please Select--")); ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <?php echo $this->Form->input('paymentmode_id', array('label' => 'Payment Mode', 'empty' => "--Please Select--")); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <?php
                                echo $this->Form->input('investmentproduct_id', array('label' => 'Investment Product', 'empty' => "--Please Select--"));
                                echo $this->Form->input('instruction_id', array('label' => 'Instructions', 'empty' => "--Please Select--"));
                                echo $this->Form->input('instruction_details', array('label' => 'Other Instruction Details', 'placeholder' => "Complete this ONLY if 'Other' is selected"));
                                ?>
                            </div>
                        </div>
                    
                    <!-- Investment Details End -->

                </td>
            </tr>
            <tr>
                <td colspan="3" align="left" valign="top" style="border-bottom: dotted 1px gray;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" align="left" valign="top">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <table width="80%" cellspacing="0" cellpadding="3" border="0">
                            <tr>
                                <td align="right"><b align="right">Due Date: </b></td>
                                <td><span id="xxxxxx"><?php
                                        if (isset($duedate)) {
                                            echo $duedate;
                                        } else {
                                            echo '';
                                        }
                                        ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <table width="80%" cellspacing="0" cellpadding="3" border="0">
                            <tr>
                                <td align="right"><b align="right">Interest Accrued: </b></td>
                                <td><span id="xxxxxx"><?php
                                        if (isset($interest)) {
                                            echo $shopCurrency . ' ' . $interest;
                                        } else {
                                            echo '';
                                        }
                                        ?></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <table width="80%" cellspacing="0" cellpadding="3" border="0">
                            <tr>
                                <td align="right"><b align="right" style='color: #ff0000'>Total Amount Due: </b></td>
                                <td><span id="xxxxxx" ><b><?php
                                            if (isset($totaldue)) {
                                                echo $shopCurrency . ' ' . $totaldue;
                                            } else {
                                                echo '';
                                            }
                                            ?></b></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>

            <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top">&nbsp;</td>
            </tr>

            <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="middle" colspan="2">
                    <?php echo $this->Html->link('Back', "/Investments/newInvestment", array("class" => 'btn btn-lg btn-info')); ?>
                    <?php echo $this->Form->button('Process', array("type" => "submit", "class" => "btn btn-lg btn-success")); ?>
                    &nbsp;&nbsp;
                    <?php echo $this->Html->link('Next', "/Investments/newInvestmentCert", array("class" => 'btn btn-lg btn-primary')); ?>
                </td>
            </tr>
        </table>
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

    </div>
    <!-- Content ends here -->
