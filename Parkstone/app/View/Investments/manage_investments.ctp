<?php echo $this->element('header'); ?>

<!-- Content starts here -->
<h3>Manage Investments</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <?php echo $this->Form->create('Investment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'searchInvest4mInvest'), "inputDefaults" => array('div' => false))); ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">

            <tr>
                <td align="center" colspan="3" style="font-size: 18px; color: gray; font-weight: bold;">Find Investor</td>
            </tr>
            <tr>
                <td align="left" valign="top" >&nbsp;</td>
                <td align="center" valign="middle" width="375">

                    <?php
                    echo $this->Form->input('search', array('size' => 70, 'class' => 'search', 'value' => (isset($int['Investor']['fullname']) ? $int['Investor']['fullname'] : '' ), 'name' => 'investor_search', 'id' => (isset($int['Investor']['id']) ? $int['Investor']['id'] : '' ), 'label' => false));
                    ?>
                    <input type="hidden" name="hid_cust" value="<?php (isset($int['Investor']['id']) ? $int['Investor']['id'] : '' ); ?>" />
                    <input type="hidden" name="conditions" value="manage" />	
                    <?php echo $this->Form->button('Search', array("type" => "submit", "id" => "search", "class" => "btn btn-lg btn-success"));
                    ?>
                    &nbsp;
                    <?php
//                    echo $this->Html->link('Proceed', "/Investments/manageClientInvestments/" . (isset($int['Investor']['id']) ? $int['Investor']['id'] . "/" . $int['Investor']['fullname'] : '' ), array("class" => 'btn btn-lg btn-primary'));
                    ?>
                    <span style="color: red;"></span>
                </td>
                <td align="left" valign="top" >&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top" width="375"></td>
                <td align="left" valign="top"></td>
            </tr>
        </table>
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>
        <?php
//   echo $this->Form->create('Investment', array("url" => array('controller' => 'Investments', 'action' => '#'), "inputDefaults" => array('label' => false, 'div' => false)));
        ?>
        <table border="0" width="100%" cellspacing="5" cellpadding="5" align="left" style="font-size:85%">
            <tr>
                <td style="border-bottom: solid 2px dodgerblue;" width="90" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('comp_name', 'Company Name'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('fullname', 'Investor Name'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('in_trust_for', 'In Trust For'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('investor_type', 'Investor Type'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('phone', 'Phone No.'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo 'Manage Inv.'; ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo 'Fixed Inv. Statements'; ?></b></td>
            </tr>
                <?php
                if (isset($data)) {
                    foreach ($data as $each_item) {
                ?>
            <tr>
                <td align="left"><?php echo $each_item['Investor']['id']; ?></td>
                <td align="left"><?php
                    if (!empty($each_item['Investor']['comp_name'])) {
//                        echo $this->Html->link($each_item['Investor']['comp_name'], "/Investments/searchInvest4mInvest/" . $each_item['Investor']['id'] . "/manage", array());
                        echo $each_item['Investor']['comp_name'];
                        
                    } else {
                        echo 'N/A';
                    }
                    ?></td>  <!--Link to enable editing -->
                <td align="left"><?php
                    if (!empty($each_item['Investor']['fullname'])) {
//                        echo $this->Html->link($each_item['Investor']['fullname'], "/Investments/searchInvest4mInvest/" . $each_item['Investor']['id'] . "/manage", array());
                        echo $each_item['Investor']['fullname'];
                    } else {
                        echo 'N/A';
                    }
                    ?></td>  <!--Link to enable editing -->
                <td align="left"><?php
                    if (!empty($each_item['Investor']['in_trust_for'])) {
                        echo $each_item['Investor']['in_trust_for'];
                    } else {
                        echo 'N/A';
                    }
                    ?></td>
                <td align="left">
            <?php echo $each_item['InvestorType']['investor_type']; ?>
                </td>
                <td align="left"><?php echo $each_item['Investor']['phone']; ?></td>
                <td align="left"><?php 
                    echo $this->Html->link('Fixed', "/Investments/manageFixedInvestments/" . (isset($each_item['Investor']['id']) ? $each_item['Investor']['id'] . "/" . $each_item['Investor']['fullname'] : '' ));
                    echo " | ";
                    echo $this->Html->link('Equity', "/Investments/manageEquityInvestments/" . (isset($each_item['Investor']['id']) ? $each_item['Investor']['id'] . "/" . $each_item['Investor']['fullname'] : '' ));
                ?></td>
                <td align="left"><?php 
                echo $this->Html->Link('Client Ledger', '/Investments/clientLedger' . "/" . (isset($each_item['Investor']['id']) ? $each_item['Investor']['id']: '' ). "/" . (!empty($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : (!empty($each_item['Investor']['comp_name']) ? $each_item['Investor']['comp_name'] : '' ) ) , array('escape' => false)); 
                echo " | ";
                echo $this->Html->Link('Statement', '/Investments/statementClient/'.(isset($each_item['Investor']['id']) ? $each_item['Investor']['id'] : '' )."/".(!empty($each_item['Investor']['fullname']) ? $each_item['Investor']['fullname'] : (!empty($each_item['Investor']['comp_name']) ? $each_item['Investor']['comp_name'] : '' ) ),array('escape'=>false));
 
//                 echo $this->Html->Link('Statement', '/Investments/statementActiveInv' . "/" . (isset($each_item['Investor']['id']) ? $each_item['Investor']['id']. "/" . $each_item['Investor']['fullname'] : '' ), array('escape' => false)); 
//               
//                echo $this->Html->Link('Statement', '/Investments/statementAllInv' . "/" . (isset($each_item['Investor']['id']) ? $each_item['Investor']['id'] : '' ), array('escape' => false)); 
                ?></td>
            </tr>
    <?php }
}
?>

            <tr>
                <td colspan="6" align="right">
                    <?php //echo $this->Form->end();
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
        <div id="clearer"></div>


    </div>
    <!-- Content ends here -->
<?php echo $this->element('footer'); ?>