<?php

class BalanceSheet extends AppModel {

    var $name = "BalanceSheet";
    var $usesTable = "balance_sheets";
    
    var $belongsTo = array(
        'CashAccount' => array(
            'className' => 'CashAccount',
            'foreignKey' => 'cash_account_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
        'Sale' => array(
            'className' => 'Sale',
            'foreignKey' => 'sale_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true)
            );

    function runBalEOD($baldate) {

        $latest = $this->find('first', array('order' => array('BalanceSheet.id DESC'), 'conditions' => array('BalanceSheet.flag' => 1)));
        $n = 0;
        $n = $this->find('count', array('conditions' => array("BalanceSheet.date" => $baldate)));

        if ($n > 0) {
            $data = $this->find('all', array('conditions' => array("BalanceSheet.date" => $baldate,'BalanceSheet.fixedasset_status' => 'available')));

            $cash = 0;
            $acc_receivables = 0;
            $stock = 0;
            $ppe = 0;
            $taxation = 0;
            $loans = 0;
            $acc_payable = 0;
            $liabilities = 0;
            $equity = 0;
            $interest= 0;
            $lgloans = 0;
            $sloans = 0;
            $profit_n_loss = 0;
            $injections = 0;
            $drawings = 0;
            $depreciation = 0;
            $purchaseofppe = 0;
           
            $land_n_building = 0;
            
            
            foreach ($data as $key => $value) {
                $cash += $value['BalanceSheet']['cash'];
                $purchaseofppe += $value['BalanceSheet']['purchaseofppe'];
                $taxation += $value['BalanceSheet']['taxation'];
                $injections += $value['BalanceSheet']['injections'];
                $drawings += $value['BalanceSheet']['drawings'];
                $depreciation += $value['BalanceSheet']['depreciation'];
                $sloans += $value['BalanceSheet']['sloans'];
                $lgloans += $value['BalanceSheet']['lgloans'];
                $acc_receivables += $value['BalanceSheet']['acc_receivable_debtors'];
                $stock += $value['BalanceSheet']['stock'];
                $interest += $value['BalanceSheet']['interest'];
                $land_n_building += $value['BalanceSheet']['land_n_building'];
                $profit_n_loss += $value['BalanceSheet']['profit_n_loss'];
                $ppe += $value['BalanceSheet']['property_plant_equipment'];
                $acc_payable += $value['BalanceSheet']['acc_payable_creditors'];
                $liabilities += $value['BalanceSheet']['other_liabilities'];
                $equity += $value['BalanceSheet']['owner_equity'];
            }

            $newdate = strtotime($baldate);
            $newdate = date('Y-m-d', $newdate);

            $itemData = array('flag' => 1, 'description' => 'bal', 'cash' => $cash, 'sloans' => $sloans,'lgloans'=> $lgloans,'acc_receivable_debtors' => $acc_receivables, 'stock' => $stock, 'property_plant_equipment' => $ppe, 'acc_payable_creditors' => $acc_payable, 'other_liabilities' => $liabilities,'land_n_building' => $land_n_building,'owner_equity' => $equity,'profit_n_loss' =>$profit_n_loss,'interest' => $interest, 'date' => $newdate,'purchaseofppe' => $purchaseofppe,'taxation' => $taxation,'drawings' => $drawings,'depreciation' => $depreciation,'injections' => $injections);
            $result = $this->save($itemData);

//        $result4 = $this->Item->save($itemData); 
//        if($latest){
//            //add to previos days data
//            
//            $lcash = 0;
//            $lacc_receivables = 0;
//            $lstock = 0;
//            $lppe = 0;
//
//            $lloans = 0;
//            $lacc_payable = 0;
//            $lliabilities = 0;
//            $lequity = 0;
//
//            $lcash =  $latest['BalanceSheet']['cash'] + $cash;
//            $lacc_receivables = $latest['BalanceSheet']['acc_receivable_debtors'] + $acc_receivables;
//            $lstock = $latest['BalanceSheet']['stock'] + $stock;
//            $lppe = $latest['BalanceSheet']['property_plant_equipment'] + $ppe;
//            $lloans = $latest['BalanceSheet']['loans'] + $loans;
//            $lacc_payable = $latest['BalanceSheet']['acc_payable_creditors'] + $acc_payable;
//            $lliabilities = $latest['BalanceSheet']['other_liabilities'] + $liabilities;
//            $lequity = $latest['BalanceSheet']['owner_equity'] + $equity;
//            
//            $latestData =   array('flag' => 1,'description' => 'bal','cash' => $lcash,'loans' => $lloans,'acc_receivable_debtors' => $lacc_receivables,'stock' => $lstock, 'property_plant_equipment' => $lppe,'acc_payable_creditors' => $lacc_payable, 'other_liabilities' => $lliabilities,'owner_equity' => $lequity, 'date' => $newdate);
//            
//            $resultlatest = $this->save($itemData);
//            
//        }elseif($latest == false){
            //save current lump sums without adding
//           $result = $this->save($itemData);
//            
//        }
        }
    }

    function fpReport($dy = "1", $s_m = "1", $e_m = "12", $y_r = "2020", $ey_r = "2021", $curr = "USD", $compName = 'QWICKFUSION') {
        $start_date = $y_r . "-" . $s_m . "-" . $dy;
        $end_date = $ey_r . "-" . $e_m . "-" . $dy;
        $snewdate = strtotime($start_date);
        $start_date = date('Y-m-d', $snewdate);

        $enewdate = strtotime($end_date);
        $end_date = date('Y-m-d', $enewdate);



        $n = 0;
        $n = $this->find('count', array('conditions' => array('AND' => array(array('BalanceSheet.date >=' => $start_date), array('BalanceSheet.date <=' => $end_date), array('BalanceSheet.flag' => 0)))));

        if ($n > 0) {
            $balResults = $this->find('all', array('conditions' => array('AND' => array(array('BalanceSheet.date >=' => $start_date), array('BalanceSheet.date <=' => $end_date), array('BalanceSheet.flag' => 1)))));

//      return json_encode($balResults);
            //            //add to previos days data

            $lcash = 0;
            $lacc_receivables = 0;
            $lstock = 0;
            $lppe = 0;

            $sloans = 0;
            $long_termln = 0;
            $lacc_payable = 0;
            $lliabilities = 0;
            $lequity = 0;

            foreach ($balResults as $key => $value) {
                $lcash += $value['BalanceSheet']['cash'];

                $sloans += $value['BalanceSheet']['sloans'];
                $long_termln += $value['BalanceSheet']['lgloans'];
                $lacc_receivables += $value['BalanceSheet']['acc_receivable_debtors'];
                $lstock += $value['BalanceSheet']['stock'];
                
                $lppe += $value['BalanceSheet']['property_plant_equipment'];
                $lacc_payable += $value['BalanceSheet']['acc_payable_creditors'];
                $lliabilities += $value['BalanceSheet']['other_liabilities'];
                $lequity += $value['BalanceSheet']['owner_equity'];


//            
//            $resultlatest = $this->save($itemData);
            }
            $total_assets = 0;
            $total_liab = 0;
            $total_liabEq = 0;
            $total_assets = $lcash + $lppe + $lacc_receivables;
            $total_liab = $lacc_payable + $lliabilities;
            $total_liabEq = $total_liab + $lequity;

            $innerBalTBL = '<tr>
                            <td align="center" valign="top" style="border-bottom: solid 1px dodgerblue;"><span style="font-size: 16px; font-weight: bold; text-algin:center;text-transform: uppercase;" >' . $compName . '<br></br>Statement of Financial Position (Balance Sheet)<br></br> For Month Ended ' . date('F d', $enewdate) . '</span></td>
                        </tr>
                        <tr>
                            <td align="left" valign="top">
                                <table width="600"cellspacing="5" cellpadding="5" border="0" style="margin-right: 30px;">
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold; border-bottom: solid 1px #101010;">ASSETS</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; border-bottom: solid 1px #101010;">' . $curr . '</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Cash</td>
                                        <td align="right" valign="top" width="95">' . $lcash . '</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Supplies</td>
                                        <td align="right" valign="top" width="95">0.00</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">PPE</td>
                                        <td align="right" valign="top" width="95">' . $lppe . '</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Accounts Receivable</td>
                                        <td align="right" valign="top" width="95">' . $lacc_receivables . '</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20" height="auto"></td>
                                        <td align="left" valign="top" height="auto"></td>
                                        <td align="right" valign="top" width="95" height="auto" style="border-bottom: solid 1px #101010;"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold;">Total Assets</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; color: #101010; border-bottom: double 3px #101010;">' . $total_assets . '</td>
                                    </tr>
                                </table>
                            </td>
                            <tr>
                            </tr>
                            <td align="left" valign="top">
                                <table width="600"cellspacing="5" cellpadding="5" border="0">
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold; border-bottom: solid 1px #101010;">LIABILITIES</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; border-bottom: solid 1px #101010;">' . $curr . '</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Accounts payable</td>
                                        <td align="right" valign="top" width="95">' . $lacc_payable . '</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Other liabilities</td>
                                        <td align="right" valign="top" width="95">' . $lliabilities . '</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20" height="auto"></td>
                                        <td align="left" valign="top" height="auto"></td>
                                        <td align="right" valign="top" width="95" height="auto" style="border-bottom: solid 1px #101010;"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold;">Total Liabilities</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; color: #101010; border-bottom: double 3px #101010;">' . $total_liab . '</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20">&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        <td align="right" valign="top" width="95">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20">&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        <td align="right" valign="top" width="95">&nbsp;</td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold; border-bottom: solid 1px #101010;">OWNER\'S EQUITY</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; border-bottom: solid 1px #101010;">' . $curr . '</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20" height="auto"></td>
                                        <td align="left" valign="top" height="auto">Owner Equity (Capital)</td>
                                        <td align="right" valign="top" width="95" height="auto" style="border-bottom: solid 1px #101010;">' . $lequity . '</td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold;">Total Liabilities and owner\'s equity</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; color: #101010; border-bottom: double 3px #101010;">' . $total_liabEq . '</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>';
//            
//            $balData =   array('flag' => 1,'description' => 'bal','cash' => $lcash,'loans' => $lloans,'acc_receivable_debtors' => $lacc_receivables,'stock' => $lstock, 'property_plant_equipment' => $lppe,'acc_payable_creditors' => $lacc_payable, 'other_liabilities' => $lliabilities,'owner_equity' => $lequity,"total_assets" => $total_assets, "total_liab" => $total_liab, "total_liabEq" => $total_liabEq, 'startdate' => $start_date, 'enddate' => $end_date,'feedback' => "success","currency" => $curr);

            $balData = array("feedback" => "success", 'balSheetTable' => $innerBalTBL);
            return $balData;
        } else {
            $innerBalTBL = '<tr>
                          <td align="center" valign="top" style="border-bottom: solid 1px dodgerblue;"><span style="font-size: 16px; font-weight: bold; text-algin:center;text-transform: uppercase;" >' . $compName . '<br></br>Statement of Income<br></br> For Month Ended ' . date_format('F d', $enewdate) . '</span></td>
                        </tr>
                        <tr>
                            <td align="left" valign="top">
                                <table width="600"cellspacing="5" cellpadding="5" border="0" style="margin-right: 30px;">
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold; border-bottom: solid 1px #101010;">ASSETS</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; border-bottom: solid 1px #101010;"><span id="Acurrency"></span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Cash</td>
                                        <td align="right" valign="top" width="95"><span id="balcash"> 00.00</span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Supplies</td>
                                        <td align="right" valign="top" width="95"><span id="balsupplies">00.00 </span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">PPE</td>
                                        <td align="right" valign="top" width="95"><span id="balppe">00.00 </span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Accounts Receivable</td>
                                        <td align="right" valign="top" width="95"><span id="balaccreceiv"> 00.00</span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20" height="auto"></td>
                                        <td align="left" valign="top" height="auto"></td>
                                        <td align="right" valign="top" width="95" height="auto" style="border-bottom: solid 1px #101010;"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold;">Total Assets</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; color: #101010; border-bottom: double 3px #101010;"><span id="baltotassets"> 00.00</span></td>
                                    </tr>
                                </table>
                            </td>
                            <tr></tr>
                            <td align="left" valign="top">
                                <table width="600"cellspacing="5" cellpadding="5" border="0">
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold; border-bottom: solid 1px #101010;">LIABILITIES</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; border-bottom: solid 1px #101010;"><span id="Bcurrency"></span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Accounts payable</td>
                                        <td align="right" valign="top" width="95"><span id="balaccpayable">00.00 </span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Other liabilities</td>
                                        <td align="right" valign="top" width="95"><span id="balliabilities">00.00 </span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20" height="auto"></td>
                                        <td align="left" valign="top" height="auto"></td>
                                        <td align="right" valign="top" width="95" height="auto" style="border-bottom: solid 1px #101010;"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold;">Total Liabilities</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; color: #101010; border-bottom: double 3px #101010;"><span id="baltotliabilities">00.00 </span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20">&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        <td align="right" valign="top" width="95">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20">&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        <td align="right" valign="top" width="95">&nbsp;</td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold; border-bottom: solid 1px #101010;">OWNER\'S EQUITY</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; border-bottom: solid 1px #101010;"><span id="Ccurrency"></span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20" height="auto"></td>
                                        <td align="left" valign="top" height="auto">Owner Equity (Capital)</td>
                                        <td align="right" valign="top" width="95" height="auto" style="border-bottom: solid 1px #101010;"><span id="balequity"> 00.00</span></td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold;">Total Liabilities and owner\'s equity</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; color: #101010; border-bottom: double 3px #101010;"><span id="baltotequity">00.00 </span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>';


            $balData = array("feedback" => "unsuccessful", 'balSheetTable' => $innerBalTBL);
            return json_encode($balData);
        }
    }

    function aReport($day, $month, $smonth, $ayear, $fyear, $currency, $shopName) {
        $start_date = $ayear . "-" . $month . "-" . $day;
        $end_date = $fyear . "-" . $smonth . "-" . $day;
        $snewdate = strtotime($start_date);
        $start_date = date('Y-m-d', $snewdate);

//        $enewdate = strtotime($end_date);
//        $end_date = date('Y-m-d', $enewdate);
        $enewdate = new DateTime($start_date);
        $enewdate->add(new DateInterval('P364D'));
        $end_date = $enewdate->format('Y-m-d');
        $eenewdate = strtotime($end_date);
        
        $n = 0;
        $n = $this->find('count', array('conditions' => array('AND' => array(array('BalanceSheet.date >=' => $start_date), array('BalanceSheet.date <=' => $end_date), array('BalanceSheet.flag' => 1),array('fixedasset_status !=' => 'not')))));

        if ($n > 0) {
            $balResults = $this->find('all', array('conditions' => array('AND' => array(array('BalanceSheet.date >=' => $start_date), array('BalanceSheet.date <=' => $end_date), array('BalanceSheet.flag' => 1),array('fixedasset_status !=' => 'not')))));

//      return json_encode($balResults);
            //            //add to previos days data

            $lcash = 0;
            $lacc_receivables = 0;
            $lstock = 0;
            $lppe = 0;
            $landBlding = 0;
            $lloans = 0;
            $lgloans = 0;
            $sloans = 0;
            $lacc_payable = 0;
            $lliabilities = 0;
            $lequity = 0;
            $bankcash = 0;
            $taxation = 0;
            $netcur_assets = 0;
            $totassetslessliab = 0;
            $share_capital = 0;
            $profit_n_loss = 0;
            $drawings = 0;
            $Pre_total_reserves = '';
            $total_reserves = 0;
            $current_assets = '';
            $properties = '';
            if($balResults){
                $balResults2 = $this->find('all', array('conditions' => array('AND' => array(array('BalanceSheet.date >=' => $start_date), array('BalanceSheet.date <=' => $end_date), array('BalanceSheet.flag' => 0),array('BalanceSheet.fixedasset_status !=' => 'not')))));
                if($balResults2){
                    foreach ($balResults2 as $key => $value) {
                        
                         if($value['BalanceSheet']['property_plant_equipment'] > 0){
                             $lppe += $value['BalanceSheet']['property_plant_equipment'];
                    $properties .=  '<tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">'.$value['BalanceSheet']['description'].'</td>
                                        <td align="right" valign="top" width="95">' . $value['BalanceSheet']['property_plant_equipment'] . '</td>
                                    </tr>';
                }
                        
                    }
                }
                
            foreach ($balResults as $key => $value) {
                //$landBlding += $value['BalanceSheet']['land_n_building'];
                $bankcash += $value['BalanceSheet']['cash'];

                //$lloans += $value['BalanceSheet']['loans'];
                $lacc_receivables += $value['BalanceSheet']['acc_receivable_debtors'];
                $lstock += $value['BalanceSheet']['stock'];
                $sloans += $value['BalanceSheet']['sloans'];
                $lgloans += $value['BalanceSheet']['lgloans'];
                $ncinterest += $value['BalanceSheet']['interest'];
                
                $lacc_payable += $value['BalanceSheet']['acc_payable_creditors'];
                $lliabilities += $value['BalanceSheet']['other_liabilities'];
                $share_capital += $value['BalanceSheet']['owner_equity'];
                $profit_n_loss += $value['BalanceSheet']['profit_n_loss'];

               
//            
//            $resultlatest = $this->save($itemData);
            }
        }
            $total_noncur = $lppe;
            $total_cur = $lstock + $lacc_receivables + $bankcash;
            $total_curliab = $lacc_payable + $taxation + $ncinterest + $sloans;
            $netcur_assets = $total_cur - $total_curliab;
            
            $totassetslessliab = ($total_noncur + $total_cur) - $total_curliab;
            $net_assets = $totassetslessliab - $lgloans;
            $Pre_total_reserves = ($share_capital + $profit_n_loss) - $drawings;
            if($Pre_total_reserves < 0){
                $total_reserves = '('.$Pre_total_reserves.')';
            }elseif($Pre_total_reserves >= 0){
                $total_reserves = $Pre_total_reserves;
            }
            $total_assets = 0;
            $total_liab = 0;
            $total_liabEq = 0;
            $total_assets = $lcash + $lppe + $lacc_receivables;
            $total_liab = $lacc_payable + $lliabilities;
            $total_liabEq = $total_liab + $lequity;
            

           if($bankcash < 0){
               $bankcash = $bankcash -($bankcash) - ($bankcash);
               $bankcash = '('.$bankcash.')';
           }
           if($total_cur < 0){
               $total_cur = $total_cur -($total_cur) - ($total_cur);
               $total_cur = '('.$total_cur.')';
           }
              if($netcur_assets < 0){
               $netcur_assets = $netcur_assets -($netcur_assets) - ($netcur_assets);
               $netcur_assets = '('.$netcur_assets.')';
           }
           if($lstock < 0){
               $lstock = $lstock -($lstock) - ($lstock);
               $lstock = '('.$lstock.')';
           }
           
           if($lacc_receivables < 0){
               $lacc_receivables = $lacc_receivables -($lacc_receivables) - ($lacc_receivables);
               $lacc_receivables = '('.$lacc_receivables.')';
           }
           
            if($totassetslessliab < 0){
               $totassetslessliab = $totassetslessliab -($totassetslessliab) - ($totassetslessliab);
               $totassetslessliab = '('.$totassetslessliab.')';
           }
            if($lgloans < 0){
               $lgloans = $lgloans -($lgloans) - ($lgloans);
               $lgloans = '('.$lgloans.')';
           }
            if($net_assets < 0){
               $net_assets = $net_assets -($net_assets) - ($net_assets);
               $net_assets = '('.$net_assets.')';
           }
           if($share_capital < 0){
               $share_capital = $share_capital -($share_capital) - ($share_capital);
               $share_capital = '('.$share_capital.')';
           }
           if($drawings < 0){
               $drawings = $drawings -($drawings) - ($drawings);
               $drawings = '('.$drawings.')';
           }
           if($profit_n_loss < 0){
               $profit_n_loss = $profit_n_loss -($profit_n_loss) - ($profit_n_loss);
               $profit_n_loss = '('.$profit_n_loss.')';
           }
           if($total_curliab < 0){
               $total_curliab = $total_curliab -($total_curliab) - ($total_curliab);
               $total_curliab = '('.$total_curliab.')';
           }
            $innerBalTBL = '<tr>
                            <td align="center" valign="top" style="border-bottom: solid 1px dodgerblue;"><span style="font-size: 16px; font-weight: bold; text-algin:center;text-transform: uppercase;" >' . $shopName . '<br></br>BALANCE SHEET<br></br> For Month Ended ' . date('F d, Y', $eenewdate) . '</span></td>
                        </tr>
                        <tr>
                            <td align="left" valign="top">
                                <table width="600"cellspacing="5" cellpadding="5" border="0" style="margin-right: 30px;">
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold;"></td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold;">' . $currency . '</td>
                                    </tr>
                            
                           <tr>
                                        <td align="left" valign="top" colspan="2" style="font-style: italic;">Fixed Assets</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold;"></td>
                                    </tr>'.
                                    $properties
                                    .'<tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top"></td>
                                        <td align="right" valign="top" width="95" style="border-top: solid 1px #101010;border-bottom: solid 1px #101010;">' . $total_noncur . '.00</td>
                                    </tr>
                                    
                                    
                                        <tr>
                                        <td align="left" valign="top" colspan="2" style="font-style: italic;">Current Assets</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold;"></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Inventory</td>
                                        <td align="right" valign="top" width="95">'.$lstock.'</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Accounts Receivable</td>
                                        <td align="right" valign="top" width="95">' . $lacc_receivables . '</td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Cash at Bank</td>
                                        <td align="right" valign="top" width="95">' . $bankcash . '</td>
                                    </tr>
                                     <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top"></td>
                                        <td align="right" valign="top" width="95" style="border-top: solid 1px #101010;border-bottom: solid 1px #101010;">' . $total_cur . '</td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-style: italic;">Current Liabilities</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold;"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Accounts payable</td>
                                        <td align="right" valign="top" width="95">' . $lacc_payable . '</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Taxation</td>
                                        <td align="right" valign="top" width="95">' . $taxation . '</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Interest Owing/Accrued</td>
                                        <td align="right" valign="top" width="95">' . $ncinterest . '</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Short term loan</td>
                                        <td align="right" valign="top" width="95">' . $sloans . '</td>
                                    </tr>
                                      <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top"></td>
                                        <td align="right" valign="top" width="95" style="border-top: solid 1px #101010;border-bottom: solid 1px #101010;">' . $total_curliab . '</td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" colspan="2">Net current assets</td>
                                        <td align="right" valign="top" width="95" style="border-bottom: solid 1px #101010; ">' . $netcur_assets . '</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" colspan="2">Total assets less current liabilities</td>
                                        <td align="right" valign="top" width="95" >' . $totassetslessliab . '</td>
                                    </tr>
                                    
                                     <tr>
                                        <td align="left" valign="top" colspan="2" style="font-style: italic;">Non-Current Liabilities</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold;"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Long term loan</td>
                                        <td align="right" valign="top" width="95">' . $lgloans . '</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-style: italic; font-weight: bold;">Net assets</td>
                                        
                                        <td align="right" valign="top" width="95" style="border-top: solid 1px #101010;border-bottom: double 3px #101010; font-weight: bold;">' . $net_assets . '</td>
                                    </tr>
                                     
                                    
                                    
<tr>
                                        <td align="left" valign="top" colspan="2" style="font-style: italic;">Rep By:</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold;"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Share capital</td>
                                        <td align="right" valign="top" width="95">' . $share_capital . '</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Profit and loss account</td>
                                        <td align="right" valign="top" width="95">' . $profit_n_loss . '</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Drawings</td>
                                        <td align="right" valign="top" width="95">(' . $drawings . ')</td>
                                    </tr>
                                      <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top"></td>
                                        <td align="right" valign="top" width="95" style="border-top: solid 1px #101010;border-bottom:double 3px #101010; font-weight: bold;">' . $total_curliab . '</td>
                                    </tr>
                                     <tr>
                                        <td align="left" valign="top" width="20">&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        <td align="right" valign="top" width="95" >&nbsp;</td>
                                    </tr>';
                                    
/*                                  <tr>
////                                        <td align="left" valign="top" width="20" height="auto"></td>
////                                        <td align="left" valign="top" height="auto"></td>
////                                        <td align="right" valign="top" width="95" height="auto" style="border-bottom: solid 1px #101010;"></td>
////                                    </tr>
////                                    
////                                    <tr>
////                                        <td align="left" valign="top" colspan="2" style="font-weight: bold;">Total Assets</td>
////                                        <td align="right" valign="top" width="95" style="font-weight: bold; color: #101010; border-bottom: double 3px #101010;">' 
                    . $currency . ' ' . $total_assets . '</td>
//                                    </tr>
//                                </table>
//                            </td>
//                            <tr></tr>
//                            <td align="left" valign="top">
//                                <table width="600"cellspacing="5" cellpadding="5" border="0">
//                                    <tr>
//                                        <td align="left" valign="top" colspan="2" style="font-weight: bold; border-bottom: solid 1px #101010;">LIABILITIES</td>
//                                        <td align="right" valign="top" width="95" style="font-weight: bold; border-bottom: solid 1px #101010;">' . $currency . '</td>
//                                    </tr>
//                                    <tr>
//                                        <td align="left" valign="top" width="20"></td>
//                                        <td align="left" valign="top">Accounts payable</td>
//                                        <td align="right" valign="top" width="95">' . $lacc_payable . '</td>
//                                    </tr>
//                                    <tr>
//                                        <td align="left" valign="top" width="20"></td>
//                                        <td align="left" valign="top">Other liabilities</td>
//                                        <td align="right" valign="top" width="95">' . $lliabilities . '</td>
//                                    </tr>
//                                    <tr>
//                                        <td align="left" valign="top" width="20" height="auto"></td>
//                                        <td align="left" valign="top" height="auto"></td>
//                                        <td align="right" valign="top" width="95" height="auto" style="border-bottom: solid 1px #101010;"></td>
//                                    </tr>
//                                    
//                                    <tr>
//                                        <td align="left" valign="top" colspan="2" style="font-weight: bold;">Total Liabilities</td>
//                                        <td align="right" valign="top" width="95" style="font-weight: bold; color: #101010; border-bottom: double 3px #101010;">' . $currency . ' ' . $total_liab . '</td>
//                                    </tr>
//                                    <tr>
//                                        <td align="left" valign="top" width="20">&nbsp;</td>
//                                        <td align="left" valign="top">&nbsp;</td>
//                                        <td align="right" valign="top" width="95">&nbsp;</td>
//                                    </tr>
//                                    <tr>
//                                        <td align="left" valign="top" width="20">&nbsp;</td>
//                                        <td align="left" valign="top">&nbsp;</td>
//                                        <td align="right" valign="top" width="95">&nbsp;</td>
//                                    </tr>
//                                    
//                                    <tr>
//                                        <td align="left" valign="top" colspan="2" style="font-weight: bold; border-bottom: solid 1px #101010;">OWNER\'S EQUITY</td>
//                                        <td align="right" valign="top" width="95" style="font-weight: bold; border-bottom: solid 1px #101010;">' . $currency . '</td>
//                                    </tr>
//                                    <tr>
//                                        <td align="left" valign="top" width="20" height="auto"></td>
//                                        <td align="left" valign="top" height="auto">Owner Equity (Capital)</td>
//                                        <td align="right" valign="top" width="95" height="auto" style="border-bottom: solid 1px #101010;">' . $lequity . '</td>
//                                    </tr>
//                                    
//                                    <tr>
//                                        <td align="left" valign="top" colspan="2" style="font-weight: bold;">Total Liabilities and owner\'s equity</td>
//                                        <td align="right" valign="top" width="95" style="font-weight: bold; color: #101010; border-bottom: double 3px #101010;">' . $currency . ' ' . $total_liabEq . '</td>
//                                    </tr>
//                                </table>
//                            </td>
//                        </tr>';*/

            //$innerBalTBL = ;
//            
//            $balData =   array('flag' => 1,'description' => 'bal','cash' => $lcash,'loans' => $lloans,'acc_receivable_debtors' => $lacc_receivables,'stock' => $lstock, 'property_plant_equipment' => $lppe,'acc_payable_creditors' => $lacc_payable, 'other_liabilities' => $lliabilities,'owner_equity' => $lequity,"total_assets" => $total_assets, "total_liab" => $total_liab, "total_liabEq" => $total_liabEq, 'startdate' => $start_date, 'enddate' => $end_date,'feedback' => "success","currency" => $curr);

            $balData = array("feedback" => "success", 'balSheetTable' => $innerBalTBL);
            return $balData;
        } else {
            $innerBalTBL = '<tr>
                          <td align="center" valign="top" style="border-bottom: solid 1px dodgerblue;"><span style="font-size: 16px; font-weight: bold; text-algin:center;text-transform: uppercase;" >' . $shopName . '<br></br>Balance Sheet<br></br> For Month Ended ' . date_format('F d, Y', $enewdate) . '</span></td>
                        </tr>
                        <tr>
                            <td align="left" valign="top">
                                <table width="600"cellspacing="5" cellpadding="5" border="0" style="margin-right: 30px;">
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold; border-bottom: solid 1px #101010;">ASSETS</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; border-bottom: solid 1px #101010;"><span id="Acurrency"></span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Cash</td>
                                        <td align="right" valign="top" width="95"><span id="balcash"> 00.00</span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Supplies</td>
                                        <td align="right" valign="top" width="95"><span id="balsupplies">00.00 </span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">PPE</td>
                                        <td align="right" valign="top" width="95"><span id="balppe">00.00 </span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Accounts Receivable</td>
                                        <td align="right" valign="top" width="95"><span id="balaccreceiv"> 00.00</span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20" height="auto"></td>
                                        <td align="left" valign="top" height="auto"></td>
                                        <td align="right" valign="top" width="95" height="auto" style="border-bottom: solid 1px #101010;"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold;">Total Assets</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; color: #101010; border-bottom: double 3px #101010;"><span id="baltotassets"> ' . $currency . ' ' . '00.00</span></td>
                                    </tr>
                                </table>
                            </td>
                            <tr></tr>
                            <td align="left" valign="top">
                                <table width="600"cellspacing="5" cellpadding="5" border="0">
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold; border-bottom: solid 1px #101010;">LIABILITIES</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; border-bottom: solid 1px #101010;"><span id="Bcurrency"></span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Accounts payable</td>
                                        <td align="right" valign="top" width="95"><span id="balaccpayable">00.00 </span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20"></td>
                                        <td align="left" valign="top">Other liabilities</td>
                                        <td align="right" valign="top" width="95"><span id="balliabilities">00.00 </span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20" height="auto"></td>
                                        <td align="left" valign="top" height="auto"></td>
                                        <td align="right" valign="top" width="95" height="auto" style="border-bottom: solid 1px #101010;"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold;">Total Liabilities</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; color: #101010; border-bottom: double 3px #101010;"><span id="baltotliabilities">' . $currency . ' ' . '00.00 </span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20">&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        <td align="right" valign="top" width="95">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20">&nbsp;</td>
                                        <td align="left" valign="top">&nbsp;</td>
                                        <td align="right" valign="top" width="95">&nbsp;</td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold; border-bottom: solid 1px #101010;">OWNER\'S EQUITY</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; border-bottom: solid 1px #101010;"><span id="Ccurrency"></span></td>
                                    </tr>
                                    <tr>
                                        <td align="left" valign="top" width="20" height="auto"></td>
                                        <td align="left" valign="top" height="auto">Owner Equity (Capital)</td>
                                        <td align="right" valign="top" width="95" height="auto" style="border-bottom: solid 1px #101010;"><span id="balequity"> 00.00</span></td>
                                    </tr>
                                    
                                    <tr>
                                        <td align="left" valign="top" colspan="2" style="font-weight: bold;">Total Liabilities and owner\'s equity</td>
                                        <td align="right" valign="top" width="95" style="font-weight: bold; color: #101010; border-bottom: double 3px #101010;"><span id="baltotequity">' . $currency . ' ' . '00.00 </span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>';


            $balData = array("feedback" => "unsuccessful", 'balSheetTable' => $innerBalTBL);
            return $balData;
        }
    }

}

?>
