<!-- Menu Start -->
<ul class="menu">
    <li class="lightblue">
        <?php
        echo $this->Html->link('
        		<span class="menu-icon"><i class="fa fa-home"></i></span>
            	<span class="menu-text">Dashboard</span>'
                , '/Dashboard/', array('escape' => false));
        ?>
    </li>
    <li class="parent lightyellow">
        <a href="#">
            <span class="menu-icon"><i class="fa fa-users"></i></span>
            <span class="menu-text">Investors</span>
        </a>
        <ul class="child">
            <li>
                <?php echo $this->Html->link('Add New Investor', '/Investments/newInvestor', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Approve Investors', '/Investments/approveInvestors', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('List/Edit Investors', '/Investments/listInvestor', array('escape' => false)); ?>
            </li>
        </ul>
    </li>

    <li class="parent cream">
        <a href="#">
            <span class="menu-icon"><i class="fa fa-money"></i></span>
            <span class="menu-text">Inbound Investments</span>
        </a>
        <ul class="child">
            <li>
                <?php echo $this->Html->link('New Investment', '/Investments/newInvestment0', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Manage Investments', '/Investments/clearManageSessions', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Daily Maturity List', '/Investments/maturityList', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Monthly Maturity List', '/Investments/monthlyMaturityList', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Approve Terminations', '/Investments/approveTerminations', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Approve Payments', '/Investments/approvePayments', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Make Payments', '/Investments/processPayments', array('escape' => false)); ?>
            </li>

        </ul>
    </li>
    <li class="parent cream">
        <a href="#">
            <span class="menu-icon"><i class="fa fa-money"></i></span>
            <span class="menu-text">Outbound Investments</span>
        </a>
        <ul class="child">
           
            <li>
                <?php echo $this->Html->link('Process Investment', '/Reinvestments/newInvestment', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Manage Investments', '/Reinvestments/manageInv', array('escape' => false)); ?>
            </li>
            
            <li>
                <?php echo $this->Html->link('Daily Maturity List', '/Reinvestments/maturityList', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Monthly Maturity List', '/Reinvestments/monthlyMaturityList', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Disposal Requests', '/Reinvestments/disposalList', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('New/Edit Inv. Destination', '/Reinvestments/newInvestmentDestination', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Inv. Destination Products', '/Reinvestments/invDestProduct', array('escape' => false)); ?>
            </li> 
        </ul>
    </li>
<!--    <li class="parent cream">
        <a href="#">
            <span class="menu-icon"><i class="fa fa-money"></i></span>
            <span class="menu-text">Fund Management</span>
        </a>
        <ul class="child">
            <li>
                <?php // echo $this->Html->link('New/Edit Client', '/FundManagement/newReinvestor', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('Client Cash Deposit', '/FundManagement/newCashDeposit', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('List/Edit Cash Deposits', '/FundManagement/listCashDeposits', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('Investment Destinations', '#', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('New/Edit Inv. Destination', '/FundManagement/newInvestmentDestination', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('Inv. Destination Products', '/FundManagement/invDestProduct', array('escape' => false)); ?>
            </li> 
            
            <li>
                <?php // echo $this->Html->link('Pay Client Funds', '/FundManagement/manageInv', array('escape' => false)); ?>
            </li>
             <li>
                <?php // echo $this->Html->link('Invest Fund', '/FundManagement/newInvestment', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('Manage Invested Funds', '/FundManagement/manageInv', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('New/Edit Inv. Destination', '/FundManagement/newInvestmentDestination', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('Inv. Destination Products', '/FundManagement/invDestProduct', array('escape' => false)); ?>
            </li>
        </ul>
        </li>-->
    <!--<li class="lightyellow">-->
    <?php
//        echo $this->Html->link('
//        		<span class="menu-icon"><i class="fa fa-money"></i></span>
//            	<span class="menu-text">Payments</span>'
//                , '/Investments/processPayments', array('escape' => false));
    ?>
    <!--</li>-->
    <!--    <li class="lightyellow">
    <?php
//        echo $this->Html->link('
//        		<span class="menu-icon"><i class="fa fa-file-text-o"></i></span>
//            	<span class="menu-text">Company Accounts</span>'
//                , '/CompanyAccounts/', array('escape' => false));
    ?>
        </li>-->
<!--    <li class="parent lightyellow">
        <a href="#">
            <span class="menu-icon"><i class="fa fa-file-text-o"></i></span>
            <span class="menu-text">Company Accounts</span>
        </a>
        <ul class="child">
            <li>
                <?php // echo $this->Html->link('Dashboard', '/CompanyAccounts/', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('Bank Transactions', '/CompanyAccounts/bankTransactions', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('Asset Management', '/CashAccounts/listAssets', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('Petty Cash Expenses', '/CashAccounts/pettyCash', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('Receivables', '/CashAccounts/receivables', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('Expenses', '/CashAccounts/expenses', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('New Cash Entry', '/CashAccounts/', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('Find Cash Entry', '/CashAccounts/findEntry', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('Delete Cash Entry', '/CashAccounts/deleteEntry', array('escape' => false)); ?>
            </li>
            <li>
                <?php // echo $this->Html->link('Authorize Cash Entry', '/CashAccounts/authorizeEntry', array('escape' => false)); ?>
            </li>
        </ul>
    </li>-->
<li class="parent lightyellow">
        <a href="#">
            <span class="menu-icon"><i class="fa fa-columns"></i></span>
            <span class="menu-text">Accounting</span>
        </a>
        <ul class="child">
            <li>
                <?php echo $this->Html->link('Revenue/Income', '/Accounting/income', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Expenses', '/Accounting/expenses', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Assets', '/Accounting/assets', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Liabilities', '/Accounting/liabilities', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Owners Equity', '/Accounting/ownerEquity', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Cash/Bank Transfers', '/Accounting/bankTransfers', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Cash/Bank Account Balances', '/Accounting/bankBalances', array('escape' => false)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Stated Bank Account Balances', '/Accounting/statedBankBalances', array('escape' => false)); ?>
            </li>
        </ul>
    </li>
    <li class="lightorange">
        <?php
        echo $this->Html->link('
        		<span class="menu-icon"><i class="fa fa-signal"></i></span>
            	<span class="menu-text">Reports</span>'
                , '/Reports/', array('escape' => false));
        ?>
    </li>
    <li class="pink">
        <?php
        echo $this->Html->link('
        		<span class="menu-icon"><i class="fa fa-cogs"></i></span>
            	<span class="menu-text">Settings</span>'
                , '/Settings/', array('escape' => false));
        ?>
    </li>


    <!--  
    <li class="purple">
            <a href="invoice.html">
                <span class="menu-icon"><i class="fa fa-money"></i></span>
                <span class="menu-text">Invoice</span>
            </a>
        </li>
        <li class="parent purple">
            <a href="">
                <span class="menu-icon"><i class="fa fa-desktop"></i></span>
                <span class="menu-text">Layouts</span>
            </a>
            <ul class="child">
                <li>
                    <a href="index-fixed-sidebar.html">Fixed Sidebar</a>
                </li>
                <li>
                    <a href="index-collapsed-sidebar.html">Collapsed Sidebar</a>
                </li>
                <li>
                    <a href="index-fixed-header-bar.html">Fixed Header Bar</a>
                </li>
            </ul>
        </li>
        <li class="orange">
            <a href="animated.html">
                <span class="menu-icon"><i class="fa fa-css3"></i></span>
                <span class="menu-text">Animated Elements</span>
                <span class="notification lightgreen">62</span>
            </a>
        </li>
        <li class="parent lightred active">
            <a href="">
                <span class="menu-icon"><i class="fa fa-windows"></i></span>
                <span class="menu-text">Pages</span>
            </a>
            <ul class="child">
                <li>
                    <a href="coming-soon.html">Coming Soon Page</a>
                </li>
                <li>
                    <a href="login.html">Login Page</a>
                </li>
                <li>
                    <a href="register.html">Register Page</a>
                </li>
                <li>
                    <a href="mail.html">Mail Page</a>
                </li>
                <li>
                    <a href="mail-compose.html">Mail Compose Page</a>
                </li>
                <li>
                    <a href="404.html">404 Error Page</a>
                </li>
                <li>
                    <a href="500.html">500 Error Page</a>
                </li>
                <li>
                    <a href="blank.html">Blank Page</a>
                </li>
                <li>
                    <a href="profile.html">Profile Page</a>
                </li>
            </ul>
        </li>
        
        <li class="parent green">
            <a href="">
                <span class="menu-icon"><i class="fa fa-rocket"></i></span>
                <span class="menu-text">UI Elements</span>
            </a>
            <ul class="child">
                <li>
                    <a href="modals.html">Modals & Alerts</a>
                </li>
                <li>
                    <a href="modals.html">ToolTips</a>
                </li>
                <li>
                    <a href="general.html">General</a>
                </li>
                <li>
                    <a href="buttons.html">Buttons</a>
                </li>
                <li>
                    <a href="grid.html">Grids</a>
                </li>
                <li>
                    <a href="calendar.html">Calendar</a>
                </li>
                <li>
                    <a href="tocify.html">Tocify</a>
                </li>
                <li>
                    <a href="tables.html">Tables</a>
                </li>
            </ul>
        </li>
        <li class="blue">
            <a href="icons.html">
                <span class="menu-icon"><i class="fa  fa-asterisk"></i></span>
                <span class="menu-text">Icons</span>
                <span class="notification purple">7</span>
            </a>
        </li>
        <li class="parent lightblue">
            <a href="">
                <span class="menu-icon"><i class="fa fa-map-marker"></i></span>
                <span class="menu-text">Maps</span>
                <span class="notification lightblue">21</span>
            </a>
            <ul class="child">
                <li>
                    <a href="google-maps.html">Google Maps</a>
                </li>
                <li>
                    <a href="vector-maps.html">Vector Maps</a>
                </li>
            </ul>
        </li>
        
        <li class="parent lightyellow">
            <a href="">
                <span class="menu-icon"><i class="fa fa-book"></i></span>
                <span class="menu-text">Forms</span>
            </a>
            <ul class="child">
                <li>
                    <a href="general-forms.html">General Form Elements</a>
                </li>
                <li>
                    <a href="smart-forms.html">Smart Form Elements</a>
                </li>
                <li>
                    <a href="form-wizards.html">Form Wizards</a>
                </li>
            </ul>
        </li>
        
        
        <li class="marine">
            <a href="tabs.html">
                <span class="menu-icon"><i class="fa fa-bars"></i></span>
                <span class="menu-text">Tabs & Accordions</span>
            </a>
        </li>
        <li class="darkblue">
            <a href="projects.html">
                <span class="menu-icon"><i class="fa fa-folder-open-o"></i></span>
                <span class="menu-text">Projects</span>
            </a>
        </li>
        <li class="lightyellow">
            <a href="tasks.html">
                <span class="menu-icon"><i class="fa fa-file-text-o"></i></span>
                <span class="menu-text">Tasks</span>
            </a>
        </li>
    -->
</ul>
<!-- Menu End -->