<?php
echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js');

if ($this->Session->check('shopCurrency')) {
    $shopCurrency = $this->Session->read('shopCurrency');
} else {
    $shopCurrency = "";
}
?>
<h3>Edit Fixed Investment</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <!-- Content start here -->
        <div class="row">

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <h4>Investor ID: 
                    <?php echo isset($investor_id) ? $investor_id : ''; ?>
                </h4>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <h4>Investor Name: 
                    <?php echo isset($investor_name) ? $investor_name : ''; ?>
                </h4>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

            </div>

            <p>&nbsp;</p><p>&nbsp;</p>
            
            <?php
                    echo $this->Form->create('EditFixedInvestments', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'editFixedInvestments'), "inputDefaults" => array('div' => false)));
                    ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table class="table table-striped">

                    <tr>
                        <th align="left" width="120">Date</th>
                        <th align="left" width="150">Inv. Number &nbsp;</th>
                        <th align="left">Inv. Amount</th>
                        <th align="left">Benchmark Rate %</th>
                        <th align="left" width="120">Maturity Date</th>
                        <th align="left">Accrued Days</th>
                        <th align="left">Accrued Interest</th>
                        <th align="left">Principal Plus Interest</th>
                        <th align="left">Payments</th>
                        <th align="left">Balance Due</th>
                    </tr>
                    <?php
                    if (isset($data)) {
                        foreach ($data as $each_item):
                            $topup_pt = 0;
                            $amount = 0;
                            $topup_in = 0;
                            if (!empty($each_item['InvestmentPayment'])) {
                                foreach ($each_item['InvestmentPayment'] as $val):
                                    if ($val['event_type'] == 'Payment') {
                                        $amount += $val['amount'];
                                    }
                                endforeach;
                            }
                            ?>

                            <tr>
                                <td align="left"><?php
                                    if (isset($each_item['Investment']['investment_date'])) {
                                        echo date('d-M-Y', strtotime($each_item['Investment']['investment_date']));
                                    }
                                    ?></td>
                                <td align="left"><?php echo $each_item['Investment']['investment_no']; ?></td>
                                <td align="left"><?php
                                    if (!empty($each_item['Investment']['investment_amount'])) {

                                        $invest_amount = number_format($each_item['Investment']['investment_amount'], 2);
//                                        echo $invest_amount;

                                        echo $this->Form->input('custom_rate', array('label' => false, 'required',
                                            'value' => ($invest_amount)));
                                    }
                                    ?></td>
                                <td align="left"><?php
                                    echo $this->Form->input('custom_rate', array('label' => false, 'required',
                                        'value' => ($each_item['Investment']['custom_rate'])));


//                                    echo $each_item['Investment']['custom_rate'] . '%'; 
                                    ?></td>
                                <td align="left"><?php
                                    if (isset($each_item['Investment']['due_date'])) {
                                        echo date('d-M-Y', strtotime($each_item['Investment']['due_date']));
                                    }
                                    ?></td>
                                <td align="left"><?php
                                    if (isset($each_item['Investment']['id'])) {
                                        $id = $each_item['Investment']['id'];
                                        $accrued_days = $this->requestAction('/Investments/get_accrueddays/' . $id);
                                        echo $accrued_days;
                                    }
                                    ?></td>
                                <td align="left"><?php
                                    if (isset($each_item['Investment']['id'])) {
                                        $id = $each_item['Investment']['id'];
                                        $interest_accrued = $this->requestAction('/Investments/get_accruedinterest/' . $id);



//              if(!empty($topup_principal)){
//                                    
//                                    foreach($topup_principal as $tp_val){
//                                        if($tp_val['Topup']['investment_id'] == $each_item['Investment']['id']){
//                                        $topup_in += $tp_val[0]['topup_in'];
//                                        }
//                                    }
//                                    $invest_int = $interest_accrued - $topup_in;
//                                    echo  number_format($invest_int,2);
//                                }else{
                                        $invest_int = number_format($interest_accrued, 2);
                                        echo $invest_int;
//                                }
                                    }
                                    ?></td>
                                <td align="left"><?php
                                    if (isset($each_item['Investment']['id']) && isset($each_item['Investment']['investment_amount'])) {


                                        $totals = $invest_amount + $invest_int;

                                        echo number_format($totals, 2);
                                    }
                                    ?></td>
                                <td align="left"><?php
                                    if (isset($amount)) {
                                        echo number_format($amount, 2);
                                    }
                                    ?></td>
                                <td align="left"><?php
                                    if (isset($each_item['Investment']['earned_balance'])) {
                                        echo number_format($each_item['Investment']['earned_balance'], 2);
                                    }
                                    ?></td>
                            </tr>


                            <?php
                            if (!empty($each_item['Topup'])) {
                                ?>
                                <tr ><td colspan="10">
                                        <table class="table table-condensed" style="font-size:75%">
                                            <tr>
                                                <th align="left" width="120">&nbsp;</th>
                                                <th align="left" width="120">&nbsp;</th>
                                                <th align="left" width="100">Topup Amt. &nbsp;</th>
                                                <th align="left">Benchmark(%)</th>
                                                <th align="left">Interest</th>
                                                <th align="left">Topup Date</th>
                                                <th align="left" width="120">Maturity Date</th>
                                                <th align="left">Topup Tenure</th>
                                            </tr>  
                                            <?php
                                            foreach ($each_item['Topup'] as $val):
                                                ?>
                                                <tr>
                                                    <th align="left" width="120">&nbsp;</th>
                                                    <td align="left">&nbsp;</td>
                                                    <td align="left"><?php
//                                                        echo number_format($val['topup_amount'], 2);

                                                        echo $this->Form->input('topup_amount', array('label' => false, 'required',
                                                            'value' => (number_format($val['topup_amount'], 2))));
                                                        ?></td>
                                                    <td align="left"><?php
                                                        if (isset($each_item['Investment']['custom_rate'])) {
                                                            echo $each_item['Investment']['custom_rate'] . '%';
                                                        }
                                                        ?></td>
                                                    <td align="left"><?php echo number_format($val['topup_interest'], 2); ?></td>
                                                    <td align="left"><?php
                                                        if (isset($val['investment_date'])) {
                                                            echo date('d-M-Y', strtotime($val['investment_date']));
                                                        }
                                                        ?></td>
                                                    <td align="left"><?php
                                                        if (isset($each_item['Investment']['due_date'])) {
                                                            echo date('d-M-Y', strtotime($each_item['Investment']['due_date']));
                                                        }
                                                        ?></td>
                                                    <td align="left"><?php
                                                        if (isset($val['tenure'])) {
                                                            echo $val['tenure'] . 'Day(s)';
                                                        }
                                                        ?></td>

                                                </tr>
                                                <?php
                                            endforeach;
                                            ?>
                                        </table>
                                    </td> 
                                </tr>

                                <?php
                            }
                        endforeach;
                    }
                    ?>




                </table>
            </div>

            <?php
            echo "<p>&nbsp;</p>";

            echo $this->Form->button('Save', array('style' => 'float: right;', 'class' => 'btn btn-lg btn-success'));
            
            echo $this->Html->link('Return', "/Investments/manageFixedInvestments/" . $investor_id . "/" . $investor_name, array('style' => 'float: right;', 'class' => 'btn btn-lg btn-info'));
            ?>
        </div>
    </div>
    <!-- Content end here -->
    <?php echo $this->element('footer'); ?>

