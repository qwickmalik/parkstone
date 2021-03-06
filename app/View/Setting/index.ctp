<?php echo $this->element('header'); ?>
<h3>Settings</h3>
<div class="boxed">
    <div class="inner2">

        <div id="clearer"></div>

        <!-- Panels start here -->
        <?php echo $this->Html->link('
		<div id="settingsbox">' . $this->Html->image('company.png', array()) . '
			<div id="innertext">
				<h3>Company Setup</h3>
				<p>Set company details here</p>
			</div>
		</div>', '/Settings/setup', array('escape' => false)); ?>
        <?php 
//        echo $this->Html->link('
//		<div id="settingsbox">' . $this->Html->image('subsidiaries.png', array()) . '
//			<div id="innertext">
//				<h3>Subsidiaries</h3>
//				<p>Set/edit details of subsidiary companies here</p>
//			</div>
//		</div>', '/Settings/subsidiaries', array('escape' => false)); 
        ?>
        
        <?php echo $this->Html->link('
				<div id="settingsbox">' . $this->Html->image('company_accounts.png', array()) . '
					<div id="innertext">
						<h3>Currencies</h3>
						<p>Add/edit currencies</p>
					</div>
				</div>', '/Settings/currencies', array('escape' => false)); ?>
        
        <?php echo $this->Html->link('
				<div id="settingsbox">' . $this->Html->image('company_accounts.png', array()) . '
					<div id="innertext">
						<h3>Exchange Rates</h3>
						<p>Add/edit exchange rates</p>
					</div>
				</div>', '/Settings/exchangeRates', array('escape' => false)); ?>
        
        <?php echo $this->Html->link('
				<div id="settingsbox">' . $this->Html->image('company_accounts.png', array()) . '
					<div id="innertext">
						<h3>Banks</h3>
						<p>Add/edit banks</p>
					</div>
				</div>', '/Settings/banks', array('escape' => false)); ?>
        
        <?php echo $this->Html->link('
				<div id="settingsbox">' . $this->Html->image('company_accounts.png', array()) . '
					<div id="innertext">
						<h3>Cash/Bank Accounts</h3>
						<p>Add/edit company cash & bank accounts</p>
					</div>
				</div>', '/Settings/cashAccounts', array('escape' => false)); ?>
        
        <?php echo $this->Html->link('
				<div id="settingsbox">' . $this->Html->image('company_accounts.png', array()) . '
					<div id="innertext">
						<h3>Transaction/Financial Categories</h3>
						<p>Add/edit transaction/financial categories here</p>
					</div>
				</div>', '/Settings/transactionCategories', array('escape' => false)); ?>
        
        <?php echo $this->Html->link('
			<div id="settingsbox">' . $this->Html->image('payment_terms.png', array()) . '
				<div id="innertext">
					<h3>Equities List</h3>
					<p>Create/edit names of equities here</p>
				</div>
			</div>', '/Settings/equitiesList', array('escape' => false)); ?>
        
        
        <?php echo $this->Html->link('
		<div id="settingsbox">' . $this->Html->image('tax_rates.png', array()) . '
			<div id="innertext">
				<h3>Tax Rates</h3>
				<p>Set/edit tax rates to be used in sales here</p>
			</div>
		</div>', '/Settings/taxesList', array('escape' => false)); ?>
        
        

        <?php echo $this->Html->link('
		<div id="settingsbox">' . $this->Html->image('defaulting_rates.png', array()) . '
			<div id="innertext">
				<h3>Defaulting rates</h3>
				<p>Set interest rates for defaulters who do not pay instalments</p>
			</div>
		</div>', '/Settings/defaultingRates', array('escape' => false)); ?>
        
        
        
        <?php echo $this->Html->link('
				<div id="settingsbox">' . $this->Html->image('users.png', array()) . '
					<div id="innertext">
						<h3>User Setup</h3>
						<p>Add/edit users and privileges here</p>
					</div>
				</div>', '/Users/users', array('escape' => false)); ?>

        <?php echo $this->Html->link('
				<div id="settingsbox">' . $this->Html->image('users.png', array()) . '
					<div id="innertext">
						<h3>User Types</h3>
						<p>Create user types here</p>
					</div>
				</div>', '/Users/userTypes', array('escape' => false)); ?>

        <?php echo $this->Html->link('
				<div id="settingsbox">' . $this->Html->image('users.png', array()) . '
					<div id="innertext">
						<h3>User Departments</h3>
						<p>Create user departments here</p>
					</div>
				</div>', '/Users/userDepartments', array('escape' => false)); ?>

        <?php // echo $this->Html->link('
//		<div id="settingsbox">' . $this->Html->image('transaction_names.png', array()) . '
//			<div id="innertext">
//				<h3>Batch Server Processes</h3>
//				<p>Run batch server processes here (Matured Payments,Daily Interests,etc)</p>
//			</div>
//		</div>', '/Settings/createExpenses', array('escape' => false)); ?>

        <?php // echo $this->Html->link('
//		<div id="settingsbox">' . $this->Html->image('payment_terms.png', array()) . '
//			<div id="innertext">
//				<h3>Payment Terms</h3>
//				<p>Add/edit payment terms here</p>
//			</div>
//		</div>', '/Settings/paymentTerms', array('escape' => false)); ?>

        <?php // echo $this->Html->link('
//		<div id="settingsbox">' . $this->Html->image('investment_portfolios.png', array()) . '
//			<div id="innertext">
//				<h3>Investment Portfolios</h3>
//				<p>Set interest rates for investment portfolios here</p>
//			</div>
//		</div>', '/Settings/investmentPortfolios', array('escape' => false)); ?>

        <?php // echo $this->Html->link('
//			<div id="settingsbox">' . $this->Html->image('investor_categories.png', array()) . '
//				<div id="innertext">
//					<h3>Investor Categories</h3>
//					<p>Set/edit investor categories here</p>
//				</div>
//			</div>', '/Settings/customerCategories', array('escape' => false)); ?>
        
        
        
        

        <!-- Panels end here -->
<?php echo $this->element('footer'); ?>