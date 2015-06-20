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

?>

<!-- Content starts here -->
<div id="content">
    <h2>Bank & Cash Account Transfers</h2>
    <div class="boxed">
        <div class="inner">
            <div id="clearer"></div>
            <div id="content_menu">

        <?php
        $list = array(
            $this->Html->link($this->Html->image('plus.png') . 'Add New Financial Category', '/Settings/transactionCategories', array('escape' => false))
        );
        echo $this->Html->nestedList($list, $tag = 'ul');
        ?>
    </div>
    <div id="clearer"></div>
    <?php echo $this->Form->create('BankTransfer', array("url" => array('controller' => 'Accounting', 'action' => 'bankTransfers'), "inputDefaults" => array('div' => false,))); ?>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">          
                            
            <?php 
            echo $this->Form->input('transfer_date', array('type' => 'date', 'dateFormat' => 'DMY', 'value' => isset($ex['BankTransfer']['transfer_date']) ? date('d-m-Y',strtotime($ex['BankTransfer']['transfer_date'])) : date('d-m-Y'), 'class' => 'form-control', 'div' => array('class' => 'form-inline')));
            
             echo $this->Form->hidden('transaction_type', array('value' => 'Withdrawal & Deposit'));
            echo $this->Form->hidden('id', ['value' => isset($ex['BankTransfer']['id']) ? $ex['BankTransfer']['id'] : '']);
            echo $this->Form->input('amount', array('required','label' => 'Amount*', 'value' => isset($ex['BankTransfer']['amount']) ? $ex['BankTransfer']['amount'] : '')); 

            echo $this->Form->input('source_account_id', array('required','label' => 'Source Account/Repository*', 'options' => $accounts, 'empty' => '--Please Select--','value' => isset($ex['BankTransfer']['source_account_id']) ? $ex['BankTransfer']['source_account_id'] : ''));
            
            echo $this->Form->input('dest_account_id', array('required','label' => 'Destination Account/Repository*', 'options' => $accounts, 'empty' => '--Please Select--','value' => isset($ex['BankTransfer']['dest_account_id']) ? $ex['BankTransfer']['dest_account_id'] : ''));
            
            ?>
        </div>
        
        
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
           <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <?php echo $this->Form->input('paymentmode_id', array('required','empty' => '--Please Select--','label' => 'Payment Mode', 'select' => isset($ex['Transaction']['payment_mode_id']) ? $ex['Transaction']['payment_mode_id'] : '')); ?> 
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <?php echo $this->Form->input('cheque_no', array('label' => 'Cheque No.', 'value' => isset($ex['Transaction']['cheque_no']) ? $ex['Transaction']['cheque_no'] : '')); ?> 
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <?php echo '<br /><br />'. $this->Form->input('cheque_cleared', array('type' => 'checkbox', 'checked' => isset($ex['Transaction']['cheque_cleared']) ? ($ex['Transaction']['cheque_cleared']>0 ? true : false) : false)); ?>
                </div>
            </div>
            <?php

            echo $this->Form->input('remarks', array('label' => 'Remarks', 'value' => isset($ex['BankTransfer']['remarks']) ? $ex['BankTransfer']['remarks'] : ''));
            echo $this->Form->input('user1', array('label' => 'Recorded By', 'value' => $username, 'disabled' => true));
            echo $this->Form->hidden('user', array('value' => $username));
            
            echo $this->Form->hidden('create_date', array('type' => 'datetime', 'value' => isset($ex['BankTransfer']['create_date']) ? $ex['BankTransfer']['create_date'] : '', 'dateFormat' => 'DMY H:i:s', 'class' => 'form-control', 'div' => array('class' => 'form-inline')));
            
            echo $this->Form->hidden('modified_date', array('type' => 'datetime', 'value' => date('d-m-Y H:i:s'), 'dateFormat' => 'DMY H:i:s', 'class' => 'form-control', 'div' => array('class' => 'form-inline')));
            
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
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('transfer_date', 'Transfer Date'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('amount', 'Amount'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('source_account_id', 'Source Account'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('dest_account_id', 'Destination Account'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="right"><b><?php echo $this->Paginator->sort('cheque_no', 'Cheque No.'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('cheque_cleared', 'Cheque Cleared'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('remarks', 'Remarks'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('create_date', 'Created'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('modified_date', 'Modified'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('user', 'Recorded By'); ?></b></th>
            <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>
        </tr>
        <?php
        foreach ($data as $each_item):
            ?>
            <tr>
                <td width="50" align="left"><?php echo $each_item['BankTransfer']['id']; ?></td>
                <td align="left"><?php echo $each_item['BankTransfer']['transfer_date']; ?></td>
                <td align="right"><?php echo $this->Html->link(number_format($each_item['BankTransfer']['amount'], 2, '.', ','), '/Accounting/bankTransfers/' . $each_item['BankTransfer']['id']); ?></td>
                <?php
//                    $source_account = $html->getSourceAccount($each_item['BankTransfer']['source_account_id']);
                    
                    $accounts = ClassRegistry::init('CashAccount');
                    $source_account = $accounts->find('first', array('conditions' => array('CashAccount.id' => $each_item['BankTransfer']['source_account_id'])));
                    $dest_account = $accounts->find('first', array('conditions' => array('CashAccount.id' => $each_item['BankTransfer']['dest_account_id'])));
                ?>
                <td align="left"><?php echo $source_account['Bank']['bank_name'].' - '.$source_account['CashAccount']['account_no']; ?></td>
                <td align="left"><?php echo $dest_account['Bank']['bank_name'].' - '.$dest_account['CashAccount']['account_no']; ?></td>
                <td align="left"><?php echo $each_item['BankTransfer']['cheque_no']; ?></td>
                <td align="left"><?php  echo $each_item['BankTransfer']['cheque_cleared']>0? '<span style="color: green;">Yes</span>': '<span style="color: red;">No</span>'; ?></td>
                <td align="left"><?php echo $each_item['BankTransfer']['remarks']; ?></td>
                <td align="left"><?php echo $each_item['BankTransfer']['create_date']; ?></td>
                <td align="left"><?php echo $each_item['BankTransfer']['modified_date']; ?></td>
                <td align="left"><?php echo $each_item['BankTransfer']['user']; ?></td>
                <td align="left"><?php echo $this->Html->link('Del', '/Accounting/delBankTransfer/' . $each_item['BankTransfer']['id'], array('confirm' => 'Are you sure you want to delete?')); ?></td>
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
<div id="clearer"></div>

</div>
<!-- Content ends here -->

<!-- Footer starts here -->
<?php echo $this->element('footer'); ?>
<!-- Footer starts here -->

    <script lang="javascript">
        jQuery(document).ready(function ($) {
               function hide_chequeno() {
                var cashmode = $("#BankTransferPaymentmodeId").val();
                if (cashmode == '2') {
                    $("#BankTransferChequeNo").prop('disabled', false);
                    return false;
                }
                if (cashmode != '2' && cashmode != '4' ) {
                    $("#BankTransferChequeNo").prop('disabled', true);
                    return false;
                }
            }





            //DISABLE CHEQUENO if CASH
            hide_chequeno();
            $("#BankTransferPaymentmodeId").change(function () {
                hide_chequeno();
            });
            
            });
    </script>