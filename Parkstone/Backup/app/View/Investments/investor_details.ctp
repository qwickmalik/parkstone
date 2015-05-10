<?php echo $this->element('header'); ?>

<!-- Content starts here -->
<h3>Investor Details</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4 align="center"><b>
                        <?php if(isset($investor['Investor']['fullname'])){echo $investor['Investor']['fullname'];} else {echo"&nbsp;";} ?>
                        <p>&nbsp;</p></b></h4>
                </div>
                
                
                <!-- first column -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Registration Date:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['registration_date'])){echo $investor['Investor']['registration_date'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Investor Type:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['InvestorType']['investor_type'])){echo $investor['InvestorType']['investor_type'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Date of Birth:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="text-align: right;">
                        <?php if(isset($investor['Investor']['dob'])){echo $investor['Investor']['dob'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>ID Type:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="text-align: right;">
                        <?php if(isset($investor['Investor']['idtype_id'])){echo $investor['Idtype']['id_type'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>ID No.:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="text-align: right;">
                        <?php if(isset($investor['Investor']['id_number'])){echo $investor['Investor']['id_number'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Nationality:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['nationality'])){echo $investor['Investor']['nationality'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;" >
                        <b>Hometown:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['hometown'])){echo $investor['Investor']['hometown'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Birth Place:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['birth_place'])){echo $investor['Investor']['birth_place'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Occupation:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['occupation'])){echo $investor['Investor']['occupation'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Work Place:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['work_place'])){echo $investor['Investor']['work_place'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Position Held:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['position_held'])){echo $investor['Investor']['position_held'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Marital Status:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['marital_status'])){echo $investor['Investor']['marital_status'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>No. of Children:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['children'])){echo $investor['Investor']['children'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Postal Address:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['postal_address'])){echo $investor['Investor']['postal_address'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Phone No.:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['phone'])){echo $investor['Investor']['phone'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Email Address:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['email'])){echo $investor['Investor']['email'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Physical Address:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">&nbsp;
                        <?php if(isset($investor['Investor']['physical_address'])){echo $investor['Investor']['physical_address'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>In Trust For:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['in_trust_for'])){echo $investor['Investor']['in_trust_for'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>ID Expiry DAte:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['id_expiry'])){echo $investor['Investor']['id_expiry'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>ID Issue Date:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['id_issue'])){echo $investor['Investor']['id_issue'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                        <p>&nbsp;</p>
                        <b class="subtitle-green">JOINT INVESTOR DETAILS</b>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>JI Name:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php 
                            if(isset($investor['Investor']['joint_surname'])){echo $investor['Investor']['joint_surname'];} else {echo"&nbsp;";} 
                            echo "&nbsp;";
                            if(isset($investor['Investor']['joint_other_names'])){echo $investor['Investor']['joint_other_names'];} else {echo"&nbsp;";} 
                            
                            ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>JI Date of Birth:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['joint_dob'])){echo $investor['Investor']['joint_dob'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>JI ID Type:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['joint_idtype_id'])){echo $investor['Investor']['joint_idtype_id'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>JI ID No.:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['joint_id_number'])){echo $investor['Investor']['joint_id_number'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>JI ID Issue Date:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['joint_id_issue'])){echo $investor['Investor']['joint_id_issue'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>JI ID Expiry Date:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['joint_id_expiry'])){echo $investor['Investor']['joint_id_expiry'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>JI Phone No.:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['phone'])){echo $investor['Investor']['phone'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>JI Email Address:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['email'])){echo $investor['Investor']['email'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>JI Postal Address:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['joint_postal_address'])){echo $investor['Investor']['joint_postal_address'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    
                </div>
                
                
                
                
                <!-- second column -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Photo:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <img src="<?php echo $this->webroot.(isset($investor['Investor']['investor_photo']) ? substr($investor['Investor']['investor_photo'],1) : '' ) ?>" width="100" height="100" alt="investor_photo" />
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Source of Income:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['source_of_income'])){echo $investor['Investor']['source_of_income'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Gross Income:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['gross_income_id'])){echo $investor['Investor']['gross_income_id'];} else {echo"&nbsp;";} ?>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                        <p>&nbsp;</p>
                        <b class="subtitle-green">NEXT OF KIN DETAILS</b>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Name:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['next_of_kin_name'])){echo $investor['Investor']['next_of_kin_name'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Phone No.:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['nk_phone'])){echo $investor['Investor']['nk_phone'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Postal Address:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['nk_postal_address'])){echo $investor['Investor']['nk_postal_address'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Email Address:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['nk_email'])){echo $investor['Investor']['nk_email'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                        <p>&nbsp;</p>
                        <b class="subtitle-green">CORPORATE DETAILS</b>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>CEO:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['ceo'])){echo $investor['Investor']['ceo'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Nature of Business:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['nature_biz'])){echo $investor['Investor']['nature_biz'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Registration No.:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['reg_numb'])){echo $investor['Investor']['reg_numb'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Inv. Frequency:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['inv_freq'])){echo $investor['Investor']['inv_freq'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Date of Inc.:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['date_incorp'])){echo $investor['Investor']['date_incorp'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Contact Person:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['contact_person'])){echo $investor['Investor']['contact_person'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Position:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['position'])){echo $investor['Investor']['position'];} else {echo"&nbsp;";} ?>&nbsp;
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Institution Type:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['InstitutionType']['inst_type_name'])){echo $investor['InstitutionType']['inst_type_name'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Gross Revenue:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['GrossRevenue']['gross_revenue_name'])){echo $investor['GrossRevenue']['gross_revenue_name'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Contact Mode:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['contact_mode'])){echo $investor['Investor']['contact_mode'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                        <p>&nbsp;</p>
                        <b class="subtitle-green">BANK DETAILS</b>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Account Name:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['acc_name'])){echo $investor['Investor']['acc_name'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Bank:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Bank']['bank_name'])){echo $investor['Bank']['bank_name'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Branch:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['bank_branch'])){echo $investor['Investor']['bank_branch'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                        <b>Account No.:</b>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <?php if(isset($investor['Investor']['acc_number'])){echo $investor['Investor']['acc_number'];} else {echo"&nbsp;";} ?>
                    </div>
                    
                </div>
                
            </div>
            
            
            
    <table id="report_content" border="0" width="100%" cellspacing="0" cellpadding="0" align="left">

        <tr>
            <td align="right" valign="top" colspan="2">
                <?php
                $page = 'editInvestor';
                if(isset($investor['Investor']['investor_type_id'])){
                $investortype = $investor['Investor']['investor_type_id'];
                if($investortype == 2){
                    $page = 'editInvestor';
                }elseif($investortype == 3){
                   $page = 'editInvestorComp';
                }
                }
                echo $this->Html->link('Print', "javascript:void(0)", array("class" => 'btn btn-warning', "id" => "print_report"));?>
                &nbsp;&nbsp;
                <?php echo $this->Html->link('Edit Investor Details',"/Investments/".$page."/".(isset($investor['Investor']['id']) ? $investor['Investor']['id'] : '' ),array("class" => 'btn btn-success')); ?>
            </td>
        </tr>
    </table>
</div>
<!-- Content ends here -->
<?php echo $this->element('footer'); ?>