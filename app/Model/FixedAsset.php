<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FixedAsset
 *
 * @author Brain
 */
class FixedAsset extends AppModel {

    var $name = "FixedAsset";
    var $usesTable = "fixed_assets";
    
     var $hasMany = array(
        'FixedassetExtra' => array(
            'className' => 'FixedassetExtra',
            'foreignKey' => 'fixed_asset_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ));
     
     
       var $belongsTo = array( 
           'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
        );
}
?>
