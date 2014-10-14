<h3>INVESTMENTS MANAGEMENT</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>
		
    <!-- Panels start here -->
		
	<?php
    echo $this->Html->link('
        <div id="dashboard">' .
            $this->Html->image('new_investor.png', array())
            . '<p>Add New Investor</p>
        </div>'
    , '/Investments/newInvestor', array('escape' => false));
    ?>  	
		
	<?php
    echo $this->Html->link('
        <div id="dashboard">' .
            $this->Html->image('list_investors.png', array())
            . '<p>List Investors</p>
        </div>'
    , '/Investments/listInvestors', array('escape' => false));
    ?> 
		
	<?php
    echo $this->Html->link('
        <div id="dashboard">' .
            $this->Html->image('new_investment.png', array())
            . '<p>New Investment</p>
        </div>'
    , '/Investments/newInvestment0', array('escape' => false));
    ?> 
	
	<?php
    echo $this->Html->link('
        <div id="dashboard">' .
            $this->Html->image('manage_investments.png', array())
            . '<p>Manage Investments</p>
        </div>'
    , '/Investments/manageInvestments', array('escape' => false));
    ?> 

    <!-- Panels end here -->
