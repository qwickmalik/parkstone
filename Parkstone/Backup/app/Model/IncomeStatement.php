<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class IncomeStatement extends AppModel {

    var $name = "IncomeStatement";
    var $usesTable = "income_statements";
    
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
     
    
 function runISEOD($isdate){
     $latest = $this->find('first',array('order' => array('IncomeStatement.id DESC'), 'conditions'=> array('IncomeStatement.flag' => 1)));
     $n= 0;
     $n = $this->find('count',array('conditions' => array("IncomeStatement.date" => $isdate,'IncomeStatement.flag' => 0)));
   
     if($n > 0){
     $data = $this->find('all',array('conditions' => array("IncomeStatement.date" => $isdate,'IncomeStatement.flag' => 0)));
     
     $revenue = 0;
     $expenditure = 0;
     $net_income = 0;
     $tax = 0;
     $saleofassets = 0;
     $proceeds = 0;
     $interest = 0;
     $actualinterest = 0;
     $loancash = 0;
        foreach($data as $key => $value){
           $revenue += $value['IncomeStatement']['revenue'];
         // $revenue   += $value['IncomeStatement']['saleofassets'];
          $saleofassets += $value['IncomeStatement']['saleofassets'];
          $expenditure += $value['IncomeStatement']['expenditure'];
          $tax += $value['IncomeStatement']['taxpaid'];
          $proceeds += $value['IncomeStatement']['proceedsonassets'];
          $interest += $value['IncomeStatement']['interest'];
          $actualinterest += $value['IncomeStatement']['actualinterest'];
          $loancash += $value['IncomeStatement']['loancash'];
        }
        
        $net_income = $revenue - $expenditure;
        $newdate = strtotime ($isdate) ;
 $newdate = date ( 'Y-m-d' , $newdate );
 
        $inData =  array('flag' => 1,'description' => 'daily','revenue' => $revenue,'expenditure' => $expenditure,'net_income' => $net_income, 'date' => $newdate,'taxpaid' => $tax,'proceedsonassets' => $proceeds,'interest' => $interest,'saleofassets' => $saleofassets,'actualinterest' => $actualinterest,'loancash' => $loancash);
        $result = $this->save($inData);
        
 }
 
 }
 
    
}
?>
