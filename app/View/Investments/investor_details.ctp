<?php
echo $this->Html->script('notification.js');

?>

<!-- Content starts here -->
<h3>Investor Details</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>

    <table id="report_content" border="0" width="100%" cellspacing="0" cellpadding="0" align="left">
        <tr>
            <td align="right" valign="top">&nbsp;</td>
            <td align="right" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top" colspan="2">
                <?php
               // echo "<div id='form_sep'>Applicant name &amp Address</div>";
                ?>
            </td>
        </tr>
        <tr>
            <td align="left" valign="top">
                <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">
                    <tr>
                        <td align="right" valign="top" width="35%">
                            <b>Registration Date:</b>
                        </td>
                        <td align="left" valign="top" width="65%">
                            <?php if(isset($investor['Investor']['registration_date'])){echo $investor['Investor']['registration_date'];} ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">
                            <b>Surname:</b>
                        </td>
                        <td align="left" valign="top">
                            <?php if(isset($investor['Investor']['surname'])){echo $investor['Investor']['surname'];} ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">
                            <b>Other Names:</b>
                        </td>
                        <td align="left" valign="top">
                            <?php if(isset($investor['Investor']['other_names'])){echo $investor['Investor']['other_names'];} ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">
                            <b>Date of Birth:</b>
                        </td>
                        <td align="left" valign="top">
                            <?php if(isset($investor['Investor']['dob'])){echo $investor['Investor']['dob'];} ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">
                            <b>ID Number:</b>
                        </td>
                        <td align="left" valign="top">
                            <?php if(isset($investor['Investor']['id_number'])){echo $investor['Investor']['id_number'];} ?>
                        </td>
                    </tr>
					<tr>
                        <td align="right" valign="top">
                            <b>ID Type:</b>
                        </td>
                        <td align="left" valign="top">
                            <?php if(isset($investor['Investor']['idtype_id'])){echo $investor['Investor']['idtype_id'];} ?>
                        </td>
                    </tr>
                   
                </table>
            </td> 
        
            <td align="left" valign="top">
                <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">
                    <tr>
                        <td align="right" valign="top" width="35">
                            <b>Investor Category:</b>
                        </td>
                        <td align="left" valign="top" width="65%">
                         <?php if(isset($investor['Investor']['customer_category_id'])){echo $investor['CustomerCategory']['customer_category'];} ?>
                        </td>
                    </tr>
					<tr>
                        <td align="right" valign="top" width="35">
                            <b>Investor Photo:</b>
                        </td>
                        <td align="left" valign="top" width="65%">
                         
                            <div id="cust_photo">
                                <img src="<?php echo $this->webroot.(isset($investor['Investor']['investor_photo']) ? substr($investor['Investor']['investor_photo'],1) : '' ) ?>" width="100" height="100" alt="investor_photo" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">
                            <b>Next of Kin Name:</b>
                        </td>
                        <td align="left" valign="top">
                            <?php if(isset($investor['Investor']['next_of_kin_name'])){echo $investor['Investor']['next_of_kin_name'];} ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">
                            <b>NK Relationship:</b>
                        </td>
                        <td align="left" valign="top">
                            <?php if(isset($investor['Investor']['nk_relationship'])){echo $investor['Investor']['nk_relationship'];} ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">
                            <b>NK Postal Address:</b>
                        </td>
                        <td align="left" valign="top">
                            <?php if(isset($investor['Investor']['nk_postal_address'])){echo $investor['Investor']['nk_postal_address'];} ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">
                            <b>NK Email:</b>
                        </td>
                        <td align="left" valign="top">
                            
                               <?php if(isset($investor['Investor']['nk_email'])){echo $investor['Investor']['nk_email'];} ?> 
<!--                           <div id="signature"> </div>-->
                            
                        </td>
                    </tr>
                     <tr>
                        <td align="right" valign="top">
                            <b>NK Phone:</b>
                        </td>
                        <td align="left" valign="top">
                            
                               <?php if(isset($investor['Investor']['nk_phone'])){echo $investor['Investor']['nk_phone'];} ?> 
<!--                           <div id="signature"> </div>-->
                            
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2"> 
				<?php 
				//echo "<div id='form_sep'>Contact Details</div>"; 
				?>
			</td>
        </tr>
        <tr>
            <td align="left" valign="top">
                <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">
                    <tr>
                        <td align="right" valign="top" width="35%">
                            <b>Phone No.:</b>
                        </td>
                        <td align="left" valign="top" width="65%">
                            <?php if(isset($investor['Investor']['phone'])){echo $investor['Investor']['phone'];} ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">
                            <b>Postal Address.:</b>
                        </td>
                        <td align="left" valign="top">
                            <?php if(isset($investor['Investor']['postal_address'])){echo $investor['Investor']['postal_address'];} ?>
                        </td>
                    </tr>
					 <tr>
                        <td align="right" valign="top">
                            <b>Home Address:</b>
                        </td>
                        <td align="left" valign="top">
                            <?php if(isset($investor['Investor']['home_address'])){echo $investor['Investor']['home_address'];} ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">
                            <b>Email:</b>
                        </td>
                        <td align="left" valign="top">
                            <?php if(isset($investor['Investor']['email'])){echo $investor['Investor']['email'];} ?>
                        </td>
                    </tr>
                   
                  
                </table>
            </td>
        </tr>
        
        <tr>
            <td align="right" valign="top" colspan="2">
                <?php
                echo $this->Html->link('Print', "javascript:void(0)", array("class" => 'btn btn-warning', "id" => "print_report"));?>
                &nbsp;&nbsp;
                <?php echo $this->Html->link('Edit Investor Details',"/Investments/editInvestor/".(isset($investor['Investor']['id']) ? $investor['Investor']['id'] : '' ),array("class" => 'btn btn-success')); ?>
            </td>
        </tr>
    </table>
</div>
<!-- Content ends here -->
