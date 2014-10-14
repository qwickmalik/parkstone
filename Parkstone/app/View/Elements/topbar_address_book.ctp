<?php
     $list = array(
         $this->Html->link($this->Html->image('plus.png').'Add New Contact','/AddressBook/newContact', array('escape' => false)),
         $this->Html->link($this->Html->image('go.png').'Export Contacts','/AddressBook/exportContacts', array('escape' => false)),
        // $this->Html->link($this->Html->image('plus.png').'List Invoice Payments','/Stocks/supPaySupplier', array('escape' => false)),
        );
     echo $this->Html->nestedList($list, $tag = 'ul');
?>