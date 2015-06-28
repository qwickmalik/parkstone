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
    <h2>Cash/Bank Account Balances</h2>
    <div class="boxed">
        <div class="inner">
            <div id="clearer"></div>
            <div id="content_menu">

    <?php
    $list = array(
        $this->Html->link($this->Html->image('plus.png') . 'Add New Account', '/Settings/cashAccounts', array('escape' => false))
    );
    echo $this->Html->nestedList($list, $tag = 'ul');
    ?>
</div>
<div id="clearer"></div>

<?php // echo $this->Form->create('BankBalance', array("url" => array('controller' => 'Accounting', 'action' => 'bankBalances'), "inputDefaults" => array('div' => false,))); ?>

<!--<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">          

        <?php
//        echo $this->Form->input('statement_date', array('type' => 'date', 'label' => 'Statement Date*','dateFormat' => 'DMY', 'value' => (isset($ex['BankBalance']['statement_date']) ? date('d-m-Y',strtotime($ex['BankBalance']['statement_date'])) : date('d-m-Y')), 'class' => 'form-control', 'div' => array('class' => 'form-inline')));
//
//        echo $this->Form->hidden('id', ['value' => isset($ex['BankBalance']['id']) ? $ex['BankBalance']['id'] : '']);
//         echo $this->Form->hidden('transaction_type', array('value' => 'Deposit'));
//        echo $this->Form->input('account_id', array('required','label' => 'Bank Account*', 'empty' => '--Please Select--', 'value' => isset($ex['BankBalance']['account_id']) ? $ex['BankBalance']['account_id'] : ''));
//        ?>
    </div>


    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        
        <?php
//        echo $this->Form->input('balance', array('required','label' => 'Balance*', 'value' => isset($ex['BankBalance']['balance']) ? $ex['BankBalance']['balance'] : ''));
//        
//        echo $this->Form->input('user1', array('label' => 'Recorded By', 'value' => $username, 'disabled' => true));
//        echo $this->Form->hidden('user', array('value' => $username));
//
//        echo $this->Form->hidden('created', array('type' => 'datetime', 'value' => isset($ex['BankBalance']['created']) ? $ex['BankBalance']['created'] : '', 'dateFormat' => 'DMY H:i:s', 'class' => 'form-control', 'div' => array('class' => 'form-inline')));
//
//        echo $this->Form->hidden('modified', array('type' => 'datetime', 'value' => date('d-m-Y H:i:s'), 'dateFormat' => 'DMY H:i:s', 'class' => 'form-control', 'div' => array('class' => 'form-inline')));
//
//          echo $this->Form->button('Save', array("type" => "submit", "class" => "btn btn-md btn-success", 'style' => 'float: right;'));
//        echo $this->Form->button('Clear', array("type" => "reset", "class" => "btn btn-md btn-default", 'style' => 'float: right;'));
        ?>
    </div>

</div>-->

<?php // $this->form->end(); ?>

<div id="clearer"></div>


<table class="table table-striped">
    <tr>
        <th style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></th>
        <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('account_id', 'Bank Account'); ?></b></th>
        <th style="border-bottom: solid 2px dodgerblue;" align="right"><b><?php echo $this->Paginator->sort('amount', 'Balance'); ?></b></th>
        <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('create_date', 'Created'); ?></b></th>
        <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('modified_date', 'Modified'); ?></b></th>
        <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('user', 'Recorded By'); ?></b></th>
        <!--<td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>-->
    </tr>
    <?php
    foreach ($data as $each_item):
        ?>
        <tr>
            <td width="50" align="left"><?php echo $each_item['BankBalance']['id']; ?></td>
            <?php
                    $myaccounts = ClassRegistry::init('CashAccount');
                    $account = $myaccounts->find('first', array('conditions' => array('CashAccount.id' => $each_item['BankBalance']['account_id'])));
                ?>
            <td align="left"><?php echo $account['Bank']['bank_name'].' - '.$account['CashAccount']['account_no']; ?></td>
            <td align="right"><?php echo number_format($each_item['BankBalance']['amount'], 2); ?></td>
            <td align="left"><?php echo $each_item['BankBalance']['created']; ?></td>
            <td align="left"><?php echo $each_item['BankBalance']['modified']; ?></td>
            <td align="left"><?php echo $each_item['BankBalance']['user']; ?></td>
<!--            <td align="left"><?php // echo $this->Html->link('Del', '/Accounting/delBankBalance/' . $each_item['BankBalance']['id']); ?></td>-->
        </tr>
    <?php endforeach; ?>


    <tr>
        <td colspan="9" align="center">
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
<!-- Footer ends here -->