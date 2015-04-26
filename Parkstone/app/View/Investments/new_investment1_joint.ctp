<?php echo $this->element('header'); ?>

<h3>New Joint Investment - Step 1</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">

            <tr>
                <td align="left" valign="top" colspan="3" style="background: #eaeaea; border: solid 1px #cccccc; border-bottom: none;"><?php
//echo $this->Form->create('Order', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Orders', 'action' => 'searchProduct'), "inputDefaults" => array('div' => false))); 
                    echo $this->Form->create('Investment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'searchinvestor4investment'), "inputDefaults" => array('div' => false)));
                    ?>
                    <table width="100%" align="left" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td align="center" colspan="3" style="font-size: 18px; color: gray; font-weight: bold;">Find Investor</td>
                        </tr>
                        <tr>
                            <td align="center" valign="top" colspan="3">

                                <div class="col-lg-4 col-md-6 col-sm-12" style="align: center; float: none;">
                                    <?php
                                    // echo $this->Form->input('search', array('size'=> 70, 'class'=>'search' ,'name' => 'product_search','value' => (isset($prod['Item']['item']) ? $prod['Item']['item'] : '' ), 'label'=>false));
                                    // echo $this->Form->button('Search', array("type" => "submit", "class" => "button_blue"));
                                    echo $this->Form->input('search', array('size' => 70, 'class' => 'search', 'value' => (isset($int['Investor']['fullname']) ? $int['Investor']['fullname'] : '' ), 'name' => 'investor_search', 'id' => (isset($int['Investor']['id']) ? $int['Investor']['id'] : '' ),
                                        'label' => false));
                                    ?>
                                    <input type="hidden" name="hid_investor" value="<?php (isset($int['Investor']['id']) ? $int['Investor']['id'] : '' ); ?>" />

<?php echo $this->Form->button('Search', array("type" => "submit", "id" => "search", "class" => "btn btn-lg btn-success")); ?>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td align="left" valign="top" width="33%">&nbsp;</td>
                            <td align="left" valign="top" width="34%">&nbsp;</td>
                            <td align="left" valign="top" width="33%">&nbsp;</td>
                        </tr>
                    </table>

                </td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="3" style="background: #eaeaea; border: solid 1px #cccccc; border-top: none;">
                    <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
                        <tr>
                            <td style="border-bottom: solid 2px dodgerblue;" align="left">
                                <b><?php echo $this->Paginator->sort('surname', 'Name'); ?></b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" align="left">
                                <b><?php echo $this->Paginator->sort('joint_surname', 'Joint Acc Name'); ?></b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue;" align="left">
                                <b><?php echo $this->Paginator->sort('in_trust_for', 'ITF'); ?></b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" width="200" align="left">
                                <b><?php echo $this->Paginator->sort('phone', 'Phone Number'); ?></b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" align="left">
                                <b><?php echo $this->Paginator->sort('email', 'Email'); ?></b>
                            </td>
                            <td width="50" style="border-bottom: solid 2px dodgerblue" align="right">
                                <b><?php echo 'Choose'; ?></b>
                            </td>
                        </tr>

                        <?php
                        if (isset($investor)) {
                            foreach ($investor as $each_item):
                                ?>
                                <tr>
                                      <td align="left">   <?php  echo $this->Html->link($each_item['Investor']['surname'].' '.$each_item['Investor']['other_names'], "/Investments/investorDetails/" . $each_item['Investor']['id'], array("class" => $each_item['Investor']['id'])); ?>
                                </td>
                                <td align="left" class="investorAnchor">
                                    <?php echo $this->Html->link($each_item['Investor']['joint_surname'].' '.$each_item['Investor']['joint_other_names'], "/Investments/investorDetails/" . $each_item['Investor']['id'], array("class" => $each_item['Investor']['id'])); ?>
                                </td> <!-- Link to enable editing -->
                                <td align="left">
                                    <?php echo $each_item['Investor']['in_trust_for']; ?>
                                </td>
                                    <td width="200" align="left">
                                        <?php echo $each_item['Investor']['phone']; ?>
                                    </td>
                                    <td width="200" align="left">
                                        <?php echo $each_item['Investor']['email']; ?>
                                    </td>
                                    <td align="right">
                                <?php echo $this->Html->link('Select', "/Investments/add/" . $each_item['Investor']['id'] . "/newInvestment1Joint", array()); ?>
                                    </td>
                                </tr>
    <?php endforeach;
} ?>

                        <tr>
                            <td colspan="5" align="right">
                                <?php
                                //echo $this->Form->button('Delete',array("type" => "#","class" => "button_red"));           //check the parameters here
                                echo $this->Form->end();
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" align="center">

                                <?php
                                echo $this->Paginator->first($this->Html->image('first.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'First', 'title' => 'First')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo $this->Paginator->prev($this->Html->image('prev.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'Previous', 'title' => 'Previous')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo $this->Paginator->numbers() . "&nbsp;&nbsp;";
                                echo $this->Paginator->next($this->Html->image('next.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'Next', 'title' => 'Next')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo $this->Paginator->last($this->Html->image('last.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'Last', 'title' => 'Last')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
                                //prints X of Y, where X is current page and Y is number of pages
                                echo $this->Paginator->counter(array('format' => 'Page %page% of %pages%, showing %current% items out of %count% total'));
                                ?>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
            <tr>
                <td align="left" valign="top" colspan="3">
                    <table border="0" width="100%" cellspacing="5" cellpadding="0" align="left">
                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-bottom: solid 2px dodgerblue;" align="left">
                                <b>Name</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" align="left">
                                <b>Joint Acct. Name</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue;" align="left">
                                <b>ITF</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" width="200" align="left">
                                <b>Phone Number</b>
                            </td>
                            <td style="border-bottom: solid 2px dodgerblue" align="left">
                                <b>Email</b>
                            </td>
                            <td width="50" style="border-bottom: solid 2px dodgerblue" align="right">
                                <b>Remove</b>
                            </td>
                        </tr>


<?php if (isset($selected)) {
    foreach ($selected as $each_item):
        ?>
                                <tr>
                                    <td align="left"><?php if (isset($each_item['surname'])) {
            echo $each_item['surname'].' '.$each_item['other_names'];
        } ?></td>
                                    <td align="left"><?php if (isset($each_item['joint_surname'])) {
            echo $each_item['joint_surname'].' '.$each_item['joint_other_names'];
        } ?></td>
                                                    <td align="left"><?php if (isset($each_item['in_trust_for'])) {
            echo $each_item['in_trust_for'];
        } ?></td>
                                    <td align="left"><?php if (isset($each_item['phone_number'])) {
            echo $each_item['phone_number'];
        } ?></td>
                                    <td align="left"><?php if (isset($each_item['email'])) {
            echo $each_item['email'];
        } ?></td>
                                    <td width="50" align="right">
        <?php echo $this->Html->link('Remove', "/Investments/rmInvestor/" . (isset($each_item['investor_id']) ? $each_item['investor_id'] : ''), array()); ?>
                                    </td>
                                </tr>
    <?php endforeach;
} ?>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>

                    </table>

                </td>
            </tr>

            <tr>
                <td align="left" valign="top" width="300" ></td>
                <td align="left" valign="top" width="300"></td>
                <td align="left" valign="top" width="300"></td>
            </tr>
            <tr>
                <td align="left" valign="top" width="300" >&nbsp;</td>
                <td align="left" valign="top" width="300">&nbsp;</td>
                <td align="left" valign="top" width="300">&nbsp;</td>
            </tr>

            <tr>
                <td align="left" valign="top" width="300">&nbsp;</td>
                <td align="left" valign="middle" width="300" ></td>
                <td align="right" valign="middle" width="300">
<?php echo $this->Html->link('Back', "/Investments/newInvestment0", array("class" => 'btn btn-lg btn-info')); ?>
<?php //echo $this->Form->button('Process Order', array("type" => "submit",  "class" => "btn btn-lg btn-success")); ?>
<?php echo $this->Html->link('Next', "/Investments/newInvestment2_joint", array("class" => 'btn btn-lg btn-success')); ?>

                </td>
            </tr>
        </table>
    </div>
        <!-- Content ends here -->
<?php echo $this->element('footer'); ?>