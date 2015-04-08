<?php
echo $this->Html->script('notification.js');
?>
<!-- Content starts here -->

<h3>Add New Investor</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        <?php
        echo $this->Html->css('prettify.css');
        echo $this->Html->script('jquery.bootstrap.wizard.js');
        echo $this->Html->script('jquery.bootstrap.wizard.min.js');
        echo $this->Html->script('prettify.js');
        echo $this->Html->css('fuelux/style.css');
        echo $this->Html->css('icheck/flat/_all.css');
        echo $this->Html->script('icheck/icheck.js');
        ?>

        <!-- Row Start -->
        <div class="row">

            <!-- Form Layout Start -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="boxed no-padding">
                    <div class="inner">

                        <div class="wizard-form-success">
                            <h2>Thank you! Your submission has been received!</h2>
                        </div>

                        <div id="wizard-form" class="wizard">
                            <ul class="steps">
                                <li data-target="#step1" class="active"><span class="badge badge-info">1</span>Personal Information<span class="chevron"></span></li>
                                <!--<li data-target="#step2"><span class="badge">2</span>For Joint Account Holder<span class="chevron"></span></li>-->
                                <!--<li data-target="#step2"><span class="badge">2</span>Investment Details<span class="chevron"></span></li>-->
                                <li data-target="#step2"><span class="badge">2</span>Bank Details<span class="chevron"></span></li>
                                <li data-target="#step3"><span class="badge">3</span>Next of Kin<span class="chevron"></span></li>
                            </ul>
                        </div>

                        <div class="step-content">
                            <!--<form method="post" action="#" id="wizard-form-data" class="basic-form horizontal-form">-->
                            <?php
                            echo $this->Form->create('Investor', array("enctype" => "multipart/form-data", "url" => array('class' => 'basic-form', 'controller' => 'Investments', 'action' => 'commit_indv'), "inputDefaults" => array('div' => false)));
                            ?>
                            <!-- Step 1 Personal Information Form Start -->
                            <div class="step-pane active" id="step1">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <input class="input-xlarge focused" id="post_url"  type="hidden" value="<?php echo $this->Html->url(array('controller' => 'Investments', 'action' => 'commit_indv')); ?> ">

                                        <?php
                                        echo $this->Form->hidden('investor_type_id', array('value' => 2));
                                        echo $this->Form->input('investortype_id', array('default' => 2, 'label' => 'Investor Type', 'disabled'));
                                        echo $this->Form->input('user_id', array('default' => 0, 'label' => 'Investment Officer*: ', 'class' => 'required', 'empty' => '--Please Select--'));
                                        echo $this->Form->input('surname', array('label' => 'Surname*', 'value' => (isset($investor['Investor']['surname']) ? $investor['Investor']['surname'] : '' ), 'placeholder' => 'Enter surname', 'class' => 'required'));
                                        echo $this->Form->input('other_names', array('label' => 'Other Names*', 'value' => (isset($investor['Investor']['other_names']) ? $investor['Investor']['other_names'] : '' ), 'placeholder' => 'Enter other (names)', 'class' => 'required'));
                                        echo $this->Form->input('in_trust_for', array('label' => 'In Trust For (Beneficiary)', 'value' => (isset($investor['Investor']['in_trust_for']) ? $investor['Investor']['in_trust_for'] : '' ), 'placeholder' => 'Enter name of person for whom investment will be made'));
                                        ?>

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>Date of Birth*:</span>" . $this->Form->day('dob', array('size' => 1, 'label' => 'D.O.B', 'value' => (isset($investor['Investor']['dob']) ? date('d', strtotime($investor['Investor']['dob'])) : date('d')), 'empty' => '---Select Birth Day---', 'class' => 'required', 'class' => 'required')); ?>&nbsp;
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->month('dob', array('size' => 1, 'label' => false, 'value' => (isset($investor['Investor']['dob']) ? date('m', strtotime($investor['Investor']['dob'])) : date('m')), 'empty' => '---Select a Birth Month---', 'class' => 'required')); ?>&nbsp;
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->year('dob', date('Y')-80, date('Y'), array("id" => "is_year", 'type' => 'date', 'dateFormat' => 'Y', 'size' => 1, "style" => "margin-right: 10px;", 'label' => false, 'value' => (isset($investor['Investor']['dob']) ? date('Y', strtotime($investor['Investor']['dob'])) : date('Y')), 'empty' => '---Select Birth Year---', 'class' => 'required')); ?>
                                            </div>
                                        </div>

                                        <?php
                                        echo $this->Form->input('occupation', array('size' => 30, 'label' => 'Occupation/Profession', 'value' => (isset($investor['Investor']['occupation']) ? $investor['Investor']['occupation'] : '' ), 'placeholder' => 'Enter occupation'));
                                        echo $this->Form->input('physical_address', array('size' => 30, 'label' => 'Physical Address*', 'value' => (isset($investor['Investor']['physical_address']) ? $investor['Investor']['physical_address'] : '' ), 'placeholder' => 'Enter physical address', 'class' => 'required'));
                                        echo $this->Form->input('postal_address', array('size' => 30, 'value' => (isset($investor['Investor']['postal_address']) ? $investor['Investor']['postal_address'] : '' ), 'placeholder' => 'Enter postal address'));
                                        ?>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <?php
                                                //,'options' => array("Drivers license"=>"Drivers license",'NHIS'=>'NHIS','National ID'=>'National ID','Passport'=>'Passport','Voter ID'=>'Voter ID') ,'empty' =>'---Select---'
                                                echo $this->Form->input('idtype_id', array('label' => 'ID Type*', 'class' => 'required', 'value' => (isset($investor['Investor']['idtype_id']) ? $investor['Investor']['idtype_id'] : '' ), 'class' => 'required'));
                                                ?>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <?php echo $this->Form->input('id_number', array('label' => 'ID Number*', 'class' => 'required', 'value' => (isset($investor['Investor']['id_number']) ? $investor['Investor']['id_number'] : '' ), 'placeholder' => 'Enter ID number')); ?>
                                            </div>
                                            <!--					<div class="col-lg-3 col-md-3 col-sm-12">
                                            <?php //echo $this->Form->input('id_issue', array('label' => 'Issue Date', 'value' => (isset($investor['Investor']['id_issue1']) ? $investor['Investor']['id_issue1'] : '' ), 'placeholder' => 'dd/mm/yyyy')); 
                                            ?>
                                                                                    </div>
                                                                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                            <?php // echo $this->Form->input('id_expiry', array('label' => 'Expiry Date', 'value' => (isset($investor['Investor']['id_expiry1']) ? $investor['Investor']['id_expiry1'] : '' ), 'placeholder' => 'dd/mm/yyyy'));
                                            ?>
                                                                                    </div>-->
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>Issue Date*:</span>" . $this->Form->day('id_issue', array('size' => 1, 'label' => 'ID Issue Date*', 'value' => (isset($investor['Investor']['id_issue']) ? date('d', strtotime($investor['Investor']['id_issue'])) : '--Select Day--'), 'empty' => '--Select Day--', 'class' => 'required')); ?>&nbsp;
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->month('id_issue', array('size' => 1, 'label' => false, 'value' => (isset($investor['Investor']['id_issue']) ? date('m', strtotime($investor['Investor']['id_issue'])) : '--Select Month--' ), 'empty' => '--Select Month--', 'class' => 'required')); ?>&nbsp;
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->year('id_issue', date('Y')-10, date('Y'), array("id" => "is_year", 'type' => 'date', 'dateFormat' => 'Y', 'size' => 1, "style" => "margin-right: 10px;", 'label' => false, 'value' => (isset($investor['Investor']['id_issue']) ? date('Y', strtotime($investor['Investor']['id_issue'])) : '--Select Year--' ), 'empty' => '--Select Year--', 'class' => 'required')); ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>Expiry Date:</span>" . $this->Form->day('id_expiry', array('size' => 1, 'label' => 'ID Expiry Date', 'value' => (isset($investor['Investor']['id_issue']) ? date('d', strtotime($investor['Investor']['id_expiry'])) : '--Select ID Expiry Day--' ), 'empty' => '--Select ID Expiry Day--', 'class' => 'required')); ?>&nbsp;
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->month('id_expiry', array('size' => 1, 'label' => false, 'value' => (isset($investor['Investor']['id_issue']) ? date('m', strtotime($investor['Investor']['id_expiry'])) : '--Select ID Expiry Month--' ), 'empty' => '--Select ID Expiry Month--', 'class' => 'required')); ?>&nbsp;
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->year('id_expiry', date('Y'), date('Y') + 10, array("id" => "is_year", 'type' => 'date', 'dateFormat' => 'Y', 'size' => 1, "style" => "margin-right: 10px;", 'label' => false, 'value' => (isset($investor['Investor']['id_expiry']) ? date('Y', strtotime($investor['Investor']['id_expiry'])) : '--Select ID Expiry Year--' ), 'empty' => '--Select ID Expiry Year--', 'class' => 'required')); ?>
                                            </div>
                                        </div>

                                        <?php
                                        echo $this->Form->input('phone', array('label' => 'Phone Number*', 'value' => (isset($investor['Investor']['phone']) ? $investor['Investor']['phone'] : '' ), 'placeholder' => 'Enter phone number', 'class' => 'required'));
                                        echo $this->Form->input('email', array('label' => 'Email Address', 'value' => (isset($investor['Investor']['email']) ? $investor['Investor']['email'] : '' ), 'placeholder' => 'Enter email address'));
                                        ?>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <?php
                                        echo $this->Form->input('nationality', array('label' => 'Nationality*', 'value' => (isset($investor['Investor']['nationality']) ? $investor['Investor']['nationality'] : '' ), 'class' => 'required', 'placeholder' => 'Enter nationality'));
                                        echo $this->Form->input('hometown', array('value' => (isset($investor['Investor']['hometown']) ? $investor['Investor']['hometown'] : '' ), 'placeholder' => 'Enter hometown'));
                                        echo $this->Form->input('birth_place', array('label' => 'Place of Birth', 'value' => (isset($investor['Investor']['birth_place']) ? $investor['Investor']['birth_place'] : '' ), 'placeholder' => 'Enter hometown'));
                                        echo $this->Form->input('work_place', array('label' => 'Place of Work', 'value' => (isset($investor['Investor']['work_place']) ? $investor['Investor']['work_place'] : '' ), 'placeholder' => 'Enter name of workplace'));
                                        echo $this->Form->input('position_held', array('value' => (isset($investor['Investor']['position_held']) ? $investor['Investor']['position_held'] : '' ), 'placeholder' => 'Enter position held at work'));
                                        echo $this->Form->radio('marital_status', array("Single" => "Single", "Married" => "Married", 'Widowed' => 'Widowed', 'Divorced' => 'Divorced'), array('hiddenField' => false, 'value' => (isset($investor['Investor']['marital_status']) ? $investor['Investor']['marital_status'] : '' )));
                                        echo $this->Form->input('children', array('label' => 'Number of Children', 'value' => (isset($investor['Investor']['children']) ? $investor['Investor']['children'] : '' ), 'placeholder' => 'Enter number of children'));


//						echo '<b><u>SOURCES OF INCOME</u></b> ';
                                        echo $this->Form->input('source_of_income', array('options' => array('Personal Savings' => 'Personal Savings', 'Salary' => 'Salary', 'Gifts/Inheritance' => 'Gifts/Inheritance', 'Other' => 'Other'), 'value' => (isset($investor['Investor']['source_of_income']) ? $investor['Investor']['source_of_income'] : '--Please Select--' ), 'empty' => '--Please Select--', 'placeholder' => 'Select source of income'));

//                        echo $this->Form->input('salary', array('value' => (isset($investor['Investor']['salary']) ? $investor['Investor']['salary'] : '' ), 'placeholder' => 'Enter salary amount'));
//						echo $this->Form->input('gifts_inheritance', array('label' => 'Gifts/Inheritance', 'value' => (isset($investor['Investor']['gifts_inheritance']) ? $investor['Investor']['gifts_inheritance'] : '' ), 'placeholder' => 'Enter amount of money received in gifts/inheritance'));
//						echo $this->Form->input('income_other', array('label' => 'Other', 'value' => (isset($investor['Investor']['income_other']) ? $investor['Investor']['income_other'] : '' ), 'placeholder' => 'Enter amount of money received from all other sources`'));
//						//echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>Gross Income:</span>".$this->Form->select('gross_income', array('1' => 'Below GHC5,000', '2' => 'GHC5,000 - GHC100,000', '3' => 'Above GHC100,000'));
                                        echo $this->Form->input('grossincome_id', array('label' => 'Gross Income', 'default' => 0));
                                        ?>


                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">

                                                <?php
                                                echo $this->Form->input('investor_photo', array('type' => 'file', 'label' => 'Investor Photo'));

//'value' => $this->webroot.(isset($investor['Investor']['investor_photo']) ? $investor['Investor']['investor_photo'] : '' )
                                                ?>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <?php
//                                                echo $this->Form->input('investor_signature', array('type' => 'file', 'value' => $this->webroot . (isset($investor['Investor']['investor_signature']) ? $investor['Investor']['investor_signature'] : '' )));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Step 1 Personal Information Form End -->


                            <!-- Step 2 Investment Details Start -->
                            <!--                <div class="step-pane" id="step2">
                                              <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                  <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php // echo $this->Form->input('inv_amount', array('label' => 'Investment Amount', 'value' => (isset($investor['Investor']['inv_amount']) ? $investor['Investor']['inv_amount'] : '' )));  ?>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php // echo $this->Form->input('currency_id',array('label' => 'Currency', 'empty' => "--Please Select a Currency--")); ?>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php // echo $this->Form->input('inv_freq', array('label' => 'Frequency', 'value' => (isset($investor['Investor']['inv_freq']) ? $investor['Investor']['inv_freq'] : '' ))); ?>
                                                    </div>
                                                                              
                                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php // echo $this->Form->input('investmentterm_id', array('label' => 'Investment Term', 'empty' => "--Please Select--"));  ?>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php // echo $this->Form->input('paymentschedule_id',array('label' => 'Payment Schedule', 'empty' => "--Please Select--")); ?>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                            <?php // echo $this->Form->input('paymentmode_id', array('label' => 'Payment Mode', 'empty' => "--Please Select--"));  ?>
                                                    </div>
                                                  </div>
                                                </div>
                            
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                            <?php
//						echo $this->Form->input('investmentproduct_id', array('label' => 'Investment Product', 'empty' => "--Please Select--"));  
//						echo $this->Form->input('instruction_id', array('label' => 'Instructions', 'empty' => "--Please Select--"));  
//						echo $this->Form->input('instruction_details', array('label' => 'Other Instruction Details', 'placeholder' => "Complete this ONLY if 'Other' is selected"));  
                            ?>
                                                </div>
                                              </div>
                                            </div>-->
                            <!-- Step 2 Investment Details End -->

                            <!-- Step 3 Bank Details Start -->
                            <div class="step-pane" id="step2">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <?php
                                        echo $this->Form->input('acc_name', array('label' => 'Account Name',  'placeholder' => "Enter investor name as used with the bank"));
                                        echo $this->Form->input('bank_id', array('label' => 'Bank Name', 'empty' => "--Select bank--"));
                                        ?>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <?php
                                        echo $this->Form->input('bank_branch', array('label' => 'Bank Branch', 'placeholder' => "Enter bank branch/location"));
                                        echo $this->Form->input('acc_number', array('label' => 'Account Number', 'placeholder' => "Enter account number"));
                                        echo $this->Form->input('inv_freq', array('label' => 'Investment Frequency', 'value' => (isset($investor['Investor']['inv_freq']) ? $investor['Investor']['inv_freq'] : '' )));
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Step 3 Bank Details End -->

                            <!-- Step 4 Next of Kin Start -->
                            <div class="step-pane" id="step3">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <?php
                                        echo $this->Form->input('next_of_kin_name', array('label' => 'Next of Kin Name', 'value' => (isset($investor['Investor']['next_of_kin_name']) ? $investor['Investor']['next_of_kin_name'] : '' ), 'placeholder' => 'Enter Next of Kin Name'));
//echo $this->Form->input('nk_other_names', array('label' => 'Other Names','value' => (isset($investor['Investor']['nk_other_names']) ? $investor['Investor']['nk_other_names'] : '' ), 'placeholder' => 'Enter other name(s)'));
                                        ?>

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>Date of Birth:</span>" . $this->Form->day('nk_dob', array('size' => 1, 'label' => 'D.O.B', 'value' => (isset($investor['Investor']['nk_dob']) ? date('d', strtotime($investor['Investor']['nk_dob'])) : date('d') ), 'empty' => (isset($investor['Investor']['nk_dob']) ? date('d', strtotime($investor['Investor']['nk_dob'])) : date('d') ))); ?>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->month('nk_dob', array('size' => 1, 'label' => false, 'value' => (isset($investor['Investor']['nk_dob']) ? date('m', strtotime($investor['Investor']['nk_dob'])) : date('m') ), 'empty' => (isset($investor['Investor']['nk_dob']) ? date('F', strtotime($investor['Investor']['nk_dob'])) : date('F') ))); ?>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>" . $this->Form->year('nk_dob', date('Y')-80, date('Y'), array("id" => "is_year", 'type' => 'date', 'dateFormat' => 'Y', 'size' => 1, "style" => "margin-right: 10px;", 'label' => false, 'value' => (isset($investor['Investor']['nk_dob']) ? date('Y', strtotime($investor['Investor']['nk_dob'])) : date('Y') ), 'empty' => (isset($investor['Investor']['nk_dob']) ? date('Y', strtotime($investor['Investor']['nk_dob'])) : date('Y')))); ?>
                                            </div>
                                        </div>
                                        
                                        <?php
                                        echo $this->Form->input('nk_relationship', array('label' => 'Relationship', 'value' => (isset($investor['Investor']['nk_relationship']) ? $investor['Investor']['nk_relationship'] : '' ), 'placeholder' => 'He/She is your ...'));
                                        ?>
                                        
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <?php
                                        echo $this->Form->input('nk_postal_address', array('label' => 'Postal Address', 'value' => (isset($investor['Investor']['nk_postal_address']) ? $investor['Investor']['nk_postal_address'] : '' ), 'placeholder' => 'Enter postal address'));
                                        echo $this->Form->input('nk_phone', array('label' => 'Phone Number', 'value' => (isset($investor['Investor']['nk_phone']) ? $investor['Investor']['nk_phone'] : '' ), 'placeholder' => 'Enter phone number'));
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 text-right">
                            <div class="actions">
                                <button type="button" class="btn btn-default  btn-prev"> <i class="icon-arrow-left"></i>Previous</button>
                                <button type="button" class="btn btn-success btn-next" data-last="Finish">Next<i class="icon-arrow-right"></i></button>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Form End -->

            <!-- Step 4 Next of Kin End -->


            <!--</form>-->
            <?php $this->Form->end(); ?>
        </div>
        <!-- Row End -->

        <!-- Content ends here -->

        <style type="text/css">
            label.error{
                color: #B94A48;
                margin-top: 2px;
            }
        </style>
        <script type="text/javascript" src="https://fuelcdn.com/fuelux/2.3/loader.min.js"></script>
        <?php
        echo $this->Html->script('prettify.js');
        echo $this->Html->script('fuelux/wizards.js');
        ?>