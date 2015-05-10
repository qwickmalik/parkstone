<?php

class Userdepartment extends AppModel {

    var $name = "Userdepartment";
    var $usesTable = "userdepartments";
    var $displayField = "department";
   
    

    var $hasMany = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'userdepartment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )//,
//         'CashAccount' => array(
//             'className' => 'CashAccount',
//             'foreignKey' => 'userdepartment_id',
//             'conditions' => '',
//             'order' => '',
//             'limit' => '',
//             'dependent' => true
//         )
        );
    
}
?>