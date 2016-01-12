<p class="subtitle-green">Receivables</p>
<?php
    $receivables = array(
        $this->Html->link($this->Html->image('green_arrow.png').'New Entry','/CompanyAccounts/receivables', array('escape' => false)),
        $this->Html->link($this->Html->image('green_arrow.png').'List Receivables','/CompanyAccounts/listReceivables', array('escape' => false)),

         );

     echo $this->Html->nestedList($receivables, $tag = 'ul');
     ?>