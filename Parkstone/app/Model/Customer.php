<?php

class Customer extends AppModel {

    var $name = "Customer";
    var $usesTable = "customers";
    var $virtualFields = array("full_name"=>"CONCAT(first_name, ' ' ,surname)","age"=>"IF(dob,(CURDATE() - dob),'')");
    var $displayField = 'fullname';
    
    var $hasMany = array(
        'Expectedinstallment' => array(
            'className' => 'Expectedinstallment',
            'foreignKey' => 'customer_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
        'ClosingBalance' => array(
            'className' => 'ClosingBalance',
            'foreignKey' => 'customer_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'customer_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Invoice' => array(
            'className' => 'Invoice',
            'foreignKey' => 'customer_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'OrdersItem' => array(
            'className' => 'OrdersItem',
            'foreignKey' => 'customer_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
    
    var $belongsTo = array(
          'Marriage' => array(
            'className' => 'Marriage',
            'foreignKey' => 'marriage_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
          ),
        'Idtype' => array(
            'className' => 'Idtype',
            'foreignKey' => 'idtype_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
          ),
		'InvestorType' => array(
            'className' => 'InvestorType',
            'foreignKey' => 'investor_type_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
          ),
        'CustomerCategory' => array(
            'className' => 'CustomerCategory',
            'foreignKey' => 'customer_category_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
//        'Zone' => array(
//            'className' => 'Zone',
//            'foreignKey' => 'zone_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//          ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
          ));
//    
//    public $actsAs = array(
//	'Uploader.Attachment' => array(
//		'customer_photo' => array(
//			'nameCallback' => '',
//			'append' => '',
//			'prepend' => '',
//			'tempDir' => TMP,
//			'uploadDir' => '',
//			'finalPath' => '',
//			'dbColumn' => '',
//			'metaColumns' => array(),
//			'defaultPath' => '',
//			'overwrite' => true,
//			'stopSave' => true,
//			'allowEmpty' => true,
//			'transforms' => array(),
//			'transport' => array()
//		),
//            'customer_signature' => array(
//			'nameCallback' => '',
//			'append' => '',
//			'prepend' => '',
//			'tempDir' => TMP,
//			'uploadDir' => '',
//			'finalPath' => '',
//			'dbColumn' => '',
//			'metaColumns' => array(),
//			'defaultPath' => '',
//			'overwrite' => true,
//			'stopSave' => true,
//			'allowEmpty' => true,
//			'transforms' => array(),
//			'transport' => array()
//		),
//              'guarantor_signature' => array(
//			'nameCallback' => '',
//			'append' => '',
//			'prepend' => '',
//			'tempDir' => TMP,
//			'uploadDir' => '',
//			'finalPath' => '',
//			'dbColumn' => '',
//			'metaColumns' => array(),
//			'defaultPath' => '',
//			'overwrite' => true,
//			'stopSave' => true,
//			'allowEmpty' => true,
//			'transforms' => array(),
//			'transport' => array()
//		)
//	)
//);
}
?>
