<?php
echo "<h2>Investments Mgt.</h2>";

     $list = array(
         $this->Html->link($this->Html->image('add_investor.png').'New Investor','/Investments/newInvestor', array('escape' => false)),
         $this->Html->link($this->Html->image('list_investors.png').'List/Edit Investors','/Investments/listInvestor', array('escape' => false)),
         $this->Html->link($this->Html->image('company_accounts.png').'Create New Investment','/Investments/newInvestment', array('escape' => false)),
         $this->Html->link($this->Html->image('manage_investments.png').'Manage Investments','/Investments/manageInvestments', array('escape' => false)),
         $this->Html->link($this->Html->image('payment.png').'Payments','/Investments/payments', array('escape' => false)),
        );
     echo $this->Html->nestedList($list, $tag = 'ul');
?>