<h3>Add New Investor</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>


        <div class="row">
            <!-- Form Elements Start -->
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

                <?php
                echo $this->Form->create('Investor', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'proceed_check1'), "inputDefaults" => array('div' => false)));
                ?>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <?php
                        echo $this->Form->input('investortype_id', array('default' => 1, 'label' => 'Investor Type'));
//,'selected' => ($this->Session->check('investortemp.investor_type_id') == true ? $this->Session->read('investortemp.investor_type_id') : 1 )
                        ?>  
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        &nbsp;
                    </div>
                </div>
                <hr>


                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        &nbsp;
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12" align="right">
                        <?php
                        //echo $this->Html->Link('[Individual]', 'newInvestorIndiv', array('style'=>'color: red;'))."&nbsp;";
                        //echo $this->Html->Link('[Company]', 'newInvestorComp', array('style'=>'color: red;'));
                        //echo "Delete links after";
                        echo $this->Form->button('Proceed', array("type" => "submit", "id" => "cust_save", "class" => "btn btn-lg btn-success"));
                        ?>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>

            </div>
            <!-- Form Elements End --> 
        </div>