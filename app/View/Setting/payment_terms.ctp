<?php echo $this->element('header'); ?>


<!-- Content starts here -->
<h3>SETTINGS: Payment Terms</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        
    <?php echo $this->Form->create('Rate', array("url" => array('controller' => 'Settings', 'action' => 'paymentTerms'), "inputDefaults" => array('label' => false, 'div' => false))); ?>
    <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">

        <tr>
            <td><h3 align="right">Payment Term Name:</h3></td>
            <td><?php echo $this->Form->input('payment_name', array("class" => "large", "size" => 40));
    echo $this->Form->hidden('id'); ?></td>
        </tr>
        <tr>
            <td><h3 align="right">Period (Months):</h3></td>
            <td><?php echo $this->Form->input('period_months', array("class" => "large", "size" => 40)); ?></td>
        </tr>
        <tr>
            <td><h3 align="right">Interest Rate (%):</h3></td>
            <td><?php echo $this->Form->input('interest_rate', array("class" => "large", "size" => 40,'value' => 0)); ?></td>
        </tr>
        <tr>
            <td><h3 align="right">&nbsp;</h3></td>
            <td>
<?php echo $this->Form->button('Save', array("type" => "submit", "class" => "button_green")); //check the parameters here  ?>
            </td>
        </tr>
    </table>
    <?php
    echo $this->Form->end();
    ?>
    <div id="clearer"></div>

    <form id="payment_terms" action="#" method="post">
        <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
            <tr>
                <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('payment_name', 'Payment Term Name'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue" width="200" align="left"><b><?php echo $this->Paginator->sort('period_months', 'Period (Months)'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue" width="200" align="left"><b><?php echo $this->Paginator->sort('interest_rate', 'Interest Rate (%)'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>
            </tr>
<?php foreach ($data as $each_item): ?>
                <tr>
                    <td width="50" align="left"><?php echo $each_item['Rate']['id']; ?></td>
                    <td align="left" class="ptermAnchor"><?php echo $this->Html->link($each_item['Rate']['payment_name'], "#", array("class" => $each_item['Rate']['id'])); ?></td> <!-- Link to enable editing -->
                    <td width="200" align="left"><?php echo $each_item['Rate']['period_months']; ?></td>
                    <td width="200" align="left"><?php echo $each_item['Rate']['interest_rate']; ?></td>
                    <td width="20" align="left"><?php echo $this->Html->link("Delete", "/Settings/delPterm/" . $each_item['Rate']['id'], array("class" => $each_item['Rate']['id'])); ?></td>
                </tr>
<?php endforeach; ?>
            <tr>
                <td colspan="4" align="right">
                    <?php
                    //echo $this->Form->button('Delete',array("type" => "#","class" => "button_red"));           //check the parameters here
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="7" align="center">
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
    </form>
</div>
<!-- Content ends here -->
<?php echo $this->element('footer'); ?>