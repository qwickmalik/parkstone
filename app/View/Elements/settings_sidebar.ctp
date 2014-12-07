     <h2>Settings</h2>
<?php
                     $settings_list = array(
                         $this->Html->link($this->Html->image('company.png').'Company Setup','../Settings/setup', array('escape' => false)),
                         $this->Html->link($this->Html->image('payment_terms.png').'Payment Terms','../Settings/paymentTerms', array('escape' => false)),
                         $this->Html->link($this->Html->image('defaulting_rates.png').'Defaulting Rates','../Settings/defaultingRates', array('escape' => false)),
                         $this->Html->link($this->Html->image('taxes.png').'Tax Rates','../Settings/taxesList', array('escape' => false)),
                         $this->Html->link($this->Html->image('payment_names.png').'Transaction Names','../Settings/createExpenses', array('escape' => false)),
                         $this->Html->link($this->Html->image('investments.png').'Investment Portfolios','../Settings/investmentPortfolios', array('escape' => false)),
                         $this->Html->link($this->Html->image('zones.png').'Zones','../Settings/zones', array('escape' => false)),
                         $this->Html->link($this->Html->image('warehouses.png').'Warehouses','../Settings/warehouses', array('escape' => false)),
//                         $this->Html->link($this->Html->image('suppliers.png').'Suppliers List','../Settings/suppliers', array('escape' => false)),
//                         $this->Html->link($this->Html->image('notifications.png').'Notifications','../Settings/notifications', array('escape' => false)),
                         $this->Html->link($this->Html->image('clients.png').'Add Clients','/Settings/clientsList', array('escape' => false)),
                         $this->Html->link($this->Html->image('clients.png').'Customer Categories','/Settings/customerCategories', array('escape' => false)),
                         $this->Html->link($this->Html->image('users.png').'User Setup','/Users/users', array('escape' => false)),
                         $this->Html->link($this->Html->image('users.png').'User Types','/Users/userTypes', array('escape' => false)),
                         $this->Html->link($this->Html->image('users.png').'User Departments','/Users/userDepartments', array('escape' => false)),
                         );
                     
                     echo $this->Html->nestedList($settings_list, $tag = 'ul');
?>
