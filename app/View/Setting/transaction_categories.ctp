<?php echo $this->element('header'); ?>


<!-- Content starts here -->
<h3>SETTINGS: Create Financial/Transaction Categories</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        
        

    <div class="row">
        <?php echo $this->Form->create('TransactionCategory', array("url" => array('controller' => 'Settings', 'action' => 'transactionCategories'))); ?>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <?php

            echo $this->Form->input('head_id', ['label' => 'Accounting Head', 'empty' => '--Please select--', 'options' => $headids, 'value' => isset($transcat['TransactionCategory']['head_id']) ? $transcat['TransactionCategory']['head_id'] : '']);

            echo $this->Form->hidden('id', ['value' => isset($transcat['TransactionCategory']['id']) ? $transcat['TransactionCategory']['id'] : '']);
            
            
            ?> 
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <?php
//            echo $this->Form->input('asset_id', ['label' => 'Asset Classification', 'empty' => '--Please select--', 'options' => $assetids, 'value' => isset($transcat['TransactionCategory']['asset_id']) ? $transcat['TransactionCategory']['asset_id'] : '']);
            echo $this->Form->input('category_name', ['label' => 'Financial/Transaction Category', 'value' => isset($transcat['TransactionCategory']['category_name']) ? $transcat['TransactionCategory']['category_name'] : '']);
            ?>
            <?php echo $this->Form->button('Save', array("type" => "submit", "class" => "btn btn-lg btn-success")); ?>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>


    <div id="clearer"></div>


    <table class="table table-striped">
        <tr>
            <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('head_id', 'Accounting Head'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('category_name', 'Transaction Category'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b>Delete</b></td>
        </tr>
        <?php foreach ($data as $each_item): ?>
            <tr>
                <td width="50" align="left"><?php echo $each_item['TransactionCategory']['id']; ?></td>
                <td align="left"><?php echo $each_item['AccountingHead']['head_name']; ?></td>
                
                
                
                <?php
                if ($each_item['TransactionCategory']['system'] == 1){
                ?>
                    <td align="left"><?php echo $each_item['TransactionCategory']['category_name']; ?></td> 
                    <td align="left"><?php echo '-System-'; ?></td>
                <?php
                } else {
                    ?>
                    <td align="left"><?php echo $this->Html->link($each_item['TransactionCategory']['category_name'], "/Settings/transactionCategories/" . $each_item['TransactionCategory']['id'], array()); ?></td> 
                    <td align="left"><?php echo $this->Html->link("Delete", "/Settings/delTransactionCategory/" . $each_item['TransactionCategory']['id'], array("class" => $each_item['TransactionCategory']['id'], 'confirm' => 'Are you sure you want to delete?'));
            ?></td>
                    <?php
                }
                ?>
            </tr>
        <?php endforeach; ?>
        
        <tr>
            <td colspan="4" align="center">
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

