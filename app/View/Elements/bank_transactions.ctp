<?php

$bank_transactions = array(
                        $this->Html->link($this->Html->image('green_arrow.png').'Bank Deposits','/bankDeposits', array('escape' => false)),
                        $this->Html->link($this->Html->image('green_arrow.png').'Bank Withdrawals','/bankWithdrawals', array('escape' => false)),
                        
                         );
                     
                     echo $this->Html->nestedList($bank_transactions, $tag = 'ul');
                     ?>