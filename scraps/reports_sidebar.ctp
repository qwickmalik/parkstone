<h2>Reports</h2>
<?php
$settings_list = array(
//                         $this->Html->link($this->Html->image('balance_sheet.png').'St. of Financial Position','financialPosition1', array('escape' => false)),
//                         $this->Html->link($this->Html->image('income_statement.png').'St. of Income','incomeStatement1', array('escape' => false)),
//                         $this->Html->link($this->Html->image('owners_equity.png').'St. of Owners Equity','ownersEquity1', array('escape' => false)),
    $this->Html->div('', "<h3>Pmts. & Instlmt. Reports</h3>"),
    $this->Html->link('Active Accounts', '/Reports/activeAccounts', array('escape' => false)),
    $this->Html->link('Customer Payment Details', '/Reports/customerpaymentDetails1', array('escape' => false)),
   // $this->Html->link('Expected Installment Due Report', '/Reports/expectedInstallment', array('escape' => false)),
    $this->Html->link('New Expected Installment Due Report', '/Reports/expectedInstallment1', array('escape' => false)),
    //$this->Html->link('Expected Installment Due Report for Zone', '/Reports/expectedInstallmentZone', array('escape' => false)),
    
    
    $this->Html->link('New Expected Installment Due Report for Zone', '/Reports/expectedInstallmentZone1', array('escape' => false)),
    
    $this->Html->div('', "<h3>Performance Reports</h3>"),
    $this->Html->link('Group Sales Report by Sales Person', '/Reports/groupSales', array('escape' => false)),
    $this->Html->link('Sales Executive Sales Report for Client', '/Reports/salesExecClient', array('escape' => false)),
    $this->Html->link('Sales Executives with Highest Defaults', '/Reports/salesExecDefaults', array('escape' => false)),
    $this->Html->link('Sales Executive Summary Report','/Reports/salesExecSummary', array('escape' => false)),
    $this->Html->link('Summary Payment Report by Collector','/Reports/summPaymentCollector', array('escape' => false)),
    $this->Html->link('Summary Zonal Performance Report','/Reports/summZonal', array('escape' => false)),
    $this->Html->link('Zonal Sales Report','/Reports/zonalSales', array('escape' => false)),
    
    $this->Html->div('', "<h3>Purchases</h3>"),
    $this->Html->link('Monthly Sales Summary', '/Reports/monthlySalesSummary', array('escape' => false)),
    $this->Html->link('Purchases Report', '/Reports/purchases', array('escape' => false)),
    $this->Html->link('Sales Details Report', '/Reports/salesDetails', array('escape' => false)),
    $this->Html->link('Cash Sales Summary Report', '/Reports/salesSummary', array('escape' => false)),
    $this->Html->div('h3', "<h3>Stocks & Suppliers Reports</h3>"),
    $this->Html->link('Zonal Item Purchase Summary', '/Reports/itemSalesBranch', array('escape' => false)),
   $this->Html->link('Supplier Transaction Summary', '/Reports/suppliers', array('escape' => false)),
    $this->Html->link('Stock Remaining','/Reports/stockRemItems/', array('escape' => false)),
    $this->Html->link('Stock Remaining Details','/Reports/stockRemItemDetails/', array('escape' => false)),
    $this->Html->link('Items Delivery Report', '/Reports/itemsDelivery', array('escape' => false)),
   // $this->Html->link('Location Stock Balances Report1', '/Reports/locStockBal1', array('escape' => false)),
   // $this->Html->link('Location Stock Balances Report2', '/Reports/locStockBal2', array('escape' => false)),
   // $this->Html->link('Suppliers Closing Balances Report', '/Reports/suppClosingBal', array('escape' => false)),
    
    $this->Html->div('', "<h3>Debtors Reports</h3>"),
    $this->Html->link('All Debtors Report by Invoice', '/Reports/allDebtors', array('escape' => false)),
    $this->Html->link('Debtors Ageing/Expected Installments Ageing Report', '/Reports/debtorsAgeing', array('escape' => false)),
    $this->Html->link('Debtors Closing Balances Report', '/Reports/debtorsClosingBal', array('escape' => false)),
    $this->Html->link('Finish Payment Report', '/Reports/finishPayment', array('escape' => false)),
    
    $this->Html->div('', "<h3>Company Accounts</h3>"),
     $this->Html->link('Cash Accounts Summary By Acct Headings','/Reports/summByHeading', array('escape' => false)),
     $this->Html->link('Zonal PettyCash Summary.','/Reports/pettycashSummByZone', array('escape' => false)),
//    $this->Html->link('Statement of Financial Position', '/Reports/financialPosition1', array('escape' => false)),
//    $this->Html->link('Statement of Income', '/Reports/incomeStatement1', array('escape' => false)),
//    $this->Html->link('Statement of Owners Equity', '/Reports/ownersEquity1', array('escape' => false)),
  //  $this->Html->link('Trend Indicator', '/Reports/trendIndicator', array('escape' => false))
);
echo $this->Html->nestedList($settings_list, $tag = 'ul');
?>
