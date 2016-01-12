<p class="subtitle-green">Bank Transactions</p>
<?php
    $bank_transactions = array(
        $this->Html->link($this->Html->image('green_arrow.png').'New Expense from Petty Cash','#', array('escape' => false)),
        $this->Html->link($this->Html->image('green_arrow.png').'List/Edit Petty Cash Expenses','#', array('escape' => false)),
        $this->Html->link($this->Html->image('green_arrow.png').'Add Cash to Petty Cash Account','/CompanyAccounts/bankDeposits', array('escape' => false)),

         );

     echo $this->Html->nestedList($bank_transactions, $tag = 'ul');
     ?>