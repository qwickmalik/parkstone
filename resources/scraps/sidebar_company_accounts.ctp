<?php
echo "<h2>Company Accounts</h2>";

     $list = array(
//         $this->Html->link($this->Html->image('sales.png').'Sales','/Sales/', array('escape' => false)),
         $this->Html->link($this->Html->image('company.png').'New Cash Entry','/cashAccounts/', array('escape' => false)),
                         $this->Html->link($this->Html->image('company.png').'Find Cash Entry','../CashAccounts/findEntry/', array('escape' => false)),
         $this->Html->link($this->Html->image('company.png').'Delete Cash Entry','/CashAccounts/deleteEntry', array('escape' => false)),
                         $this->Html->link($this->Html->image('company.png').'Authorise Cash Entry','/CashAccounts/authoriseEntry', array('escape' => false)),
         
                        
          
        // $this->Html->link($this->Html->image('debtors.png').'Debtors','/Debtors/', array('escape' => false)),
         //$this->Html->link($this->Html->image('creditors.png').'Creditors','/Creditors/', array('escape' => false))
//         $this->Html->link($this->Html->image('reports.png').'Reports','/Reports/', array('escape' => false))
        );
     echo $this->Html->nestedList($list, $tag = 'ul');
?>
