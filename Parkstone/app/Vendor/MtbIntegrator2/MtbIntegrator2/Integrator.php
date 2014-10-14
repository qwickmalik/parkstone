<?php
/**
 * Created by IntelliJ IDEA.
 * User: joseph
 * Date: 1/4/14
 * Time: 12:31 PM
 */
define("ROOTDIR", dirname(__FILE__));

date_default_timezone_set("Africa/Accra");
include_once ROOTDIR."/lib/log4php/Logger.php";

Logger::configure(ROOTDIR."/config/log4php.properties");

class Integrator {


    private $wsdl;
    private $client;
    private $logger;
    public $userDetail;
    private $appId;
    public $settings;

    public function __construct($wsdl, $username, $password, $appId) {

        $this->logger = Logger::getLogger(__CLASS__);
        $this->logger = Logger::getRootLogger();

//
//        $this->settings = parse_ini_file(ROOTDIR . "/config/settings.ini", true);
//
//        $username = $this->settings["account"]["username"];
//        $password = $this->settings["account"]["password"];
//        $appId=$this->settings["webservice"]["appId"];
//        $wsdl=$this->settings["webservice"]["wsdl"];
        try {

            $this->wsdl = $wsdl;
            $this->appId = $appId;
            $this->client = new SoapClient($this->wsdl);
           return  $this->login($username, $password, $appId);
        } catch (Exception $exc) {
            $this->logger->debug("Error instantiating soapclient " . $exc->getMessage());
        }
    }

    public function login($username, $password,$appId) {
        $this->logger->info("calling login ");

        try {
//           
            $params = array(
                'email' => "$username",
                'password' => sha1("$password"),
                'appId' => "$appId",
            );


            $return = $this->client->login($params);
            $this->logger->info($return);
            $this->userDetail = (object) $return->return;
            if (!empty($this->userDetail->error)) {
                die($this->userDetail->error);
            }
            return $this->userDetail;
        } catch (Exception $e) {
            $this->logger->info("Error calling login :" . $e->getMessage());
            $this->logger->debug("Error calling login :" . $e->getTraceAsString());
            return null;
        }
    }

    public function sendMessage($subject, $message, $recipients, $from) {
        $this->logger->info("calling sendMessage : $subject, $message, $recipients, $from ");

        try {

            $params = array(
                'subject' => $subject,
                'message' => $message,
                'mobileNumbers' => $recipients,
                'groupIds' => "",
                'contactIds' => "",
                'from' => $from,
                'sessionId' => $this->userDetail->key,
            );

            $return = $this->client->sendMessage($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling sendMessage  :" . $e->getMessage());
            $this->logger->debug("Error calling sendMessage :" . $e->getTraceAsString());
        }
    }




    public function addContact($fullname, $gender, $mobile, $email) {
        $this->logger->info("calling addContact :  $fullname, $gender, $mobile, $email");
        try {
            $params = array(
                'fullname' => $fullname,
                'gender' => $gender,
                'mobile' => $mobile,
                'email' => $email,
                'sessionId' => $this->userDetail->key
            );

            $return = $this->client->addContact($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling addContact :" . $e->getMessage());
            $this->logger->debug("Error calling addContact :" . $e->getTraceAsString());
        }
    }

    public function addContactsToGroups($contactIds, $groupIds) {
        $this->logger->info("calling addContactToGroup : $contactIds, $groupIds");

        try {
//            
//             
            $params = array(
                'contactIds' => $contactIds,
                'groupIds' => $groupIds,
                'sessionId' => $this->userDetail->key
            );
            $return = $this->client->addContactsToGroups($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling addContactToGroup :" . $e->getMessage());
            $this->logger->debug("Error calling addContactToGroup :" . $e->getTraceAsString());
        }
    }

    public function addGroup($name) {
        $this->logger->info("calling addGroup : $name");

        try {
//
            $params = array(
                'name' => $name,
                'sessionId' => $this->userDetail->key,
            );
            $return = $this->client->addGroup($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling addGroup :" . $e->getMessage());
            $this->logger->debug("Error calling addGroup :" . $e->getTraceAsString());
        }
    }

    public function checkBalance() {
        $this->logger->info("calling checkBalance ");

        try {
//            
//             
            $params = array(
                'sessionId' => $this->userDetail->key,
            );
            $return = $this->client->checkBalance($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling checkBalance:" . $e->getMessage());
            $this->logger->debug("Error calling checkBalance :" . $e->getTraceAsString());
        }
    }

    public function countContacts() {
        $this->logger->info("calling countContact ");
        try {

            $params = array(
                'sessionId' => $this->userDetail->key,
            );

            $return = $this->client->countContacts($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling countContacts:" . $e->getMessage());
            $this->logger->debug("Error calling countContacts :" . $e->getTraceAsString());
        }
    }

    public function countGroupContacts($groupId) {
        $this->logger->info("calling countGrojupContacts:  " . $groupId);

        try {

            $params = array(
                'groupId' => $groupId,
                'sessionId' => $this->userDetail->key,
            );
            $return = $this->client->countGroupContacts($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling countGroupContacts :" . $e->getMessage());
            $this->logger->debug("Error calling countGroupContacts :" . $e->getTraceAsString());
        }
    }


    public function countMessages() {

        try {

            $params = array(
                'sessionId' => $this->userDetail->key,
            );
            $return = $this->client->countMessages($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling countMessages :" . $e->getMessage());
            $this->logger->debug("Error calling countMessages :" . $e->getTraceAsString());
        }
    }

    public function editContact($contactId, $fullname, $gender, $mobile, $email) {
        $this->logger->info("calling editContact ");

        try {
//            
//             
            $params = array(
                'contactId' => $contactId,
                'fullname' => $fullname,
                'gender' => $gender,
                'mobile' => $mobile,
                'email' => $email,
                'sessionId' => $this->userDetail->key,
                'appId' => $this->appId,
            );
            $return = $this->client->editContact($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling editContact :" . $e->getMessage());
            $this->logger->debug("Error calling editContact :" . $e->getTraceAsString());
        }
    }

    public function editGroup($groupId, $name) {
        $this->logger->info("calling editGroup :$groupId, $name ");

        try {

            $params = array(
                'groupId' => $groupId,
                'name' => $name,
                'sessionId' => $this->userDetail->key,
            );
            $return = $this->client->editGroup($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling editGroup :" . $e->getMessage());
            $this->logger->debug("Error calling editGroup :" . $e->getTraceAsString());
        }
    }

    public function getContacts($offset, $pagesize) {

        $this->logger->info("calling getContact, $offset, $pagesize ");

        try {
//            
//             
            $params = array(
                'start' => $offset,
                'pageSize' => $pagesize,
                'sessionId' => $this->userDetail->key,

            );
            $return = $this->client->getContacts($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling getContact :" . $e->getMessage());
            $this->logger->debug("Error calling getContact :" . $e->getTraceAsString());
        }
    }

    public function getGroupContacts($groupId, $offset, $pagesize) {
        $this->logger->info("calling getGroupContacts : $groupId, $offset, $pagesize");

        try {
//            
//             
            $params = array(
                "groupId" => $groupId,
                'start' => $offset,
                'pageSize' => $pagesize,
                'sessionId' => $this->userDetail->key,

            );
            $return = $this->client->getGroupContacts($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling getGroupContact :" . $e->getMessage());
            $this->logger->debug("Error calling getGroupContact :" . $e->getTraceAsString());
        }
    }

    public function getGroups() {
        $this->logger->info("calling getGroup ");

        try {

            $params = array(
                'sessionId' => $this->userDetail->key,
            );
            $return = $this->client->getGroups($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling getGroup :" . $e->getMessage());
            $this->logger->debug("Error calling getGroup :" . $e->getTraceAsString());
        }
    }


    public function getMessages($offset, $pagesize) {
        $this->logger->info("calling getMessages: $offset, $pagesize ");

        try {

            $params = array(
                'start' => $offset,
                'pageSize' => $pagesize,
                'sessionId' => $this->userDetail->key,
            );
            $return = $this->client->getMessages($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling getMessages :" . $e->getMessage());
            $this->logger->debug("Error calling getMessages :" . $e->getTraceAsString());
        }
    }

    public function getSenderIds() {
        $this->logger->info("calling getSenderIds ");

        try {
            $params = array(
                'sessionId' => $this->userDetail->key,
            );
            $return = $this->client->getSenderIds($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling getSenderIds :" . $e->getMessage());
            $this->logger->debug("Error calling getSenderIds :" . $e->getTraceAsString());
        }
    }

    public function logout() {
        $this->logger->info(" calling logout ");

        try {
//            
//             
            $params = array(
                'sessionId' => $this->userDetail->key,
            );
            $return = $this->client->logout($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling logout :" . $e->getMessage());
            $this->logger->debug("Error calling logout :" . $e->getTraceAsString());
        }
    }

    public function refreshProduct() {
        $this->logger->info("calling refreshProduct ");

        try {

            $params = array(
                'sessionId' => $this->userDetail->key,
            );
            $return = $this->client->refreshProduct($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling refreshProduct :" . $e->getMessage());
            $this->logger->debug("Error calling refreshProduct :" . $e->getTraceAsString());
        }
    }

    public function registerProduct($productCode) {
        $this->logger->info("calling registerProduct : $productCode");

        try {

            $params = array(
                'productCode' => $productCode,
                'sessionId' => $this->userDetail->key,
                'appId' => $this->appId,
            );
            $return = $this->client->registerProduct($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling registerProduct :" . $e->getMessage());
            $this->logger->debug("Error calling registerProduct :" . $e->getTraceAsString());
        }
    }

    public function removeContacts($contactIds) {
        $this->logger->info("calling registerContacts : $contactIds");

        try {
            $ids= preg_split("/[\s,]/", $contactIds);
            $params = array(
                'contactIds' => $ids,
                'sessionId' => $this->userDetail->key,

            );
            $return = $this->client->registerProduct($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling registerProduct :" . $e->getMessage());
            $this->logger->debug("Error calling registerProduct :" . $e->getTraceAsString());
        }
    }

    public function removeContactFromGroup($contactId, $groupId) {
        $this->logger->info("Error calling removeContactFromGroup : $contactId, $groupId");

        try {

            $params = array(
                'contactId' => $contactId,
                'groupId' => $groupId,
                'sessionId' => $this->userDetail->key,

            );
            $return = $this->client->removeContactFromGroup($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling removeContactFromGroup :" . $e->getMessage());
            $this->logger->debug("Error calling removeContactFromGroup :" . $e->getTraceAsString());
        }
    }

    public function removeGroup($groupId) {
        $this->logger->info("calling removeGroup : $groupId");

        try {
//            
//             
            $params = array(
                'groupId' => $groupId,
                'sessionId' => $this->userDetail->key,
                'appId' => $this->appId,
            );
            $return = $this->client->removeGroups($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling removeGroup :" . $e->getMessage());
            $this->logger->debug("Error calling removeGroup :" . $e->getTraceAsString());
        }
    }

    public function removeGroups($groupIds) {
        $this->logger->info("calling removeGroups : $groupIds");

        try {
//            
//             
            $params = array(
                'groupIds' => $groupIds,
                'sessionId' => $this->userDetail->key,
                'appId' => $this->appId,
            );
            $return = $this->client->removeGroups($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling removeGroups :" . $e->getMessage());
            $this->logger->debug("Error calling removeGroups :" . $e->getTraceAsString());
        }
    }

    public function resendVerificationMail($email) {
        $this->logger->info("calling resendVerificationMail : $email");

        try {
//            
//             
            $params = array(
                'email' => $email,
                'appId' => $this->appId,
            );
            $return = $this->client->resendVerificationMail($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling resendVerificationMail :" . $e->getMessage());
            $this->logger->debug("Error calling resendVerificationMail :" . $e->getTraceAsString());
        }
    }

    public function resetPassword($email) {
        $this->logger->info("calling resetPassword : $email");

        try {
//            
//             
            $params = array(
                'email' => $email,
                'appId' => $this->appId,
            );
            $return = $this->client->resetPassword($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling resetPassword :" . $e->getMessage());
            $this->logger->debug("Error calling resetPassword :" . $e->getTraceAsString());
        }
    }



    public function setDefaultLocale($arg) {
        $this->logger->info("calling setDefaultLocale $arg");


        try {
//            
//             
            $params = array(
                'arg0' => $arg,
            );
            $return = $this->client->setDefaultLocale($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling setDefaultLocale :" . $e->getMessage());
            $this->logger->debug("Error calling setDefaultLocale :" . $e->getTraceAsString());
        }
    }

    public function signup($fullname, $email, $password, $mobile, $senderId, $company, $telephone, $address) {
        $this->logger->info("calling signup : $fullname, $email, $password, $mobile, $senderId, $company, $telephone, $address ");

        try {
//            
//             
            $params = array(
                'fullname' => $fullname,
                'email' => $email,
                'password' => $password,
                'mobile' => $mobile,
                'senderId' => $senderId,
                'company' => $company,
                'telephone' => $telephone,
                'address' => $address,
                'appId' => $this->appId,
            );
            $return = $this->client->signup($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling signup :" . $e->getMessage());
            $this->logger->debug("Error calling signup :" . $e->getTraceAsString());
        }
    }

    public function switchProduct($productCode) {
        $this->logger->info("calling switchProduct : $productCode");

        try {
//            
//             
            $params = array(
                'productCode' => "",
                'sessionId' => $this->userDetail->key,
                'appId' => $this->appId,
            );
            $return = $this->client->switchProduct($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling switchProduct :" . $e->getMessage());
            $this->logger->debug("Error calling switchProduct :" . $e->getTraceAsString());
        }
    }

    public function topup($voucherCode) {
        $this->logger->info(" calling topup :" . $voucherCode);

        try {
//            
//             
            $params = array(
                'voucherCode' => $voucherCode,
                'sessionId' => $this->userDetail->key,
                'appId' => $this->appId,
            );
            $return = $this->client->topup($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling topup :" . $e->getMessage());
            $this->logger->debug("Error calling topup :" . $e->getTraceAsString());
        }
    }

    public function viewContact($contactId) {
        $this->logger->info("calling viewContact : $contactId");

        try {
//            
//             
            $params = array(
                'contactId' => $contactId,
                'sessionId' => $this->userDetail->key,
                'appId' => $this->appId,
            );
            $return = $this->client->viewContact($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling viewContact :" . $e->getMessage());
            $this->logger->debug("Error calling viewContact :" . $e->getTraceAsString());
        }
    }

    public function viewGroup($groupId) {
        $this->logger->info("calling viewGroup : $groupId");

        try {
//            
//             
            $params = array(
                'groupId' => $groupId,
                'sessionId' => $this->userDetail->key,
                'appId' => $this->appId,
            );
            $return = $this->client->viewGroup($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling viewGroup :" . $e->getMessage());
            $this->logger->debug("Error calling viewGroup :" . $e->getTraceAsString());
        }
    }

    public function viewMessageStatuses($messageId) {
        $this->logger->info("calling viewMessageStatuses : $messageId");

        try {
//            
//             
            $params = array(
                'messageId' => $messageId,
                'sessionId' => $this->userDetail->key,
                'appId' => $this->appId,
            );
            $return = $this->client->viewMessageStatuses($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling viewMessageStatuses :" . $e->getMessage());
            $this->logger->debug("Error calling viewMessageStatuses :" . $e->getTraceAsString());
        }
    }

    public function viewMessages() {
        $this->logger->info("calling viewMessages ");

        try {
//            
//             
            $params = array(
                'sessionId' => $this->userDetail->key,
                'appId' => $this->appId,
            );
            $return = $this->client->viewMessages($params);
            return $return;
        } catch (Exception $e) {
            $this->logger->info("Error calling viewMessages  :" . $e->getMessage());
            $this->logger->debug("Error calling viewMessages  :" . $e->getTraceAsString());
        }
    }


} 