<?php
echo $this->element('header');
echo $this->Html->script('notification.js');
echo $this->Html->script('jquery.printElement.js');

if ($this->Session->check('shopCurrency')) {
    $shopCurrency = $this->Session->read('shopCurrency');
} else {
    $shopCurrency = "";
}

if (isset($customer)) {
    $customer_name = $customer;
} else {
    $customer_name = "[customer]";
}

if (isset($start_date)) {
    $sdate = $start_date;
} else {
    $sdate = "[start_date]";
}

if (isset($end_date)) {
    $edate = $end_date;
} else {
    $edate = "[end_date]";
}
?>
<!-- Content starts here -->
<h3>Find Cash Entries</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <?php echo $this->Form->create('CashAccount', array("url" => array('controller' => 'CashAccounts', 'action' => 'findEntry'))); ?>

        <div class="row" style="background: #fafad2;">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
        <div id="clearer"></div>


        <form id="order_list" action="#" method="post">
            <table border="0" width="100%" cellspacing="10" id ="report_content" cellpadding="0" align="left">

                <tr>
                    <th style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></th>
                    <th style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('expense_name', 'Account Heading'); ?></b></th>
                    <th style="border-bottom: solid 2px dodgerblue" width="120" align="left"><b><?php echo $this->Paginator->sort('expense_type', 'Account Type'); ?></b></th>
                    <th style="border-bottom: solid 2px dodgerblue" width="80" align="left"><b><?php echo $this->Paginator->sort('zone', 'Zone'); ?></b></th>
                    <th style="border-bottom: solid 2px dodgerblue" width="60" align="left"><b><?php echo $this->Paginator->sort('amount', 'Amount'); ?></b></th>
                    <th style="border-bottom: solid 2px dodgerblue;" width="120" align="left"><b><?php echo $this->Paginator->sort('expense_date', 'Date'); ?></b></th>

                    <th style="border-bottom: solid 2px dodgerblue;"  align="left"><b><?php echo $this->Paginator->sort('remarks', 'Description'); ?></b></th>

                </tr>
                <?php
                foreach ($data as $each_item):

                    switch ($each_item['CashAccount']['expense_type']) {
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
                        <td width="50" align="left"><?php echo $each_item['CashAccount']['id']; ?></td>
                        <td align="left"><a href="#"><?php echo $each_item['Expense']['payment_name']; ?></a></td> <!-- Link to enable editing -->
                        <td width="120" align="left"><?php echo $expensename ?></td>

                        <td width="80" align="left"><?php echo $each_item['Zone']['zone']; ?></td>
                        <td width="60" align="left"><?php echo $each_item['CashAccount']['amount']; ?></td>
                        <td align="left"><?php echo $each_item['CashAccount']['expense_date']; ?></td>
                        <td  align="left"><?php echo $each_item['CashAccount']['remarks']; ?></td>

                    </tr>
<?php endforeach; ?>
                <tr>
                    <td colspan="7" align="right">
                        <?php
                        //echo $this->Form->button('Delete',array("type" => "#","class" => "button_red"));           //check the parameters here
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


                <tr>
                    <td align="right" valign="top" colspan="6">
                        <p style="font-style: italic;">Accessed on <?php echo date('d-m-Y'); ?></p>
                    </td>
                </tr>
                <tr>
                    <td align="right" valign="top" colspan="6">
                        <?php
                        echo $this->Html->link('Print', "javascript:void(0)", array("class" => 'button_red', "id" => "print_report"));
                        ?>
                    </td>
                </tr>


            </table>
            <br></br><br></br>



            <!-- Content ends here -->

            <script type="text/javascript">
                $(document).ready(function () {
                    $("#print_report").click(function (event) {
                        event.preventDefault();
                        $("#hidrow").hide();
                        $("#reports_print").printElement();
                        $("#hidrow").show();
                    });
                });


            </script>