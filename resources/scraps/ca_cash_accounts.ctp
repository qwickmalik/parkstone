<p class="subtitle-green">Cash Accounts</p>
<?php
$cash_accounts = array(
                        $this->Html->link($this->Html->image('green_arrow.png').'New Cash Entry','/CashAccounts/', array('escape' => false)),
                        $this->Html->link($this->Html->image('green_arrow.png').'Find Cash Entry','/CashAccounts/findEntry', array('escape' => false)),
                        $this->Html->link($this->Html->image('green_arrow.png').'Delete Cash Entry','/CashAccounts/deleteEntry', array('escape' => false)),
                        $this->Html->link($this->Html->image('green_arrow.png').'Authorize Cash Entry','/CashAccounts/authorizeEntry', array('escape' => false)),
                         );
                     
                     echo $this->Html->nestedList($cash_accounts, $tag = 'ul');
                     ?>