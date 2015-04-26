<?php echo $this->element('header'); ?>

<h3>DASHBOARD</h3>
<div class="boxed">
    <div class="nothing">
        <div id="clearer"></div>

        <!--<div style="margin-left: 20px;">-->
        <?php
//    echo $this->Html->link('
//        <div id="dashboard">' .
//            $this->Html->image('investors.png', array())
//            . '<p>Investors</p>
//        </div>'
//    , '/Investments/listInvestor', array('escape' => false));
        ?>          

        <?php
//    echo $this->Html->link('
//        <div id="dashboard">' .
//            $this->Html->image('investments.png', array())
//            . '<p>Investments</p>
//        </div>'
//    , '/Investments/', array('escape' => false));
        ?>

        <?php
//    echo $this->Html->link('
//        <div id="dashboard">' .
//            $this->Html->image('payments.png', array())
//            . '<p>Payments</p>
//        </div>'
//    , '/Investments/payments', array('escape' => false));
//    
        ?>

        <?php
//    echo $this->Html->link('
//        <div id="dashboard">' .
//            $this->Html->image('company_accounts.png', array())
//            . '<p>Accounts</p>
//        </div>'
//    , '/CompanyAccounts/', array('escape' => false));
        ?>

        <?php
//echo $this->Html->link('
////        <div id="dashboard">' .
//            $this->Html->image('reports.png', array())
//            . '<p>Reports</p>
//        </div>'
//    , '/Reports/', array('escape' => false));
        ?>
        <!--</div>-->	



        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >
            <!-- Pending Approvals Start -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                <div class="box daily-traffic">

                    <!-- Title Bar Start -->
                    <div class="standalone-title-bar red">
                        <i class="fa fa-check-square"></i>
                        Pending Approvals
                    </div>
                    <!-- Title Bar End -->

                    <div class="inner" style="box-shadow: none;">
                        <div class="col-md-4">
                            <h3>New Investors</h3>
                            <div class="count-to">
                                <?php
                                if ($this->Session->check('public_unapproved_investors')) {
                                    echo $this->Session->read('public_unapproved_investors');
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3>Terminations</h3>
                            <div class="count-to">
                                <?php
                                if ($this->Session->check('public_termination_req')) {
                                    echo $this->Session->read('public_termination_req');
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3>Payments</h3>
                            <div class="count-to">
                                <?php
                                if ($this->Session->check('public_payment_req')) {
                                    echo $this->Session->read('public_payment_req');
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Pending Approvals End -->


            <div style="clear: both;"></div>
            <!-- General Stats Start -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                <div class="box social-stats">
                    <!-- Title Bar Start -->
                    <div class="standalone-title-bar dodgerblue">
                        <i class="fa fa-users"></i>
                        General Stats
                    </div>
                    <!-- Title Bar End -->

                    <!-- General Stats List Start -->
                    <?php
                    $amount = 0;
                    if (isset($investments)) {
                        foreach ($investments as $invest) {
                            $amount +=$invest[0]['amt'];
                        }
                    }
                    ?>
                    <ul>
                        <li><i class="fa fa-arrow-right"></i> No. of Clients <span><?php
                                if (isset($clients)) {
                                    echo $clients;
                                } else {
                                    echo '1,425';
                                };
                                ?></span></li>
                        <li><i class="fa fa-arrow-right"></i> Total Client Investments <span><?php
                                if (isset($amount)) {
                                    echo 'GH$ ' . number_format($amount, 2, '.', ',');
                                } else {
                                    echo 'GH$ 251,546';
                                };
                                ?></span></li>
                        <li><i class="fa fa-arrow-right"></i> Total Company Investments <span>GH$ 351,546</span></li>
                        <li><i class="fa fa-arrow-right"></i> Expected Client Payments for Current Mth <span>GH$ 311,546</span></li>
                        <li><i class="fa fa-arrow-right"></i> Expected Comp Inv Returns for Current Mth <span>GH$ 451,546</span></li>
                        <li><i class="fa fa-arrow-right"></i> Profit <span>GH$ 140,000</span></li>
                    </ul>
                    <!-- General Stats List End -->

                </div>
            </div>
            <!-- General Stats End -->	

        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >
            <!-- Important DAtes Start -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >
                <div class="box tasks">

                    <!-- Title Bar Start -->
                    <!--                    <div class="title-bar">
                                            <i class="fa fa-user"></i>Important Dates
                                            <div class="close-box">
                                                <a href="#"><i class="fa fa-times-circle-o"></i></a>
                                            </div>
                                        </div>-->
                    <div class="standalone-title-bar purple">
                        <i class="fa fa-user"></i>
                        Important Dates
                    </div>
                    <!-- Title Bar End -->

                    <!-- Stats List Start -->
                    <ul>
                        <li>Monthly payments due on <span>Jan 7th, 2014</span></li>
                        <li>Financial year starts <span>1st July</span></li>
                    </ul>
                    <!-- Stats List End -->

                </div>
            </div>
            <!-- Important DAtes End -->
        </div>

<?php echo $this->element('footer'); ?>