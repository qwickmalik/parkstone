<?php 
echo $this->Html->script('notification.js');
?>
            
<!-- Content starts here -->
<h3>Settings: Create Transaction Names</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>
		
			<?php echo $this->Html->link('Go To Cash Accounts',"/CashAccounts/", array("class" => 'btn btn-info')); ?>
			
			<?php echo $this->Form->create('Expense',array("url" => array('controller' => 'Settings', 'action' => 'createExpense'),"inputDefaults" => array('label' => false,'div' => false)));?>
			
			<table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">

				<tr>
					<td><h3 align="right">New Name:</h3></td>
					<td>
						<?php echo $this->Form->input('payment_name',array("size" => 40)); echo $this->Form->hidden('id'); ?>
					</td>
					<td align="left">
						<?php 
							echo $this->Form->button('Save',array("type" => "submit","id" =>"expenseBtn","class" => "btn btn-lg btn-success")); 
						?>
					</td>
				</tr>
			</table>
			<?php
				echo $this->Form->end();
			?>
			<div id="clearer"></div>

			<form id="transaction_names" action="#" method="post">
				<table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
					<tr>
						<td style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
						<td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('Expense_name', 'Payment Name'); ?></b></td>
						<td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Delete</b></td>
					</tr>
					<?php foreach($data as $each_item): ?>
					<tr>
						<td width="50" align="left">
							<?php echo $each_item['Expense']['id']; ?>
						</td>
						<td align="left" class="clientAnchor">
							<?php echo $this->Html->link($each_item['Expense']['payment_name'],"#",array("class" => $each_item['Expense']['id'])); ?>
						</td> <!-- Link to enable editing -->
						<td width="20" align="left">
							<?php echo $this->Html->link("Delete", "/Settings/delPaymentName/" . $each_item['Expense']['id'], array("class" => $each_item['Expense']['id']));
    ?>
						</td>
					</tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="4" align="right">
							<?php
							//echo $this->Form->button('Delete',array("type" => "#","class" => "button_red"));           //check the parameters here
							?>
						</td>
					</tr>
					<tr>
						<td colspan="7" align="center">
							<?php
								echo $this->Paginator->first($this->Html->image('first.png', array('width'=>15, 'height'=>15, 'valign'=>'middle', 'alt'=>'First', 'title'=>'First')), array('escape' => false), null, null, array('class' => 'disabled'))."&nbsp;&nbsp;&nbsp;&nbsp;";
								echo $this->Paginator->prev($this->Html->image('prev.png', array('width'=>15, 'height'=>15, 'valign'=>'middle', 'alt'=>'Previous', 'title'=>'Previous')), array('escape' => false), null, null, array('class' => 'disabled'))."&nbsp;&nbsp;&nbsp;&nbsp;";
								echo $this->Paginator->numbers()."&nbsp;&nbsp;";
								echo $this->Paginator->next($this->Html->image('next.png', array('width'=>15, 'height'=>15, 'valign'=>'middle', 'alt'=>'Next', 'title'=>'Next')), array('escape' => false), null, null, array('class' => 'disabled'))."&nbsp;&nbsp;&nbsp;&nbsp;";
								echo $this->Paginator->last($this->Html->image('last.png', array('width'=>15, 'height'=>15, 'valign'=>'middle', 'alt'=>'Last', 'title'=>'Last')), array('escape' => false), null, null, array('class' => 'disabled'))."&nbsp;&nbsp;&nbsp;&nbsp;";
								//prints X of Y, where X is current page and Y is number of pages
								echo $this->Paginator->counter(array('format' => 'Page %page% of %pages%, showing %current% items out of %count% total'));  
							?>
						</td>
					</tr>
				</table>
			</form>
		</div>
<!-- Content ends here -->