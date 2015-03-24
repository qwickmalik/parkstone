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
            <td colspan="11">
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
            <td style="border-bottom: solid 2px dodgerblue" width="60" align="right"><b><?php echo $this->Paginator->sort('investment_date', 'Inv. Date'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="right"><b><?php echo $this->Paginator->sort('investment_amount', 'Inv. Amount'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" width="60" align="center"><b><?php echo $this->Paginator->sort('interest_rate', 'Rate(%)'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" width="60" align="right"><b><?php echo $this->Paginator->sort('due_date', 'Due Date'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="center"><b><?php echo $this->Paginator->sort('amount_due', 'Amount Due'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b>Instructions</b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Action</b></td>
            <td style="border-bottom: solid 2px dodgerblue" width="60" align="center"><b><?php echo $this->Paginator->sort('status', 'Status'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" width="60" align="right"><b>Statement</b></td>
            <td style="border-bottom: solid 2px dodgerblue" width="60" align="right"><b>Top-up</b></td>
            
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
                            echo $this->Html->link('Edit', '/Investments/editFixedInvestment/'.$investor_id.'/'.$each_item['Investment']['id'], array('class' => 'btn btn-xs btn-info'));
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
                        if(isset($each_item['Investment']['interest_rate'])){
                            echo $each_item['Investment']['interest_rate'];
                        }
                        
                        ?></td>
                <td align="right"><?php
                        if(isset($each_item['Investment']['due_date'])){
                            echo $each_item['Investment']['due_date'];
                        }
                        
                        ?></td>
                <td align="center"><?php
                        if(isset($each_item['Investment']['amount_due'])){
                            echo $each_item['Investment']['amount_due'];
                        }
                        ?></td>
                <td align="left"><?php if($each_item['Instruction']['id'] != 5){
                                    echo $each_item['Instruction']['instruction_name'];
                                }else{
                                   echo $each_item['Investment']['instruction_details']; 
                                } ?></td>
                <td align="center">
                    
                    <?php 
                    
                    if(isset($each_item['Investment']['status']) && $each_item['Investment']['status'] == 'Cancelled'){
                         echo $this->Html->Link('Re-instate', '/Investments/ReinstateInvestment/'."/".(isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' )."/".(isset($each_item['Investment']['investor_id']) ? $each_item['Investment']['investor_id'] : '' )."/".(isset($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : '' ), array('escape'=>false));
                    }elseif(isset($each_item['Investment']['status']) && $each_item['Investment']['status'] == 'Paid' || $each_item['Investment']['status'] == 'Payment_Requested' || $each_item['Investment']['status'] == 'Termination_Requested'){
                   echo "No-Action Necessary";
                    
                    }elseif(isset($each_item['Investment']['status']) && $each_item['Investment']['status'] == 'Matured'){
                     echo $this->Html->Link('Rollover', '/Investments/rollover/'."/".(isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' )."/".(isset($each_item['Investment']['investor_id']) ? $each_item['Investment']['investor_id'] : '' ), array('escape'=>false));?> 
                    | <?php 
                      echo $this->Html->Link('Request Paymt', '/Investments/requestPayment4managefixedinvestments/' . "/" . (isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' ).'/'. (isset($each_item['Investor']['id']) ? $each_item['Investor']['id'] . "/" . $each_item['Investor']['fullname'] : '' ), array('escape' => false));
                              
                        
                    }elseif(isset($each_item['Investment']['status']) && $each_item['Investment']['status'] == 'Invested' || $each_item['Investment']['status'] == 'Rolled_over'){
                    echo $this->Html->Link('Request Termination', '/Investments/cancelInvestment/'."/".
                            (isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' )
                        ."/".(isset($each_item['Investment']['investor_id']) ? 
                            $each_item['Investment']['investor_id'] : '' )."/".
                            (isset($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : '' ),
                            array('escape'=>false));
                    }
                    
                    
                    ?></td>
                <td align="center"><?php
                        if(isset($each_item['Investment']['status'])){
                            echo $each_item['Investment']['status'];
                        }
                        ?></td>
                <td align="left"><?php echo $this->Html->Link('Statement', '/Investments/statementDailyInterest'."/".(isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' )."/".(isset($each_item['Investment']['investor_id']) ? $each_item['Investment']['investor_id'] : '' )."/".(isset($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : '' ),array('escape'=>false));?></td>
                
                <td align="left"><?php echo $this->Html->Link('Top-up', '#topUpForm'."/".(isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' ),array('escape'=>false, 'class' => 'btn btn-xs btn-success', 'data-toggle' => 'modal', 'data-target' => '#topUpForm'));?>
                
                    
                    <!-- Pop-up form -->
                    <div class="modal fade" id="topUpForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Top-up Investment</h4>
                          </div>
                          <div class="modal-body">

                            <form class="basic-form" action="#" method="post">
                             <?php // echo $this->Form->create('Topup', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'topupInvestment'), 'class'=> 'basic-form')); ?> 
                                <div class="row">
                                    <p style='width: 100%; font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>Top-up Date*:</p>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <?php
                                        if ($this->Session->check('investtemp1.investment_date') == true) {

                                            $dob_string = $this->Session->read('investtemp1.investment_date');
                                            $month = date('m', strtotime($dob_string));
                                            $day = date('d', strtotime($dob_string));
                                            $Year = date('Y', strtotime($dob_string));
                                        } else {

                                            $month = date('m');
                                            $day = date('d');
                                            $Year = date('Y');
                                        }
                                        ?>
                                        <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                                        <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                                        <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                                        <?php echo $this->Form->day('investment_date', array("selected" => $day)); ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <?php echo $this->Form->month('investment_date', array("selected" => $month)); ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <?php echo $this->Form->year('investment_date', 1950, date('Y'), array("selected" => $Year)); ?>
                                    </div>
                                    <script>
                                        var day = $("#day").val();
                                        var month = $("#month").val();
                                        var year = $("#year").val();
                                        $("#InvestmentInvestmentDateDay option[value=" + day + "]").attr('selected', true);
                                        $("#InvestmentInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                                        $("#InvestmentInvestmentDateYear option[value=" + year + "]").attr('selected', true);
                                    </script>
                            </div>
                                <?php echo $this->Form->input('topup_amount', array('label' => 'Top-up Amount', 'class' => 'required', 'placeholder' => '0.00')); ?> 
                            
                            </form>
                            <?php // $this->Form->end(); ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success">Submit</button>
                           
                          </div>
                            
                        </div>
                      </div>
                    </div>
                    <!-- Pop-up form Ends -->
                
                </td>
                
                
        <?php  }} ?>
            </tr>
        <tr>
            <td colspan="11" align="right">
                <?php 
                //echo $this->Html->link('Print', "/Stocks/supListSuppliersInvoicesPrint", array("class" => 'button_red'));
				echo $this->Html->link('Back', "/Investments/manageInvestments", array("class" => 'btn btn-lg btn-info')); 
                ?>
            </td>
        </tr>
    </table>
    <div id="clearer"></div>


</div>
<!-- Content ends here -->
