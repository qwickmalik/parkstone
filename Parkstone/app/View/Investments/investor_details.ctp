<?php
echo $this->element('header');
echo $this->Html->script('jquery.js');
echo $this->Html->script('jquery.printElement.js');

echo $this->Html->script('print.js');
?>

<!-- Content starts here -->
<h3>Investor Details</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></td>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4 align="center"><b>
                            <?php
                            if (isset($investor['Investor']['fullname'])) {
                                echo $investor['Investor']['fullname'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                            <p>&nbsp;</p></b></h4>
                    </td>


                    <!-- first column -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <table class="table table-striped">
                            <tr><td width="30%" text-align="right" v-align="middle">
                                    <b>Registration Date:</b>
                                </td>
                                <td text-align="left" v-align="middle">
                                    <?php
                                    if (isset($investor['Investor']['registration_date'])) {
                                        echo $investor['Investor']['registration_date'];
                                    } else {
                                        echo"&nbsp;";
                                    }
                                    ?>
                                </td>

                            </tr><tr><td width="30%" text-align="right" v-align="middle">
                                    <b>Investor Type:</b>
                                </td>
                                <td text-align="left" v-align="middle">
                                    <?php
                                    if (isset($investor['InvestorType']['investor_type'])) {
                                        echo $investor['InvestorType']['investor_type'];
                                    } else {
                                        echo"&nbsp;";
                                    }
                                    ?>
                                </td>

                            </tr><tr><td width="30%" text-align="right" v-align="middle">
                                    <b>Date of Birth:</b>
                                </td>
                                <td text-align="left" v-align="middle">
                                    <?php
                                    if (isset($investor['Investor']['dob'])) {
                                        echo $investor['Investor']['dob'];
                                    } else {
                                        echo"&nbsp;";
                                    }
                                    ?>
                                </td>

                            </tr><tr><td width="30%" text-align="right" v-align="middle">
                                    <b>ID Type:</b>
                                </td>
                                <td text-align="left" v-align="middle">
                                    <?php
                                    if (isset($investor['Investor']['idtype_id'])) {
                                        echo $investor['Idtype']['id_type'];
                                    } else {
                                        echo"&nbsp;";
                                    }
                                    ?>
                                </td>

                            </tr><tr><td width="30%" text-align="right" v-align="middle">
                                    <b>ID No.:</b>
                                </td>
                                <td text-align="left" v-align="middle">
                                    <?php
                                    if (isset($investor['Investor']['id_number'])) {
                                        echo $investor['Investor']['id_number'];
                                    } else {
                                        echo"&nbsp;";
                                    }
                                    ?>
                                </td>

                            </tr><tr><td width="30%" text-align="right" v-align="middle">
                                    <b>Nationality:</b>
                                </td>
                                <td text-align="left" v-align="middle">
                                    <?php
                                    if (isset($investor['Investor']['nationality'])) {
                                        echo $investor['Investor']['nationality'];
                                    } else {
                                        echo"&nbsp;";
                                    }
                                    ?>
                                </td>

                            </tr><tr><td width="30%" text-align="right" v-align="middle">
                                    <b>Hometown:</b>
                                </td>
                                <td text-align="left" v-align="middle">
                                    <?php
                                    if (isset($investor['Investor']['hometown'])) {
                                        echo $investor['Investor']['hometown'];
                                    } else {
                                        echo"&nbsp;";
                                    }
                                    ?>
                                </td>

                            </tr><tr><td width="30%" text-align="right" v-align="middle">
                                    <b>Birth Place:</b>
                                </td>
                                <td text-align="left" v-align="middle">
                                    <?php
                                    if (isset($investor['Investor']['birth_place'])) {
                                        echo $investor['Investor']['birth_place'];
                                    } else {
                                        echo"&nbsp;";
                                    }
                                    ?>
                                </td>

                            </tr><tr><td width="30%" text-align="right" v-align="middle">
                                    <b>Occupation:</b>
                                </td>
                                <td text-align="left" v-align="middle">
                                    <?php
                                    if (isset($investor['Investor']['occupation'])) {
                                        echo $investor['Investor']['occupation'];
                                    } else {
                                        echo"&nbsp;";
                                    }
                                    ?>
                                </td>

                            </tr><tr><td width="30%" text-align="right" v-align="middle">
                                    <b>Work Place:</b>
                                </td>
                                <td text-align="left" v-align="middle">
                                    <?php
                                    if (isset($investor['Investor']['work_place'])) {
                                        echo $investor['Investor']['work_place'];
                                    } else {
                                        echo"&nbsp;";
                                    }
                                    ?>
                                </td>

                            </tr><tr><td width="30%" text-align="right" v-align="middle">
                                    <b>Position Held:</b>
                                </td>
                                <td text-align="left" v-align="middle">
                                    <?php
                                    if (isset($investor['Investor']['position_held'])) {
                                        echo $investor['Investor']['position_held'];
                                    } else {
                                        echo"&nbsp;";
                                    }
                                    ?>
                                </td>

                            </tr><tr><td width="30%" text-align="right" v-align="middle">
                                    <b>Marital Status:</b>
                                </td>
                                <td text-align="left" v-align="middle">
                                    <?php
                                    if (isset($investor['Investor']['marital_status'])) {
                                        echo $investor['Investor']['marital_status'];
                                    } else {
                                        echo"&nbsp;";
                                    }
                                    ?>
                                </td>

                            </tr><tr><td width="30%" text-align="right" v-align="middle">
                                    <b>No. of Children:</b>
                                </td>
                                <td text-align="left" v-align="middle">
                                    <?php
                                    if (isset($investor['Investor']['children'])) {
                                        echo $investor['Investor']['children'];
                                    } else {
                                        echo"&nbsp;";
                                    }
                                    ?>
                                </td>
                            <br />
                        </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Postal Address:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['postal_address'])) {
                                echo $investor['Investor']['postal_address'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Phone No.:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['phone'])) {
                                echo $investor['Investor']['phone'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Email Address:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['email'])) {
                                echo $investor['Investor']['email'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Physical Address:</b>
                        </td>
                        <td text-align="left" v-align="middle">&nbsp;
                            <?php
                            if (isset($investor['Investor']['physical_address'])) {
                                echo $investor['Investor']['physical_address'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>In Trust For:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['in_trust_for'])) {
                                echo $investor['Investor']['in_trust_for'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>ID Expiry DAte:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['id_expiry'])) {
                                echo $investor['Investor']['id_expiry'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>ID Issue Date:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['id_issue'])) {
                                echo $investor['Investor']['id_issue'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>
                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Photo:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php 
                            $user_id = $investor['Investor']['id'];
                            $user_photo = $this->Html->url(array('controller' => 'Investments', 'action' => 'display_user_image', $user_id)); ?>
                                          
                                            <?php
                                            $check = $this->requestAction('/Investments/countUserImage/'.(isset($user_id)? $user_id:''));
                                            if(isset($user_photo) && !empty($user_photo) && !empty($check)){ ?>
                                                <img src="<?php echo $user_photo;?>"  width="100" height="100" alt="investor_photo"> 
                                           <?php
                                           }else{ ?>
                                                 <?php echo $this->Html->image('user-default.png', array('width'=>'100','height'=>"100")); ?>   
                                          <?php 
                                          }
                                          ?>
                            <!--<img src="<?php // echo $this->webroot . (isset($investor['Investor']['investor_photo']) ? substr($investor['Investor']['investor_photo'], 1) : '' ) ?>" width="100" height="100" alt="investor_photo" />-->
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Source of Income:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['source_of_income'])) {
                                echo $investor['Investor']['source_of_income'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Gross Income:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['gross_income_id'])) {
                                echo $investor['Investor']['gross_income_id'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td colspan="2" align="center">
                            <p>&nbsp;</p>
                            <b class="subtitle-blue">JOINT INVESTOR DETAILS</b>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>JI Name:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['joint_surname'])) {
                                echo $investor['Investor']['joint_surname'];
                            } else {
                                echo"&nbsp;";
                            }
                            echo "&nbsp;";
                            if (isset($investor['Investor']['joint_other_names'])) {
                                echo $investor['Investor']['joint_other_names'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>JI Date of Birth:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['joint_dob'])) {
                                echo $investor['Investor']['joint_dob'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>JI ID Type:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['joint_idtype_id'])) {
                                echo $investor['Investor']['joint_idtype_id'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>JI ID No.:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['joint_id_number'])) {
                                echo $investor['Investor']['joint_id_number'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>JI ID Issue Date:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['joint_id_issue'])) {
                                echo $investor['Investor']['joint_id_issue'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>JI ID Expiry Date:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['joint_id_expiry'])) {
                                echo $investor['Investor']['joint_id_expiry'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>JI Phone No.:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['phone'])) {
                                echo $investor['Investor']['phone'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>JI Email Address:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['email'])) {
                                echo $investor['Investor']['email'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>JI Postal Address:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['joint_postal_address'])) {
                                echo $investor['Investor']['joint_postal_address'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>




            <!-- second column -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <table class="table table-striped">
                    <tr><td colspan="2" align="center">
                            <p>&nbsp;</p>
                            <b class="subtitle-blue">NEXT OF KIN DETAILS</b>
                        </td>
                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Name:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['next_of_kin_name'])) {
                                echo $investor['Investor']['next_of_kin_name'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Phone No.:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['nk_phone'])) {
                                echo $investor['Investor']['nk_phone'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Postal Address:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['nk_postal_address'])) {
                                echo $investor['Investor']['nk_postal_address'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Email Address:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['nk_email'])) {
                                echo $investor['Investor']['nk_email'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td colspan="2" align="center">
                            <p>&nbsp;</p>
                            <b class="subtitle-blue">CORPORATE DETAILS</b>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>CEO:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['ceo'])) {
                                echo $investor['Investor']['ceo'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Nature of Business:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['nature_biz'])) {
                                echo $investor['Investor']['nature_biz'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Registration No.:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['reg_numb'])) {
                                echo $investor['Investor']['reg_numb'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Inv. Frequency:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['inv_freq'])) {
                                echo $investor['Investor']['inv_freq'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Date of Inc.:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['date_incorp'])) {
                                echo $investor['Investor']['date_incorp'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Contact Person:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['contact_person'])) {
                                echo $investor['Investor']['contact_person'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Position:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['position'])) {
                                echo $investor['Investor']['position'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>&nbsp;
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Institution Type:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['InstitutionType']['inst_type_name'])) {
                                echo $investor['InstitutionType']['inst_type_name'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Gross Revenue:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['GrossRevenue']['gross_revenue_name'])) {
                                echo $investor['GrossRevenue']['gross_revenue_name'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Contact Mode:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['contact_mode'])) {
                                echo $investor['Investor']['contact_mode'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td colspan="2" align="center">
                            <p>&nbsp;</p>
                            <b class="subtitle-blue">BANK DETAILS</b>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Account Name:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['acc_name'])) {
                                echo $investor['Investor']['acc_name'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Bank:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Bank']['bank_name'])) {
                                echo $investor['Bank']['bank_name'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Branch:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['bank_branch'])) {
                                echo $investor['Investor']['bank_branch'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>

                    </tr><tr><td width="30%" text-align="right" v-align="middle">
                            <b>Account No.:</b>
                        </td>
                        <td text-align="left" v-align="middle">
                            <?php
                            if (isset($investor['Investor']['acc_number'])) {
                                echo $investor['Investor']['acc_number'];
                            } else {
                                echo"&nbsp;";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

        </div>



        <table id="report_content" border="0" width="100%" cellspacing="0" cellpadding="0" align="left">

            <tr>
                <td align="right" valign="top" colspan="2">
                    <?php
                    $page = 'editInvestor';
                    if (isset($investor['Investor']['investor_type_id'])) {
                        $investortype = $investor['Investor']['investor_type_id'];
                        if ($investortype == 2) {
                            $page = 'editInvestor';
                        } elseif ($investortype == 3) {
                            $page = 'editInvestorComp';
                        }
                    }
                    echo $this->Html->link('Print', "javascript:void(0)", array("class" => 'btn btn-warning', "id" => "print_report"));
                    ?>
                    &nbsp;&nbsp;
                    <?php echo $this->Html->link('Edit Investor Details', "/Investments/" . $page . "/" . (isset($investor['Investor']['id']) ? $investor['Investor']['id'] : '' ), array("class" => 'btn btn-success')); ?>
                </td>
            </tr>
        </table>
    </div>
    <!-- Content ends here -->
    <?php echo $this->element('footer'); ?>