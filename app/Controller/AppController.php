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
//  $this->__validateLoginStatus();
        }
    //&& ($this->action != 'defaultJobs' && $this->action != 'cronJobs' && $this->action != 'backendJobs' && $this->action != 'miscJobs')
    function __validateLoginStatus() {
        if (($this->action != 'login' && $this->action != 'logout') ) {
            if ($this->Session->check('userData') == false) {
                $this->redirect('/');
            }
        }
    }
    
    public function get_accruedinterest($investment_id = null) {
        $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id),'recursive' => -1));

        if ($data) {
            $status = $data['Investment']['status'];
            switch ($status) {
                case 'Rolled_over':
                case 'Invested':
                case 'Termination_Requested':
                case 'Payment_Requested':
                    $period = $data['Investment']['investment_period'];
                    $first_date = $data['Investment']['investment_date'];
                    $inv_date = new DateTime($first_date);
                    $date = date('Y-m-d');
                    $to_date = new DateTime($date);
                    $duration = date_diff($inv_date, $to_date);
                    $duration = $duration->format("%a");
                    $year = $duration;
                    $custom_rate = $data['Investment']['custom_rate'];
                    $investment_amount = $data['Investment']['investment_amount'];
                    $interest_amount = '0.00';
                    switch ($period) {
                        case 'Day(s)':

                            $date = new DateTime($first_date);
                            $date->add(new DateInterval('P' . $duration . 'D'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
                            $statemt_array = array();
                            $rate = $custom_rate;

                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($duration / 365);
                            $amount_due = $interest_amount + $investment_amount;


                            break;
                        case 'Year(s)':

                            //$finv_date = $inv_date;
                            $date = new DateTime($first_date);
                            $date->add(new DateInterval('P' . $duration . 'D'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
                            $statemt_array = array();
                            $rate = $custom_rate;

                            //$YEAR2DAYS = 365 * $duration;
                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($duration / 365);
                            $amount_due = $interest_amount + $investment_amount;
                            break;
                    }
                    $accrued_interest = $interest_amount;
                    return $accrued_interest;
                    break;
                        case 'Termination_Approved':
                        case 'Cancelled':
                       $accrued_interest = $data['Investment']['interest_accrued'];
                    return $accrued_interest;
                default:
                     $period = $data['Investment']['investment_period'];
                    $first_date = $data['Investment']['investment_date'];
                    $inv_date = new DateTime($first_date);
                    $date = $data['Investment']['due_date'];
                    $to_date = new DateTime($date);
                    $duration = date_diff($inv_date, $to_date);
                    $duration = $duration->format("%a");
                    $year = $duration;
                    $custom_rate = $data['Investment']['custom_rate'];
                    $investment_amount = $data['Investment']['investment_amount'];
                    switch ($period) {
                        case 'Day(s)':

                            $date = new DateTime($first_date);
                            $date->add(new DateInterval('P' . $duration . 'D'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
                            $statemt_array = array();
                            $rate = $custom_rate;

                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($duration / 365);
                            $amount_due = $interest_amount + $investment_amount;


                            break;
                        case 'Year(s)':

                            //$finv_date = $inv_date;
                            $date = new DateTime($first_date);
                            $date->add(new DateInterval('P' . $duration . 'D'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
                            $statemt_array = array();
                            $rate = $custom_rate;

                            //$YEAR2DAYS = 365 * $duration;
                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($duration / 365);
                            $amount_due = $interest_amount + $investment_amount;
                            break;
                    }
                    $accrued_interest = $interest_amount;
                    return $accrued_interest;
                    break;
            }
        }else{
            return 'Invesment details missing';
        }
    }
    
    function get_accrueddays($investment_id = null){
        $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id),'recursive' => -1));

        if ($data) {
            $status = $data['Investment']['status'];
            switch ($status) {
                case 'Rolled_over':
                case 'Invested':
                case 'Termination_Requested':
                case 'Payment_Requested':
                    $period = $data['Investment']['investment_period'];
                    $first_date = $data['Investment']['investment_date'];
                    $inv_date = new DateTime($first_date);
                    $date = date('Y-m-d');
                    $to_date = new DateTime($date);
                    $duration = date_diff($inv_date, $to_date);
                    $duration = $duration->format("%a");
                    
                    $accrued_days = $duration;
                    return $accrued_days;
                    break;
                        case 'Termination_Approved':
                        case 'Cancelled':
                       $accrued_days = $data['Investment']['accrued_days'];
                    return $accrued_days;
                default:
                     $period = $data['Investment']['investment_period'];
                    $first_date = $data['Investment']['investment_date'];
                    $inv_date = new DateTime($first_date);
                    $date = $data['Investment']['due_date'];
                    $to_date = new DateTime($date);
                    $duration = date_diff($inv_date, $to_date);
                    $duration = $duration->format("%a");
                    
                    $accrued_days = $duration;
                    return $accrued_days;
                    break;
            }
        }else{
            return 'Invesment details missing';
        }
    }

}
