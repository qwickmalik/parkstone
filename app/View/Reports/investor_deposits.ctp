<?php echo $this->element('header');
//echo $this->Html->script('jquery.js');
//echo $this->Html->script('jquery.printElement.js');
//
//        
//echo $this->Html->script('print.js'); 


        
?>

<h3>Reports: Investor Deposits Report</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">
            <?php echo $this->Form->create('InvestorDeposits', array('url' => array('controller' => 'Reports', 'action' => 'investorDeposits'))); ?>
            
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <?php
                echo $this->Form->input('fullname', array('required','label' => 'Investor Name*','placeholder' => 'Type investor name here'));
                echo $this->Form->hidden('investor_id');  
                ?>
            </div>
            
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <p style="font-weight: bold; padding: 10px 0px 0px 0px;">From</p>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <?php
                    $month = date('m');
                    $day = date('d');
                    $Year = date('Y');
                    ?>
                    <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                    <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                    <?php echo $this->Form->day('begin_date', array("selected" => $day)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->month('begin_date', array("selected" => $month)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->year('begin_date', 2003, date('Y'), array("selected" => $Year)); ?>
                </div>
                <script>
                    var day = $("#day").val();
                    var month = $("#month").val();
                    var year = $("#year").val();
                    $("#InvestorDepositsBeginDateDay option[value=" + day + "]").attr('selected', true);
                    $("#InvestorDepositsBeginDateMonth option[value=" + month + "]").attr('selected', true);
                    $("#InvestorDepositsBeginDateYear option[value=" + year + "]").attr('selected', true);
                </script>

            </div>
             <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <p style="font-weight: bold; padding: 10px 0px 0px 0px;">To</p>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <?php
                    $month = date('m');
                    $day = date('d');
                    $Year = date('Y');
                    ?>
                    <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                    <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                    <?php echo $this->Form->day('finish_date', array("selected" => $day)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->month('finish_date', array("selected" => $month)); ?>&nbsp;
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php echo $this->Form->year('finish_date', 2003, date('Y'), array("selected" => $Year)); ?>
                </div>
                <script>
                    var day = $("#day").val();
                    var month = $("#month").val();
                    var year = $("#year").val();
                    $("#InvestorDepositsFinishDateDay option[value=" + day + "]").attr('selected', true);
                    $("#InvestorDepositsFinishDateMonth option[value=" + month + "]").attr('selected', true);
                    $("#InvestorDepositsFinishDateYear option[value=" + year + "]").attr('selected', true);
                </script>
                <?php
                echo $this->Form->button('Find', array('type' => 'submit', 'class' => 'btn btn-lg btn-success', 'style' => 'float: right;'));
                ?>

            </div>
            <?php echo $this->Form->end(); ?>
            <p style="clear: both; width: 100%; margin-bottom: 20px; border-bottom: solid 2px dodgerblue;">&nbsp;</p>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 inner_print" align="center">
                <?php
                echo $this->Element('logo_reports');
                echo "<H3><b>PARKSTONE CAPITAL LIMITED</b></H3>";
                $postaladd = 'Postal Address: ';

                if ($this->Session->check('shopAddress')) {
                    $shopAddress = $this->Session->read('shopAddress');
                    $postaladd .=$shopAddress;
                    if ($this->Session->check('shopPosttown')) {
                        $shopPosttown = $this->Session->read('shopPosttown');

                        // $postaladd .= ', '.$shopPosttown;
                    }
                    if ($this->Session->check('shopPostCity')) {
                        $shopPostCity = $this->Session->read('shopPostCity');
                        $postaladd .= ', ' . $shopPostCity;
                    }
                    if ($this->Session->check('shopPostCount')) {
                        $shopPostCount = $this->Session->read('shopPostCount');
                        $postaladd .= ', ' . $shopPostCount;
                    }
                    echo "<p>" . $postaladd . "</p>";
                }

                echo "<p><b>INVESTOR DEPOSITS REPORT</b></p>";
                ?>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table border="1" cellspacing="" cellpadding="3" width="100%" align="left" style="border: solid 2px gray;">
                    <tr>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Name</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment No.</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Deposit Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Amount Deposited</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Investment Date</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Rate</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Tenure/Period</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>User/Staff</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 2px Gray;"><b>Receipt No.</b></td>
                    </tr>
                    <?php if (isset($accounts)) {
                          
    foreach ($accounts as $each_item):  
              
            ?>
                    <tr>
                        <td align="left" valign="top"><?php if (isset($fullname)) {
            echo  $fullname; 
            
                        } ?></td>
                        <td align="left" valign="top"><?php if (isset($each_item['Investment']['investment_no'])) {
            echo  $each_item['Investment']['investment_no'];
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['InvestorDeposit']['deposit_date'])) {
            echo  date('d-M-Y',strtotime($each_item['InvestorDeposit']['deposit_date']));
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['InvestorDeposit']['amount'])) {
            echo  number_format($each_item['InvestorDeposit']['amount'],2);
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['Investment']['investment_date'])) {
            echo  date('d-M-Y',strtotime($each_item['Investment']['investment_date']));
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['Investment']['custom_rate'])) {
            echo  $each_item['Investment']['custom_rate'].'%';
        } ?></td>
                        <td align="right" valign="top"><?php if(!empty($each_item['InvestorDeposit']['topup_id'])) {
                            
           echo  $each_item['Topup']['tenure'].' '.$each_item['Topup']['period'];
        }elseif(isset($each_item['Investment']['duration']) && isset($each_item['Investment']['investment_period'])){
            echo  $each_item['Investment']['duration'].' '.$each_item['Investment']['investment_period'];
            
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['User']['firstname']) && 
                                isset($each_item['User']['lastname'])) {
            echo  $each_item['User']['firstname'].' '.$each_item['User']['lastname'];
        } ?></td>
                        <td align="right" valign="top"><?php if (isset($each_item['InvestorDeposit']['receipt_no'])) {
            echo  $each_item['InvestorDeposit']['receipt_no'];
        } ?></td>
                    </tr>
                    <?php
    
    endforeach;
} ?>
                    <?php if (isset($total)) {
            foreach($total as $each_item):
                ?>
                    <tr style="border-top: solid 2px; background: #eaeaea;">
                        <td align="right" valign="top">&nbsp;</td>
                        <td align="left" valign="top">&nbsp;</td>
                        <td align="left" valign="top">TOTAL</td>
                        <td align="right" valign="top"> <?php   if (isset($each_item[0]['total_deposit'])) {
                    echo  'GH$ '. number_format($each_item[0]['total_deposit'], 2);
                }
                ?></td>
                        <td align="right" valign="top">&nbsp;</td>
                        <td align="right" valign="top">&nbsp;</td>
                        <td align="right" valign="top">&nbsp;</td>
                        <td align="right" valign="top">&nbsp;</td>
                        <td align="right" valign="top">&nbsp;</td>
                    </tr>
                        <?php endforeach;
                }
                ?>
                </table>
            </div>
            <?php
            echo "<p>&nbsp;</p>";
            echo $this->Html->link('Print', "javascript:void(0)", array('style' => 'float: right;', "class" => 'btn btn-lg btn-warning', "id" => "print_receipt"));
            echo $this->Html->link('Return', "/Reports/", array('style' => 'float: right;', 'class' => 'btn btn-lg btn-info'));
            ?>
        </div>
    </div>
    <!-- Content end here -->
    <?php echo $this->element('footer'); ?>
<script type="text/javascript" language="javascript">
$(document).ready(function()
{
    
//    $( "#TempSaleItemName" ).on( "autocompleteselect", function( event, ui ) {
//        this.val()
//    } );
$("#InvestorDepositsFullname").autocomplete({source:function (request, response) {
            $.ajax({
                url: "invest_search",
                type: 'GET',
                dataType: 'json',
                data: request,
                success: function (data) {
                       if(data['status'] == "ok"){
                        response($.map(data, function (value, key) {
                        return {
                            label: value['fullname'],
                            value: value['id']
                        };
                    }));
                    
                }else if(data['status'] == "fail"){
                     response($.map(data, function (value, key) {
                        return {
                            label: "Investor Not Found",
                            value: key
                        };
                    }));
                }
                }
            });
        },
    
    	minChars:5,
    	max:100,
        minLength:3,
        dataType:'json',
    	selectFirst: false,
       	delay:10,
    	formatItem: function(row) {
			return row[1];
		},
        select: function(event, ui) {
           $("#InvestorDepositsInvestorId").val( ui.item.value);
           $("#InvestorDepositsFullname").val(ui.item.label);    
           $("#InvestorDepositsFullname").html( ui.item.label );                         
           //$("#term").val( ui.item.term);
          
             return false; 
        }
            
    });
    
    });
    </script>