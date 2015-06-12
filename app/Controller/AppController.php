<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    var $uses = array('Investor', 'Investment');
    
    public function beforeFilter(){
        
        $this->__validateLoginStatus();
        $this->Session->delete('public_unapproved_investors');
        $this->Session->write('public_unapproved_investors', $this->Investor->find('count', array('conditions' => array('Investor.approved' => 0))));
        
        $this->Session->delete('public_termination_req');
        $this->Session->write('public_termination_req', $this->Investment->find('count', array('conditions' => array('Investment.status LIKE' => "Termination_Requested"))));
        
        $this->Session->delete('public_payment_req');
        $this->Session->write('public_payment_req', $this->Investment->find('count', array('conditions' =>
            array('Investment.status' => array("Payment_Requested",'Disposal_Requested')))));
  $this->__validateLoginStatus();
        }
    
    function __validateLoginStatus() {
        if ($this->action != 'login' && $this->action != 'logout') {
            if ($this->Session->check('userData') == false) {
                $this->redirect('/');
            }
        }
    }

}
