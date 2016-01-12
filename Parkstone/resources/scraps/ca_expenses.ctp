<p class="subtitle-green">Expenses</p>
<?php
$expenses = array(
                        $this->Html->link($this->Html->image('green_arrow.png').'Link','/CompanyAccounts/', array('escape' => false)),
                        $this->Html->link($this->Html->image('green_arrow.png').'Link','/CompanyAccounts/', array('escape' => false)),
                        
                         );
                     
                     echo $this->Html->nestedList($expenses, $tag = 'ul');
                     ?>