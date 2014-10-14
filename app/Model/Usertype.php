<?php

class Usertype extends AppModel {

    var $name = "Usertype";
    var $usesTable = "usertypes";
    var $displayField = "usertype";
   
    var $hasMany = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'usertype_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));

    
    
}
?>