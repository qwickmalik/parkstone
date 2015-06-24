<?php echo $this->element('header'); ?>


<h3 style="color: red;">Manage Processed Investments</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>


        <?php echo $this->Form->create('ListCashDeposits', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'searchreinvestor4list'), "inputDefaults" => array('div' => false))); ?>
        
        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">
            <tr>
                <td align="left" valign="top" colspan="3" ><p class="subtitle-blue">Step 2 - Fixed Investments - Select Action</p></td>
            </tr>
            <tr>
                <td align="center" colspan="3" ></td>
            </tr>
            <tr>
                <td align="center" valign="middle" colspan="3">
                    <div class="col-lg-4 col-md-6 col-sm-12" style="align: center; float: none;">
                        
                        <?php
                        echo $this->Form->input('company_name', array('label' => 'Company','empty' => '--Select Company--', 'default' => (isset($reinvestors['Reinvestor']['company_name']) ? $reinvestors['Reinvestor']['company_name'] : '' ),'disabled'));
                        
                        ?>
                        <span style="color: red;"></span>
                    </div>

                </td>
            </tr>
            
        </table>
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

        <!--    <form id="order_list" action="#" method="post">-->
      <?php
echo $this->Form->create('', array("url" => array('controller' => 'Reinvestments', 'action' => '#'), "inputDefaults" => array()));
?>

        <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
            
            <tr>
                <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left">
                    <b><?php echo $this->Paginator->sort('id', 'ID'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('investment_date', 'Investment Date'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('due_date', 'Due Date'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('currency_id', 'Currency'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('investment_amount', 'Amt Invested'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('interest_rate', 'Benchmark Rate'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue; font-weight: bold;" align="left"><?php echo "Action"; ?></td>
                <td style="border-bottom: solid 2px dodgerblue" width="100" align="left"><b>Statement</b></td>
                <td style="border-bottom: solid 2px dodgerblue" width="60" align="left"><b>Top-up</b></td>
                <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Delete Deposits</b></td>
                <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Delete Payments</b></td>
            </tr>
            
            <?php foreach ($data as $each_item): ?>
                <tr>
                    <td width="50" align="left"><?php echo $each_item['Reinvestment']['id']; ?></td>
                    <td align="left"><?php echo $each_item['Reinvestment']['investment_date']; ?></td>
                    <td align="left"><?php echo $each_item['Reinvestment']['due_date']; ?></td>
                    <td align="left"><?php echo $each_item['Currency']['symbol']; ?></td>
                    <td align="left"><?php echo number_format( $each_item['Reinvestment']['investment_amount'], 2) ?></td>
                    <td align="left"><?php echo $each_item['Reinvestment']['interest_rate']; ?></td>
                    <td align="left">
                        <?php if($each_item['Reinvestment']['status'] == 'Invested' || 
                                $each_item['Reinvestment']['status']=='Rolled_over'
                                ){
                            echo $this->Html->link("Details","/Reinvestments/manageInvFixedDetails/".$each_item['Reinvestment']['id']);  
                            echo " | ";
                            echo $this->Html->link("Terminate","/Reinvestments/terminateFixedInvestment/".$each_item['Reinvestment']['id']."/".$each_item['Reinvestment']['reinvestor_id']);  
//                           
                        }elseif($each_item['Reinvestment']['status'] == 'Cancelled'){
                            echo $this->Html->link("Details","/Reinvestments/manageInvFixedDetails/".$each_item['Reinvestment']['id']);  
                            echo " | ";
                            echo $this->Html->link("Record Inv. Returns","/Reinvestments/payReinvestorFixed/".$each_item['Reinvestment']['id']); 
                        }elseif($each_item['Reinvestment']['status'] == 'Paid'){
                            echo $this->Html->link("Details","/Reinvestments/manageInvFixedDetails/".$each_item['Reinvestment']['id']);  
                      
                        }elseif($each_item['Reinvestment']['status'] == 'Matured' || $each_item['Reinvestment']['status'] == 'Part_payment'){
                           
                            echo $this->Html->link("Roll-over","/Reinvestments/rollover/".$each_item['Reinvestment']['id']."/".$each_item['Reinvestment']['reinvestor_id']);
                            //rolloverReinvestorFixed
                            echo " | ";
                            echo $this->Html->link("Record Inv. Returns","/Reinvestments/payReinvestorFixed/".$each_item['Reinvestment']['id']);  
                            }else{
                            echo $each_item['Reinvestment']['status'];
                        }
                        ?>
                    </td>
                    
                <td align="left"><?php echo $this->Html->Link('Statement', '/Reinvestments/statementDailyInterest'."/".(isset($each_item['Reinvestment']['id']) ? $each_item['Reinvestment']['id'] : '' )."/".(isset($each_item['Reinvestment']['reinvestor_id']) ? $each_item['Reinvestment']['reinvestor_id'] : '' )."/".(isset($each_item['Reinvestor']['fullname']) ? $each_item['Reinvestor']['fullname'] : '' ),array('escape'=>false));?></td>
                
                <td align="center"><?php if(isset($each_item['Reinvestment']['status']) && $each_item['Reinvestment']['status'] == 'Invested' || $each_item['Reinvestment']['status'] == 'Rolled_over'){
                   
                    echo $this->Html->Link('Top-up', '#topUpForm'."/".(isset($each_item['Reinvestment']['id']) ? $each_item['Reinvestment']['id'] : '' ),array('escape'=>false, 'class' => 'btn btn-xs btn-success topup','data-id' => (isset($each_item['Reinvestment']['id']) ? $each_item['Reinvestment']['id'] : '' ),'data-toggle' => 'modal', 'data-target' => '#topUpForm'));
                
                    }else{
                        echo "N/A";
                    }
                    
                    ?>
                    <!-- Pop-up form -->
                            
                    <div class="modal fade" id="topUpForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <!--<form class="basic-form" action="/parkstone_online/Investments/topupInvestment" method="post">-->
                      <?php echo $this->Form->create('Topup', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'topupInvestment'), 'class'=> 'basic-form')); ?> 
                                
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
                            <td style="border-bottom: solid 2px dodgerblue;" width="250" align="left">
                                <b>Name</b>
                            </td>

                            <td style="border-bottom: solid 2px dodgerblue" width="170" align="left">
                                <b>Total Deposits</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue"  align="left">
                                <b>Available Cash</b>
                        </tr>
                        <?php
                        if (isset($reinvestors)) {
                            ?>
                            <tr>
                                <td align="left">
                                    <?php
                                    if (!empty($reinvestors['Reinvestor']['id'])) {
                                        echo $reinvestors['Reinvestor']['id'];
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>
                                <td align="left">
                                    <?php
                                    if (!empty($reinvestors['Reinvestor']['company_name'])) {
                                        echo $reinvestors['Reinvestor']['company_name'];
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>

                                <td align="left">
                                    <?php
                                    if (!empty($reinvestors['ReinvestorCashaccount']['fixed_inv_amount'])) {
                                        echo 'GH$ '.number_format($reinvestors['ReinvestorCashaccount']['fixed_inv_amount'],2);
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                </td>
                                <td align="left">
                                    <?php
                                    if (!empty($reinvestors['ReinvestorCashaccount']['fixed_inv_balance'])) {
                                        echo 'GH$ '.number_format($reinvestors['ReinvestorCashaccount']['fixed_inv_balance'],2);
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
<?php echo $this->Form->input('paymentmode_id', array('required', 'label' => 'Cash Receipt Mode', 'empty' => "--Please Select--")); ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
<?php echo $this->Form->input('cheque_no', array('disabled', 'label' => 'Cheque No.', 'placeholder' => "Cheque number(s)")); ?>
                                </div>
                             <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php 
                                 echo $this->Form->hidden('topupinvestment_id',array('class' => 'invest_id'));
                                 
                                 echo $this->Form->hidden('topupinvestor_id',array('value' =>
                                     (isset($reinvestors['Reinvestor']['reinvestor_id']) 
                                        ? $reinvestors['Reinvestor']['reinvestor_id'] : '')));
                                 echo $this->Form->hidden('topupinvestor_name',array('value' => (isset($reinvestors['Reinvestor']['company_name']) 
                                        ? $reinvestors['Reinvestor']['company_name'] : '')));
                                echo $this->Form->hidden('topupavailable_cash',array('value' => (isset($reinvestors['ReinvestorCashaccount']['fixed_inv_balance']) 
                                        ? $reinvestors['ReinvestorCashaccount']['fixed_inv_balance'] : 0)));
                                echo $this->Form->input('topup_amount', array('label' => 'Top-up Amount', 'class' => 'required', 'placeholder' => '0.00','value' => 0)); ?> 
                            </div>
                                 </div>
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
                    <!-- Pop-up form Ends -->
               
                </td>
                    
                <td align="center"><?php
                        if(isset($each_item['Investment']['id'])){
                            echo $this->Html->link('Delete', '/Reinvestments/delFixedInvestmentDeposits/'.$investor_id.'/'.$each_item['Reinvestment']['id'], array('class' => 'btn btn-xs btn-warning'));
                        }
                        ?></td>
                <td align="center"><?php
                        if(isset($each_item['Investment']['id'])){
                            echo $this->Html->link('Delete', '/Reinvestments/delFixedInvestmentPayments/'.$investor_id.'/'.$each_item['Reinvestment']['id'], array('class' => 'btn btn-xs btn-danger'));
                        }
                        ?></td>
                </tr>
<?php endforeach; ?>
            <tr>
                <td colspan="5" align="right">
<?php
//  echo $this->Form->button('Delete',array("type" => "#","class" => "button_red"));           //check the parameters here
?><p>&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td colspan="5" align="center">
                <?php
                echo $this->Paginator->first($this->Html->image('first.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'First', 'title' => 'First')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
                echo $this->Paginator->prev($this->Html->image('prev.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'Previous', 'title' => 'Previous')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
                echo $this->Paginator->numbers() . "&nbsp;&nbsp;";
                echo $this->Paginator->next($this->Html->image('next.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'Next', 'title' => 'Next')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
                echo $this->Paginator->last($this->Html->image('last.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'Last', 'title' => 'Last')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
                //prints X of Y, where X is current page and Y is number of pages
                echo $this->Paginator->counter(array('format' => 'Page %page% of %pages%, showing %current% items out of %count% total'));
                ?>
                </td>
            </tr>
        </table>
<?php echo $this->Form->end(); ?>	

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
                var cashmode = $("#TopupPaymentmodeId").val();
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
            $("#TopupPaymentmodeId").change(function() {
                hide_chequeno();
            });
           
            
            });
    </script>