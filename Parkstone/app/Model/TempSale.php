<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class TempSale extends AppModel {

    public $name = "TempSale";
    var $usesTable = "temp_sales";
        var $belongsTo = array(
        'Item' => array(
            'className' => 'Item',
            'foreignKey' => 'item_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
          'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'client_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
          ),
           'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
          ));

    
    function updateSale($saleId=0, $data=0) {
        $this->id = $saleId;
        return $this->save($data);
    }
    
    
 function getTempSales(){
        $result = $this->find('all');
        return $result;
    }
   
}

?>
