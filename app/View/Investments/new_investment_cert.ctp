<?php
 echo $this->element('header');
 
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js');
?>

<h3>Investor Contract</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
                <?php 
                    echo $this->Element('logo_reports');
                    echo "<H2><b>PARKSTONE CAPITAL LIMITED</b></H2>"; 
                    echo "<p><b>Investment Deposit Receipt</b></p>";  
                ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <p>Client Name: <?php echo $data['Investor']['fullname']; ?></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <p>Client Number: <?php echo $data['Investor']['id']; ?></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <p>Client Type: <?php echo $data['InvestorType']['investor_type']; ?></p>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <hr>
                
            </div>
            <?php if (isset($data) && $data['Investment']['investment_product_id'] == 1 || $data['Investment']['investment_product_id'] == 3) {
                        ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p><b>Fixed Investment</b></p>
                <table border="1" cellspacing="" cellpadding="3" width="100%" align="left" style="border: solid 1px gray;">
                    <tr>
                        <td align="left" valign="top" style="border-bottom: solid 1px Gray;"><b>Date</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 1px Gray;"><b>Investment No.</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"><b>Investment Tenure</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"><b>Principal Amt. GHS</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"><b>Interest Rate</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"><b>Interest GHS</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"><b>Maturity Amt. GHS</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"><b>Maturity Date</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 1px Gray;"><b>Instructions A/c</b></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top"><?php echo $data['Investment']['investment_date']; ?></td>
                        <td align="left" valign="top"><?php echo $data['Investment']['investment_no']; ?></td>
                        <td align="right" valign="top"><?php echo $data['Investment']['total_tenure'].' '.$data['Investment']['investment_period']; ?></td>
                        <td align="right" valign="top"><?php echo $data['Investment']['investment_amount']; ?></td>
                        <td align="right" valign="top"><?php echo $data['Investment']['custom_rate'].'%'; ?></td>
                        <td align="right" valign="top"><?php echo $data['Investment']['interest_earned']; ?></td>
                        <td align="right" valign="top"><?php echo $data['Investment']['amount_due']; ?></td>
                        <td align="right" valign="top"><?php echo $data['Investment']['due_date']; ?></td>
                        <td align="left" valign="top"><?php echo $data['Instruction']['instruction_name']; ?></td>
                    </tr>
                </table>
            </div>
            <p>&nbsp;</p>
            <?php } if (isset($data) && $data['Investment']['investment_product_id'] == 2 || $data['Investment']['investment_product_id'] == 3) {
                     if(isset($equity)){  
                ?>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p><b>Equity Investment</b></p>
                <table border="1" cellspacing="" cellpadding="3" width="100%" align="left" style="border: solid 1px gray;">
                    <tr>
                        <td align="left" valign="top" style="border-bottom: solid 1px Gray;"><b>Date</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 1px Gray;"><b>Investment No.</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 1px Gray;"><b>Equity Name</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 1px Gray;"><b>Equity Code</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"><b>No. of Shares</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"><b>Min. Purchase Price</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"><b>Max. Purchase Price</b></td>
                    </tr>
                    <?php
                    foreach ($equity as $each_item) { 
                        ?>
                    <tr>
                        <td align="left" valign="top"><?php echo $each_item['InvestorEquity']['purchase_date']; ?></td>
                        <td align="left" valign="top"><?php echo $data['Investment']['investment_no']; ?></td>
                        <td align="left" valign="top"><?php echo $each_item['EquitiesList']['equity_name']; ?></td>
                        <td align="left" valign="top"><?php echo $each_item['EquitiesList']['equity_abbrev']; ?></td>
                        <td align="right" valign="top"><?php echo $each_item['InvestorEquity']['numb_shares']; ?></td>
                        <td align="right" valign="top"><?php echo $each_item['InvestorEquity']['min_share_price']; ?></td>
                        <td align="right" valign="top"><?php echo $each_item['InvestorEquity']['max_share_price']; ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <?php
               }
            }
            ?>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p><b>Management Fees</b></p>
                <table border="1" cellspacing="" cellpadding="3" width="100%" align="left" style="border: solid 1px gray;">
                    <tr>
                        <td align="left" valign="top" style="border-bottom: solid 1px Gray;"><b>Fee Type</b></td>
                        <td align="left" valign="top" style="border-bottom: solid 1px Gray;"><b>Base Rate</b></td>
                        <td align="right" valign="top" style="border-bottom: solid 1px Gray;"><b>Benchmark Rate</b></td>
                        
                    </tr>
                    <tr>
                        <td align="left" valign="top"><?php echo $data['Investment']['management_fee_type']; ?></td>
                         <td align="left" valign="top"><?php if(!empty($data['Investment']['base_rate'])){echo $data['Investment']['base_rate'].'%';}else{ echo '0%'; } ?></td>
                        <td align="right" valign="top"><?php if(!empty($data['Investment']['benchmark_rate'])){echo $data['Investment']['benchmark_rate'].'%';}else{ echo '0%'; } ?></td>
                        
                    </tr>
                </table>
            </div>
            <?php 
            echo "<p>&nbsp;</p>";
            echo $this->Html->link('Print', "javascript:void(0)", array('style' => 'float: right;', "class" => 'btn btn-lg btn-warning', "id" => "print_receipt"));
            echo $this->Html->link('Return', "/Investments/newInvestment0", array('style' => 'float: right;', 'class' => 'btn btn-lg btn-info'));
           
            ?>
        </div>
        <!-- Content end here -->
<?php echo $this->element('footer'); ?>
