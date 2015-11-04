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
<h3>Step 1 - Select by deposit</h3>
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
                    echo $this->Form->create('EditFixedInvestments', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => ''), "inputDefaults" => array('div' => false)));
                    ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table class="table table-striped">

                    <tr>
                        
                        <th align="left">Action</th>
                        <th align="left">Deposit Date</th>
                        <th align="left">Deposit Amt.</th>
                        <th align="left">Benchmark Rate</th>
                        <th align="left">Maturity Date</th>
                        
<!--                        <th align="left">Accrued Days</th>
                        <th align="left">Accrued Interest</th>-->
                    </tr>
                    <?php
                    if (isset($data)) {
                        $x = 1;
                        foreach ($data as $each_item):
                           
                            ?>

                            <tr>
                                 <td align="left"><?php
                                  if(isset($each_item['Investment']['id'])){
                            echo $this->Html->link('Edit', '/Investments/editFixedInvestment/'.$investor_id.'/'.$each_item['Investment']['id'].'/'.$each_item['InvestmentCash']['id'].'/'.$x, array('class' => 'btn btn-xs btn-success',));
                        }
                                    ?></td>
                                <td align="left"><?php
                                    if (isset($each_item['InvestmentCash']['investment_date'])) {
                                        echo date('d-M-Y', strtotime($each_item['InvestmentCash']['investment_date']));
                                    }
                                    ?></td>
                                <td align="left"><?php
                                    if (!empty($each_item['InvestmentCash']['amount'])) {

                                        $invest_amount = number_format($each_item['InvestmentCash']['amount'], 2);
                                        echo $invest_amount;

//                                        echo $this->Form->input('amount', array('style' => 'width:65%','label' => false, 'required',
//                                            'value' => ($invest_amount)));
                                    }
                                    ?></td>
                                <td align="left"><?php
//                                    echo $this->Form->input('custom_rate', array('style' => 'width:65%','label' => false, 'required',
//                                        'value' => ($each_item['Investment']['custom_rate'])));


                                    echo $each_item['Investment']['custom_rate'] . '%'; 
                                    ?></td>
                                <td align="left"><?php
                                    if (isset($each_item['Investment']['due_date'])) {
                                        echo date('d-M-Y', strtotime($each_item['Investment']['due_date']));
                                    }
                                    ?></td>
<!--                                <td align="left"><?php
//                                    if (isset($each_item['Investment']['id'])) {
//                                        $id = $each_item['Investment']['id'];
//                                        $accrued_days = $this->requestAction('/Investments/get_accrueddays/' . $id);
//                                        echo $accrued_days;
//                                    }
                                    ?></td>-->
<!--                                <td align="left"><?php
//                                    if (isset($each_item['Investment']['id'])) {
//                                        $id = $each_item['Investment']['id'];
//                                        $interest_accrued = $this->requestAction('/Investments/get_accruedinterest/' . $id);
//
//
//                                        $invest_int = number_format($interest_accrued, 2);
//                                        echo $invest_int;
//
//                                    }
                                    ?></td>-->
                               
                              
                            </tr>


                           

                                <?php
                            $x++;
                        endforeach;
                    }
                    ?>




                </table>
            </div>

            <?php
            echo "<p>&nbsp;</p>";

//            echo $this->Form->button('Save', array('style' => 'float: right;', 'class' => 'btn btn-lg btn-success'));
            
            echo $this->Html->link('Return', "/Investments/manageFixedInvestments/" . $investor_id . "/" . $investor_name, array('style' => 'float: right;', 'class' => 'btn btn-lg btn-info'));
            ?>
        </div>
    </div>
    <!-- Content end here -->
    <?php echo $this->element('footer'); ?>

