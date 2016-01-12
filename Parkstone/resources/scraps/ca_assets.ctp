<p class="subtitle-green">Asset Management</p>
<?php

$assets = array(
                        $this->Html->link($this->Html->image('green_arrow.png').'Add New Asset','/CompanyAccounts/newAsset', array('escape' => false)),
                        $this->Html->link($this->Html->image('green_arrow.png').'List/Edit Asset(s)','/CompanyAccounts/listAssets', array('escape' => false)),
                        $this->Html->link($this->Html->image('green_arrow.png').'Depreciation Journal','/CompanyAccounts/depreJournal', array('escape' => false)),
                         );
                     
                     echo $this->Html->nestedList($assets, $tag = 'ul');
                     ?>