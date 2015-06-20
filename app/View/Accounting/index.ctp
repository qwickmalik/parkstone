<!-- Header starts here -->
<?php echo $this->element('header'); ?>
<!-- Header ends here -->



    <h1>Financial Accounting</h1>
    <div id="clearer"></div>
    <div id="content_menu">
        <?php
        
        $related = array(
            $this->Html->link($this->Html->image('plus.png') . 'Banks', '/Settings/banks', array('escape' => false)),
            $this->Html->link($this->Html->image('plus.png') . 'Cash Accounts/Repositories', '/Settings/cashAccounts', array('escape' => false)),
            $this->Html->link($this->Html->image('plus.png') . 'Transaction Categories', '/Settings/transactionCategories', array('escape' => false)),
        );
        echo $this->Html->nestedList($related, $tag = 'ul');
        ?>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!-- Panels start here -->
            <div id="panel">
                <?php
                echo $this->Html->link($this->Html->image('expenses.png', array('width' => '90', 'height' => '90')), '/Accounting/expenses', array('escape' => false));
                ?>
                <div id="panel_txt">
                    <h2>Expenses</h2>
                    <p>Enter and update expenses here e.g. salaries, utility bills, etc.</p>
                </div>
            </div>

            <div id="panel">
                <?php
                echo $this->Html->link($this->Html->image('income.png', array('width' => '90', 'height' => '90')), '/Accounting/income', array('escape' => false));
                ?>
                <div id="panel_txt">
                    <h2>Income/Revenue</h2>
                    <p>Enter and update income here</p>
                </div>
            </div>

            <div id="panel">
                <?php
                echo $this->Html->link($this->Html->image('assets.png', array('width' => '90', 'height' => '90')), '/Accounting/assets', array('escape' => false));
                ?>
                <div id="panel_txt">
                    <h2>Assets</h2>
                    <p>Manage company assets here</p>
                </div>
            </div>
            
            <div id="panel">
                <?php
                echo $this->Html->link($this->Html->image('liabilities.png', array('width' => '90', 'height' => '90')), '/Accounting/liabilities', array('escape' => false));
                ?>
                <div id="panel_txt">
                    <h2>Liabilities</h2>
                    <p>Manage company liabilities here</p>
                </div>
            </div>
            
            <div id="panel">
                <?php
                echo $this->Html->link($this->Html->image('owner_equity.png', array('width' => '90', 'height' => '90')), '/Accounting/ownerEquity', array('escape' => false));
                ?>
                <div id="panel_txt">
                    <h2>Owner Equity</h2>
                    <p>Enter and update Owner Equity transactions here</p>
                </div>
            </div>
            
            <div id="panel">
                <?php
                echo $this->Html->link($this->Html->image('bank_transfers.png', array('width' => '90', 'height' => '90')), '/Accounting/bankTransfers', array('escape' => false));
                ?>
                <div id="panel_txt">
                    <h2>Bank & Cash Account Transfers</h2>
                    <p>Transfer cash between bank and cash accounts here</p>
                </div>
            </div>
            
            <div id="panel">
                <?php
                echo $this->Html->link($this->Html->image('report1.png', array('width' => '90', 'height' => '90')), '/Accounting/bankBalances', array('escape' => false));
                ?>
                <div id="panel_txt">
                    <h2>Bank Account Balances</h2>
                    <p>View bank/cash account balances based on transactions entered here</p>
                </div>
            </div>
            
            <div id="panel">
                <?php
                echo $this->Html->link($this->Html->image('bank_balances.png', array('width' => '90', 'height' => '90')), '/Accounting/statedBankBalances', array('escape' => false));
                ?>
                <div id="panel_txt">
                    <h2>Stated Bank Account Balances</h2>
                    <p>Enter and update bank account balances based on bank statements</p>
                </div>
            </div>
<!--
            <div id="panel">
                <?php
//                echo $this->Html->link($this->Html->image('fixed_assets.png', array('width' => '90', 'height' => '90')), '/FixedAssets/', array('escape' => false));
                ?>

                <div id="panel_txt">
                    <h2>Fixed Assets Register</h2>
                    <p>Enter & Update Depreciation Details of Fixed Assets Here</p>
                </div>
            </div>-->


            <!--    <div id="panel">
            <?php
//    echo $this->Html->link($this->Html->image('manage_investments.png', array('width' => '90', 'height' => '90')), '/Investments/', array('escape' => false));
            ?>
                    <div id="panel_txt">
                        <h2>Investments</h2>
                        <p>Manage investments into the company here.</p>
                    </div>
                </div>-->


            <!--
             second row of panels 
                <div id="panel">
            <?php
// echo $this->Html->link($this->Html->image('creditors.png', array('width' => '100', 'height' => '100')), '/Creditors/', array('escape' => false));
            ?>
                    <div id="panel_txt">
                        <h2>Creditors</h2>
                        <p>Check and update information about your creditors here</p>
                    </div>
                </div>-->

            <!--    <div id="panel">
            <?php
//echo $this->Html->link($this->Html->image('reports.png', array('width' => '90', 'height' => '90')), '/Reports/', array('escape' => false));
            ?>
            
                    <div id="panel_txt">
                        <h2>Reports</h2>
                        <p>View company's financial performance here e.g. general ledger, sales journal, financial statement, balance account, etc.</p>
                    </div>
                </div>-->
            

            <!-- Panels end here -->

        </div>
    </div>
</div>
<!-- Sidebar starts here -->
<div id="sidebar">
    <?php
    echo $this->element('logo');
    ?>
</div>
<!-- Sidebar starts here -->
<!-- Footer starts here -->
<?php echo $this->element('footer'); ?>
<!-- Footer starts here -->