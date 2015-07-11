<?php echo $this->element('header'); ?>
<h3>Reports</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        
        <!-- Content start here -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                
                <?php
                //General Ledger
                $general_ledger = array(
                  //  $this->Html->link('Journal Voucher: Receipt Voucher','/Reports/jvReceiptVoucher', array('escape' => false)),
                   // $this->Html->link('Journal Voucher: Payment Voucher','/Reports/jvPaymentVoucher', array('escape' => false)),
                    $this->Html->link('Client Ledger','/Reports/clientLedger', array('escape' => false)),
                     );
               //  echo '<p class="subtitle-blue">Journals & Ledgers</p>';
                 //echo $this->Html->nestedList($general_ledger, array('class' => 'square'), $tag = 'ul');
                 
                 //Investments
                $investments = array(
                   // $this->Html->link('Investor Contract','/Reports/investorContract', array('escape' => false)),
                   // $this->Html->link('Daily Interests','/Reports/dailyInterests', array('escape' => false)),
                  //  $this->Html->link('Maturity List','/Reports/maturityList', array('escape' => false)),
                   // $this->Html->link('Discounting of Investment','/Reports/discountInvestment', array('escape' => false)),
                    $this->Html->link('Active Investments List','/Reports/activeInvestments', array('escape' => false)),
                    $this->Html->link('Aggregate Investment Report','/Reports/aggregateInvestment', array('escape' => false)),
                    $this->Html->link('Investor Deposits Report','/Reports/investorDeposits', array('escape' => false)),
                    $this->Html->link('Rollover/Disinvestments Report','/Reports/rolloverDisinv', array('escape' => false)),
                    $this->Html->link('Funds Under Management','/Reports/fundsUnderMgt', array('escape' => false)),
                    $this->Html->link('Internal Investments Accrued Interest','/Reports/interestAccrued', array('escape' => false)),
                    $this->Html->link('External Investments Accrued Interest','/Reports/outboundInterestAccrued', array('escape' => false)),
                    $this->Html->link('Income Spread','/Reports/incomeSpread', array('escape' => false)),
                     );
                 echo '<p class="subtitle-blue">Investments</p>';
                 echo $this->Html->nestedList($investments, array('class' => 'square'), $tag = 'ul');
                 
                
                 
                 
                 
                 ?>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
                //Bank Accounts
                $bank_accounts = array(
                    $this->Html->link('Cash/Bank Balances','/Accounting/bankBalances', array('escape' => false)),
                    $this->Html->link('Stated Bank Balances','/Reports/', array('escape' => false)),
                     );
                echo '<p class="subtitle-blue">Cash/Bank Accounts</p>';
                echo $this->Html->nestedList($bank_accounts, array('class' => 'square'), $tag = 'ul');
                 
                
                //Financial Statements
                $financial_statements = array(
//                    $this->Html->link('Journal', '/Reports/journal', array('escape' => false)),
//                    $this->Html->link('General Ledger', '/Reports/generalLedger', array('escape' => false)),
//                    $this->Html->link('Trial Balance', '/Reports/trialBalance', array('escape' => false)),

                    $this->Html->link('Balance Sheet', '/Reports/balanceSheet', array('escape' => false)),
                    $this->Html->link('Income Statement', '/Reports/incomeStatement', array('escape' => false)),
                    $this->Html->link('Cash Flow Statement', '/Reports/cashFlow', array('escape' => false)),
                    $this->Html->link('Statement of Owners Equity', '/Reports/ownersEquity', array('escape' => false)),
                    $this->Html->link('Aggregate Indebtedness', '/Reports/aggregateIndebtedness', array('escape' => false)),
                    $this->Html->link('Bank Reconciliation Statement', '/Reports/bankReconciliation', array('escape' => false)),
                     );
                echo '<p class="subtitle-blue">Financial Statements</p>';
                echo $this->Html->nestedList($financial_statements, array('class' => 'square'), $tag = 'ul');
                 
                
                
                
                ?>
            </div>
        </div>


        <!-- Content end here -->
