<?php

CakePlugin::load('Uploader');
App::import('Vendor', 'Uploader.Uploader');

class CustomersController extends AppController {

    public $components = array('RequestHandler', 'Session');
    var $name = 'Customers';
    public $helpers = array('Html', 'Form');
    var $uses = array('Customer', 'Marriage', 'Idtype', 'Zone', 'User', 'CustomerCategory');
    var $paginate = array(
        'Customer' => array('limit' => 25, 'order' => array('Customer.surname' => 'asc'))
    );

    function beforeFilter() {
        $this->__validateLoginStatus();
        $this->Uploader = new Uploader(array('tempDir' => TMP));
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
            $message = 'You Don\'t Have The Priviledges To View The Chosen Resource';
            $this->Session->write('bmsg', $message);
            $this->redirect('/Dashboard/');
        }
    }

    function __validateUserType3() {

        $userType = $this->Session->read('userDetails.usertype_id');

        if ($userType == 1 || $userType == 3 || $userType == 7 || $userType == 8 || $userType == 4) {
            
        } else {
            $message = 'You Don\'t Have The Priviledges To View The Chosen Resource';
            $this->Session->write('bmsg', $message);
            $this->redirect('/Dashboard/');
        }
    }

    function __validateUserType2() {

        $userType = $this->Session->read('userDetails.usertype_id');

        if ($userType == 1 || $userType == 3 || $userType == 7) {
            
        } else {
            $message = 'You Don\'t Have The Priviledges To View The Chosen Resource';
            $this->Session->write('bmsg', $message);
            $this->redirect('/Dashboard/');
        }
    }

    public function index() {
        $this->__validateUserType3();

        $this->set('marriages', $this->Marriage->find('list'));
        $this->set('idtypes', $this->Idtype->find('list'));
        $this->set('customercategories', $this->CustomerCategory->find('list'));
        $this->set('zones', $this->Zone->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id' => 4))));
    }

    public function commit() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $dob_day = $this->request->data['Customer']['dob']['day'];
            $dob_month = $this->request->data['Customer']['dob']['month'];
            $dob_year = $this->request->data['Customer']['dob']['year'];
//            $registration_day = $this->request->data['Customer']['registration_date']['day'];
//            $registration_month = $this->request->data['Customer']['registration_date']['month'];
//            $registration_year = $this->request->data['Customer']['registration_date']['year'];

            $dob = $dob_year . "-" . $dob_month . "-" . $dob_day;
            $dob_date = date('Y-m-d', strtotime($dob));
            if ($dob == date('Y-m-d')) {
                $message = 'Please Supply The Customer\'s Date of Birth';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }
//            $registration = $registration_year ."-". $registration_month ."-".$registration_day;
            $registration_date = date('Y-m-d');

            if ($this->request->data['Customer']['first_name'] == "" || $this->request->data['Customer']['first_name'] == null) {
                $message = 'Please Supply The Customer\'s Firstname';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }

            if ($this->request->data['Customer']['surname'] == "" || $this->request->data['Customer']['surname'] == null) {
                $message = 'Please Supply The Customer\'s Surname';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }
            $fullname = $this->request->data['Customer']['first_name'] . " " . $this->request->data['Customer']['surname'];

            if ($this->request->data['Customer']['idtype_id'] == "" || $this->request->data['Customer']['idtype_id'] == null) {
                $message = 'Please Supply The Customer\'s ID-Type';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }

            if ($this->request->data['Customer']['id_number'] == "" || $this->request->data['Customer']['id_number'] == null) {
                $message = 'Please Supply The Customer\'s Number';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }
            if ($this->request->data['Customer']['emergency_person'] == "" || $this->request->data['Customer']['emergency_person'] == null) {
                $message = 'Please Supply The Customer\'s Emergency Person';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }
            if ($this->request->data['Customer']['emergency_no'] == "" || $this->request->data['Customer']['emergency_no'] == null) {
                $message = 'Please Supply The Customer\'s Emergency Number';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }


            if ($this->request->data['Customer']['mobile_no'] == "" || $this->request->data['Customer']['mobile_no'] == null) {
                $message = 'Please Supply The Customer\'s Mobile Number';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }
            if ($this->request->data['Customer']['landmark'] == "" || $this->request->data['Customer']['landmark'] == null) {
                $message = 'Please Supply A Landmark for Customer\'s House';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }
            if ($this->request->data['Customer']['house_no'] == "" || $this->request->data['Customer']['house_no'] == null) {
                $message = 'Please Supply The Customer\'s House Number';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }

            if ($this->request->data['Customer']['area'] == "" || $this->request->data['Customer']['area'] == null) {
                $message = 'Please Supply The Customer\'s Area/Locality';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }
            if ($this->request->data['Customer']['city'] == "" || $this->request->data['Customer']['city'] == null) {
                $message = 'Please Supply The Customer\'s City';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }
            if ($this->request->data['Customer']['guarantor_name'] == "" || $this->request->data['Customer']['guarantor_name'] == null) {
                $message = 'Please Supply The Guarantor\'s Name';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }
            if ($this->request->data['Customer']['guarantor_no'] == "" || $this->request->data['Customer']['guarantor_no'] == null) {
                $message = 'Please Supply The Guarantor\'s Phone Number';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }
            $this->request->data['Customer']['fullname'] = $fullname;
            $this->request->data['Customer']['dob'] = $dob_date;
            $this->request->data['Customer']['registration_date'] = $registration_date;
            $photo = $this->request->data['Customer']['surname'] . "_" . "photo" . "_" . $dob_date;
            $this->request->data['Customer']['customer_category_id'] = $this->request->data['Customer']['customercategory_id'];
//                  $signature = $this->request->data['Customer']['customer_signature'];
//                  $guarantor_sig = $this->request->data['Customer']['guarantor_signature'];

            if ($data = $this->Uploader->upload('customer_photo', array('overwrite' => true, 'name' => $photo))) {
                $this->request->data['Customer']['customer_photo'] = $data['path'];
                // Upload successful, do whatever
            } else {
                $message = 'Please Supply The Customer\'s Picture';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }
            if (isset($_FILES["file"]["type"])) {
                $validextensions = array("jpeg", "jpg", "png");
                $temporary = explode(".", $_FILES["file"]["name"]);
                $file_extension = end($temporary);
                if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
                        ) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
                        && in_array($file_extension, $validextensions)) {
                    if ($_FILES["file"]["error"] > 0) {
                        echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
                    } else {
                        if (file_exists("upload/" . $_FILES["file"]["name"])) {
                            echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
                        } else {
                            $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
                            $targetPath = "upload/" . $_FILES['file']['name']; // Target path where file is to be stored
                            move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                            echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
                            echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
                            echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
                            echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                            echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
                        }
                    }
                } else {
                    echo "<span id='invalid'>***Invalid file Size or Type***<span>";
                }
            }
//	if ($signature == "" || $signature == null) {
//                    $message = 'Please Select Availability of Customer\'s Signature';
//                   $this->Session->write('emsg', $message);
//                   $this->redirect(array('controller' => 'Customers','action' => 'index'));
//			// Upload successful, do whatever
//		}
//                
//                if($guarantor_sig == "" || $guarantor_sig == null) {
//                    $message = 'Please Select Availability of Guarantor\'s Signature';
//                   $this->Session->write('emsg', $message);
//                   $this->redirect(array('controller' => 'Customers','action' => 'index'));
//			// Upload successful, do whatever
//		}

            if ($this->request->data['Customer']['user_id'] == "" || $this->request->data['Customer']['user_id'] == null) {
                $message = 'Please Assign a Sales Person';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }

            // debug($data);
            // pr($this->request->data);
            $result = $this->Customer->save($this->request->data);
            $customerid = $this->Customer->id;
            //pr($this->request->data);
            if ($result) {
                $result['Customer']['full_name'] = $result['Customer']['first_name'] . ' ' . $result['Customer']['surname'];
                $this->Session->write('custID', $customerid);
                $this->Session->write('cust', $result);
                $this->redirect(array('controller' => 'Orders', 'action' => 'index'));
            } else {
                $message = 'Customer Save Error';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'index'));
            }
        }
    }

    public function edit() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $id = $this->request->data['Customer']['id'];
            $dob_day = $this->request->data['Customer']['dob']['day'];
            $dob_month = $this->request->data['Customer']['dob']['month'];
            $dob_year = $this->request->data['Customer']['dob']['year'];
//            $registration_day = $this->request->data['Customer']['registration_date']['day'];
//            $registration_month = $this->request->data['Customer']['registration_date']['month'];
//            $registration_year = $this->request->data['Customer']['registration_date']['year'];

            $dob = $dob_year . "-" . $dob_month . "-" . $dob_day;
            $dob_date = date('Y-m-d', strtotime($dob));
            if ($dob == date('Y-m-d')) {
                $message = 'Please Supply The Customer\'s Date of Birth';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
            }
            // $registration = $registration_year ."-". $registration_month ."-".$registration_day;
            $registration_date = date('Y-m-d');

            if ($this->request->data['Customer']['first_name'] == "" || $this->request->data['Customer']['first_name'] == null) {
                $message = 'Please Supply The Customer\'s Firstname';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
            }

            if ($this->request->data['Customer']['surname'] == "" || $this->request->data['Customer']['surname'] == null) {
                $message = 'Please Supply The Customer\'s Surname';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
            }
            $fullname = $this->request->data['Customer']['first_name'] . " " . $this->request->data['Customer']['surname'];

            if ($this->request->data['Customer']['idtype_id'] == "" || $this->request->data['Customer']['idtype_id'] == null) {
                $message = 'Please Supply The Customer\'s ID-Type';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
            }

            if ($this->request->data['Customer']['id_number'] == "" || $this->request->data['Customer']['id_number'] == null) {
                $message = 'Please Supply The Customer\'s Number';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
            }
            if ($this->request->data['Customer']['emergency_person'] == "" || $this->request->data['Customer']['emergency_person'] == null) {
                $message = 'Please Supply The Customer\'s Emergency Person';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
            }
            if ($this->request->data['Customer']['emergency_no'] == "" || $this->request->data['Customer']['emergency_no'] == null) {
                $message = 'Please Supply The Customer\'s Emergency Number';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
            }


            if ($this->request->data['Customer']['mobile_no'] == "" || $this->request->data['Customer']['mobile_no'] == null) {
                $message = 'Please Supply The Customer\'s Mobile Number';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
            }
            if ($this->request->data['Customer']['landmark'] == "" || $this->request->data['Customer']['landmark'] == null) {
                $message = 'Please Supply A Landmark for Customer\'s House';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
            }
            if ($this->request->data['Customer']['house_no'] == "" || $this->request->data['Customer']['house_no'] == null) {
                $message = 'Please Supply The Customer\'s House Number';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
            }

            if ($this->request->data['Customer']['area'] == "" || $this->request->data['Customer']['area'] == null) {
                $message = 'Please Supply The Customer\'s Area/Locality';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
            }
            if ($this->request->data['Customer']['city'] == "" || $this->request->data['Customer']['city'] == null) {
                $message = 'Please Supply The Customer\'s City';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
            }
            if ($this->request->data['Customer']['guarantor_name'] == "" || $this->request->data['Customer']['guarantor_name'] == null) {
                $message = 'Please Supply The Guarantor\'s Name';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
            }
            if ($this->request->data['Customer']['guarantor_no'] == "" || $this->request->data['Customer']['guarantor_no'] == null) {
                $message = 'Please Supply The Guarantor\'s Phone Number';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
            }
            $this->request->data['Customer']['fullname'] = $fullname;
            $this->request->data['Customer']['customer_category_id'] = $this->request->data['Customer']['customercategory_id'];
            $this->request->data['Customer']['dob'] = $dob_date;
            $this->request->data['Customer']['registration_date'] = $registration_date;
            $photo = $this->request->data['Customer']['surname'] . "_" . "photo" . "_" . $dob_date;
            $signature = '';
            $guarantor_sig = '';
            $cust_photo = '';
            if (isset($this->request->data['Customer']['cust_signature'])) {
                $signature = $this->request->data['Customer']['cust_signature'];
            }
            if (isset($this->request->data['Customer']['guarantor_signature'])) {
                $guarantor_sig = $this->request->data['Customer']['guarantor_signature'];
            }
            if (isset($this->request->data['hiddenphoto'])) {
                $cust_photo = $this->request->data['hiddenphoto'];
            }

            if ($data = $this->Uploader->upload('customer_photo', array('overwrite' => true, 'name' => $photo))) {
                $this->request->data['Customer']['customer_photo'] = $data['path'];
                // Upload successful, do whatever
            } elseif ($cust_photo != '') {
                $this->request->data['Customer']['customer_photo'] = $cust_photo;
            } else {
                $message = 'Please Supply The Customer\'s Picture';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
            }
//	if ($signature == "" || $signature == null) {
//                    $message = 'Please Select Availability of Customer\'s Signature';
//                   $this->Session->write('emsg', $message);
//                   $this->redirect(array('controller' => 'Customers','action' => 'index'));
//			// Upload successful, do whatever
//		}
//                
//                if($guarantor_sig == "" || $guarantor_sig == null) {
//                    $message = 'Please Select Availability of Guarantor\'s Signature';
//                   $this->Session->write('emsg', $message);
//                   $this->redirect(array('controller' => 'Customers','action' => 'index'));
//			// Upload successful, do whatever
//		}

            if (isset($this->request->data['userIdentify'])) {
                $this->request->data['Customer']['user_id'] = $this->request->data['userIdentify'];
            }

            if (isset($this->request->data['Customer']['user_id'])) {
                if ($this->request->data['Customer']['user_id'] == "" || $this->request->data['Customer']['user_id'] == null) {
                    $message = 'Please Assign a Sales Person';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
                }
            }
            // debug($data);
            // pr($this->request->data);
            $result = $this->Customer->save($this->request->data);
            $customerid = $this->Customer->id;
            //pr($this->request->data);
            if ($result) {

                $message = 'Customer Edit Successful';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'findCustomers'));
            } else {
                $message = 'Customer Save Error';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'editCustomer', $id));
            }
        }
    }

    public function findCustomers() {
        $this->__validateUserType3();
        $data = $this->paginate('Customer');
        $this->set('customer', $data);

        $check = $this->Session->check('ct');
        if ($check) {
            $cust = $this->Session->read('ct');
//            pr($cust);
            $this->set('ct', $cust);
        }
        $check = $this->Session->check('cts');
        if ($check) {
            $cust = $this->Session->read('cts');
            $this->set('customer', $cust);
        }
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

        $this->redirect(array('controller' => 'Customers', 'action' => 'findCustomers'));
    }

    public function deleteCustomers() {
        $this->__validateUserType();
        $data = $this->paginate('Customer');
        $this->set('customer', $data);

        $check = $this->Session->check('ct');
        if ($check) {
            $cust = $this->Session->read('ct');
//            pr($cust);
            $this->set('ct', $cust);
        }
        $check = $this->Session->check('cts');
        if ($check) {
            $cust = $this->Session->read('cts');
            $this->set('customer', $cust);
        }
    }

    public function delCustomer($customer = Null) {
        $this->autoRender = false;

        $order_status = array('id' => $customer, 'status' => 'Deleted');
        $result = $this->Customer->delete($customer, false);

        if ($result) {
            $message = 'Deleted Customer Details Successfully';
            $this->Session->write('smsg', $message);
        } else {
            $message = 'Unable to Delete Customer Details';
            $this->Session->write('bmsg', $message);
        }
        $this->redirect(array('controller' => "Customers", 'action' => "deleteCustomers"));
    }

    public function customerDetails($customer_id = null) {
        $this->__validateUserType3();
        $this->paginate('Customer');
        $data = $this->Customer->find('first', array('conditions' => array('Customer.id' => $customer_id)));
        if ($data) {
            $this->set('customer', $data);
        } else {

            $message = 'Sorry, Customer Not Found';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => "Customers", 'action' => "findCustomers"));
        }
    }

    public function editCustomer($customer_id = null) {
        $this->__validateUserType2();
        $this->paginate('Customer');
        $data = $this->Customer->find('first', array('conditions' => array('Customer.id' => $customer_id)));
        if ($data) {
            $this->set('customer', $data);
        } else {

            $message = 'Sorry, Customer Not Found';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => "Customers", 'action' => "findCustomers"));
        }
        $this->set('customer', $data);
        $userType3 = $this->Session->read('userDetails.usertype_id');
        $prevent = 0;
        if ($userType3 == 3) {
            $prevent = 1;
        } else {
            $prevent = 0;
        }
        $this->set('prevent', $prevent);
        $this->set('marriages', $this->Marriage->find('list'));
        $this->set('idtypes', $this->Idtype->find('list'));
        $this->set('customercategories', $this->CustomerCategory->find('list'));
        $this->set('zones', $this->Zone->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id' => 4))));
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
                $this->redirect(array('controller' => 'Customers', 'action' => 'findCustomers'));
            } else {
                $message = 'Sorry, Customer Not Found';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'findCustomers'));
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
                $this->redirect(array('controller' => 'Customers', 'action' => 'findCustomers'));
            } else {

                $message = 'Sorry, Customer Not Found';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'findCustomers'));
            }
        }
    }

    public function searchCustomerDel($custID = Null) {
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
                $this->redirect(array('controller' => 'Customers', 'action' => 'deleteCustomers'));
            } else {
                $message = 'Sorry, Customer Not Found';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'deleteCustomers'));
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
                $this->redirect(array('controller' => 'Customers', 'action' => 'deleteCustomers'));
            } else {

                $message = 'Sorry, Customer Not Found';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Customers', 'action' => 'deleteCustomers'));
            }
        }
    }

}

?>
