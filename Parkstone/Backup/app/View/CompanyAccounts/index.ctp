<h3>Company Accounts</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        <!-- Content start here -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
                echo $this->Element('ca_bank_transactions');
                echo $this->Element('ca_petty_cash');
                echo $this->Element('ca_receivables');
                
                ?>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
                echo $this->Element('ca_expenses');
                echo $this->Element('ca_cash_aacounts');
                echo $this->Element('ca_assets');
                ?>
            </div>
        </div>


        <!-- Content end here -->
