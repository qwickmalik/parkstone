<?php echo $this->element('header'); ?>

<!-- Content starts here -->
<h3>Settings: Company Setup</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>
		
			<div class="col-lg-6 col-md-12 col-xs-12 col-sm-12">
            <div class="boxed">
			<?php echo $this->Form->create('Setting',array("url" => array('controller' => 'Settings', 'action' => 'setup'),"inputDefaults" => array('label' => false,'div' => false)));
				  ?>
			
		<table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
		<tr>
			<td align="right"><b>Company Name:</b></td>
			<td><?php echo $this->Form->input('company_name',array("size" => 40,"value" => $setupResults['Setting']['company_name']));  ?></td>
		</tr>
		<tr>
			<td align="right"><b>Director/CEO:</b></td>
			<td><?php echo $this->Form->input('owner_name',array("class" => "large","size" => 40,"value" => $setupResults['Setting']['owner_name']));  ?></td>
		</tr>
		<tr>
			<td align="right"><b>Location:</b></td>
			<td><?php echo $this->Form->input('location',array("class" => "large","size" => 40,"value" => $setupResults['Setting']['location'])); ?></td>
		</tr>
		<tr>
			<td align="right"><b>Postal Address:</b></td>
			<td><?php echo $this->Form->input('postal_address',array("class" => "large","size" => 40,"value" => $setupResults['Setting']['postal_address'])); ?></td>
		</tr>
		<tr>
			<td align="right"><b>Postal Town/Suburb:</b></td>
			<td><?php echo $this->Form->input('postal_town_suburb',array("class" => "large","size" => 40,"value" => $setupResults['Setting']['postal_town_suburb'])); ?></td>
		</tr>
		<tr>
			<td align="right"><b>Postal City:</b></td>
			<td><?php echo $this->Form->input('postal_city',array("class" => "large","size" => 40,"value" => $setupResults['Setting']['postal_city'])); ?></td>
		</tr>
		<tr>
			<td align="right"><b>Country:</b></td>
			<td><?php echo $this->Form->input('postal_country',array("class" => "large","size" => 40,"value" => $setupResults['Setting']['postal_country'])); ?></td>
		</tr>
		<tr>
			<td align="right"><b>Telephone:</b></td>
			<td><?php echo $this->Form->input('telephone',array("class" => "large","size" => 20,"value" => $setupResults['Setting']['telephone'])); ?></td>
		</tr>
		<tr>
			<td align="right"><b>Mobile Phone:</b></td>
			<td><?php echo $this->Form->input('mobile',array("class" => "large",'maxlength' => 40,"size" => 40,"value" => $setupResults['Setting']['mobile'])); ?></td>
		</tr>
		<tr>
			<td align="right"><b>Email Address:</b></td>
			<td><?php echo $this->Form->input('email',array("class" => "large","size" => 40,"value" => $setupResults['Setting']['email'])); ?></td>
		</tr>
				<tr>
			<td align="right"><b>Currency:</b></td>
			<td>
				<?php 

$curr = $setupResults['Setting']['currency_id'];
if(!empty($curr)){
	$emtpy =1;
	switch($curr){
		case 1:
		$empty = "Ghana Cedi";
		break;
		case 2:
		$empty = "US Dollar";
		break;
		case 3:
		$empty = "Pound Sterling";
		break;
	}
}
echo $this->Form->input('currency_id',array('empty' => "--Please Select a Currency--",'selected' => $curr));                                
				?>

			</td>
		</tr>
		<tr>
			<?php
$month =  date('m',strtotime($setupResults['Setting']['accounting_month']));
$day =  date('d',strtotime($setupResults['Setting']['accounting_month']));
$Year = date('Y',strtotime($setupResults['Setting']['accounting_month']));

			?>
			<input type="hidden" id="month" value="<?php echo $month; ?>"/>
			<input type="hidden" id="day" value="<?php echo $day; ?>"/>
			<input type="hidden" id="year" value="<?php echo $Year; ?>"/>
			<td align="right"><b>Accounting Year Starts:</b></td>
			<td><?php echo $this->Form->day('accounting_month',array("class" => "large")); ?>&nbsp;<?php echo $this->Form->month('accounting_month',array("selected" => $month,'empty' => $month,"class" => "large"));?>&nbsp;<?php echo $this->Form->year('accounting_month',2000,date('Y'),array("class" => "large"));?>
				<script>
					var day = $("#day").val();
					var month = $("#month").val();
					var year = $("#year").val();
					$("#SettingAccountingMonthDay option[value="+day+"]").attr('selected', true);
					$("#SettingAccountingMonthMonth option[value="+month+"]").attr('selected', true);
					$("#SettingAccountingMonthYear option[value="+year+"]").attr('selected', true);
				</script>
			</td>
		</tr>
		<tr>
			<td align="right">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="right">&nbsp;</td>
			<td>
				<?php
echo $this->Form->button('Save Details',array("type" => "submit","class" => "btn btn-lg btn-success","id" => "company_submit"));//check the parameters here
				?>
			</td>
		</tr>
	</table>
	<?php
	echo $this->Form->end();
	?>
	<div id="clearer"></div>
	</div>
</div>
			
</div>
<!-- Content ends here -->
<?php echo $this->element('footer'); ?>