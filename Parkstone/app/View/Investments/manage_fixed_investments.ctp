<?php
echo $this->Html->script('notification.js');
?>

<!-- Content starts here -->
<h3>Manage Fixed Investments</h3>
<div class="boxed">
	<div class="inner">
		<div id="clearer"></div>
	
        <?php // echo $this->Html->link('Edit/Delete Investments', "/Investments/listPayments", array("class" => 'btn btn-lg btn-success')); ?>


    <?php
//    echo $this->Form->create('', array("url" => array('controller' => 'Stocks', 'action' => '#'), "inputDefaults" => array('label' => false, 'div' => false)));
    ?>
    <table border="0" width="100%" cellspacing="5" cellpadding="5" align="left">
        <tr>
            <td colspan="9">
                <table border="0" width="100%" cellspacing="5" cellpadding="0" align="left">
                    <tr>
                        <td align="left" width="200"><p style="font-size: 18px;">Investor ID: </p></td>
                        <td align="left"><p style="font-size: 18px;"><?php
                        if(isset($investor_id)){
                            echo $investor_id;
                        }
                        
                        ?></p></td>
                    </tr>
                    <tr>
                        <td align="left" width="200"><p style="font-size: 18px;">Investor Name: </p></td>
                        <td align="left"><p style="font-size: 18px;"><?php
                        if(isset($investor_name)){
                            echo $investor_name;
                        }
                        
                        ?></p></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-bottom: solid 2px dodgerblue;" width="30" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b>Edit</b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b>Details</b></td>
            <td style="border-bottom: solid 2px dodgerblue" width="60" align="right"><b><?php echo $this->Paginator->sort('investment_date', 'Inv. Date'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="right"><b><?php echo $this->Paginator->sort('investment_amount', 'Inv. Amount'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" width="60" align="center"><b><?php echo $this->Paginator->sort('interest_rate', 'Rate(%)'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" width="60" align="right"><b><?php echo $this->Paginator->sort('due_date', 'Due Date'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="right"><b><?php echo $this->Paginator->sort('amount_due', 'Amount Due'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Action</b></td>
            <td style="border-bottom: solid 2px dodgerblue" width="60" align="center"><b><?php echo $this->Paginator->sort('status', 'Status'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" width="60" align="right"><b>Statement</b></td>
            
        </tr>
        <?php  if(isset($data)){ foreach ($data as $each_item) { ?>
            <tr>
                <td align="left"><?php
                        if(isset($each_item['Investment']['id'])){
                            echo $each_item['Investment']['id'];
                        }
                        
                        ?></td>
                <td align="left"><?php
                        if(isset($each_item['Investment']['id'])){
                            echo $this->Html->link('Edit', '/Investments/editFixedInvestment/'.$investor_id.'/'.$each_item['Investment']['id']);
                        }
                        ?></td>
                <td align="left"><?php
                        if(isset($each_item['Portfolio']['payment_name'])){
                            echo $each_item['Portfolio']['payment_name'];
                        }
                        
                        ?></td>
                <td align="right"><?php
                        if(isset($each_item['Investment']['investment_date'])){
                            echo $each_item['Investment']['investment_date'];
                        }
                        
                        ?></td>
                <td align="right"><?php
                        if(isset($each_item['Investment']['investment_amount'])){
                            echo $each_item['Investment']['investment_amount'];
                        }
                        
                        ?></td>
                <td align="center"><?php
                        if(isset($each_item['Portfolio']['interest_rate'])){
                            echo $each_item['Portfolio']['interest_rate'];
                        }
                        
                        ?></td>
                <td align="right"><?php
                        if(isset($each_item['Investment']['due_date'])){
                            echo $each_item['Investment']['due_date'];
                        }
                        
                        ?></td>
                <td align="right"><?php
                        if(isset($each_item['Investment']['amount_due'])){
                            echo $each_item['Investment']['amount_due'];
                        }
                        ?></td>
                <td align="center">
                    
                    <?php 
                    
                    if(isset($each_item['Investment']['status']) && $each_item['Investment']['status'] == 'Cancelled'){
                         echo $this->Html->Link('Re-instate', '/Investments/ReinstateInvestment/'."/".(isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' )."/".(isset($each_item['Investment']['investor_id']) ? $each_item['Investment']['investor_id'] : '' )."/".(isset($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : '' ), array('escape'=>false));
                    }elseif(isset($each_item['Investment']['status']) && $each_item['Investment']['status'] == 'Paid'){
                   echo "No-Action Necessary";
                    
                    }else{
//                    echo $this->Html->Link('Pay', '/Investments/payInvestor/'."/".(isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' ), array('escape'=>false));?> <!--|--> <?php echo $this->Html->Link('Rollover', '/Investments/rollover/'."/".(isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' )."/".(isset($each_item['Investment']['investor_id']) ? $each_item['Investment']['investor_id'] : '' )."/".(isset($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : '' ), array('escape'=>false));?> | <?php echo $this->Html->Link('Terminate', '/Investments/cancelInvestment/'."/".(isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' )."/".(isset($each_item['Investment']['investor_id']) ? $each_item['Investment']['investor_id'] : '' )."/".(isset($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : '' ), array('escape'=>false));
                    
                    }
                    
                    
                    ?></td>
                <td align="center"><?php
                        if(isset($each_item['Investment']['status'])){
                            echo $each_item['Investment']['status'];
                        }
                        ?></td>
                <td align="left"><?php echo $this->Html->Link('Statement', '/Investments/statementDailyInterest'."/".(isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' )."/".(isset($each_item['Investment']['investor_id']) ? $each_item['Investment']['investor_id'] : '' )."/".(isset($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : '' ),array('escape'=>false));?></td>
                
                
        <?php  }} ?>
            </tr>
        <tr>
            <td colspan="1" align="left">
                <?php 
                
                ?>
            </td>
            <td colspan="9" align="right">
                <?php 
                //echo $this->Html->link('Print', "/Stocks/supListSuppliersInvoicesPrint", array("class" => 'button_red'));
				echo $this->Html->link('Back', "/Investments/manageInvestments", array("class" => 'btn btn-info')); 
                ?>
            </td>
        </tr>
    </table>
    <div id="clearer"></div>


</div>
<!-- Content ends here -->
