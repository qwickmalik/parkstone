<?php
echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');
echo $this->Html->script('print.js');
?>
<!-- Content starts here -->
<h3>Balance Sheet</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <p ><i style="font-size: 14px;">Please select the desired year</i></p>

        <?php echo $this->Form->create('BalanceSheet', array("url" => array('controller' => 'Reports', 'action' => 'balanceSheet'))); ?>

        <div class="row" style="background: #eaeaea; padding: 10px 0px 5px 0px;">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <?php echo $this->Form->input('year', array('label' => 'Year Ending*', 'type' => 'date', 'value' => date('Y'), 'dateFormat' => 'Y', 'maxYear' => date('Y'), 'class' => 'form-control', 'div' => array('class' => 'form-inline')));
                ?>
            </div>

            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <?php echo $this->Form->button('View', array("type" => "submit", "class" => "btn btn-md btn-success")); ?>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">

            </div>

        </div>
        <?php echo $this->Form->end(); ?>

        <div id="clearer"></div>



        <?php
        if (isset($balance_sheet)) {
            ?>
            <table id="report_content">
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php
                                
//                                print_r("<br />prev start date - " . $prev_start_date);
//                                print_r("<br />prev end date - " . $prev_end_date);
//                                print_r("<br />start date - " . $start_date);
//                                print_r("<br />end date - " . $end_date);

                                ?>

                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                <?php
                                echo $this->Html->image('parkstone_logo2.png', array('style' => 'float: left; margin-right: 20px;', 'width' => 120, 'alt' => $this->Session->read('shopName')));
                                ?>
                                <p style='font-weight: bold; font-size: 14px; text-align: left;'>
                                    <?php
                                    echo $this->Session->read('shopName') . '<br />';
                                    echo 'BALANCE SHEET for the year ending ' . $statement_date;
                                    ?></p>
                                <p align='left'>Generated on <?php echo date('jS F, Y'); ?></p>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <p align="right"><?php echo $this->Session->read('shopAddress') . ', ' . $this->Session->read('shopPosttown') . '<br />' . $this->Session->read('shopPostCity') . ', ' . $this->Session->read('shopPostCount') . '<br />' . $this->Session->read('shopTelephone') . '<br />' . $this->Session->read('shopEmail'); ?></p>
                            </div>

                        </div>




                        <table class="table table-striped">
                            <tr>
                                <td align="left">&nbsp;</td>
                                <td align="right" width="150" style="font-weight: bold;"><?php echo $e_date; ?></td>
                                <td align="right" width="150" style="font-weight: bold;"><?php echo $pe_date; ?></td>
                            </tr>
                            <tr>
                                <td align="left" colspan="3" style="font-weight: bold; background: #eaeaea;">ASSETS

                                </td>
                            </tr>
                            <?php
                            $tblname = 'balance_sheets_' . $user;

                            $assets_req_yr = 0;
                            $assets_prev_yr = 0;
                            $oe_req_yr = 0;
                            $oe_prev_yr = 0;
                            $lib_req_yr = 0;
                            $lib_prev_yr = 0;


                            foreach ($balance_sheet as $each_item):

                                if ($each_item[$tblname]['head_id'] == 4 && ($each_item[$tblname]['requested_year'] != 0.00 || $each_item[$tblname]['previous_year'] != 0.00)) {
                                    ?>



                                    <tr>
                                        <td align="left"><?php echo $each_item[$tblname]['category_name']; ?></td>
                                        <td align="right" width="150"><?php
                                            if ($each_item[$tblname]['id'] == 100) {
                                                echo "(" . number_format($each_item[$tblname]['requested_year'], 2, '.', ',') . ")";
                                                $assets_req_yr -= $each_item[$tblname]['requested_year'];
                                            } else {
                                                echo number_format($each_item[$tblname]['requested_year'], 2, '.', ',');
                                                $assets_req_yr += $each_item[$tblname]['requested_year'];
                                            }
                                            ?></td>
                                        <td align="right" width="150"><?php
                                            if ($each_item[$tblname]['id'] == 100) {
                                                echo "(" . number_format($each_item[$tblname]['previous_year'], 2, '.', ',') . ")";
                                                $assets_prev_yr -= $each_item[$tblname]['previous_year'];
                                            } else {
                                                echo number_format($each_item[$tblname]['previous_year'], 2, '.', ',');
                                                $assets_prev_yr += $each_item[$tblname]['previous_year'];
                                            }
                                            ?></td>
                                    </tr>


                                    <?php
                                }
                            endforeach;
                            ?>
                            
                            <tr>
                                <td align="left" style="font-weight: bold; background: #CDEEFE;">Total Assets</td>
                                <td align="right" width="150" style="font-size: 14px; font-weight: bold; text-decoration: underline; background: #CDEEFE;"><?php echo number_format($assets_req_yr, 2, '.', ','); ?></td>
                                <td align="right" width="150" style="font-size: 14px; font-weight: bold; text-decoration: underline; background: #CDEEFE;"><?php echo number_format($assets_prev_yr, 2, '.', ','); ?></td>
                            </tr>
                            
                            
                            
                            <tr>
                                <td align="left" colspan="3" style="font-weight: bold; background: #eaeaea;">SHAREHOLDERS' FUNDS & LIABILITIES</td>
                            </tr>
                            
                            
                            
                            <tr>
                                <td align="left" colspan="3" style="font-weight: bold;">Shareholders' Funds</td>
                            </tr>
                            <?php
                            foreach ($balance_sheet as $each_item):

                                if ($each_item[$tblname]['head_id'] == 3 && ($each_item[$tblname]['requested_year'] != 0.00 || $each_item[$tblname]['previous_year'] != 0.00)) {
                                    ?>



                                    <tr>
                                        <td align="left"><?php echo $each_item[$tblname]['category_name']; ?></td>
                                        <td align="right" width="150"><?php
                                                echo number_format($each_item[$tblname]['requested_year'], 2, '.', ',');
                                                $oe_req_yr += $each_item[$tblname]['requested_year'];
                                            
                                            ?></td>
                                        <td align="right" width="150"><?php
                                            
                                                echo number_format($each_item[$tblname]['previous_year'], 2, '.', ',');
                                                $oe_prev_yr += $each_item[$tblname]['previous_year'];
                                            
                                            ?></td>
                                    </tr>


                                    <?php
                                }
                            endforeach;
                            ?>
                            
                            <tr>
                                <td align="left" style="font-weight: bold; background: #CDEEFE;">Total Shareholder's Funds</td>
                                <td align="right" width="150" style="font-size: 14px; font-weight: bold; text-decoration: underline; background: #CDEEFE;"><?php echo number_format($oe_req_yr, 2, '.', ','); ?></td>
                                <td align="right" width="150" style="font-size: 14px; font-weight: bold; text-decoration: underline; background: #CDEEFE;"><?php echo number_format($oe_prev_yr, 2, '.', ','); ?></td>
                            </tr>
                            
                            
                            
                            
                            <tr>
                                <td align="left" colspan="3" style="font-weight: bold;">Current & Long-Term Liabilities</td>
                            </tr>
                            
                            
                            <?php
                            foreach ($balance_sheet as $each_item):

                                if ($each_item[$tblname]['head_id'] == 5 && ($each_item[$tblname]['requested_year'] != 0.00 || $each_item[$tblname]['previous_year'] != 0.00)) {
                                    ?>



                                    <tr>
                                        <td align="left"><?php echo $each_item[$tblname]['category_name']; ?></td>
                                        <td align="right" width="150"><?php
                                                echo number_format($each_item[$tblname]['requested_year'], 2, '.', ',');
                                                $lib_req_yr += $each_item[$tblname]['requested_year'];
                                            
                                            ?></td>
                                        <td align="right" width="150"><?php
                                            
                                                echo number_format($each_item[$tblname]['previous_year'], 2, '.', ',');
                                                $lib_prev_yr += $each_item[$tblname]['previous_year'];
                                            
                                            ?></td>
                                    </tr>


                                    <?php
                                }
                            endforeach;
                            ?>
                            
                            <tr>
                                <td align="left" style="font-weight: bold; background: #CDEEFE;">Total Current & Long-term Liabilities</td>
                                <td align="right" width="150" style="font-size: 14px; font-weight: bold; text-decoration: underline; background: #CDEEFE;"><?php echo number_format($lib_req_yr, 2, '.', ','); ?></td>
                                <td align="right" width="150" style="font-size: 14px; font-weight: bold; text-decoration: underline; background: #CDEEFE;"><?php echo number_format($lib_prev_yr, 2, '.', ','); ?></td>
                            </tr>
                            
                            
                            

                            <tr>
                                <?php 
                                    $total_req_oe_lib = $oe_req_yr + $lib_req_yr; 
                                    $total_prev_oe_lib = $oe_prev_yr + $lib_prev_yr; 
                                ?>
                                <td align="left" style="font-weight: bold; background: #CDEEFE;">Total Shareholders' Funds & Liabilities</td>
                                <td align="right" width="150" style="font-size: 14px; font-weight: bold; text-decoration: underline; background: #CDEEFE;"><?php echo number_format($total_req_oe_lib, 2, '.', ','); ?></td>
                                <td align="right" width="150" style="font-size: 14px; font-weight: bold; text-decoration: underline; background: #CDEEFE;"><?php echo number_format($total_prev_oe_lib, 2, '.', ','); ?></td>
                            </tr>
                            <tr>
                                <td align="right" valign="top" colspan="3">
                                    <p style="font-style: italic;">Generated on <?php echo date('d-m-Y'); ?></p>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
            <div id="clearer"></div>
            <?php
            echo "<p>&nbsp;</p>";
            echo $this->Html->link('Print', "javascript:void(0)", array("class" => 'btn btn-md btn-danger', "id" => "print_report", 'style' => 'float: right;'));
            echo $this->Html->link('Return', "/Reports/", array('style' => 'float: right;', 'class' => 'btn btn-md btn-info'));
        }
        ?>
        <div id="clearer"></div>
    </div>
    <!-- Content ends here -->

    <!-- Footer starts here -->
    <?php echo $this->element('footer'); ?>
    <!-- Footer starts here -->