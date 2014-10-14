<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FixedassetExtra
 *
 * @author Brain
 */
class FixedassetExtra extends AppModel {
    //put your code here
     var $name = "FixedassetExtra";
    var $usesTable = "fixedasset_extras";

    
    
       var $belongsTo = array( 
           'FixedAsset' => array(
            'className' => 'FixedAsset',
            'foreignKey' => 'fixed_asset_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
        );
}

?>
