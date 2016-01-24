<?php echo $this->element('header'); ?>


<!-- Content starts here -->
<h3>SETTINGS: Batch Server Processes</h3>
<div class="boxed">
    <div class="inner2">
        <div id="clearer"></div>
        
        

    <!-- Panels start here -->
        <?php echo $this->Html->link('
		<div id="settingsbox">' . $this->Html->image('transaction_names.png', array()) . '
			<div id="innertext">
				<h3>Process Inbound Investments</h3>
				<p>Click to process all new Inbound Investments</p>
			</div>
		</div>', '/ShellConsoles/cronJobs', array('escape' => false)); ?>
    
    <!-- Panels start here -->
        <?php echo $this->Html->link('
		<div id="settingsbox">' . $this->Html->image('transaction_names.png', array()) . '
			<div id="innertext">
				<h3>Daily Inbound Jobs</h3>
				<p>Process daily interests and matured for Inbound Investments</p>
			</div>
		</div>', '/ShellConsoles/defaultJobs', array('escape' => false)); ?>
    
    <!-- Panels start here -->
        <?php echo $this->Html->link('
		<div id="settingsbox">' . $this->Html->image('transaction_names.png', array()) . '
			<div id="innertext">
				<h3>Daily Outbound Jobs</h3>
				<p>Process daily interests and matured for Outbound Investments</p>
			</div>
		</div>', '/ShellConsoles/backendJobs', array('escape' => false)); ?>
    
    <!-- Panels start here -->
        <?php echo $this->Html->link('
		<div id="settingsbox">' . $this->Html->image('transaction_names.png', array()) . '
			<div id="innertext">
				<h3>Process Base Fees</h3>
				<p>Click to process daily management fees</p>
			</div>
		</div>', '/ShellConsoles/miscJobs', array('escape' => false)); ?>


  <!-- Panels start here -->
        <?php echo $this->Html->link('
		<div id="settingsbox">' . $this->Html->image('transaction_names.png', array()) . '
			<div id="innertext">
				<h3>Process Accrued Interests</h3>
				<p>Click to process accrued interests for reporting purposes</p>
			</div>
		</div>', '/ShellConsoles/reportJobs', array('escape' => false)); ?>
        
    </div>
    <!-- Content ends here -->
    <?php echo $this->element('footer'); ?>

