<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Equity extends AppModel {

    var $name = "Equity";
    var $usesTable = "equities";

    function runEQEOM($isdate, $acc_month) {

        $revenue = 0;
        $expenditure = 0;
        $net_income = 0;
        $net_loss = 0;
        $withdrawal = 0;
        $Investment = 0;
        $net = 0;
        $beginning_balance = 0;



        if ($acc_month == 'first') {

            $date = new DateTime($isdate);
            $date->add(new DateInterval('P1M'));


            $data = $this->find('all', array('conditions' => array('AND' => array(array('Equity.date >=' => $isdate), array('Equity.date <=' => $date->format('Y-m-d')), array('Equity.flag' => 0)))));

            foreach ($data as $key => $value) {
                $revenue += $value['Equity']['revenue'];

                $expenditure += $value['Equity']['expenditure'];
                $Investment += $value['Equity']['Owner_Investment'];
                $withdrawal += $value['Equity']['withdrawal'];
            }

            $net = $revenue - $expenditure;
            if ($net >= 0) {
                $net_income = $net;
            } elseif ($net < 0) {
                $net_loss = $net;
            }
            $newdate = strtotime($last_EOM);
            $newdate = date('Y-m-d', $newdate);

            $balance_end_plus = $Investment + $beginning_balance + $net_income;
            $balance_end_less = $withdrawal + $net_loss;
            $balance_end = $balance_end_plus - $balance_end_less;


            $inData = array('flag' => 2, 'description' => 'EOM', 'beginning_balance' => $beginning_balance, 'Owner_Investment' => $Investment, 'revenue' => $revenue, 'expenditure' => $expenditure, 'net_income' => $net_income, 'withdrawal' => $withdrawal, 'net_loss' => $net_loss, 'balance_end' => $balance_end, 'date' => $newdate);


            $result = $this->save($inData);

            $date->add(new DateInterval('P1D'));
            $feedback = array('next_eom_date' => $date->format('Y-m-d'));
            return $feedback;
        } elseif ($acc_month == 'other') {

            //find last eom and calculate eom from there
            $latest = $this->find('first', array('order' => array('Equity.id DESC'), 'conditions' => array('Equity.flag' => 2)));

            $last_EOM = $latest['Equity']['date'];

            $date = new DateTime($last_EOM);
            $date->add(new DateInterval('P1M'));



            $beginning_balance = $latest['Equity']['balance_end'];

            $data = $this->find('all', array('conditions' => array('AND' => array(array('Equity.date >=' => $last_EOM), array('Equity.date <=' => $date->format('Y-m-d')), array('Equity.flag' => 0)))));

            foreach ($data as $key => $value) {
                $revenue += $value['Equity']['revenue'];

                $expenditure += $value['Equity']['expenditure'];
                $Investment += $value['Equity']['Owner_Investment'];
                $withdrawal += $value['Equity']['withdrawal'];
            }

            $net = $revenue - $expenditure;
            if ($net >= 0) {
                $net_income = $net;
            } elseif ($net < 0) {
                $net_loss = $net;
            }

            $newdate = strtotime($isdate);
            $newdate = date('Y-m-d', $newdate);

            $balance_end_plus = $Investment + $beginning_balance + $net_income;
            $balance_end_less = $withdrawal + $net_loss;
            $balance_end = $balance_end_plus - $balance_end_less;


            $inData = array('flag' => 2, 'description' => 'EOM', 'beginning_balance' => $beginning_balance, 'Owner_Investment' => $Investment, 'revenue' => $revenue, 'expenditure' => $expenditure, 'net_income' => $net_income, 'withdrawal' => $withdrawal, 'net_loss' => $net_loss, 'balance_end' => $balance_end, 'date' => $newdate);
            $result = $this->save($inData);

            $date = new DateTime($last_EOM);
            $date->add(new DateInterval('P1M1D'));
            $feedback = array('next_eom_date' => $date->format('Y-m-d'));
            return $feedback;
        }
    }

    function eqReport($dy = "1", $s_m = "1", $e_m = "12", $y_r = "2020", $t_yr = "2021", $curr = "USD", $compName = "QWICKFUSION", $owner = '') {
        
        if ($owner == '') {
            $owner = $compName;
        }
        $starts_date = $y_r . "-" . $s_m . "-" . $dy;
        $enewdates = $t_yr . "-" . $e_m . "-" . $dy;
        $snewdate = strtotime($starts_date);
        $start_date = date('Y-m-d', $snewdate);

        $enewdate = strtotime($enewdates);
        $end_date = date('Y-m-d', $enewdate);
        $year_ended = date('F d, Y', $enewdate);

        $n = 0;
        $n = $this->find('count', array('conditions' => array('AND' => array(array('Equity.date >=' => $start_date), array('Equity.date <=' => $end_date), array('Equity.flag' => 2)))));

        //------Declaration of variables---------//
        $totalRev = 0.00;
        $totalExpend = 0.00;
        $net_income = 0.00;
        $post_net_income = 0.00;
        $revenue = 0.00;
        $expenditure = 0.00;
        $net_income = 0.00;
        $net_loss = 0.00;
        $withdrawal = 0.00;
        $Investment = 0.00;
        $net = 0;
        $beginning_balance = 0;

        $latest = $this->find('first', array('order' => array('Equity.id DESC'), 'conditions' => array('Equity.flag' => 2)));
        
//        return json_encode($latest);
        $beginning_balance = $latest['Equity']['balance_end'];
        $isTableHeader = ' <tr>
                            <td align="center" valign="top" colspan="4" style="border-bottom: solid 1px dodgerblue;"><span style="font-size: 16px; font-weight: bold; text-algin:center;text-transform: uppercase;" >' . $compName . '<br></br>Statement of Changes in Owner\'s Equity<br></br> For Year Ended ' . $year_ended . '</span></td>
                        </tr>
';
        $isTableHeader .= '
                        <tr>
                            <td align="left" valign="top" width="20"></td>
                            <td align="left" valign="top" width="465"></td>
                            <td align="right" valign="top" width="95" style="font-weight: bold;">' . $curr . '</td>
                            <td align="right" valign="top" width="95" style="font-weight: bold;">' . $curr . '</td>
                        </tr>
';
        //----------------------------------------------------------//

        if ($n > 0) {
            $inResults = $this->find('all', array('conditions' => array('AND' => array(array('Equity.date >=' => $start_date), array('Equity.date <=' => $end_date), array('Equity.flag' => 2)))));

//      return json_encode($balResults);
            //            //add to previos days data



            $eqOwnerIncome .= '<tr>
                            <td align="left" valign="top" colspan="2" style="font-style: italic; padding-left: 80px;"></td>
                            <td align="right" valign="top" width="95"></td>
                            <td align="right" valign="top" width="95" style="border-bottom: solid 1px #101010;"></td>
                        </tr>';
            
            $eqOwnerLoss .= '';

            foreach ($inResults as $key => $value) {

                $Investment += $value['Equity']['Owner_Investment'];
                $revenue += $value['Equity']['revenue'];
                $expenditure += $value['Equity']['expenditure'];


                $withdrawal += $value['Equity']['withdrawal'];


//            
//            $resultlatest = $this->save($itemData);
            }

            $net = $revenue - $expenditure;
            if ($net >= 0) {
                $net_income = $net;
                $balance_end_plus = $Investment + $beginning_balance + $net_income;
                $eqOwnerIncome .= '<tr>
                            <td align="left" valign="top" colspan="2" style="font-style: italic; padding-left: 80px;">Net income</td>
                            <td align="right" valign="top" width="95" style="border-bottom: solid 1px #101010;">' . $net_income . '</td>
                            <td align="right" valign="top" width="95" style="border-bottom: solid 1px #101010;">' . $balance_end_plus . '</td>
                        </tr>';
            } elseif ($net < 0) {
                $net_loss = $net;
                $balance_end_less = $withdrawal + $net_loss;
                $eqOwnerLoss .= '<tr>
                            <td align="left" valign="top" >Net Loss</td>
                            <td align="right" valign="top" width="95"></td>
                            <td align="right" valign="top" width="95" ></td>
                            <td align="right" valign="top" width="95" >(' . $net_loss . ')</td>
                        </tr>';
            }



            $newdate = strtotime($isdate);
            $newdate = date('Y-m-d', $newdate);

            $balance_end_plus = $Investment + $beginning_balance + $net_income;
            $balance_end_less = $withdrawal + $net_loss;
            $balance_end = $balance_end_plus - $balance_end_less;


            $innerBalTBL = '<tr>
                            <td align="left" valign="top" colspan="2" width="20">' . $owner. ' capital,' . $year_ended . '</td>
                            <td align="right" valign="top" width="95" ></td>
                            <td align="right" valign="top" width="95">'.$curr.' ' . $beginning_balance . '</td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" colspan="2" width="20">Plus: Investment by owner</td>
                            <td align="right" valign="top" width="95">' . $Investment . '</td>
                            <td align="right" valign="top" width="95"></td>
                        </tr>' .
                    $eqOwnerIncome
                    . '<tr>
                            <td align="left" valign="top" colspan="3" style="font-style: italic;">Total</td>
                            <td align="right" valign="top" width="95">'.$curr.' '.$balance_end_plus.'</td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" COLSPAN="2" >Less: Withdrawal by owner</td>
                            <td align="right" valign="top" width="95"></td>
                            <td align="right" valign="top" width="95" ('.$withdrawal.')</td>
                        </tr>'.
                    $eqOwnerLoss
            .'<tr>
                            <td align="left" valign="top" colspan="3" style="text-transform: uppercase; font-weight: bold;">' . $owner. ' capital,' . $year_ended . '</td>
                            <td align="right" valign="top" width="95" style="font-weight: bold; color: #101010;border-top: solid 1px #101010; border-bottom: double 3px #101010;">'.$curr.' '.$balance_end.'</td>
                        </tr>';
//            
//            $balData =   array('flag' => 1,'description' => 'bal','cash' => $lcash,'loans' => $lloans,'acc_receivable_debtors' => $lacc_receivables,'stock' => $lstock, 'property_plant_equipment' => $lppe,'acc_payable_creditors' => $lacc_payable, 'other_liabilities' => $lliabilities,'owner_equity' => $lequity,"total_assets" => $total_assets, "total_liab" => $total_liab, "total_liabEq" => $total_liabEq, 'startdate' => $start_date, 'enddate' => $end_date,'feedback' => "success","currency" => $curr);

            $balData = array("feedback" => "success", 'ownerEquityTable' => $isTableHeader.$innerBalTBL);
            return $balData;
        } else {
            $innerBalTBL = '<tr>
                            <td align="left" valign="top" colspan="2" width="20">' . $owner . ' capital,' . $year_ended . '</td>
                            <td align="right" valign="top" width="95" ></td>
                            <td align="right" valign="top" width="95">'.$curr.' 0.00</td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" colspan="2" width="20">Plus: Investment by owner</td>
                            <td align="right" valign="top" width="95">0.00</td>
                            <td align="right" valign="top" width="95"></td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" colspan="2" style="font-style: italic; padding-left: 80px;">Net income</td>
                            <td align="right" valign="top" width="95" style="border-bottom: solid 1px #101010;">0.00</td>
                            <td align="right" valign="top" width="95" style="border-bottom: solid 1px #101010;">0.00</td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" colspan="3" style="font-style: italic;">Total</td>
                            <td align="right" valign="top" width="95">'.$curr.' 0.00</td>
                        </tr>
                        <tr>
                            <td align="left" COLSPAN="2" valign="top" >Less: Withdrawal by owner</td>
                          
                            <td align="right" valign="top" width="95"></td>
                            <td align="right" valign="top" width="95" >(0.00)</td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" colspan="3" style="text-transform: uppercase; font-weight: bold;">' . $owner. ' capital,' . $year_ended. '</td>
                            <td align="right" valign="top" width="95" style="font-weight: bold; color: #101010;border-top: solid 1px #101010; border-bottom: double 3px #101010;">'.$curr.' 0.00</td>
                        </tr>';


            $balData = array("feedback" => "unsuccessful", 'ownerEquityTable' => $isTableHeader.$innerBalTBL);
            return $balData;
        }
    }

}

?>
