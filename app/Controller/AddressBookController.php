<?php
class AddressBookController extends AppController{
    
public $components = array('RequestHandler','Session');
    
    var $name = 'AddressBook';
    var $helpers = array('Html', 'Form');
    var $uses = array('Customer');
    var $paginate = array(
        'Customer' => array('limit' => 25, 'order' => array('Customer.fullname' => 'asc'))
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
    
    function __validateUserType(){
        
        $userType = $this->Session->read('userDetails.usertype_id');
        if($userType != 1 ){
            $this->redirect('/Dashboard/');
        }
    }
    public function index(){
       // $this->__validateUserType();
        $data = $this->paginate('Customer');
        $this->set('customer', $data);
        
    }
    
    public function clearSessions() {
        $check = $this->Session->check('ct');
        if ($check) {
            $this->Session->delete('ct');
        }
        $check = $this->Session->check('cts');
        if ($check) {
            $this->Session->delete('cts');
        }

        $this->redirect(array('controller' => 'AddressBooks', 'action' => 'index'));
    }
    
    public function searchCustomer($custID = Null) {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $custname = $this->request->data['customer_search'];
            $customer = $this->Customer->find('all', array('conditions' => array('OR' => array(array('Customer.surname LIKE' => "%$custname%"), array('Customer.first_name LIKE' => "%$custname%"), array('Customer.fullname LIKE' => "%$custname%")))));

            if ($customer) {
                $check = $this->Session->check('cts');
                if ($check) {
                    $this->Session->delete('cts');
                }
                $cust = $this->Session->write('cts', $customer);

//                $this->Session->write('custID', $customer);
                $this->redirect(array('controller' => 'AddressBook', 'action' => 'index'));
            } else {
                $message = 'Sorry, Customer Not Found';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'AddressBook', 'action' => 'index'));
            }
        } else {

            $customers = $this->Customer->find('all', array('conditions' => array('Customer.id' => $custID)));
            $customer = $this->Customer->find('first', array('conditions' => array('Customer.id' => $custID)));
            if ($customers) {
                $check = $this->Session->check('ct');
                if ($check) {
                    $this->Session->delete('ct');
                }
                $check = $this->Session->check('ct');
                if ($check) {
                    $this->Session->delete('ct');
                }
//                $check = $this->Session->check('custID');
//                if ($check) {
//                    $this->Session->delete('custID');
//                }
                $cust = $this->Session->write('cts', $customers);
                $this->Session->write('ct', $customer);
//                $this->Session->write('custID', $custID);
                $this->redirect(array('controller' => 'AddressBook', 'action' => 'index'));
            } else {

                $message = 'Sorry, Customer Not Found';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'AddressBook', 'action' => 'index'));
            }
        }
    }
    
    public function newContact(){
        $this->__validateUserType();
    }
    public function editContact(){
        $this->__validateUserType();
    }
    public function exportContacts(){
        $this->__validateUserType();
    }
}

?>

