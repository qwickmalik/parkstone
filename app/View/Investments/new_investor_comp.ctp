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
                <li data-target="#step1" class="active"><span class="badge badge-info">1</span>Company Information<span class="chevron"></span></li>
                <li data-target="#step3"><span class="badge">2</span>Investment Details<span class="chevron"></span></li>
				<li data-target="#step3"><span class="badge">3</span>Bank Details<span class="chevron"></span></li>
				
              </ul>
            </div>

            <div class="step-content">
              <!--<form method="post" action="#" id="wizard-form-data" class="basic-form horizontal-form">-->
				<?php
				echo $this->Form->create('Investor', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'save'), "inputDefaults" => array('div' => false))); 
				?>
                <!-- Step 1 Company Information Form Start -->
                <div class="step-pane active" id="step1">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
					<?php 
 					echo $this->Form->input('investortype_id', array('default' => 4, 'label' => 'Investor Type', 'disabled'));
					echo $this->Form->input('comp_name', array('label' => 'Company/Organisation Name*','value' => (isset($investor['Investor']['comp_name']) ? $investor['Investor']['comp_name'] : '' ), 'placeholder' => 'Enter company/organisation name', 'class' => 'required')); 
					echo $this->Form->input('nature_biz', array('label' => 'Nature of Business','value' => (isset($investor['Investor']['nature_biz']) ? $investor['Investor']['nature_biz'] : '' ), 'placeholder' => 'Describe nature of business'));
					echo $this->Form->input('reg_numb', array('value' => (isset($investor['Investor']['reg_numb']) ? $investor['Investor']['reg_numb'] : '' ), 'placeholder' => 'Enter company registration number'));
					?>
				
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px; '>Date of Incorporation*:</span>
					</div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
					  <?php echo $this->Form->day('dob', array('size' => 1, 'label'=>'D.O.B','value' => (isset($investor['Investor']['dob']) ? date('d',strtotime($investor['Investor']['dob'])) : date('d') ),'empty' => (isset($investor['Investor']['dob']) ? date('d',strtotime($investor['Investor']['dob'])) : date('d') ), 'class' => 'required'));  ?>&nbsp;
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
					  <?php echo $this->Form->month('dob', array('size' => 1, 'label'=>false,'value' => (isset($investor['Investor']['dob']) ? date('m',strtotime($investor['Investor']['dob'])) : date('m') ),'empty' => (isset($investor['Investor']['dob']) ? date('F',strtotime($investor['Investor']['dob'])) : date('F') ), 'class' => 'required')); ?>&nbsp;
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
					  <?php echo $this->Form->year('dob', 1950, date('Y'), array("id" => "is_year", 'type' => 'date', 'dateFormat' => 'Y','size' => 1, "style" => "margin-right: 10px;",'label'=>false,'value' => (isset($investor['Investor']['dob']) ? date('Y',strtotime($investor['Investor']['dob'])) : date('Y') ),'empty' => (isset($investor['Investor']['dob']) ? date('Y',strtotime($investor['Investor']['dob'])) : date('Y')), 'class' => 'required')); ?>
                	</div>
				</div>
					
				<?php
					echo $this->Form->input('physical_address', array('size' => 30,'value' => (isset($investor['Investor']['physical_address']) ? $investor['Investor']['physical_address'] : '' ), 'placeholder' => 'Enter physical address'));
					echo $this->Form->input('postal_address', array('size' => 30,'value' => (isset($investor['Investor']['postal_address']) ? $investor['Investor']['postal_address'] : '' ), 'placeholder' => 'Enter postal address'));
					
					?>
                    </div>
                    
					<div class="col-lg-6 col-md-6 col-sm-12">
                      <?php
						echo $this->Form->input('ceo', array('size' => 30,'value' => (isset($investor['Investor']['ceo']) ? $investor['Investor']['ceo'] : '' ), 'placeholder' => 'Enter name of CEO/Director/Manager', 'label' => 'CEO/Director/Manager'));
						echo $this->Form->input('contact_person', array('value' => (isset($investor['Investor']['contact_person']) ? $investor['Investor']['contact_person'] : '' ), 'placeholder' => 'Enter name of contact person for investment'));
						echo $this->Form->input('position', array('value' => (isset($investor['Investor']['position']) ? $investor['Investor']['position'] : '' ), 'placeholder' => 'Enter position of contact person'));
						echo $this->Form->input('phone', array('label' => 'Phone Number*','value' => (isset($investor['Investor']['phone']) ? $investor['Investor']['phone'] : '' ), 'placeholder' => 'Enter phone number', 'class' => 'required'));
						echo $this->Form->input('email', array('label' => 'Email Address*','value' => (isset($investor['Investor']['email']) ? $investor['Investor']['email'] : '' ), 'placeholder' => 'Enter email address', 'class' => 'required'));
						echo $this->Form->input('institutiontype_id', array('label' => 'Type of Institution', 'default' => 0));
						echo $this->Form->input('grossrevenue_id', array('label' => 'Annual Gross Revenue', 'default' => 0));
						echo  "<span style='font-size: 14px;font-weight: bold; padding: 10px 0px 10px 0px;'>Preferred Mode of Contact</span>".$this->Form->select('contact_mode', array('1' => 'Phone', '2' => 'Email'), array('empty' => '-Please select-'));
						?>
                    </div>
                  </div>
                </div>
                <!-- Step 1 Company Information Form End -->

                <!-- Step 2 Investment Details Start -->
                <div class="step-pane" id="step2">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                          <?php echo $this->Form->input('inv_amount', array('label' => 'Inv. Amount', 'value' => (isset($investor['Investor']['inv_amount']) ? $investor['Investor']['inv_amount'] : '' ))); ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                          <?php echo $this->Form->input('currency_id',array('label' => 'Currency', 'empty' => "--Please Select a Currency--")); ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                          <?php echo $this->Form->input('inv_freq', array('label' => 'Frequency', 'value' => (isset($investor['Investor']['inv_freq']) ? $investor['Investor']['inv_freq'] : '' ))); ?>
                        </div>
                      </div>
						<?php 
							echo $this->Form->input('investmentproduct_id', array('label' => 'Investment Product', 'empty' => "--Please Select--"));  
							?>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-12">
							  <?php echo $this->Form->input('investmentterm_id', array('label' => 'Investment Term', 'empty' => "--Please Select--")); ?>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12">
							  <?php echo $this->Form->input('paymentschedule_id',array('label' => 'Payment Schedule', 'empty' => "--Please Select--")); ?>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12">
							  <?php echo $this->Form->input('paymentmode_id', array('label' => 'Payment Mode', 'empty' => "--Please Select--"));  ?>
							</div>
						</div>
                      <?php 
						echo $this->Form->input('instruction_id', array('label' => 'Instructions', 'empty' => "--Please Select--"));  
						echo $this->Form->input('instruction_details', array('label' => 'Other Instruction Details', 'placeholder' => "Complete this ONLY if 'Other' is selected"));  
						?>
                    </div>
                  </div>
                </div>
                <!-- Step 2 Investment Details End -->
				
				 <!-- Step 3 Bank Details Start -->
                <div class="step-pane" id="step3">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <?php
						echo $this->Form->input('acc_name', array('label' => 'Account Name', 'placeholder' => "Enter investor name as used with the bank"));  
						echo $this->Form->input('bank_name', array('label' => 'Bank Name', 'placeholder' => "Enter name of bank"));  
						?>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <?php 
						echo $this->Form->input('bank_branch', array('label' => 'Bank Branch', 'placeholder' => "Enter bank branch/location"));  
						echo $this->Form->input('acc_number', array('label' => 'Account Number', 'placeholder' => "Enter account number"));  
						?>
                    </div>
                  </div>
                </div>
                <!-- Step 3 Bank Details End -->
				
					
              <!--</form>-->
			<?php $this->Form->end(); ?>
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

    </div>
    <!-- Row End -->

<script type="text/javascript" src="https://fuelcdn.com/fuelux/2.3/loader.min.js"></script>
<?php
echo $this->Html->script('prettify.js');
echo $this->Html->script('fuelux/wizards.js');
?>