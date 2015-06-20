<?php echo $this->element('header'); ?>


<!-- Content starts here -->
<h3>SETTINGS: Cash/Bank Accounts</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <?php echo $this->Form->create('CashAccount', array("url" => array('controller' => 'Settings', 'action' => 'cashAccounts'))); ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
//                echo $this->Form->input('account_name', array('value' => 'Parkstone Capital Limited'));
//                echo $this->Form->hidden('id');
//                echo $this->Form->hidden('create_date');
//                echo $this->Form->hidden('zone_id', array());

                echo $this->Form->hidden('zone_id', ['default' => 1, 'empty' => '--Please select--', 'value' => isset($ca['CashAccount']['zone_id']) ? $ca['CashAccount']['zone_id'] : 1]);
                echo $this->Form->input('account_name', ['required','label' => 'Account Name*', 'value' => isset($ca['CashAccount']['account_name']) ? $ca['CashAccount']['account_name'] : $company['Setting']['company_name']]);
                echo $this->Form->hidden('id', ['value' => isset($ca['CashAccount']['id']) ? $ca['CashAccount']['id'] : '']);
                echo $this->Form->hidden('create_date');
                echo $this->Form->input('currency_id', array('default' => 1, 'label' => 'Currency*', 'empty' => "--Select bank--", 'class' => 'required'));
                ?>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
//                echo $this->Form->input('bank_name', array()); 
//                echo $this->Form->input('bank_id', array('label' => 'Bank Name*', 'empty' => "--Select bank--"));
//                echo $this->Form->input('account_no', array('label' => 'Account Number*'));
//                echo $this->Form->input('branch', array('label' => 'Branch*'));
//                echo $this->Form->button('Save', array("type" => "submit", "class" => "btn btn-lg btn-success", 'style' => 'float: right;'));
                    echo $this->Form->input('bank_id', ['required','label' => 'Bank Name*', 'empty' => '--Please select--', 'options' => $banks, 'value' => isset($ca['CashAccount']['bank_id']) ? $ca['CashAccount']['bank_id'] : '']);
                ?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php echo $this->Form->input('account_no', ['required','label' => 'Account Number/Identifier*', 'value' => isset($ca['CashAccount']['account_no']) ? $ca['CashAccount']['account_no'] : '']);?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php echo $this->Form->input('branch', ['required','label' => 'Bank Branch', 'value' => isset($ca['CashAccount']['branch']) ? $ca['CashAccount']['branch'] : '']);?>
                    </div>
                </div>
            </div>
        </div>

        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>
        <div id="clearer"></div>
<table class="table table-striped">
        <tr>
            <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('zone_id', 'Company Branch'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('account_name', 'Account Name'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('symbol', 'Currency'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('bank_name', 'Bank Name'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('account_no', 'Account Number'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('branch', 'Branch'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>
        </tr>
        <?php foreach ($data as $each_item): ?>
            <tr>
                <td width="50" align="left"><?php echo $each_item['CashAccount']['id']; ?></td>
                <td align="left"><?php echo $each_item['Zone']['zone']; ?></td>
                <td align="left"><?php echo $each_item['CashAccount']['account_name']; ?></td>
                <td align="left"><?php echo $each_item['Currency']['symbol']; ?></td>
                <td align="left"><?php echo $each_item['Bank']['bank_name']; ?></td>
                <td align="left"><?php echo $this->Html->link($each_item['CashAccount']['account_no'], "/Settings/cashAccounts/" . $each_item['CashAccount']['id']); ?></td> 
                <td align="left"><?php echo $each_item['CashAccount']['branch']; ?></td>
                <td width="20" align="left"><?php echo $this->Html->link("Delete", "/Settings/delCashAcc/" . $each_item['CashAccount']['id'], array("class" => $each_item['CashAccount']['id'], 'confirm' => 'Are you sure you want to delete?')); ?></td>
            </tr>
        <?php endforeach; ?>
        
        <tr>
            <td colspan="8" align="center">
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
    <?php echo $this->element('footer'); ?>

