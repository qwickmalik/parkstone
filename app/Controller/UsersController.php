<?php

class UsersController extends AppController {

    public $components = array('RequestHandler', 'Session');
    var $name = 'User';
    var $uses = array('User', 'Usertype', 'Userdepartment', 'Setting', 'Currency', 'Eod', 'Eom', 'BalanceSheet', 'IncomeStatement', 'Equity', 'Zone', 'DailyDefault',  'ClosingBalance','Usertype','Module','UserPrivilege');
    var $paginate = array(
        'User' => array('limit' => 100, 'order' => array('User.id' => 'asc')),
        'Usertype' => array('limit' => 25, 'order' => array('Usertype.id' => 'asc')),
        'Userdepartment' => array('limit' => 25, 'order' => array('Userdepartment.id' => 'asc'))
    );

    function beforeFilter() {
        $this->__validateLoginStatus();
    }

    function __validateLoginStatus() {
        if ($this->action != 'login' && $this->action != 'logout') {
            if ($this->Session->check('userData') == false) {
                $this->redirect('/');
            }
        }
    }

    function __validateUserType() {

        $userType = $this->Session->read('userDetails.usertype_id');
        if ($userType != 1) {
            $this->redirect('/Settings/');
        }
    }

    function __validateUserType2() {

        $userType = $this->Session->read('userDetails.usertype');
        if ($userType == 2 || $userType == 1) {
            $this->redirect('/Settings/');
        }
    }

    function index() {
              if($this->Session->check('emsg')){
               $this->Session->delete('emsg');
        }
      
        if( $this->Session->check('upemsg') ) {
                        //$errorMessage = $this->Session->read('emsg');
                               $message = "Please enter Username and Password";
                $this->Session->write('emsg', $message);
        }else if($this->Session->check('uemsg')){
            
                                    $message = "Username Not Valid";
                $this->Session->write('emsg', $message);
        }else if($this->Session->check('pemsg')){
           
                                       $message = "Password Not Valid";
                $this->Session->write('emsg', $message); 
                 
        }else{
         $this->Session->delete('emsg');
        }
    }

    /**
     * Authenticate user
     * @return array() 
     */
    public function cronJobs() {
        $this->autoRender = false;
        $this->__defaultDaily();
        $this->__EOD();
        $this->__EOM();
    }
    
    function login() {
//        $this->autoRender = false;
        if ($this->request->is('post')) {
            
            if (empty($_POST['username']) && empty($_POST['password'])) {
                $message = "Please enter Username and Password";
                $this->Session->write('upemsg', $message);
               $this->redirect('/');
               
            } 
            else {

                $username = $_POST['username'];
                $password = md5($_POST['password']);
                $result = $this->User->getUserByUsername($username);
                $settings = $this->Setting->getSettings();


                $currency = $this->Currency->getCurrency($settings['Setting']['currency_id']);
//                
                $check = $this->Session->check('userData');
                if($check){
                    $this->Session->delete('userData');
                }
                $check = $this->Session->check('userDetails');
                if($check){
                    $this->Session->delete('userDetails');
                }
                $check = $this->Session->check('shopCurrency');
                   if($check){
                    $this->Session->delete('shopCurrency');
                }
                $check = $this->Session->check('shopCurrencyname');
                   if($check){
                    $this->Session->delete('shopCurrencyname');
                }
                $check = $this->Session->check('shopName');
                   if($check){
                    $this->Session->delete('shopName');
                }
                $check = $this->Session->check('shopAddress');
                   if($check){
                    $this->Session->delete('shopAddress');
                }
                $check = $this->Session->check('shopMobile');
                   if($check){
                    $this->Session->delete('shopMobile');
                }
                $check = $this->Session->check('shopPosttown');
                   if($check){
                    $this->Session->delete('shopPosttown');
                }
                $check = $this->Session->check('shopPostCity');
                   if($check){
                    $this->Session->delete('shopPostCity');
                }
                $check = $this->Session->check('shopPostCount');
                   if($check){
                    $this->Session->delete('shopPostCount');
                }
                $check = $this->Session->check('accYear');
                   if($check){
                    $this->Session->delete('accYear');
                }
                $check = $this->Session->check('owner');
                   if($check){
                    $this->Session->delete('owner');
                }
                $check = $this->Session->check('userInfo');
                   if($check){
                    $this->Session->delete('userInfo');
                }

                $this->Session->write('userData', $result['User']['username']);
                $this->Session->write('userDetails', $result['User']);
                $this->Session->write('shopCurrency', $currency['Currency']['symbol']);
                $this->Session->write('shopCurrencyname', $currency['Currency']['currency_name']);
                $this->Session->write('shopName', $settings['Setting']['company_name']);
                $this->Session->write('shopAddress', $settings['Setting']['postal_address']);
                $this->Session->write('shopMobile', $settings['Setting']['mobile']);
                $this->Session->write('shopPosttown', $settings['Setting']['postal_town_suburb']);
                $this->Session->write('shopPostCity', $settings['Setting']['postal_city']);
                $this->Session->write('shopPostCount', $settings['Setting']['postal_country']);
                $this->Session->write('accYear', $settings['Setting']['accounting_month']);
                $this->Session->write('owner', $settings['Setting']['owner_name']);
                $this->Session->write('userInfo', $result);
                     $this->Session->delete('public_unapproved_investors');
        $this->Session->write('public_unapproved_investors', $this->Investor->find('count', array('conditions' => array('Investor.approved' => 0))));
        
        $this->Session->delete('public_termination_req');
        $this->Session->write('public_termination_req', $this->Investment->find('count', array('conditions' => array('Investment.status LIKE' => "Termination_requested"))));
        
        $this->Session->delete('public_payment_req');
        $this->Session->write('public_payment_req', $this->Investment->find('count', array('conditions' => array('Investment.status LIKE' => "Payment_requested"))));
    
                if (count($result['User']['username']) != 0) {
                    $jsonData = json_encode($result['User']['username']);
                } else {

                $message = "Username Not Valid";
                $this->Session->write('uemsg', $message);
                $this->redirect('/');
                }

                if ($password == $result['User']['password']) {

                $message = "Welcome ".$result['User']['username']." !!!";
                $this->Session->write('smsg', $message);
                  $this->redirect(array('controller' => 'Dashboard', 'action' => 'index'));

                } else {

                $message = "Password Not Valid";
                $this->Session->write('pemsg', $message);
                $this->redirect('/');
                }
            }
        }
    }

    public function users() {
        $this->__validateUserType();
        $data = $this->paginate('User');
        $this->set('data', $data);
        $this->set('userdepartments', $this->Userdepartment->find('list'));
        $this->set('usertypes', $this->Usertype->find('list'));
//        pr($result);
//        exit;
        if ($this->request->is('ajax')) {
            
            if (!empty($this->request->data)) {


                if (isset($this->request->data['User']['id']) && ($this->request->data['User']['id'] == "" || $this->request->data['User']['id'] == null)) {
                   $username = $this->request->data['User']['username'];
                    $user = $this->User->find('count', array('conditions' => array('User.username LIKE' => "$username")));

                    if ($user > 0) {
                        return "user exists";
                    }
                }
                
            $password = $this->request->data['User']['pass'];
            if(!is_null($password) || $password == ""){
                $this->request->data['User']['password'] = md5($this->request->data['User']['pass']);
            
            }


                $result = $this->User->save($this->request->data);

                if ($result) {
                    $this->request->data = null;

                    return "success";
                } else {
                    return "unsuccessful";
                }
            }
        }
    }

    function userInfo() {

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;

            if (!empty($_POST['userId'])) {
                $userId = $_POST['userId'];
                $userLst = $this->User->find('first', array('conditions' => array('User.id' => $userId)));

                $userLsts = json_encode($userLst);
                return $userLsts;
            }
        }
    }

    function delUser($userID = null) {
        $this->autoRender = $this->autoLayout = false;
            
      
            Configure::write('debug', 0);
            
            if (!is_null($userID)) {


               // $userID = $_POST['userId'];
                $result = $this->User->delete($userID,false);



                if ($result) {
                    
                    $message = 'User Deleted';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Users', 'action' => 'users'));
                } else {
                    
                    $message = 'Could not Delete User';
                    $this->Session->write('bmsg', $message);
                  $this->redirect(array('controller' => 'Users', 'action' => 'users'));
                }
            }else{
                    $message = 'Invalid Selection';
                    $this->Session->write('emsg', $message);
                  $this->redirect(array('controller' => 'Users', 'action' => 'users'));
            }
        
    }

    public function userTypes() {
        $this->__validateUserType();
//        $data = $this->paginate('Usertype');
//         $data = $this->Paginator->settings = array(
        $this->UserPrivilege->recursive = 0;
        $this->set('modules',$this->Module->find('all'));
        $this->set('userprivi',$this->UserPrivilege->find('all',array('recursive' => -1)));
       $this->paginate = array('UserPrivilege'=>array('group' => array('UserPrivilege.usertype_id'),'order' => array('UserPrivilege.usertype_id' => 'ASC')));
 
        // Getting paginated result based on page #
        $this->set('data', $this->paginate('UserPrivilege'));
        
       
        if ($this->request->is('post')) {
            // Configure::write('debug', 0);
            $this->autoRender = false;
            if (!empty($this->request->data)) {
                $username = '';
                $check = $this->Session->check('userDetails');
                if($check){
                   $firstname = $this->Session->check('userDetails.firstname');
                   $lastname = $this->Session->check('userDetails.lastname');
                   
                   $username = $firstname.' '.$lastname;
                   if(empty($this->request->data['Usertype']['id'])){
                       $this->request->data['Usertype']['created_by'] = $username;
                   }else{
                       $this->request->data['Usertype']['modified_by'] = $username;
                   }
                   
                }
//                print_r($this->request->data);
//                exit;
                
                
                $result = $this->Usertype->save($this->request->data);

                if($result){
                    $usertype_id = $this->Usertype->id;
                    
                    $modules = $this->Module->find('all');
                if ($modules) {
                    
                    foreach ($modules as $mod) {
                        $this->request->data['UserPrivilege']['usertype_id'] = $usertype_id;
                        $this->request->data['UserPrivilege']['module_id'] = $mod['Module']['id'];
                        $this->request->data['UserPrivilege']['created_by'] = $username;
                        $this->request->data['UserPrivilege']['mod_view'] = $this->request->data['Usertype']['mod_view'.$mod['Module']['id']];
                        $this->request->data['UserPrivilege']['mod_create'] = $this->request->data['Usertype']['mod_create'.$mod['Module']['id']];
                        $this->request->data['UserPrivilege']['mod_edit'] = $this->request->data['Usertype']['mod_edit'.$mod['Module']['id']];
                        $this->request->data['UserPrivilege']['mod_delete'] = $this->request->data['Usertype']['mod_delete'.$mod['Module']['id']];
                        $this->UserPrivilege->create();
                         $this->UserPrivilege->save($this->request->data);
                        }
                        $this->request->data = null;

                }
                    $message = 'UserType Added';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Users', 'action' => 'userTypes'));
                } else {
                    $message = 'Could not Add UserType';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Users', 'action' => 'userTypes'));
                }
            }
        }
    }

    public function delusertype($usertpe = null) {
        $this->autoRender = false;

        $result = $this->Usertype->delete($usertpe,false);
        if ($result) {

            $message = 'User Type Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Users', 'action' => 'userTypes'));
        } else {
            $message = 'Issue Deleting User Type';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Users', 'action' => 'userTypes'));
        }
    }

    public function userDepartments() {
        $this->__validateUserType();
        $data = $this->paginate('Userdepartment');
        $this->set('data', $data);
        if ($this->request->is('post')) {
            $this->autoRender = false;
            if (!empty($this->request->data)) {

                $result = $this->Userdepartment->save($this->request->data);

                if ($result) {
                    $this->request->data = null;

                    $message = 'User Department Added';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Users', 'action' => 'userDepartments'));
                } else {
                    $message = 'Could not Add User Department';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Users', 'action' => 'userDepartments'));
                }
            }
        }
    }

    public function deluserdep($userdep = null) {
        $this->autoRender = false;

        $result = $this->Userdepartment->delete($userdep,false);
        if ($result) {

            $message = 'User Type Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Users', 'action' => 'userDepartments'));
        } else {
            $message = 'Issue Deleting User Type';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Users', 'action' => 'userDepartments'));
        }
    }

//    function __EOD() {
//
//        $total = $this->Eod->find('count');
////        
//        if ($total > 0) {
//            $set = $this->Eod->find('first', array('order' => 'Eod.id DESC'));
//            $today = date('Y-m-d');
//
//
//
//            if (($today != $set['Eod']['eod_date']) && ($set['Eod']['flag'] == 0)) {
//
//                $EOD_date = $set['Eod']['eod_date'];
//                $this->__balEOD($EOD_date);
//
//                $this->__incomestatementEOD($EOD_date);
//
////            $this->__ownerequityEOD($EOD_date);
//
//
//                $EODdata = array('id' => $set['Eod']['id'], 'flag' => 1);
//                $result = $this->Eod->save($EODdata);
//
//                if ($result) {
//
//                    $EODdata2 = array('eod_date' => $today);
//                    $this->Eod->create();
//                    $this->Eod->save($EODdata2);
//                }
//            }
//        } else {
//            $today = date('Y-m-d');
//            $EODdata3 = array('eod_date' => $today);
//            $this->Eod->save($EODdata3);
//        }
//    }

    function __defaultDaily() {

        $total = $this->DailyDefault->find('count');
//        
        if ($total > 0) {
            $set = $this->DailyDefault->find('first', array('order' => 'DailyDefault.id DESC'));
            $today = date('Y-m-d');


            if (($today != $set['DailyDefault']['date']) && ($set['DailyDefault']['flag'] == 0)) {

                $EOD_date = $set['DailyDefault']['date'];
                $this->__checkDailyDefaulters($EOD_date);
                $this->__saveClosingBalance($EOD_date);
//                $this->__balEOD($EOD_date);
//
//                $this->__incomestatementEOD($EOD_date);
//            $this->__ownerequityEOD($EOD_date);


                $DDdata = array('id' => $set['DailyDefault']['id'], 'flag' => 1);
                $result = $this->DailyDefault->save($DDdata);

                if ($result) {

                    $DDdata2 = array('date' => $today);
                    $this->DailyDefault->create();
                    $result = $this->DailyDefault->save($DDdata2);
                }
            }
        } else {
            $today = date('Y-m-d');
            $DDdata3 = array('date' => $today);
            $result = $this->DailyDefault->save($DDdata3);
        }
    }

//    function __EOM() {
//
//        $total = $this->Eom->find('count');
////        
//        if ($total > 0) {
//            $set = $this->Eom->find('first', array('order' => 'Eom.id DESC'));
//            $today = date('Y-m-d');
//
//
//
//            if (($today != $set['Eom']['year']) && ($set['Eom']['flag'] == 0)) {
//
//                $EOM_date = $set['Eom']['year'];
////                $this->__balEOD($EOD_date);
////
////                $this->__incomestatementEOD($EOD_date);
//
//                $this->__ownerequityEOM($EOM_date, $set);
//            }
//        } else {
//            $today = $this->Session->read('accYear');
//            $date = new DateTime($today);
//            $date->add(new DateInterval('P1M1D'));
//
//            $EOMdata3 = array('year' => $date->format('Y-m-d'));
//            $this->Eom->save($EOMdata3);
//        }
//    }

    function __checkDailyDefaulters($ddDate) {
        $this->Order->runDailyDefaulters($ddDate);
    }

    function __saveClosingBalance($ddDate) {
        $closing_balance = $this->Order->find('all', array('conditions' => array('Order.balance >' => 0, 'Order.status' => 'Approved', 'Order.delivery' => 'Delivered', 'Order.delivery_date' => $ddDate)));

        if ($closing_balance) {
            foreach ($closing_balance as $closing_bal) {
                $balance_details = array('order_id' => $closing_bal['Order']['id'], 'customer_id' => $closing_bal['Order']['customer_id'], 'balance' => $closing_bal['Order']['balance'], 'date' => $ddDate);
                $result = $this->ClosingBalance->saveAll($balance_details);
            }
        }
    }
//
//    function __balEOD($bDate) {
//
//
//        $this->BalanceSheet->runBalEOD($bDate);
//    }
//
//    function __incomestatementEOD($isDate) {
//        $this->IncomeStatement->runISEOD($isDate);
//    }
//
////    function __ownerequityEOD($oeDate) {
////        $this->Equity->runEQEOD($oeDate);
////        
////    }
//
//    function __ownerequityEOM($oeqDate, $set) {
//
//        $this->runEQEOM($oeqDate, $set);
//    }
//
//    function runEQEOM($ismonth, $set) {
//
//        $eomCheck = $this->Session->read('accYear');
//        $eomCheck2 = date('d-m', strtotime($eomCheck));
//
////        return $eomCheck;
//        $today = date('Y-m-d');
//        $thisDay = date('Y-m-d', strtotime($set['Eom']['year']));
//        $thisYear = date('Y-m');
//        $eomYear = date('Y-m', strtotime($eomCheck));
//
//        //check if EOM
//        $is_EOM = $this->isEOM($ismonth, $eomCheck);
//
//        if ($is_EOM) {
//
//            if ($thisYear == $eomYear) {
//
//                $data = $this->Equity->runEQEOM($eomCheck, 'first');
//                $EOMdata = array('id' => $set['Eom']['id'], 'flag' => 1);
//                $result = $this->Eom->save($EOMdata);
//
//                if ($result) {
//                    $next_oem_dt = $data['next_eom_date'];
//
//                    $EOMdata2 = array('year' => $next_oem_dt);
//                    $this->Eom->create();
//                    $result = $this->Eom->save($EOMdata2);
////                    return $result;
//                }
//            } elseif ($today >= $thisDay) {
//
//                $data = $this->Equity->runEQEOM($ismonth, 'other');
//                $EOMdata = array('id' => $set['Eom']['id'], 'flag' => 1);
//                $result = $this->Eom->save($EOMdata);
//
//                if ($result) {
//                    $next_oem_dt = $data['next_eom_date'];
//
//                    $EOMdata2 = array('year' => $next_oem_dt);
//                    $this->Eom->create();
//                    $result = $this->Eom->save($EOMdata2);
////                    return $result;
//                }
//            }
//        }
//    }
//
//    function isEOM($next_eom, $acc_year) {
//        $today = date('Y-m-d');
//        $eomCheck3 = date('Y-m-d', strtotime($acc_year));
//        $eomCheck4 = date('Y-m-d', strtotime($next_eom));
//        $acc_day = date('d', strtotime($acc_year));
//        $day = date('d');
//
//        if ($today == $eomCheck3) {
//            return false;
//        }
//
//        if ($today >= $eomCheck4) {
//            return true;
//        } else {
//            return false;
//        }
//    }
    
    
    function __EOD() {

        $total = $this->Eod->find('count');
//        
        if ($total > 0) {
            $set = $this->Eod->find('first', array('order' => 'Eod.id DESC'));
            $today = date('Y-m-d');

//if($today =='2013-10-15'){
//    return 'trial End';
//}

            if (($today != $set['Eod']['eod_date']) && ($set['Eod']['flag'] == 0)) {

                $EOD_date = $set['Eod']['eod_date'];
                $this->__balEOD($EOD_date);

                $this->__incomestatementEOD($EOD_date);

//            $this->__ownerequityEOD($EOD_date);


                $EODdata = array('id' => $set['Eod']['id'], 'flag' => 1);
                $result = $this->Eod->save($EODdata);

                if ($result) {

                    $EODdata2 = array('eod_date' => $today);
                    $this->Eod->create();
                    $result = $this->Eod->save($EODdata2);
                }
            }
        } else {
            $today = date('Y-m-d');
            $EODdata3 = array('eod_date' => $today);
            $result = $this->Eod->save($EODdata3);
        }
    }

    function __EOM() {

        $total = $this->Eom->find('count');
//        
        if ($total > 0) {
            $set = $this->Eom->find('first', array('order' => 'Eom.id DESC'));
            $today = date('Y-m-d');



            if (($today != $set['Eom']['year']) && ($set['Eom']['flag'] == 0)) {

                $EOM_date = $set['Eom']['year'];
//                $this->__balEOD($EOD_date);
//
//                $this->__incomestatementEOD($EOD_date);

                $data = $this->__ownerequityEOM($EOM_date,$set);
                
               return $data;
            }
        } else {
            $today = $this->Session->read('accYear');
            $date = new DateTime($today);
            $date->add(new DateInterval('P1M1D'));
            
            $EOMdata3 = array('year' => $date->format('Y-m-d'));
            $result = $this->Eom->save($EOMdata3);
        }
    }

    function __balEOD($bDate) {


        $this->BalanceSheet->runBalEOD($bDate);
    }

    function __incomestatementEOD($isDate) {
        $this->IncomeStatement->runISEOD($isDate);
    }

//    function __ownerequityEOD($oeDate) {
//        $this->Equity->runEQEOD($oeDate);
//        
//    }

    function __ownerequityEOM($oeqDate,$set) {
      
        $data = $this->runEQEOM($oeqDate,$set);
        return $data;
    }

    function runEQEOM($ismonth,$set) {
        
        $eomCheck = $this->Session->read('accYear');
        $eomCheck2 = date('d-m', strtotime($eomCheck));

//        return $eomCheck;
      $today = date('Y-m-d');
      $thisDay = date('Y-m-d', strtotime($set['Eom']['year']));
       $thisYear = date('Y-m');
        $eomYear = date('Y-m', strtotime($eomCheck));
      
        //check if EOM
        $is_EOM = $this->isEOM($ismonth,$eomCheck);
       
        if ($is_EOM) {
             
            if ($thisYear == $eomYear) {
            
                $data = $this->Equity->runEQEOM($eomCheck, 'first');
                $EOMdata = array('id' => $set['Eom']['id'], 'flag' => 1);
                $result = $this->Eom->save($EOMdata);
 
                if ($result) {
                    $next_oem_dt = $data['next_eom_date'];
                    
                    $EOMdata2 = array('year' => $next_oem_dt);
                    $this->Eom->create();
                    $result = $this->Eom->save($EOMdata2);
                    return $result;
                }
                return $data;
            } elseif ($today >= $thisDay) {
                 
                $data = $this->Equity->runEQEOM($ismonth, 'other');
                $EOMdata = array('id' => $set['Eom']['id'], 'flag' => 1);
                $result = $this->Eom->save($EOMdata);

                if ($result) {
                    $next_oem_dt = $data['next_eom_date'];
                    
                    $EOMdata2 = array('year' => $next_oem_dt);
                    $this->Eom->create();
                    $result = $this->Eom->save($EOMdata2);
                    return $result;
                }
                return $data;
            }
             
        }
    }

    function isEOM($next_eom,$acc_year){
        $today = date('Y-m-d');
        $eomCheck3 = date('Y-m-d', strtotime($acc_year));
        $eomCheck4 = date('Y-m-d', strtotime($next_eom));
        $acc_day = date('d', strtotime($acc_year));
        $day = date('d');

        if ($today == $eomCheck3){
            return false;
        }

        if ($today >= $eomCheck4) {
            return true;
        } else {
            return false;
        }
    }

    function logout() {

        $this->Session->delete('payments');
        $this->Session->delete('userData');
        $this->Session->delete('userDetails');
        $this->Session->delete('shopCurrency');
        $this->Session->delete('shopName');
        $this->Session->delete('shopAddress');
        $this->Session->delete('accYear');
        $this->Session->delete('owner');
        $this->Session->delete('userInfo');
        $this->Session->destroy();
        $this->redirect('/');
    }

}

?>