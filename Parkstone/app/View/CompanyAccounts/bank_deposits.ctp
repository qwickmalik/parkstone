
<h3>Bank Deposits</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        <!-- Content start here -->
        <?php
        echo $this->Form->create('BankDeposit', array('url' => array('controller' => 'CompanyAccounts','action' => 'bankDeposits')));
        ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                <?php
                    echo $this->Form->input('depositor', array('placeholder' => 'Depositor Name'));
                    echo $this->Form->input('reference_no', array('label' => 'Deposit Slip Reference Number','placeholder' => 'Depositor Name'));
                    echo $this->Form->input('account_id', array());
                    echo $this->Form->input('amount', array('placeholder' => '0.00'));
                    
                ?>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-6">
                <?php
                    echo $this->Form->input('description', array('label' => 'Description','placeholder' => 'Further details about this deposit', 'type' => 'textarea'));
                    echo $this->Form->button('save', array('type' => 'submit', 'class' => 'btn btn-lg btn-success', 'style' => 'float: right;'));
                ?>
            </div>
        </div>
        <?php
        $this->Form->end();
                ?>


        <!--    Content ends here-->
    </div>
