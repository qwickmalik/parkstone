<?php echo $this->element('header'); ?>
<!-- Content starts here -->
<h3>Delete Fixed Investment Payments</h3>
<div class="boxed">
	<div class="inner">
		<div id="clearer"></div>


    <?php
    echo $this->Form->create('DelFixedInvestmentPayments', array("url" => array('controller' => 'FundManagements', 'action' => 'delFixedInvestmentPayments'), "inputDefaults" => array('label' => false, 'div' => false)));
    ?>
                <table border="0" width="100%" cellspacing="5" cellpadding="5" align="left" style="font-size: 12px;">
        <tr>
            <td colspan="7">
                <table border="0" width="100%" cellspacing="5" cellpadding="0" align="left">
                    <tr>
                        <td align="left" width="200"><p style="font-weight: bold;">Investor ID: </p></td>
                        
                        <td align="left"><p style="font-weight: bold;"><?php
                        if(isset($investor_id)){
                            echo $investor_id;
                        }
                        ?></p></td>
                        
                        <td align="left" width="200"><p style="font-weight: bold;">Investor Name: </p></td>
                        
                        <td align="left"><p style="font-weight: bold;"><?php
                        if(isset($investor_name)){
                            echo $investor_name;
                        }
                        ?></p></td>
                        
                        <td align="left" width="200"><p style="font-weight: bold;">Investment ID: </p></td>
                        
                        <td align="left"><p style="font-weight: bold;"><?php
                        if(isset($investment_id)){
                            echo $investment_id;
                        }
                        ?></p></td>
                        
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('id', 'Deposit ID'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="center"><b><?php echo $this->Paginator->sort('payment_mode_id', 'Payment Mode'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('cheque_no', 'Cheque No.'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="right"><b><?php echo $this->Paginator->sort('event_type', 'Event Type'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('event_date', 'Event Date'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="right"><b><?php echo $this->Paginator->sort('amount', 'Amount Paid'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('payment_date', 'Payment Date'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Delete</b></td>
        </tr>
        <?php  if(isset($data)){ foreach ($data as $each_item) { ?>
            <tr>
                <td align="left"><?php echo $each_item['InvestmentPayment']['id']; ?></td>
                <td align="center"><?php echo $each_item['PaymentMode']['payment_mode_name']; ?></td>
                <td align="center"><?php echo $each_item['InvestmentPayment']['cheque_no']; ?></td>
                <td align="left"><?php echo $each_item['InvestmentPayment']['event_type']; ?></td>
                <td align="right"><?php echo $each_item['InvestmentPayment']['event_date']; ?></td>
                <td align="left"><?php echo $each_item['InvestmentPayment']['amount']; ?></td>
                <td align="left"><?php echo $each_item['InvestmentPayment']['payment_date']; ?></td>
                <td align="center">
                <?php 
                    echo $this->Form->hidden('id', array('value' => $each_item['InvestmentPayment']['id']));
                    echo $this->Form->input('delete'.$each_item['InvestmentPayment']['id'], array( 'type' => 'checkbox', 'label' => false, 'hiddenField' => false, 'style' => 'float: right;'));  
                    ?>
                </td>
                
                
        <?php  }} ?>
            </tr>
        <tr>
            <td colspan="14" align="right">
                <?php 
				echo $this->Html->link('Back', "/FundManagements/manageInvFixed/".$investor_id."/".$investment_id, array("class" => 'btn btn-md btn-info')); 
                                echo $this->Form->button('Delete', array('type' => 'submit', 'class' => 'btn btn-md btn-danger'))
                ?>
            </td>
        </tr>
    </table>
                <?php
                echo $this->Form->end();
                ?>
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