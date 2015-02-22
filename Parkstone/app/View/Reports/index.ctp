<h3>Reports</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        
        <!-- Content start here -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                
                <?php
                $general_ledger = array(
                    $this->Html->link('Journal Voucher: Receipt Voucher','/Reports/jvReceiptVoucher', array('escape' => false)),
                    $this->Html->link('Investor Contract','/Reports/investorContract', array('escape' => false)),
                    $this->Html->link('Daily Interests','/Reports/dailyInterests', array('escape' => false)),
                    $this->Html->link('Maturity List','/Reports/maturityList', array('escape' => false)),
                    $this->Html->link('Discounting of Investment','/Reports/discountInvestment', array('escape' => false)),
                    $this->Html->link('Journal Voucher: Payment Voucher','/Reports/jvPaymentVoucher', array('escape' => false)),
                    $this->Html->link('Client Ledger','/Reports/clientLedger', array('escape' => false)),
                     );
                 echo '<p class="subtitle-blue">General Ledger</p>';
                 echo $this->Html->nestedList($general_ledger, array('class' => 'square'), $tag = 'ul');
                 
                $bank_accounts = array(
                    $this->Html->link('Link','/Reports/', array('escape' => false)),
                    $this->Html->link('Link','/Reports/', array('escape' => false)),
                    $this->Html->link('Link','/Reports/', array('escape' => false)),
                     );
                echo '<p class="subtitle-blue">Bank Accounts</p>';
                echo $this->Html->nestedList($bank_accounts, array('class' => 'square'), $tag = 'ul');
                 
                 
                 
                 
                 ?>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
                
                ?>
            </div>
        </div>


        <!-- Content end here -->
