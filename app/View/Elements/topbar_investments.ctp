<?php
     $list = array(
         $this->Html->link($this->Html->image('go.png').'Edit/Delete Payments','/Investments/listPayments', array('escape' => false)),
//         $this->Html->link($this->Html->image('go.png').'Manage Investments','/Investments/manageInvestments', array('escape' => false)),
        // $this->Html->link($this->Html->image('plus.png').'List Invoice Payments','/Stocks/supPaySupplier', array('escape' => false)),
        );
     echo $this->Html->nestedList($list, $tag = 'ul');
?>