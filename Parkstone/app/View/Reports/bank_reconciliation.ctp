<?php
echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');
echo $this->Html->script('print.js');
?>
<!-- Content starts here -->
<h3>Bank Reconciliation Statement</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

<p ><i style="font-size: 14px;"></i></p>

<?php echo $this->Form->create('Account', array("url" => array('controller' => 'Reports', 'action' => 'bankReconciliation'))); ?>
<div class="row" style="background: #eaeaea; padding: 10px 0px 5px 0px;">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <?php
//        echo $this->Form->input('account_id', array('label' => 'Select Account*', 'options' => $accounts, 'empty' => '--Please select--', 'class' => 'form-control', 'div' => array('class' => 'form-inline'))); 
        echo $this->Form->input('account_id', array('label' => 'Account*', 'empty' => '--Please Select--', 'options' => (isset($accounts) ? $accounts : '--No Accounts Available--'), 'class' => 'form-control', 'div' => array('class' => 'form-inline')));
        ?>
    </div>

    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <?php echo $this->Form->button('Next', array("type" => "submit", "class" => "btn btn-md btn-primary")); ?>
    </div>

    <?php
//    if (isset($balance_details)) {
    ?>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <?php ?>
        <?php echo $this->Form->input('statement_date', array('label' => 'Statement Date*', 'options' => (isset($statement_dates) ? $statement_dates : ''), 'empty' => '--Please select--', 'class' => 'form-control', 'div' => array('class' => 'form-inline'))); ?>
    </div>

    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <?php echo $this->Form->button('View', array("type" => "submit", "class" => "btn btn-md btn-success")); ?>
    </div>


    <?php // }  ?>


</div>
<?php echo $this->Form->end(); ?>

<div id="clearer"></div>

<?php
if (isset($stated_balance) && isset($balance_per_books)) {
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
                            echo 'BANK RECONCILIATION STATEMENT as at '.$statement_date;
                            ?></p>
                        <p align='left'>Generated on <?php echo date('jS F, Y'); ?></p>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                    </div>
                
                </div>


                    <!--<table border="1" cellspacing="0" cellpadding="5" style="border: solid 2px gray;" align="left" width="100%">-->
                <table class="table table-striped">
                    <tr>
                        <td align="left"><?php echo "Balance as per Bank as at " . $statement_date; ?></td>
                        <td align="right" width="150"></td>
                        <td align="right" width="150"><?php echo number_format($stated_balance[0][0]['sum_amount'], 2, '.', ','); ?></td>
                    </tr>
                    <tr>
                        <td align="left"><?php echo "ADD: Deposits in Transit"; ?></td>
                        <td align="right" width="150"></td>
                        <td align="right" width="150"><?php echo number_format($total_deposit_cheques_in_transit[0][0]['sum_amount'], 2, '.', ','); ?></td>
                    </tr>
                    <tr>
                        <td align="left"><?php echo "LESS: Outstanding Cheques"; ?></td>
                        <td align="right" width="150"></td>
                        <td align="right" width="150"></td>
                    </tr>
                    <!-- cheque details go here -->
                    <?php
                    $total_less_cheques = 0;
                    if ($uncleared_payout_cheques[0][0]['sum_amount'] != null) {
                        foreach ($uncleared_payout_cheques as $each_item):
                            ?>
                            <tr>
                                <td align="left"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $each_item['BankTransfer']['cheque_no']; ?></td>
                                <td align="right" width="150"><?php echo number_format($each_item['BankTransfer']['amount'], 2, '.', ','); ?></td>
                                <td align="right" width="150"></td>
                            </tr>
                            <?php
                            $total_less_cheques += $each_item['BankTransfer']['amount'];
                        endforeach;
                    }
                    ?>

                    <?php
                    if ($uncleared_cash_asset_credit_cheques[0][0]['sum_amount'] != null) {
                        foreach ($uncleared_cash_asset_credit_cheques as $each_item):
                            ?>
                            <tr>
                                <td align="left"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $each_item['Transaction']['cheque_no']; ?></td>
                                <td align="right" width="150"><?php echo number_format($each_item['Transaction']['amount'], 2, '.', ','); ?></td>
                                <td align="right" width="150"></td>
                            </tr>
                            <?php
                            $total_less_cheques += $each_item['Transaction']['amount'];
                        endforeach;
                    }
                    ?>



                    <?php
//        if ($uncleared_expense_cheques[0][0]['sum_amount'] != null){
//        foreach ($uncleared_expense_cheques as $each_item):
                    ?>
                <!--            <tr>
                    <td align="left"><?php // echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $each_item['Transaction']['cheque_no'];     ?></td>
                    <td align="right" width="150"><?php // echo number_format($each_item['Transaction']['amount'], 2, '.', ',');     ?></td>
                    <td align="right" width="150"></td>
                </tr>-->
                    <?php
//            $total_less_cheques += $each_item['Transaction']['amount'];
//        endforeach;
//        }
                    ?>
                    <?php
//        if ($uncleared_oe_exp_cheques[0][0]['sum_amount'] != null){
//        foreach ($uncleared_oe_exp_cheques as $each_item):
                    ?>
                <!--            <tr>
                    <td align="left"><?php // echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $each_item['Transaction']['cheque_no'];     ?></td>
                    <td align="right" width="150"><?php // echo number_format($each_item['Transaction']['amount'], 2, '.', ',');     ?></td>
                    <td align="right" width="150"></td>
                </tr>-->
                    <?php
//            $total_less_cheques += $each_item['Transaction']['amount'];
//        endforeach;
//        }
                    ?>

                    <tr>
                        <td align="left"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Outstanding Cheques"; ?></td>
                        <td align="right" width="150"></td>
                        <td align="right" width="150"><?php echo '(' . number_format($total_less_cheques, 2, '.', ',') . ')'; ?></td>
                    </tr>

                    <?php $adjusted_bank_balance = $stated_balance[0][0]['sum_amount'] + $total_deposit_cheques_in_transit[0][0]['sum_amount'] - $total_less_cheques; ?>
                    <tr>
                        <td align="left"><?php echo "<b>Adjusted Bank Balance</b>"; ?></td>
                        <td align="right" width="150"></td>
                        <td align="right" width="150"><?php echo '<b>' . number_format($adjusted_bank_balance, 2, '.', ',') . '</b>'; ?></td>
                    </tr>
                    <tr>
                        <td align="left"><?php echo "<b>Balance as per Books as at </b>" . $statement_date; ?></td>
                        <td align="right" width="150"></td>
                        <td align="right" width="150"><?php echo '<b>' . number_format($balance_per_books, 2, '.', ',') . '</b>'; ?></td>
                    </tr>        

                    <tr>
                        <td align="right" valign="top" colspan="3">
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

</div>
<!-- Content ends here -->

<!-- Footer starts here -->
<?php echo $this->element('footer'); ?>
<!-- Footer starts here -->


<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#AccountAccountId").change(function () {

            var toplevel = jQuery(this).val();
            if (toplevel == "") {
                jQuery('#AccountStatementDate').html('<option value="">-Please Select-</option>');
            }
            if (toplevel != "") {
                var query = "action=getStatementDates&ID=" + toplevel;
                jQuery.ajax({
                    url: "getStatementDates",
                    data: query,
                    dataType: 'json',
                    type: 'POST',
                    success: function (data) {
                        //jQuery('#tab a[href="#mednotes"]').button('toggle');   
                        if (data && data.error) {
                            window.location.reload();

                        } else {
                            //jquery("midleveltype").
                            jQuery('#AccountStatementDate').html('<option value="">-Please Select-</option>');
                            var numbers = data;
                            jQuery.each(numbers, function (val, text) {

                                jQuery('#AccountStatementDate').append('<option value="' + text['StatedBankBalance']['statement_date'] + '">' + text['StatedBankBalance']['statement_date'] + '</option>');
                            });

                            return false;
                        }
                    },
                    error: function () {
                        window.location.reload();
                    }
                });
            }
        });

    });

</script>