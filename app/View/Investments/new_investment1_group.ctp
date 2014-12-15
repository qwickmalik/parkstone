<?php
//echo $this->Html->script('notification.js');
?>

<h3>New Group Investment - Step 1</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>


        <?php echo $this->Form->create('Investment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'searchinvestor4compinvestment'), "inputDefaults" => array('div' => false))); ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">

            <tr>
                <td align="center" colspan="3" ></td>
            </tr>
            <tr>
                <td align="center" valign="middle" colspan="3">
                    <div class="col-lg-4 col-md-6 col-sm-12" style="align: center; float: none;">
                        <?php //echo $this->Form->input('investmentproduct_id', array('label' => 'Investment Product', 'empty' => "--Please Select--", 'value' => (isset($investor['Investor']['investmentproduct_id']) ? $investor['Investor']['investmentproduct_id'] : '' )));
                    ?>
                        
                        
                        <p style="font-size: 18px; color: gray; font-weight: bold;">Find Company</p>
                        <?php
                        echo $this->Form->input('search', array('size' => 70, 'class' => 'search', 'value' => (isset($int['Investor']['comp_name']) ? $int['Investor']['comp_name'] : '' ), 'name' => 'investor_search', 'id' => (isset($int['Investor']['id']) ? $int['Investor']['id'] : '' ),
                            'label' => false));
                        ?>
                        <input type="hidden" name="hid_investor" value="<?php (isset($int['Investor']['id']) ? $int['Investor']['id'] : '' ); ?>" />

<?php echo $this->Form->button('Search', array("type" => "submit", "id" => "search", "class" => "btn btn-lg btn-success")); ?> &nbsp;
<?php echo $this->Html->link('Proceed', "/Investments/newInvestment2Group/" . (isset($int['Investor']['id']) ? $int['Investor']['id'] : '' ), array("class" => 'btn btn-lg btn-primary')); ?>
                        <span style="color: red;"></span>
                    </div>

                </td>
            </tr>
            <tr>
                <td align="left" valign="top" width="150">&nbsp;</td>
                <td align="left" valign="top" width="375"></td>
                <td align="left" valign="top" width="375"></td>
            </tr>
        </table>
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

        <!--    <form id="order_list" action="#" method="post">-->
      <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
            <tr>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('comp_name', 'Group Name'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue" align="left">
                    <b><?php echo $this->Paginator->sort('contact_person', 'Contact Person'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue" width="200" align="left">
                    <b><?php echo $this->Paginator->sort('email', 'Email'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue" align="left">
                    <b><?php echo $this->Paginator->sort('phone', 'Phone'); ?></b>
                </td>
            </tr>

            <?php
            if (isset($investor)) {
                foreach ($investor as $each_item):
                    ?>
                    <tr>
                        <td align="left">
                            <?php echo $this->Html->link($each_item['Investor']['comp_name'], "/Investments/searchinvestor4groupinvestment/" . $each_item['Investor']['id'], array("class" => $each_item['Investor']['id'])); ?>
                        </td>
                        <td align="left" class="orderAnchor">
                            <?php echo $this->Html->link($each_item['Investor']['contact_person'], "/Investments/searchinvestor4groupinvestment/" . $each_item['Investor']['id'], array("class" => $each_item['Investor']['id'])); ?>
                        </td> <!-- Link to enable editing -->
                        <td width="200" align="left">
                            <?php echo $each_item['Investor']['email']; ?>
                        </td>
                        <td width="200" align="left">
        <?php echo $each_item['Investor']['phone']; ?>
                        </td>

                    </tr>
                        <?php endforeach;
                    } ?>
            <tr>
                <td colspan="4" align="right">
<?php
//echo $this->Form->button('Delete',array("type" => "#","class" => "button_red"));           //check the parameters here
?>
                </td>
            </tr>
            <tr>
                <td colspan="4" align="center">
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

    </div>
    <!-- Content ends here -->
