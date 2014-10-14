<h3>DASHBOARD</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>
		
	<div style="margin-left: 20px;">
		<?php
    echo $this->Html->link('
        <div id="dashboard">' .
            $this->Html->image('investors.png', array())
            . '<p>Investors</p>
        </div>'
    , '/Investments/listInvestor', array('escape' => false));
    ?>          

    <?php
    echo $this->Html->link('
        <div id="dashboard">' .
            $this->Html->image('investments.png', array())
            . '<p>Investments</p>
        </div>'
    , '/Investments/', array('escape' => false));
    ?>
		
		<?php
    echo $this->Html->link('
        <div id="dashboard">' .
            $this->Html->image('payments.png', array())
            . '<p>Payments</p>
        </div>'
    , '/Investments/payments', array('escape' => false));
    ?>
    
    <?php
    echo $this->Html->link('
        <div id="dashboard">' .
            $this->Html->image('company_accounts.png', array())
            . '<p>Accounts</p>
        </div>'
    , '/CompanyAccounts/', array('escape' => false));
    ?>
    
    <?php
    echo $this->Html->link('
        <div id="dashboard">' .
            $this->Html->image('reports.png', array())
            . '<p>Reports</p>
        </div>'
    , '/Reports/', array('escape' => false));
    ?>
		</div>	
	

		
<!------ STATS ------------------>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<!-- Open Tasks Start -->
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
				<div class="box tasks">

					<!-- Title Bar Start -->
					<div class="title-bar">
						<i class="fa fa-user"></i>Important Dates
						<div class="close-box">
							<a href="#"><i class="fa fa-times-circle-o"></i></a>
						</div>
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
			<!-- Open Tasks End -->

			<div style="clear: both;"></div>
			<!-- Social Stats Start -->
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
				<div class="box social-stats">

					<!-- Title Bar Start -->
					<div class="title-bar">
						<i class="fa fa-users"></i>General Stats
						<div class="close-box">
							<a href="#"><i class="fa fa-times-circle-o"></i></a>
						</div>
					</div>
					<!-- Title Bar End -->

					<!-- Social Stats List Start -->
					<ul>
						<li><i class="fa fa-arrow-right"></i> No. of Clients <span>1,425</span></li>
						<li><i class="fa fa-arrow-right"></i> Total Client Investments <span>GHC 251,546</span></li>
						<li><i class="fa fa-arrow-right"></i> Total Company Investments <span>GHC 351,546</span></li>
						<li><i class="fa fa-arrow-right"></i> Expected Client Payments for Current Mth <span>GHC 311,546</span></li>
						<li><i class="fa fa-arrow-right"></i> Expected Comp Inv Returns for Current Mth <span>GHC 451,546</span></li>
						<li><i class="fa fa-arrow-right"></i> Profit <span>GHC 140,000</span></li>
					</ul>
					<!-- Social Stats List End -->

				</div>
			</div>
			<!-- Social Stats End -->	

		</div>
		
		