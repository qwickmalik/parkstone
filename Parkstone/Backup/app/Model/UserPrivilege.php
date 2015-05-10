<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserPrivilege
 *
 * @author kwaku.afreh-nuamah
 */
class UserPrivilege extends AppModel {

    var $name = "UserPrivilege";
    var $usesTable = "user_privileges";
    
    var $belongsTo = array(
        'Usertype' => array(
            'className' => 'Usertype',
            'foreignKey' => 'usertype_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Module' => array(
            'className' => 'Module',
            'foreignKey' => 'module_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
   
}
