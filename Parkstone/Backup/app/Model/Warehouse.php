<?php

class Warehouse extends AppModel {

    var $name = "Warehouse";
    var $usesTable = "warehouses";
    var $displayField = "warehouse";
    
     var $hasMany = array(
        'Item' => array(
            'className' => 'Item',
            'foreignKey' => 'warehouse_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'Supplieritem' => array(
            'className' => 'Supplieritem',
            'foreignKey' => 'warehouse_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
    
//    function getWarehouseByWarehouse($warehouse=null) {
//        $condition = array('Warehouse.warehouse' => $warehouse);
//        $results = $this->find('first',array('conditions' => $condition));
//        return $results;
//    }

    function getWarehouses(){
        $result = $this->find('all');
        return $result;
    }
    
    
}
?>