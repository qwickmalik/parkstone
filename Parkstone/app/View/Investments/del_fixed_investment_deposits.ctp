<?php echo $this->element('header'); ?>
<!-- Content starts here -->
<h3>Delete Fixed Investment Deposits</h3>
<div class="boxed">
	<div class="inner">
		<div id="clearer"></div>
	
        <?php // echo $this->Html->link('Edit/Delete Investments', "/Investments/listPayments", array("class" => 'btn btn-lg btn-success')); ?>


    <?php
//    echo $this->Form->create('', array("url" => array('controller' => 'Stocks', 'action' => '#'), "inputDefaults" => array('label' => false, 'div' => false)));
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
                        
                        <td align="left" width="200"><p style="font-weight: bold;">Investment No.: </p></td>
                        
                        <td align="left"><p style="font-weight: bold;"><?php
                        if(isset($investment_no)){
                            echo $investment_no;
                        }
                        ?></p></td>
                        
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('id', 'Deposit ID'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="center"><b><?php echo $this->Paginator->sort('deposit_date', 'Deposit Date'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="center"><b><?php echo $this->Paginator->sort('ledger_transaction_id', 'Ledger Trans. ID'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('topup_id', 'Top-up ID'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="right"><b><?php echo $this->Paginator->sort('amount', 'Amount'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('receipt_no', 'Receipt No.'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Delete</b></td>
        </tr>
        <?php  if(isset($data)){ foreach ($data as $each_item) { ?>
            <tr>
                <td align="left"><?php echo $each_item['InvestorDeposit']['id']; ?></td>
                <td align="center"><?php echo $each_item['InvestorDeposit']['deposit_date']; ?></td>
                <td align="center"><?php echo $each_item['InvestorDeposit']['ledger_transaction_id']; ?></td>
                <td align="left"><?php echo $each_item['InvestorDeposit']['topup_id']; ?></td>
                <td align="right"><?php echo $each_item['InvestorDeposit']['amount']; ?></td>
                <td align="left"><?php echo $each_item['InvestorDeposit']['receipt_no']; ?></td>
                <td align="center">
                <?php 
                 if(isset($each_item['InvestorDeposit']['id'])){
                            echo $this->Html->link('Delete', '/Investments/delDeposit/'.$each_item["InvestorDeposit"]["id"], array());
                        }
//                    echo $this->Form->hidden('id', array('value' => $each_item['InvestorDeposit']['id']));
//                    echo $this->Form->input('delete'.$each_item['InvestorDeposit']['id'], array( 'type' => 'checkbox',$checked. 'label' => false, 'hiddenField' => false));  
                    ?>
                </td>
                
                
        <?php  }} ?>
            </tr>
        <tr>
            <td colspan="14" align="right">
                <?php 
                
				echo $this->Html->link('Back', "/Investments/manageFixedInvestments/".(isset($investor_id)?$investor_id:'').'/'.(isset($investor_name)?$investor_name:''), array("class" => 'btn btn-lg btn-info')); 
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