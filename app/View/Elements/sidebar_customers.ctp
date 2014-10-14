<?php
//echo "<h2>Repossessions</h2>";

     $list = array(
         $this->Html->link($this->Html->image('plus.png').'New Customer','/Customers/', array('escape' => false)),
         $this->Html->link($this->Html->image('plus.png').'Find Customer','/Customers/clearSessions', array('escape' => false)),
         $this->Html->link($this->Html->image('plus.png').'Delete Customers','/Customers/deleteCustomers', array('escape' => false))
        );
     echo $this->Html->nestedList($list, $tag = 'ul');
?>