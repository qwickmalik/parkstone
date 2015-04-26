<?php echo $this->element('header'); ?>
<h3>Edit Investor</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>
		
			<!-- Form Elements Start -->
          <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12">
            <div class="boxed">

              <div class="inner no-radius">

				<?php 
					echo $this->Form->create('Investor', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'edit'), "inputDefaults" => array('div' => false))); 
                	echo $this->Form->hidden('id',array('value' => (isset($investor['Investor']['id']) ? $investor['Investor']['id'] : '' )));
                ?>
				  
				<div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
					   
                    <?php echo $this->Form->input('surname', array('size' => 30,'value' => (isset($investor['Investor']['surname']) ? $investor['Investor']['surname'] : '' ))); ?>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <?php echo $this->Form->input('other_names', array('size' => 30,'value' => (isset($investor['Investor']['other_names']) ? $investor['Investor']['other_names'] : '' ))); ?>
                  </div>
                </div>
				  
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12">
						<img src="<?php echo $this->webroot.(isset($investor['Investor']['investor_photo']) ? substr($investor['Investor']['investor_photo'],1) : '' ) ?>" width="100" height="100" alt="Investor Photo" />
                                <input type="hidden" name="hiddenphoto" value="<?php echo (isset($investor['Investor']['investor_photo']) ? $investor['Investor']['investor_photo'] : '' ) ?>" />
						<?php echo $this->Form->input('investor_photo', array('size' => 10, 'type' => 'file','value' => $this->webroot.(isset($investor['Investor']['investor_photo']) ? $investor['Investor']['investor_photo'] : '' ))); ?>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
						<?php echo $this->Form->input('id_number', array('size' => 15,'value' => (isset($investor['Investor']['id_number']) ? $investor['Investor']['id_number'] : '' ))); ?>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
						<?php echo $this->Form->input('idtype_id', array('default' => 1,'value' => (isset($investor['Investor']['idtype_id']) ? $investor['Investor']['idtype_id'] : '' ),'empty' => (isset($investor['Investor']['id_number']) ? $investor['Idtype']['id_type'] : '' ))); ?>
					</div>
				</div> 
				  
				<div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
					  <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>Date of Birth:</span>".$this->Form->day('dob', array('size' => 1, 'label'=>'D.O.B','value' => (isset($investor['Investor']['dob']) ? date('d',strtotime($investor['Investor']['dob'])) : date('d') ),'empty' => (isset($investor['Investor']['dob']) ? date('d',strtotime($investor['Investor']['dob'])) : date('d') )));  ?>&nbsp;
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
					  <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>".$this->Form->month('dob', array('size' => 1, 'label'=>false,'value' => (isset($investor['Investor']['dob']) ? date('m',strtotime($investor['Investor']['dob'])) : date('m') ),'empty' => (isset($investor['Investor']['dob']) ? date('F',strtotime($investor['Investor']['dob'])) : date('F') ))); ?>&nbsp;
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
					  <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>".$this->Form->year('dob', 1950, date('Y'), array("id" => "is_year", 'type' => 'date', 'dateFormat' => 'Y','size' => 1, "style" => "margin-right: 10px;",'label'=>false,'value' => (isset($investor['Investor']['dob']) ? date('Y',strtotime($investor['Investor']['dob'])) : date('Y') ),'empty' => (isset($investor['Investor']['dob']) ? date('Y',strtotime($investor['Investor']['dob'])) : date('Y')))); ?>
                  </div>
                </div>
					
				<div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
					  <?php echo $this->Form->input('customer_category_id', array('size' => 10,'label'=>'Investor Category','value' => (isset($investor['Investor']['customer_category_id']) ? $investor['CustomerCategory']['customer_category'] : '' ))); ?>
                  </div>
                </div>	
				<div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
					<?php echo $this->Form->input('postal_address', array('size' => 10,'value' => (isset($investor['Investor']['postal_address']) ? $investor['Investor']['postal_address'] : '' ))); ?>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <?php echo $this->Form->input('home_address', array('size' => 10,'value' => (isset($investor['Investor']['home_address']) ? $investor['Investor']['home_address'] : '' ))); ?>
                  </div>
                </div>	
					
				<div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <?php echo $this->Form->input('email', array('size' => 10,'value' => (isset($investor['Investor']['email']) ? $investor['Investor']['email'] : '' ))); ?>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <?php echo $this->Form->input('phone', array('size' => 10,'value' => (isset($investor['Investor']['phone']) ? $investor['Investor']['phone'] : '' ))); ?>
                  </div>
                </div>
                  
				<hr>
					
				<div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
					  <?php echo $this->Form->input('next_of_kin_name', array('size' => 10,'value' => (isset($investor['Investor']['next_of_kin_name']) ? $investor['Investor']['next_of_kin_name'] : '' ))); ?>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
					  <?php echo $this->Form->input('nk_relationship', array('size' => 10,'value' => (isset($investor['Investor']['nk_relationship']) ? $investor['Investor']['nk_relationship'] : '' ))); ?>
                  </div>
                </div>
					
				<div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
					  <?php echo $this->Form->input('nk_postal_address', array('size' => 10,'value' => (isset($investor['Investor']['nk_postal_address']) ? $investor['Investor']['nk_postal_address'] : '' ))); ?>
                  </div>
                </div>	
					
				<div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
					  <?php echo $this->Form->input('nk_email', array('size' => 10,'value' => (isset($investor['Investor']['nk_email']) ? $investor['Investor']['nk_email'] : '' ))); ?>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
					  <?php echo $this->Form->input('nk_phone', array('size' => 10,'value' => (isset($investor['Investor']['nk_phone']) ? $investor['Investor']['nk_phone'] : '' ))); ?>
                  </div>
                </div>	
				  
				<div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
					  <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>Sign-up Date:</span>".$this->Form->day('dob', array('size' => 1, 'label'=>'D.O.B','value' => (isset($investor['Investor']['dob']) ? date('d',strtotime($investor['Investor']['dob'])) : date('d') ),'empty' => (isset($investor['Investor']['dob']) ? date('d',strtotime($investor['Investor']['dob'])) : date('d') )));  ?>&nbsp;
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
					  <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>".$this->Form->month('dob', array('size' => 1, 'label'=>false,'value' => (isset($investor['Investor']['dob']) ? date('m',strtotime($investor['Investor']['dob'])) : date('m') ),'empty' => (isset($investor['Investor']['dob']) ? date('F',strtotime($investor['Investor']['dob'])) : date('F') ))); ?>&nbsp;
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
					  <?php echo "<span style='font-size: 14px;font-weight: bold;line-height: 20px; padding: 10px 0px 10px 0px;'>&nbsp;</span>".$this->Form->year('dob', 1950, date('Y'), array("id" => "is_year", 'type' => 'date', 'dateFormat' => 'Y','size' => 1, "style" => "margin-right: 10px;",'label'=>false,'value' => (isset($investor['Investor']['dob']) ? date('Y',strtotime($investor['Investor']['dob'])) : date('Y') ),'empty' => (isset($investor['Investor']['dob']) ? date('Y',strtotime($investor['Investor']['dob'])) : date('Y')))); ?>
                  </div>
                </div>
				  
				<div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    &nbsp;
                 	</div>
                  <div class="col-lg-6 col-md-6 col-sm-12" align="right">
                     <?php echo $this->Form->button('Save', array("type" => "submit", "id" => "cust_save", "class" => "btn btn-lg btn-success"));   ?>
           
                  </div>
                </div>
                <?php echo $this->Form->end(); ?>

              </div>
            </div>
          </div>
          <!-- Form Elements End --> 
        </div>
    <!-- content ends here -->
<?php echo $this->element('footer'); ?>