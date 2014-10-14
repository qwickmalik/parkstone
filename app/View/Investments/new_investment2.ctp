<?php
//echo $this->Html->script('notification.js');
?>

    <?php $shopCurrency =""; if ($this->Session->check('shopCurrency')) {
                        $shopCurrency = $this->Session->read('shopCurrency');
                        
                    }
                    ?>
<!-- Content starts here -->
<h3>New Investment - Step 2</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>

    <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">

        <tr>
            <td align="left" valign="top" colspan="3" style="font-size: 18px; color: gray; font-weight: bold;">Investor Details</td>
        </tr>
		<tr>
			<td align="left" valign="top" colspan="3">
				<table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
					<tr>
						<td style="border-bottom: solid 2px dodgerblue;" align="left">
							<b>ID</b>
						</td>
						<td style="border-bottom: solid 2px dodgerblue;" align="left">
							<b>Surname</b>
						</td>
						<td style="border-bottom: solid 2px dodgerblue" align="left">
							<b>Other Names</b>
						</td>
						<td style="border-bottom: solid 2px dodgerblue" width="200" align="left">
							<b>Phone Number</b>
						</td>
						<td style="border-bottom: solid 2px dodgerblue" align="left">
							<b>Email</b>
						</td>
					</tr>
					<tr>
						<td align="left">
							<?php if (isset($investor['Investor']['id'])) {
								echo $investor['Investor']['id'];
							} else {
								echo '';
							} ?>
						</td>
						<td align="left">
							<?php if (isset($investor['Investor']['surname'])) {
								echo $investor['Investor']['surname'];
							} else {
								echo '';
							} ?>
						</td>
						<td align="left">
							<?php if (isset($investor['Investor']['other_names'])) {
								echo $investor['Investor']['other_names'];
							} else {
								echo '';
							} ?>
						</td>
						<td align="left">
							<?php if (isset($investor['Investor']['phone'])) {
								echo $investor['Investor']['phone'];
							} else {
								echo '';
							} ?>
						</td>
						<td align="left">
							<?php if (isset($investor['Investor']['email'])) {
								echo $investor['Investor']['email'];
							} else {
								echo '';
							} ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="left" valign="top" style="border-bottom: dotted 1px gray;">&nbsp;</td>
		</tr>
        <tr>
            <td align="left" valign="top" colspan="3">
				
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
					<div class="row">
						<?php 
echo $this->Form->create('Investment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'process'), "inputDefaults" => array('div' => false))); 
						?>
						<div class="col-lg-3 col-md-3 col-sm-12">
							<?php
echo $this->Form->input('portfolio_id', array('label' => 'Portfolio','default' => '--Please Select--','value' => ($this->Session->check('investtemp.portfolio_id') == true ? $this->Session->read('investtemp.portfolio_id') : '' ))); 

//,'options' => array("3mths/5%" => "3mths/5%", "6mths/11%" => "6mths/11%", "9mths/17%" => "9mths/17%", "12mths/25%" => "12mths/25%")

echo $this->Form->hidden('user_id',array('value' => ($this->Session->check('userDetails.id') == true ? $this->Session->read('userDetails.id') : 1 )));
echo $this->Form->hidden('investor_id',array('value' => (isset($investor['Investor']['id']) ? $investor['Investor']['id'] : '' )));
							?>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12">
							<?php
echo $this->Form->input('investment_amount', array('label' => 'Investment Amount','size' => 20,'value' => ($this->Session->check('investtemp.investment_amount') == true ? $this->Session->read('investtemp.investment_amount') : '' ))); 
							?>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12">

							<?php
								if($this->Session->check('investtemp.investment_date') == true){

									$dob_string = $this->Session->read('investtemp.investment_date');
									$month =  date('m',strtotime($dob_string));
									$day =  date('d',strtotime($dob_string));
									$Year = date('Y',strtotime($dob_string));
								}
								else{
									$month =  date('m');
									$day =  date('d');
									$Year = date('Y');
								}
							?>

							<input type="hidden" id="month" value="<?php echo $month; ?>"/>
							<input type="hidden" id="day" value="<?php echo $day; ?>"/>
							<input type="hidden" id="year" value="<?php echo $Year; ?>"/>

							<div class="col-lg-3 col-md-2 col-sm-12">
								<?php echo "<label for='investment_date'>Inv. Date</label>".$this->Form->day('investment_date',array("selected" => $day )); ?>&nbsp;
							</div>
							<div class="col-lg-3 col-md-2 col-sm-12">
								<?php echo "<label for='investment_date'>&nbsp;</label>".$this->Form->month('investment_date',array("selected" => $month));?>&nbsp;
							</div>
							<div class="col-lg-3 col-md-2 col-sm-12">
								<?php echo "<label for='investment_date'>&nbsp;</label>".$this->Form->year('investment_date',1950,date('Y'),array("selected" => $Year));?>
							</div>

							<script>
								var day = $("#day").val();
								var month = $("#month").val();
								var year = $("#year").val();
								$("#InvestmentInvestmentDateDay option[value="+day+"]").attr('selected', true);
								$("#InvestmentInvestmentDateMonth option[value="+month+"]").attr('selected', true);
								$("#InvestmentInvestmentDateYear option[value="+year+"]").attr('selected', true);
							</script>

						</div>
					</div>
				</div>
			</td>
        </tr>
		<tr>
			<td colspan="3" align="left" valign="top" style="border-bottom: dotted 1px gray;">&nbsp;</td>
		</tr>
        <tr>
			<td colspan="3" align="left" valign="top">
				<div class="col-lg-4 col-md-4 col-sm-12">
        		<table width="80%" cellspacing="0" cellpadding="3" border="0">
					<tr>
						<td align="right"><b align="right">Due Date: </b></td>
						<td><span id="xxxxxx"><?php if (isset($duedate)) {
												echo $duedate;
											} else {
												echo '';
											} ?></span>
						</td>
					</tr>
					</table>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12">
        		<table width="80%" cellspacing="0" cellpadding="3" border="0">
					<tr>
						<td align="right"><b align="right">Interest Accrued: </b></td>
						<td><span id="xxxxxx"><?php if (isset($interest)) {
												echo $shopCurrency.' '.$interest;
											} else {
												echo '';
											} ?></span>
						</td>
					</tr>
					</table>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12">
        		<table width="80%" cellspacing="0" cellpadding="3" border="0">
					<tr>
						<td align="right"><b align="right" style='color: #ff0000'>Total Amount Due: </b></td>
						<td><span id="xxxxxx" ><b><?php if (isset($totaldue)) {
							echo $shopCurrency.' '.$totaldue;
						} else {
							echo '';
						} ?></b></span>
						</td>
					</tr>
					</table>
				</div>
        	</td>
		</tr>
		
		<tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
        </tr>

        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="right" valign="middle" colspan="2">
    <?php echo $this->Html->link('Back', "/Investments/newInvestment", array("class" => 'btn btn-lg btn-info')); ?>
<?php echo $this->Form->button('Process', array("type" => "submit",  "class" => "btn btn-lg btn-success")); ?>
                &nbsp;&nbsp;
<?php echo $this->Html->link('Next', "/Investments/newInvestmentCert", array("class" => 'btn btn-lg btn-primary')); ?>
            </td>
        </tr>
    </table>
<?php
echo $this->Form->end();
?>
    <div id="clearer"></div>

</div>
<!-- Content ends here -->
