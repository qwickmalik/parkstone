<?php echo $this->element('header'); ?>
<!-- Content starts here -->
<h3>Manage Fixed Investments</h3>
<div class="boxed">
	<div class="inner">
		<div id="clearer"></div>
	
        <?php // echo $this->Html->link('Edit/Delete Investments', "/Investments/listPayments", array("class" => 'btn btn-lg btn-success')); ?>


    <?php
    $userType = $this->Session->read('userDetails.usertype_id');
//    echo $this->Form->create('', array("url" => array('controller' => 'Stocks', 'action' => '#'), "inputDefaults" => array('label' => false, 'div' => false)));
    ?>
                <table border="0" width="100%" cellspacing="5" cellpadding="5" align="left" style="font-size: 12px;">
        <tr>
            <td colspan="14">
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
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('id', 'Inv. No.'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="center"><b>Edit</b></td>
            <td style="border-bottom: solid 2px dodgerblue" width="80" align="center"><b><?php echo $this->Paginator->sort('investment_date', 'Inv. Date'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="right"><b><?php echo $this->Paginator->sort('investment_amount', 'Inv. Amount'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="center"><b><?php echo $this->Paginator->sort('custom_rate', 'Benchmark(%)'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" width="80" align="center"><b><?php echo $this->Paginator->sort('due_date', 'Due Date'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="right"><b><?php echo $this->Paginator->sort('amount_due', 'Amount Due'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b>Instructions</b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Action</b></td>
            <td style="border-bottom: solid 2px dodgerblue" width="60" align="center"><b><?php echo $this->Paginator->sort('status', 'Status'); ?></b></td>
            <!--<td style="border-bottom: solid 2px dodgerblue" width="60" align="right"><b>Statement</b></td>-->
            <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Top-up</b></td>
        <?php    if ( $userType == 1) { ?>    <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Delete Deposits</b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Delete Payments</b></td>
           <?php } ?>
        </tr>
        <?php  if(isset($data)){ foreach ($data as $each_item) { ?>
            <tr>
                <td align="left"><?php
                        if(isset($each_item['Investment']['investment_no'])){
                            echo $each_item['Investment']['investment_no'];
                            $investment_id = $each_item['Investment']['id'];
                        }
                        
                        ?></td>
                <td align="center"><?php
                         if(isset($each_item['Investment']['id'])){
                            echo $this->Html->link('Edit', '/Investments/editFixedInvestments/'.$investor_id.'/'.$each_item['Investment']['id'], array('class' => 'btn btn-xs btn-primary',));
                        }
                        ?></td>
                
                <td align="center"><?php
                        if(isset($each_item['Investment']['investment_date'])){
                            echo $each_item['Investment']['investment_date'];
                        }
                        
                        ?></td>
                <td align="right"><?php
                        if(isset($each_item['Investment']['investment_amount'])){
                            echo number_format($each_item['Investment']['investment_amount'],2);
                        }
                        
                        ?></td>
                <td align="center"><?php
                        if(isset($each_item['Investment']['custom_rate'])){
                            echo $each_item['Investment']['custom_rate'].'%';
                        }
                        
                        ?></td>
                <td align="center"><?php
                        if(isset($each_item['Investment']['due_date'])){
                            echo $each_item['Investment']['due_date'];
                        }
                        
                        ?></td>
                <td align="right"><?php
                        if(isset($each_item['Investment']['amount_due'])){
                            echo number_format($each_item['Investment']['amount_due'],2);
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
                    
                    }elseif(isset($each_item['Investment']['status']) && $each_item['Investment']['status'] == 'Matured' || $each_item['Investment']['status'] == 'Part_payment'  || $each_item['Investment']['status'] == 'Termination_Approved'){
                     echo $this->Html->Link('Rollover', '/Investments/clearRolloverSession/'."/".(isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' )."/".(isset($each_item['Investment']['investor_id']) ? $each_item['Investment']['investor_id'] : '' ), array('escape'=>false));?> 
                    | <?php 
                      echo $this->Html->Link('Request Paymt', '/Investments/requestPayment4managefixedinvestments/' . "/" . (isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' ).'/'. (isset($each_item['Investor']['id']) ? $each_item['Investor']['id'] . "/" . $each_item['Investor']['fullname'] : '' ), array('escape' => false));
                              
                        
                    }elseif(isset($each_item['Investment']['status']) && $each_item['Investment']['status'] == 'Invested' || $each_item['Investment']['status'] == 'Rolled_over'){
                    echo $this->Html->Link('Request Termination', '/Investments/cancelInvestment/'."/".
                            (isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' )
                        ."/".(isset($each_item['Investment']['investor_id']) ? 
                            $each_item['Investment']['investor_id'] : '' )."/".
                            (isset($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : '' ),
                            array('escape'=>false));
                    }elseif(isset($each_item['Investment']['status']) && $each_item['Investment']['status'] == 'Termination_Approved'){
                    
                    
                     echo $this->Html->Link('Rollover', '/Investments/clearRolloverSession/'."/".(isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' )."/".(isset($each_item['Investment']['investor_id']) ? $each_item['Investment']['investor_id'] : '' ), array('escape'=>false));
                    } ?></td>
                <td align="center"><?php
                        if(isset($each_item['Investment']['status'])){
                            echo $each_item['Investment']['status'];
                        }
                        ?></td>
<!--                <td align="left"><?php
//echo $this->Html->Link('Statement', '/Investments/statementInvDetail'."/".
//        (isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' )."/".
//        (isset($each_item['Investment']['investor_id']) ? $each_item['Investment']['investor_id'] : '' )."/".
//        (isset($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : '' ),array('escape'=>false));
// echo $this->Html->Link('Statement', '/Investments/statementClient/'.(isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' )."/".(isset($each_item['Investment']['investor_id']) ? $each_item['Investment']['investor_id'] : '' )."/".(isset($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : '' ),array('escape'=>false));?>
                </td>-->
                
                <td align="center"><?php if(isset($each_item['Investment']['status']) && $each_item['Investment']['status'] == 'Invested' || $each_item['Investment']['status'] == 'Rolled_over'){
                   
                    echo $this->Html->Link('Top-up', '#topUpForm'."/".(isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' ),array('escape'=>false, 'class' => 'btn btn-xs btn-success topup','data-id' => (isset($each_item['Investment']['id']) ? $each_item['Investment']['id'] : '' ),'data-toggle' => 'modal', 'data-target' => '#topUpForm'));
                
                    }else{
                        echo "N/A";
                    }
                    
                    ?>
                    <!-- Top-up Pop-up form -->
                            
                    <div class="modal fade" id="topUpForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <!--<form class="basic-form" action="/parkstone_online/Investments/topupInvestment" method="post">-->
                      <?php echo $this->Form->create('Topup', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'topupInvestment'), 'class'=> 'basic-form')); ?> 
                                
                        <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Top-up Investment</h4>
                          </div>
                          <div class="modal-body">
                              <div class="row">
                                  
                    <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
                               <table border="0" width="100%" cellspacing="10" cellpadding="5" align="left">
                        <tr>
                            <td style="border-bottom: solid 2px dodgerblue;" align="left">
                                <b>ID</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue;" width="170" align="left">
                                <b>Name</b>
                            </td>

                            <td style="border-bottom: solid 2px dodgerblue" width="170" align="left">
                                <b>ITF</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue"  align="left">
                                <b>Invested Amount</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue"  align="left">
                                <b>Available Cash</b>
                        </tr>
                        <?php
                        if (isset($inv)) {
                            ?>
                            <tr>
                                <td align="left">
                                    <?php
                                    if (!empty($inv['Investor']['id'])) {
                                        echo $inv['Investor']['id'];
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>
                                <td align="left">
                                    <?php
                                    if (!empty($inv['Investor']['surname']) && !empty($inv['Investor']['other_names'])) {
                                        echo $inv['Investor']['surname'] . ' ' . $inv['Investor']['other_names'];
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>

                                <td align="left">
                                    <?php
                                    if (!empty($inv['Investor']['in_trust_for'])) {
                                        echo $inv['Investor']['in_trust_for'];
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>
                                <td align="left">
                                    <?php
                                    if (!empty($inv['ClientLedger']['invested_amount'])) {
                                        echo 'GH$ '.number_format($inv['ClientLedger']['invested_amount']);
                                    } else {
                                        echo 'GH$ 0.00';
                                    }
                                    ?>
                                </td>
                                <td align="left">
                                    <?php
                                    if (!empty($inv['ClientLedger']['available_cash'])) {
                                        echo 'GH$ '.number_format($inv['ClientLedger']['available_cash']);
                                    } else {
                                        echo 'GH$ 0.00';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        
                        ?></table>
                              </div>
                               
                            <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <?php
                                        if ($this->Session->check('topuptemp.investment_date') == true) {

                                            $dob_string = $this->Session->read('topuptemp.investment_date');
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
                                        <?php echo "<p style='width: 100%;float:left; font-size: 14px;font-weight: bold;line-height: 0px; padding: 60px 0px 0px 0px;'>Top-up Date*:</p>
                               ".$this->Form->day('investment_date', array("selected" => $day,)); ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <?php echo "<p style='width: 100%;float:left; font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</p>
                               ".$this->Form->month('investment_date', array("selected" => $month)); ?>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <?php echo "<p style='width: 100%;float:left; font-size: 14px;font-weight: bold;line-height: 40px; padding: 10px 0px 10px 0px;'>&nbsp;</p>
                               ".$this->Form->year('investment_date', 1950, date('Y'), array("selected" => $Year)); ?>
                                    </div>
                                    <script>
                                        var day = $("#day").val();
                                        var month = $("#month").val();
                                        var year = $("#year").val();
                                        $("#TopupInvestmentDateDay option[value=" + day + "]").attr('selected', true);
                                        $("#TopupInvestmentDateMonth option[value=" + month + "]").attr('selected', true);
                                        $("#TopupInvestmentDateYear option[value=" + year + "]").attr('selected', true);
                                    </script>
                            </div>
                            <div class="row">
                             <div class="col-lg-4 col-md-4 col-sm-12">
<?php echo $this->Form->input('cashreceiptmode_id', array('required', 'label' => 'Cash Receipt Mode', 'empty' => "--Please Select--")); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
<?php echo $this->Form->input('cheque_no', array('disabled', 'label' => 'Cheque No.', 'placeholder' => "Cheque number(s)")); ?>
                                </div>
                             <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php 
                                 echo $this->Form->hidden('topupinvestment_id',array('class' => 'invest_id'));
                                 
                                 echo $this->Form->hidden('topupinvestor_id',array('value' => (isset($inv['ClientLedger']['investor_id']) 
                                        ? $inv['ClientLedger']['investor_id'] : '')));
                                 echo $this->Form->hidden('topupinvestor_name',array('value' => (isset($inv['Investor']['fullname']) 
                                        ? $inv['Investor']['fullname'] : '')));
                                echo $this->Form->hidden('topupavailable_cash',array('value' => (isset($inv['ClientLedger']['available_cash']) 
                                        ? $inv['ClientLedger']['available_cash'] : 0)));
                                echo $this->Form->input('topup_amount', array('label' => 'Top-up Amount', 
                                    'class' => 'required', 'placeholder' => '0.00','value' => 0)); ?> 
                            </div>
                                 </div>
<!--                              <div class="row">
                                  <div class="col-lg-4 col-md-4 col-sm-12">
                                    <?php
                                    //echo $this->Form->input('receipt_no', array('label' => 'Receipt Number','value' => '',
                                        //'placeholder' =>'Receipt No.'));
                                    ?>
                                </div>
                              </div>-->
                            </form>
                            
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                           
                          </div>
                        </div>
                      </div>
                          <!--</form>-->
                          
                            <?php $this->Form->end(); ?>
                    </div>
                    <!-- Top-up Pop-up form Ends -->
               
                </td>
                <?php  if ( $userType == 1) { ?>
                <td align="center"><?php
                if(isset($each_item['Investment']['status']) && $each_item['Investment']['status'] == 'Invested' || $each_item['Investment']['status'] == 'Rolled_over' || $each_item['Investment']['status'] == 'Part_payment'){
                        if(isset($each_item['Investment']['id'])){
                            echo $this->Html->link('Delete', '/Investments/delFixedInvestmentDeposits/'.$investor_id.'/'.$each_item['Investment']['id'].'/'.$each_item['Investment']['investment_no'], array('class' => 'btn btn-xs btn-warning'));
                        }
                }else {
                                        echo 'N/A';
                                    }
                                   
                        ?></td>
                <td align="center"><?php
                        if(isset($each_item['Investment']['id'])){
                            echo $this->Html->link('Delete', '/Investments/delFixedInvestmentPayments/'.$investor_id.'/'.$each_item['Investment']['id'].'/'.$each_item['Investment']['investment_no'], array('class' => 'btn btn-xs btn-danger'));
                        }
                        ?></td>
                
        <?php  } ?>
            </tr>
            <?php  }} ?>
        <tr>
            <td colspan="14" align="right">
                <?php 
                //echo $this->Html->link('Print', "/Stocks/supListSuppliersInvoicesPrint", array("class" => 'button_red'));
				echo $this->Html->link('Back', "/Investments/manageInvestments/", array("class" => 'btn btn-lg btn-info')); 
                ?>
            </td>
        </tr>
    </table>
    <div id="clearer"></div>


</div>
<!-- Content ends here -->
<?php echo $this->element('footer'); ?>


    <script lang="javascript">
        jQuery(document).ready(function($) {
            $(".topup").click(function () {
            var myid = $(this).data('id');

//            alert(myid);
            $(".invest_id").attr('value', myid);
//            return false;
        });
  function hide_chequeno() {
                var cashmode = $("#TopupCashreceiptmodeId").val();
                if (cashmode == '2') {
                    $("#TopupChequeNo").prop('disabled',false);
                    return false;
                }
                if (cashmode != '2') {
                    $("#TopupChequeNo").prop('disabled', true);
                    return false;
                }
            }
            
            
           

            
            //DISABLE CHEQUENO if CASH
            hide_chequeno();
            $("#TopupCashreceiptmodeId").change(function() {
                hide_chequeno();
            });
           
            
            });
    </script>