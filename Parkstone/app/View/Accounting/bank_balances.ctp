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
            <td align="left"><?php echo $each_item['CashAccount']['account_name']; ?></td>
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