<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Module
 *
 * @author kwaku.afreh-nuamah
 */
class Module extends AppModel {

    var $name = "Module";
    var $usesTable = "modules";
   
    var $hasMany = array(
        'UserPrivilege' => array(
            'className' => 'UserPrivilege',
            'foreignKey' => 'module_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
}
