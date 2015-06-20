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
//$options = array("Expense");
//$expense_options = array("Petty Cash");
//if ($this->Session->read('userDetails.usertype_id')) {
//
//    $userType = $this->Session->read('userDetails.usertype_id');
//
//    if ($userType == 1 || $userType == 7) {
//        $options = array("Expense", "New_Loans", "Owner_Injections", "Owner_Withdrawal", "Loan_Repayment", "Tax Payments", "Deposits", "Dispense Petty Cash");
//        $expense_options = array("Petty Cash", "Bank", "Other");
//    }
//}
?>

<!-- Content starts here -->
    <h2>Cheque Payables</h2>
    <div id="content_menu">

        <?php
        $list = array(
            $this->Html->link($this->Html->image('plus.png') . 'Bank Accounts', '/Settings/cashAccounts', array('escape' => false))
        );
        echo $this->Html->nestedList($list, $tag = 'ul');
        ?>
    </div>
    <div id="clearer"></div>
    <?php echo $this->Form->create('ChequePayables', array("url" => array('controller' => 'Accounting', 'action' => 'chequePayables'), "inputDefaults" => array('div' => false,))); ?>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <?php 
            echo $this->Form->input('cheque_date', array('type' => 'date', 'value' => date('d-m-Y'), 'dateFormat' => 'DMY', 'class' => 'form-control', 'div' => array('class' => 'form-inline')));
            echo $this->Form->hidden('id', ['value' => isset($ex['Transaction']['id']) ? $ex['Transaction']['id'] : '']);
            echo $this->Form->input('amount', array('label' => 'Amount*', 'value' => isset($ex['Transaction']['amount']) ? $ex['Transaction']['amount'] : '')); 

            ?>
        </div>
        
        
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <?php
            echo $this->Form->input('source_account', array('label' => 'Source Account/Repository*', 'options' => $account, 'empty' => '--Please Select--','value' => isset($ex['Transaction']['account_id']) ? $ex['Transaction']['account_id'] : ''));
            
            echo $this->Form->input('destination_account', array('label' => 'Destination Account/Repository*', 'options' => $account, 'empty' => '--Please Select--','value' => isset($ex['Transaction']['account_id']) ? $ex['Transaction']['account_id'] : ''));
            
            echo $this->Form->input('remarks', array('label' => 'Transaction description', 'value' => isset($ex['Transaction']['remarks']) ? $ex['Transaction']['remarks'] : ''));
            echo $this->Form->input('user1', array('label' => 'Prepared By', 'value' => $username, 'disabled' => true));
            echo $this->Form->hidden('user', array('value' => $username));
            
            echo $this->Form->hidden('create_date', array('type' => 'date', 'value' => date('d-m-Y'), 'dateFormat' => 'DMY'));
            echo $this->Form->hidden('modified_date', array('type' => 'date', 'value' => date('d-m-Y'), 'dateFormat' => 'DMY'));
            
            echo $this->Form->button('Save', array("type" => "submit", "class" => "btn btn-md btn-success", 'style'=> 'float: right;')); 
            echo $this->Form->button('Clear', array("type" => "reset", "class" => "btn btn-md btn-default", 'style'=> 'float: right;'));
            ?>
        </div>
        
    </div>

    <?php $this->form->end(); ?>

<div id="clearer"></div>


    <table class="table table-striped">
        <tr>
            <th style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('transaction_date', 'Trans. Date'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('head_id', 'Accounting Head'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('category_id', 'Trans. Category'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('account_id', 'Source Acc/Repository'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" width="60" align="right"><b><?php echo $this->Paginator->sort('amount', 'Amount'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('remarks', 'Trans. Desc.'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('paid_to', 'Paid To'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('prepared_by', 'Prepared By'); ?></b></th>
            <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>
        </tr>
        <?php
        foreach ($data as $each_item):
            ?>
            <tr>
                <td width="50" align="left"><?php echo $each_item['Transaction']['id']; ?></td>
                <td align="left"><?php echo $each_item['Transaction']['transaction_date']; ?></td>
                <td align="left"><?php echo $each_item['AccountingHead']['head_name']; ?></td>
                <td align="left"><?php echo $each_item['TransactionCategory']['category_name']; ?></td>
                <td align="left"><?php echo $each_item['CashAccount']['account_no']; ?></td>
                <td align="right"><?php echo $this->Html->link($each_item['Transaction']['amount'], '/Accounting/expenses/' . $each_item['Transaction']['id']); ?></td>
                <td align="left"><?php echo $each_item['Transaction']['remarks']; ?></td>
                <td align="left"><?php echo $each_item['Transaction']['paid_to']; ?></td>
                <td align="left"><?php echo $each_item['Transaction']['prepared_by']; ?></td>
                <td align="left"><?php echo $this->Html->link('Del', '/Accounting/delExpense/' . $each_item['Transaction']['id']); ?></td>
            </tr>
        <?php endforeach; ?>

        
        <tr>
            <td colspan="10" align="center">
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


</div>
<!-- Content ends here -->
<!-- Sidebar starts here -->
<div id="sidebar">
    <?php
    echo $this->element('logo');
    echo $this->element('sidebar_company_accounts'); //Mini Dashboard
    ?>
</div>
<!-- Sidebar ends here -->
<!-- Footer starts here -->
<?php echo $this->element('footer'); ?>
<!-- Footer starts here -->