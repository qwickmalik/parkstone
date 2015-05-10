<?php
echo $this->element('header');


$username = "Unknown";
if ($this->Session->check('userData')) {
    $username = $this->Session->read('userData');
    $username = ucwords(strtolower($username));
} else {
    $username = "Unknown";
    $username = ucwords(strtolower($username));
}
$options = array("Expense");
$expense_options = array("Petty Cash");
//if ($this->Session->read('userDetails.usertype_id')) {

    //$userType = $this->Session->read('userDetails.usertype_id');
    $userType = 1;
    if ($userType == 1 || $userType == 7) {
        $options = array("Expense", "New_Loans", "Owner_Injections", "Owner_Withdrawal", "Loan_Repayment", "Tax Payments", "Deposits", "Dispense Petty Cash");
        $expense_options = array("Petty Cash", "Bank", "Other");
    }
//}
?>

<!-- Content starts here -->
<h3>Cash Entry</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        <?php
        $list = array(
            $this->Html->link('Add New Account Heading', '/Settings/createExpenses', array('escape' => false, 'class' => 'btn btn-lg btn-info'))
        );
        echo $this->Html->nestedList($list, $tag = 'ul');
        ?>

        <div id="clearer"><br /></div>
        <?php echo $this->Form->create('CashAccount', array("url" => array('controller' => 'CashAccounts', 'action' => 'saveCash'), "inputDefaults" => array('label' => false, 'div' => false))); ?>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <table border="0" width="100%" cellspacing="0" cellpadding="0" align="left">
                    <tr>
                        <td align="right" valign="middle"><b>Expense Date:&nbsp;&nbsp;</b></td>
                        <td valign="bottom">
                            <?php
//echo $this->Form->input('expense_date', array('size' => 1, 'type' => 'date', 'value' => date('Y-m-d'), 'dateFormat' => 'DMY', 'label' => false));
//echo $this->Form->year('expense_date', 2005, date('Y'), array("id" => "is_year", 'size' => 1, "style" => "margin-right: 10px;", 'empty' => date('Y')));
                            ?>
                            <div class="row" >
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo $this->Form->day('expense_date', array('label' => false, 'value' => (isset($investor['CashAccount']['expense_date']) ? date('d', strtotime($investor['CashAccount']['expense_date'])) : date('d')), 'empty' => '---Select Day---', 'class' => 'required')); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo $this->Form->month('expense_date', array('label' => false, 'value' => (isset($investor['CashAccount']['expense_date']) ? date('m', strtotime($investor['CashAccount']['expense_date'])) : date('m')), 'empty' => '---Select Month---', 'class' => 'required')); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php echo $this->Form->year('expense_date', 1950, date('Y'), array("id" => "is_year", 'type' => 'date', 'dateFormat' => 'Y', "style" => "margin-right: 10px;", 'label' => false, 'value' => (isset($investor['CashAccount']['expense_date']) ? date('Y', strtotime($investor['CashAccount']['expense_date'])) : date('Y')), 'empty' => '---Select Year---', 'class' => 'required')); ?>
                                </div>
                            </div>
                        </td>
                    </tr>    
                    <tr>
                        <td align="right"><b>Acct. Heading:&nbsp;&nbsp;</b></td>
                        <td><?php echo $this->Form->input('expense_id', array('empty' => '--Please Select--')); ?></td>
                    </tr>


                    <tr>
                        <td width="120" align="right"><b>Account Type:&nbsp;&nbsp;</b></td>
                        <td> <?php
                            echo $this->Form->input('expense_type', array('options' => $options, 'empty' => '--Please Select--'));
                            ?></td>
                    </tr>
                    <tr class="exp_desc" style="display: none;">
                        <td width="120" align="right"><div class="exp_desc" style="display: none;"><b>Expense Type:&nbsp;&nbsp;</b></div></td>
                        <td> <div class="exp_desc" style="display: none;"><?php
                                echo $this->Form->input('expense_desc', array('options' => array("Selling & Distribution", "Administrative"), 'empty' => '--Please Select--', "style" => "display: none;"));
                                ?></div></td>

                    </tr>

                    <tr class="exp_desc" style="display: none;">
                        <td width="120" align="right"><div class="exp_desc" style="display: none;"><b>Source:&nbsp;&nbsp;</b></div></td>
                        <td> <div class="exp_desc" style="display: none;"><?php
                                echo $this->Form->input('source', array('options' => $expense_options, 'empty' => '--Please Select--'));
                                ?></div></td>

                    </tr>
                    <tr class="zoneclass" style="display: none;">
                        <td width="120" align="right"><div class="zoneclass" style="display: none;"><b>Zone:&nbsp;&nbsp;</b></div></td>
                        <td><?php echo $this->Form->input('zone_id', array('default' => 0, 'label' => false, 'empty' => '--Please Select--', "class" => "zoneclass", "style" => "display: none;")); ?></td>

                    </tr>
<!--                                            <tr class="pettyc" style="display: none;">
<td width="120" align="right"><div class="pettyc" style="display: none;"><b>Zone:&nbsp;&nbsp;</b></div></td>
<td><?php //echo $this->Form->input('zone_id', array('default' => 0, 'label' => false,'empty' => '--Please Select--', "class"=>"pettyc","style" => "display: none;"));   ?></td>
                    
                    </tr>-->
                    <tr class="deposit" style="display: none;">
                        <td><div class="deposit" style="display: none;"><b align="right">Deposit Type:&nbsp;&nbsp;</b></div></td>
                        <td><div class="deposit" style="display: none;"><?php echo $this->Form->input('deposit_type', array('options' => array("Revenue", "Donations", "Bank", "Other"), 'empty' => '--Please Select--', "style" => "display: none;")); ?></div></td>
                    </tr>
                    <!--                    
                                        <tr class="deposit" style="display: none;">
                                            <td width="120" align="right"><div class="deposit" style="display: none;"><b>Zone:&nbsp;&nbsp;</b></div></td>
                                        <td><?php // echo $this->Form->input('zone_id', array('default' => 0, 'label' => false,'empty' => '--Please Select--'));   ?></td>
                                                                </tr>-->
                    <tr class="loan" style="display: none;">
                        <td><div class="loan" style="display: none;"><b align="right">Principal Amt:&nbsp;&nbsp;</b></div></td>
                        <td><div class="loan" style="display: none;"><?php echo $this->Form->input('principal', array("class" => "large", "size" => 20, "style" => "display: none;")); ?></div></td>
                    </tr>
                    <tr class="loan" style="display: none;">
                        <td><div class="loan" style="display: none;"><b align="right">First Payment:&nbsp;&nbsp;</b></div></td>
                        <td><div class="loan" style="display: none;"><?php
                                echo $this->Form->input('first_payment', array('size' => 1, 'type' => 'date', 'dateFormat' => 'DMY', 'value' => date('Y-m-d'), 'label' => false));

                                //echo $this->Form->year('first_payment', 2005, null, array('size' => 1, "style" => "margin-right: 10px;", 'empty' => date('Y')));
                                ?></div></td>
                    </tr>
                    <tr class="repay" style="display: none;">
                        <td align="right" ><b>Loan Name:&nbsp;&nbsp;</b></td>
                        <td><?php echo $this->Form->input('loan_id', array('empty' => '--Please Select--', "style" => "display: none;")); ?></td>
                    </tr>

                    <tr class="repay" style="display: none;">
                        <td align="left" colspan="2">
                            <?php
// echo "<b style='font-size: 15px;'>Principal:&nbsp;</b>&nbsp;".$this->Form->input('principal',array("class" => "large","size" => 20,"disabled" => "disabled","value" => 0));
                            ?>  <?php
                            echo "<h3>Principal Balance:&nbsp;&nbsp;" . $this->Form->input('principal_balance', array("class" => "large", "size" => 20, "disabled" => "disabled", "value" => 0)) . "</h3>";
                            ?>
                        </td>
                    </tr>
                    <tr class="repay" style="display: none;">
                        <td align="left" colspan="2">
                            <?php
                            echo "<h3>Total Interest Due:&nbsp;&nbsp;" . $this->Form->input('tinterest_due', array("class" => "large", "size" => 20, "disabled" => "disabled", "value" => 0)) . "</h3>";
                            ?>  <?php
                            echo "<h3>&nbsp;&nbsp;&nbsp;Yearly Interest Due:&nbsp;&nbsp;" . $this->Form->input('interest_due', array("class" => "large", "size" => 20, "disabled" => "disabled", "value" => 0)) . "</h3>";
                            ?>
                        </td>
                    </tr>
                    <tr class="repay" style="display: none;">
                        <td><div class="repay" style="display: none;"><b align="right">Interest Payment:&nbsp;&nbsp;</b></div></td>
                        <td><div class="repay" style="display: none;"><?php echo $this->Form->input('interest_payment', array("class" => "large", "size" => 20, "style" => "display: none;", "value" => 0)); ?></div></td>
                    </tr>


                    <tr class="loan" style="display: none;">
                        <td><div class="loan" style="display: none;"><b align="right">Schedule Type:&nbsp;&nbsp;</b></div></td>
                        <td><div class="loan" style="display: none;"><?php echo $this->Form->input('scd_type', array('options' => array("Daily", "Weekly", "Monthly"), 'empty' => '--Please Select--', "style" => "display: none;")); ?></div></td>
                    </tr>
                    <tr class="loan" style="display: none;">
                        <td><div class="loan" style="display: none;"><b align="right">Schedule Period:&nbsp;&nbsp;</b></div></td>
                        <td><div class="loan" style="display: none;"><?php echo $this->Form->input('ln_months', array("class" => "large", "size" => 20, "style" => "display: none;")); ?></div></td>
                    </tr>

                    <tr>
                        <td align="right"><b><span class="amt">Amount</span>:&nbsp;&nbsp; </b></td>
                        <td><?php echo $this->Form->input('amount', array("class" => "large", "size" => 20)); ?></td>
                    </tr>
<!--                    <tr>
                        <td align="right"><b>Authorized by:&nbsp;&nbsp;</b></td>
                        <td><?php //echo $this->Form->input('user_id', array('empty' => '--Please Select--'));   ?></td>
                    </tr>-->
                    <tr>
                        <td align="right"><b>Paid to:&nbsp;&nbsp;</b></td>
                        <td><?php echo $this->Form->input('paid_to', array()); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Prepared by:&nbsp;&nbsp;</b></td>
                        <td><?php echo $this->Form->input('prepared_by', array('value' => $username, 'disabled' => true)); ?></td>
                    </tr>
<!--                        <tr>
                        <td align="right"><b>Department:&nbsp;&nbsp;</b></td>
                        <td>
                    <?php //echo $this->Form->input('userdepartment_id',array('empty' => '--Please Select--', 'disabled' => true));   ?><i style="color: red;">automatically load department of logged in user</i></td>
                    </tr>-->
                </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php
                echo $this->Form->input('remarks', array('label' => 'Transaction Description'));

                echo $this->Form->button('Save', array("type" => "submit", "class" => "btn btn-lg btn-success", "id" => "expense_save")); //check the parameters here 
                echo $this->Form->button('Clear', array("type" => "reset", "class" => "btn btn-lg btn-info"));
                ?>
            </div>
        </div>

        </td>

        </tr>
        <tr>
            <td align="right">&nbsp;</td>
            <td align="right">

            </td>
        </tr>
        </table>
        </form>
        <div id="clearer"></div>

        <form id="expense_list" action="#" method="post">
            <table border="0" width="100%" cellspacing="0" id ="report_content" cellpadding="5" align="left">
                <tr>
                    <th style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></th>
                    <th style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('expense_name', 'Account Heading'); ?></b></th>
                    <th style="border-bottom: solid 2px dodgerblue" width="120" align="left"><b><?php echo $this->Paginator->sort('expense_type', 'Account Type'); ?></b></th>
                    <th style="border-bottom: solid 2px dodgerblue" width="80" align="left"><b><?php echo $this->Paginator->sort('zone', 'Zone'); ?></b></th>
                    <th style="border-bottom: solid 2px dodgerblue" width="60" align="left"><b><?php echo $this->Paginator->sort('amount', 'Amount'); ?></b></th>
                    <th style="border-bottom: solid 2px dodgerblue;" width="120" align="left"><b><?php echo $this->Paginator->sort('expense_date', 'Date'); ?></b></th>

                    <th style="border-bottom: solid 2px dodgerblue;"  align="left"><b><?php echo $this->Paginator->sort('remarks', 'Description'); ?></b></th>

<!--                                <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>-->
                </tr>
                <?php
                foreach ($data as $each_item):

                    switch ($each_item['CashAccount']['expense_type']) {
                        case 0:
                            $expensename = "Expense";
                            break;
                        case 1:
                            $expensename = "New_Loans";
                            break;
                        case 2:
                            $expensename = "Owner_Investment";
                            break;
                        case 3:
                            $expensename = "Owner_Withdrawal";
                            break;
                        case 4:
                            $expensename = "Loan_Repayment";
                            break;
                        case 5:
                            $expensename = "Tax Payments";
                            break;
                        case 6:
                            $expensename = "Deposits";
                            break;
                        case 7:
                            $expensename = "Petty Cash Dispensation";
                            break;
                    }
                    ?>
                    <tr>
                        <td width="50" align="left"><?php echo $each_item['CashAccount']['id']; ?></td>
                        <td align="left"><a href="#"><?php echo $each_item['Expense']['payment_name']; ?></a></td> <!-- Link to enable editing -->
                        <td width="120" align="left"><?php echo $expensename ?></td>

                        <td width="80" align="left"><?php echo $each_item['Zone']['zone']; ?></td>
                        <td width="60" align="left"><?php echo $each_item['CashAccount']['amount']; ?></td>
                        <td align="left"><?php echo $each_item['CashAccount']['expense_date']; ?></td>
                        <td  align="left"><?php echo $each_item['CashAccount']['remarks']; ?></td>
            <!--                                <td width="20" align="left">
                        <?php
                        //echo $this->Html->link("Delete", "/CashAccounts/delAsset/" . $each_item['CashAccount']['id'], array("class" => $each_item['CashAccount']['id']));
//                                    echo $this->Form->checkbox($each_item['Order']['id'], array('value' => 'Y','hiddenField' => 'N',));
                        ?>
                        </td>-->
                    </tr>
                <?php endforeach; ?>

                <tr>
                    <td colspan="7" align="right">
                        <?php
                        //echo $this->Form->button('Delete',array("type" => "#","class" => "button_red"));           //check the parameters here
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="7" align="center">
                        <?php
                        echo $this->Paginator->first($this->Html->image('first.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'First', 'title' => 'First')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
                        echo $this->Paginator->prev($this->Html->image('prev.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'Previous', 'title' => 'Previous')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
                        echo $this->Paginator->numbers() . "&nbsp;&nbsp;";
                        echo $this->Paginator->next($this->Html->image('next.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'Next', 'title' => 'Next')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
                        echo $this->Paginator->last($this->Html->image('last.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'Last', 'title' => 'Last')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
//prints X of Y, where X is current page and Y is number of pages
                        echo $this->Paginator->counter(array('format' => 'Page %page% of %pages%, showing %current% items out of %count% total'));
                        ?>
                    </td>
                </tr>
            </table>
        </form>

        <!-- Content ends here -->
