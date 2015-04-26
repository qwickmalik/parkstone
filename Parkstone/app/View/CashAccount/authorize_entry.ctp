<?php


$num = 0;
if ($this->Session->check('shopCurrency')) {
    $shopCurrency = $this->Session->read('shopCurrency');
} else {
    $shopCurrency = "";
}
?>

<!-- Content starts here -->
<h3>Authorize Cash Entries</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <table id="report_content" width="100%" align="left" cellspacing="0" cellpadding="5" border="0">
            <?php
            echo $this->Html->css('template.css');
            ?>

            <tr style="background: #fafad2;" id="dateRow">

                <td align="left" valign="top" colspan="15">

                    <?php echo $this->Form->create('TempcashAccount', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'CashAccounts', 'action' => 'authoriseEntry'), "inputDefaults" => array('div' => false))); ?>   
                    

                    <div class="row" style="background: #fafad2;">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <b>Subsidiary</b>
                            </div>
                            <?php echo $this->Form->input('zone_id', array('default' => 1, 'empty' => 'ALL ZONES', 'label' => false, 'style' => 'width: 140px;')); ?>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <b>Start date</b>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php
                                $month = date('m');
                                $day = date('d');
                                $Year = date('Y');
                                ?>
                                <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                                <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                                <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                                <?php echo $this->Form->day('begin_date', array("selected" => $day)); ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php echo $this->Form->month('begin_date', array("selected" => $month)); ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php echo $this->Form->year('begin_date', 1950, date('Y'), array("selected" => $Year)); ?>
                            </div>

                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <b>End date</b>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php
                                $month = date('m');
                                $day = date('d');
                                $Year = date('Y');
                                ?>
                                <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                                <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                                <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                                <?php echo $this->Form->day('finish_date', array("selected" => $day)); ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php echo $this->Form->month('finish_date', array("selected" => $month)); ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <?php echo $this->Form->year('finish_date', 1950, date('Y'), array("selected" => $Year)); ?>
                            </div>
                        </div>
                        <input type="hidden" name="data[Setting][from]" id="dtFrom" />
                        <?php
                        echo $this->Form->button('View', array("type" => "submit", "class" => "btn btn_lg btn-success", "style" => "float: right;"));
                        ?>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="7">&nbsp;</td>
            </tr>
            <tr>
                <th style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></th>
                <th style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('expense_name', 'Account Heading'); ?></b></th>
                <th style="border-bottom: solid 2px dodgerblue" width="120" align="left"><b><?php echo $this->Paginator->sort('expense_type', 'Account Type'); ?></b></th>
                <th style="border-bottom: solid 2px dodgerblue" width="80" align="left"><b><?php echo $this->Paginator->sort('zone', 'Zone'); ?></b></th>
                <th style="border-bottom: solid 2px dodgerblue" width="60" align="left"><b><?php echo $this->Paginator->sort('amount', 'Amount'); ?></b></th>
                <th style="border-bottom: solid 2px dodgerblue;" width="120" align="left"><b><?php echo $this->Paginator->sort('expense_date', 'Date'); ?></b></th>

                <th style="border-bottom: solid 2px dodgerblue;"  align="left"><b><?php echo $this->Paginator->sort('remarks', 'Description'); ?></b></th>

                <th style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b><?php echo $this->Paginator->sort('status', 'Status'); ?></b></th>
                <th style="border-bottom: solid 2px dodgerblue;" width="100" align="center"><b>Authorise</b></th>
            </tr>  <?php
            if (isset($data)) {

                foreach ($data as $each_item):

                    switch ($each_item['TempcashAccount']['expense_type']) {
                        case 0:
                            $expensename = "Expense";
                            break;
                        case 1:
                            $expensename = "New_Loans";
                            break;
                        case 2:
                            $expensename = "Owner_Investment";
                            break;
                        case 3:
                            $expensename = "Owner_Withdrawal";
                            break;
                        case 4:
                            $expensename = "Loan_Repayment";
                            break;
                        case 5:
                            $expensename = "Tax Payments";
                            break;
                        case 6:
                            $expensename = "Deposits";
                            break;
                        case 7:
                            $expensename = "Petty Cash Dispensation";
                    }
                    ?>
                    <tr>
                        <td width="50" align="left"><?php echo $each_item['TempcashAccount']['id']; ?></td>
                        <td align="left"><a href="#"><?php echo $each_item['Expense']['payment_name']; ?></a></td> <!-- Link to enable editing -->
                        <td width="60" align="left"><?php echo $expensename ?></td>
                        <td width="60" align="left"><?php echo $each_item['Zone']['zone']; ?></td>
                        <td width="60" align="left"><?php echo $each_item['TempcashAccount']['amount']; ?></td>
                        <td align="left"><?php echo $each_item['TempcashAccount']['expense_date']; ?></td>
                        <td  align="left"><?php echo $each_item['TempcashAccount']['remarks']; ?></td>

                        <td align="left"><?php echo $each_item['TempcashAccount']['status']; ?></td>
                        <td width="100" align="center" >
                            <?php
                            if (isset($each_item['TempcashAccount']['status']) && ($each_item['TempcashAccount']['status'] != "" && !is_null($each_item['TempcashAccount']['status']))) {
                                if ($each_item['TempcashAccount']['status'] == "Pending") {
                                    echo $this->Html->link("Approve", "/CashAccounts/approveEntry/" . $each_item['TempcashAccount']['id'] . "/Approve", array("class" => $each_item['TempcashAccount']['id']));
                                    ?>  ||  

                                    <?php
                                    echo $this->Html->link("Reject", "/CashAccounts/approveEntry/" . $each_item['TempcashAccount']['id'] . "/Reject", array("class" => $each_item['TempcashAccount']['id']));
                                } elseif ($each_item['TempcashAccount']['status'] == "Rejected") {
                                    echo $this->Html->link("Approve", "/CashAccounts/approveEntry/" . $each_item['TempcashAccount']['id'] . "/Approve", array("class" => $each_item['TempcashAccount']['id']));
                                    ?>
                                    ||  

                                    <?php
                                    echo $this->Html->link("Pending", "/CashAccounts/approveEntry/" . $each_item['TempcashAccount']['id'] . "/Pend", array("class" => $each_item['TempcashAccount']['id']));
                                }
                            }
                            ?> 

                        </td>
                    </tr>
                <?php endforeach;
            }
            ?>

            <?php
            if (isset($total)) {
                foreach ($total as $each_item):
                    ?>
                    <tr>
                        <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">Total</td>
                        <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>

                        <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                        <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;"><?php
                            if (isset($each_item[0]['instalmt'])) {
                                echo $shopCurrency . ' ' . round($each_item[0]['instalmt'], 0);
                            }
                            ?></td>


                    </tr>
                    <?php
                endforeach;
            }
            ?>
            <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top">
                    <p style="font-style: italic;">Accessed on <?php echo date('d-m-Y'); ?></p>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top"></td>
                <td align="left" valign="top"></td>
                <td align="left" valign="top"></td>
                <td align="left" valign="top"></td>
                <td align="left" valign="top"></td>
                <td align="left" valign="top"></td>
                <td align="right" valign="top">
                    <?php
                    echo $this->Html->link('Print', "javascript:void(0)", array("class" => 'button_red', "id" => "print_report"));
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="7" align="center">
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


        <script type="text/javascript" language="javascript">
            $(document).ready(function ()
            {
                $("#dateRow").hide();
                var content = $("#report_content").html();
                $("#email_content").val(content);
                $("#dateRow").show();

            });
        </script>