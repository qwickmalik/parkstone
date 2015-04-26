<?php echo $this->element('header'); ?>

<!-- Content starts here -->
<h3>Process Payments</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>

    <?php
//    echo $this->Form->create('', array("url" => array('controller' => 'Stocks', 'action' => '#'), "inputDefaults" => array('label' => false, 'div' => false)));
    ?>
    <table border="0" width="100%" cellspacing="5" cellpadding="5" align="left">
        <tr>
            <td style="border-bottom: solid 2px dodgerblue;" width="30" align="left"><b>Inv. ID<?php // echo $this->Paginator->sort('id', 'ID'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b>Investor ID<?php // echo $this->Paginator->sort('id', 'ID'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b>Investor Name<?php // echo $this->Paginator->sort('id', 'ID'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" width="60" align="right"><b>Inv. Date<?php // echo $this->Paginator->sort('date', 'Supply Date'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="right"><b>Principal<?php //echo $this->Paginator->sort('cost_price', 'Total Cost Price'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" width="30" align="center"><b>Rate (%)</b></td>
            <td style="border-bottom: solid 2px dodgerblue" width="60" align="right"><b>Due Date<?php //echo $this->Paginator->sort('balance', 'Balance'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="right"><b>Amount Due <br />(to date)<?php //echo $this->Paginator->sort('cost_price', 'Total Cost Price'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="center"><b>Action<?php //echo $this->Paginator->sort('balance', 'Balance'); ?></b></td>
            
        </tr>
        <?php // if(isset($data)){ foreach ($data as $each_item) { ?>
            <tr>
                <td align="left">1</td>
                <td align="left">44</td>
                <td align="left">Kwaku Afreh-Nuamah</td>
                <td align="right">01/01/2014</td>
                <td align="right">20,000</td>
                <td align="center">15</td>
                <td align="right">01/07/2014</td>
                <td align="right">20,000</td>
                <td align="center">
                    <?php echo $this->Html->Link('Pay', '/Investments/payInvestor/', array('escape'=>false));?> | <a <?php echo $this->Html->Link('Rollover', '/Investments/rollover/', array('escape'=>false));?> | <?php echo $this->Html->Link('Cancel', '/Investments/cancelInvestment/', array('escape'=>false));?></td>
            </tr>
            <tr>
                <td align="left">2</td>
                <td align="left">002</td>
                <td align="left">Abdul Malik Sulley</td>
                <td align="right">01/01/2014</td>
                <td align="right">20,000</td>
                <td align="center">15</td>
                <td align="right">01/07/2014</td>
                <td align="right">20,000</td>
                <td align="center">
                    <?php echo $this->Html->Link('Pay', '/Investments/payInvestor/', array('escape'=>false));?> | <a <?php echo $this->Html->Link('Rollover', '/Investments/rollover/', array('escape'=>false));?> | <?php echo $this->Html->Link('Cancel', '/Investments/cancelInvestment/', array('escape'=>false));?>
                </td>
            </tr>
            <tr>
                <td align="left">3</td>
                <td align="left">44</td>
                <td align="left">Kwaku Afreh-Nuamah</td>
                <td align="right">01/01/2014</td>
                <td align="right">20,000</td>
                <td align="center">15</td>
                <td align="right">01/07/2014</td>
                <td align="right">20,000</td>
                <td align="center">
                    <?php echo $this->Html->Link('Pay', '/Investments/payInvestor/', array('escape'=>false));?> | <a <?php echo $this->Html->Link('Rollover', '/Investments/rollover/', array('escape'=>false));?> | <?php echo $this->Html->Link('Cancel', '/Investments/cancelInvestment/', array('escape'=>false));?></td>
            </tr>
            
        <?php // }} ?>
        <tr>
            <td colspan="9" align="right">
                <?php
//                echo $this->Form->end();
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="9" align="center">
                <?php
//                echo $this->Paginator->first($this->Html->image('first.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'First', 'title' => 'First')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
//                echo $this->Paginator->prev($this->Html->image('prev.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'Previous', 'title' => 'Previous')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
//                echo $this->Paginator->numbers() . "&nbsp;&nbsp;";
//                echo $this->Paginator->next($this->Html->image('next.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'Next', 'title' => 'Next')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
//                echo $this->Paginator->last($this->Html->image('last.png', array('width' => 15, 'height' => 15, 'valign' => 'middle', 'alt' => 'Last', 'title' => 'Last')), array('escape' => false), null, null, array('class' => 'disabled')) . "&nbsp;&nbsp;&nbsp;&nbsp;";
//                //prints X of Y, where X is current page and Y is number of pages
//                echo $this->Paginator->counter(array('format' => 'Page %page% of %pages%, showing %current% items out of %count% total'));
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="1" align="left">&nbsp;</td>
            <td colspan="8" align="right">
                <?php 
				echo $this->Html->link('Back', "/Investments/manageInvestments", array("class" => 'btn btn-xs btn-info')); 
                //echo $this->Html->link('Print', "/Stocks/supListSuppliersInvoicesPrint", array("class" => 'button_red'));
                ?>
            </td>
        </tr>
    </table>
    <div id="clearer"></div>


</div>
<!-- Content ends here -->
<?php echo $this->element('footer'); ?>
