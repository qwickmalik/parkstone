<?php
//echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');
//echo $this->Html->script('notification.js');
?>
<!-- Content starts here -->
<h3>Daily Interest Statement</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>

<div>
    <table id="payment_receipt" border="0" width="700px" cellspacing="0" cellpadding="5" align="center" style="border: solid 5px Gray;">
        <?php
        $shopCurrency = "";
        if ($this->Session->check('shopCurrency')) {
            $shopCurrency = $this->Session->read('shopCurrency');
        }
        ?>
        <tr>
            <td align="left" valign="top" colspan="2">
                <div style="float: left; width: auto; height: auto; margin: 0; padding: 10px 100px 10px 10px;">
                    <?php echo $this->Html->image('logo.png');
                    ;
                    ?>
                </div>
                <div style="font-weight: bold;">
                    <p style="font-size: 25px;"><?php
                        if ($this->Session->check('shopName')) {
                            $shopName = $this->Session->read('shopName');
                            echo $shopName;
                        }
                        ?></p>
                    <p><?php
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
                            echo $postaladd;
                        }
                        ?></p>
                    <p><?php
                        if ($this->Session->check('shopMobile')) {
                            $shopMobile = $this->Session->read('shopMobile');

                            echo 'Mobile Phone: ' . $shopMobile;
                        }
                        ?></p>
                </div>
            </td>
        </tr>
        <tr>
            <td align="left" valign="top" width="50%" style="border-top: solid 1px Silver;">&nbsp;</td>
            <td align="left" valign="top" width="50%" style="border-top: solid 1px Silver;">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top" width="50%">
                <b style="font-size: 20px; font-weight: bold; display: block; width:90%; height: 100%; background-color: dodgerblue; padding: 10px 10px 10px 10px; text-align: center; border: solid 1px gray; color: #ffffff;">Statement: Daily Interest</b><br />
                
            </td>
            <td align="left" valign="top" width="50%">
                <!--                <b>Warehouse: Warehouse name</b><br></br>-->
                <b>Investor ID: <?php
                    if (isset($investor_id)) {
                        echo $investor_id;
                    }
                    ?></b><br />

                <b>Date: </b><?php
                 echo  date('jS F,Y');
                ?></b><br />
                <b style="font-size: 14px;">To: <?php
                    if (isset($investor_name)) {
                        echo $investor_name;
                    }
                    ?></b>
            </td>
        </tr>
        <tr>
            <td align="left" valign="top" width="50%" style="border-top: solid 1px Silver;">&nbsp;</td>
            <td align="left" valign="top" width="50%" style="border-top: solid 1px Silver;">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top" width="50%">
                <table width="100%" cellspacing="10" cellpadding="0" border="0">
                    <tr>
                        <td><b align="right">Investment ID:</b></td>
                        <td><span id="xxxxxx"><?php
                    if (isset($invesmentID)) {
                        echo $invesmentID;
                    }
                    ?></td>
                    </tr>
                    <tr>
                        <td><b align="right">Investment Term:</b></td>
                        <td><span id="xxxxxx"><?php
                                if (isset($data2['Portfolio']['payment_name'])) {
                                    echo $data2['Portfolio']['payment_name'];
                                }
                                ?></span></td>
                    </tr>
                </table>
            </td>
            <td align="left" valign="top" width="50%">
                <table width="100%" cellspacing="10" cellpadding="0" border="0">
                    <tr>
                        <td><b align="right">Investment Date:</b></td>
                        <td><span id="xxxxxx"><?php
                                if (isset($data2['Investment']['investment_date'])) {
                                    echo $data2['Investment']['investment_date'];
                                }
                                ?></td>
                    </tr>
                    <tr>
                        <td><b align="right">Due Date:</b></td>
                        <td><span id="xxxxxx"><?php
                                if (isset($data2['Investment']['due_date'])) {
                                    echo $data2['Investment']['due_date'];
                                }
                                ?></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td align="left" valign="top" colspan="2" style="border-top: solid 5px Silver;">
                <table width="100%" align="left" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td style="border-bottom: solid 2px dodgerblue" align="left"><b>Date<?php // echo $this->Paginator->sort('date', 'Supply Date');  ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="right"><b>Principal<?php echo "(".$shopCurrency.")";//echo $this->Paginator->sort('cost_price', 'Total Cost Price');   ?></b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Interest (%)</b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Interest (amt.)</b></td>
                        <td style="border-bottom: solid 2px dodgerblue" align="right"><b>Total<?php echo "(".$shopCurrency.")";//echo $this->Paginator->sort('balance', 'Balance');   ?></b></td>
                    </tr>
<?php  if(isset($data)){ foreach ($data as $each_item) {   ?>
                    <tr>
                        <td align="left"><?php 
                        if(isset($each_item['InvestmentStatement']['date'])){
                            echo date('M,y',strtotime($each_item['InvestmentStatement']['date']));//.",".date('y',$each_item['InvestmentStatement']['maturity_date']);
                        }
                        ?></td>
                        <td align="right"><?php 
                        if(isset($each_item['InvestmentStatement']['principal'])){
                            echo number_format($each_item['InvestmentStatement']['principal'], 2, '.', ',');
                        }
                        ?></td>
                        <td align="center"><?php 
                        if(isset($each_item['InvestmentStatement']['rate'])){
                            echo $each_item['InvestmentStatement']['rate'];
                        }
                        ?></td>
                        <td align="center"><?php 
                        if(isset($each_item['InvestmentStatement']['interest'])){
                            echo $each_item['InvestmentStatement']['interest'];
                        }
                        ?></td>
                        <td align="right"><?php 
                        if(isset($each_item['InvestmentStatement']['total'])){
                            echo number_format($each_item['InvestmentStatement']['total'], 2, '.', ',');
                        }
                        ?></td>
                    </tr>
                   
            <?php      } }  
            
             if (isset($data_total)) {
                            
            foreach ($data_total as $each_item):
                
                ?>
                <tr>
                   <td align="left" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">Total</td>
                   <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                   <td style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                   <td align="center" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;"><?php
                if (isset($each_item[0]['total_interest'])) {
                    echo $shopCurrency . ' ' . number_format($each_item[0]['total_interest'], 2, '.', ',');
                }
                ?></td>
                   <td align="right" valign="top" style="border-bottom: solid 1px #ffffff; background: #eaeaea; font-weight: bold;">&nbsp;</td>
                </tr>
                    <?php endforeach;
                }
                ?>
                </table>
            </td>
        </tr>
        
        <tr>
            <td align="left" valign="top" width="50%" style="border-top: solid 5px Silver;">&nbsp;</td>
            <td align="left" valign="top" width="50%" style="border-top: solid 5px Silver;">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top" width="50%">
                <p><b>Issued by: </b><?php
                                if (isset($issued)) {
                                    echo $issued;
                                }
                                ?></p>
            </td>
            <td align="right" valign="top" width="50%" >
                &nbsp;

            </td>

        </tr>
        <tr>
            <td align="left" valign="top" width="50%">&nbsp;</td>
            <td align="left" valign="top" width="50%">
                &nbsp;
            </td>
        </tr>
    </table>

    <table border="0" width="700px" cellspacing="0" cellpadding="5" align="center">
        <tr>
            <td align="left" valign="top" width="50%">&nbsp;</td>
            <td align="left" valign="top" width="50%">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td align="left" valign="top" width="50%">&nbsp;</td>
            <td align="right" valign="top" width="50%">
<?php
echo $this->Html->link('Return', "/Investments/manageClientInvestments"."/".(isset($investor_id) ? $investor_id: '' )."/".(isset($investor_name) ? $investor_name : '' ), array("class" => 'btn btn-lg btn-info'));
echo $this->Html->link('Print Receipt', "javascript:void(0)", array("class" => 'btn btn-lg btn-warning', "id" => "print_receipt"));
// echo $this->Form->button('Print Receipt',array("type" => "submit","class" => "button_red","id"=>"print_receipt"));
?>
            </td>
        </tr>
    </table>

</div>
		