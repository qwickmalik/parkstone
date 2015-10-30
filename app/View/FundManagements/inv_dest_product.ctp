<?php echo $this->element('header'); ?>


<!-- Content starts here -->
<h3 style="color: red;">Investment Destination Products</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        <?php echo $this->Form->create('InvDestProduct', array("url" => array('controller' => 'FundManagements', 'action' => 'addInvDestProduct'), "inputDefaults" => array()));
        ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
                echo $this->Form->input('investmentdestination_id', array('label' => 'Destination Company', 'empty' => "--Please select--"));
                
                ?>
                
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
                echo $this->Form->input('inv_dest_product', array('label' => 'Investment Destination Product'));
                
                echo $this->Form->button('Save Details', array("type" => "submit", "class" => "btn btn-lg btn-success", "id" => "product_submit", "style" => "float: right; "));
                ?>
            </div>
        </div>
        <?php
        echo $this->Form->end();
        ?>

        <?php
        echo $this->Form->create('', array("url" => array('controller' => 'FundManagements', 'action' => '#'), "inputDefaults" => array('label' => false, 'div' => false)));
        ?>

        <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
            <tr>
                <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left">
                    <b><?php echo $this->Paginator->sort('id', 'ID'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('investment_destination_id', 'Destination Company'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue" align="left">
                    <b><?php echo $this->Paginator->sort('inv_dest_product', 'Investment Destination Product'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>
            </tr>
            <?php foreach ($data as $each_item): ?>
                <tr>
                    <td width="50" align="left"><?php echo $each_item['InvDestProduct']['id']; ?></td>
                    <td align="left" class="userTypeAnchor"><?php echo $this->Html->link($each_item['InvestmentDestination']['company_name'], "/FundManagements/invDestProduct/".$each_item['InvestmentDestination']['id']."/".$each_item['InvDestProduct']['id'], array("class" => $each_item['InvDestProduct']['id'])); ?></td> 
                    <td align="left"><?php echo $each_item['InvDestProduct']['inv_dest_product']; ?></td>
                   
                    <td align="left"><?php echo $this->Html->link("Delete", "/FundManagements/delInvDestProduct/".$each_item['InvDestProduct']['id']); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="6" align="right">
                    <?php
//  echo $this->Form->button('Delete',array("type" => "#","class" => "button_red"));           //check the parameters here
                    ?><p>&nbsp;</p>
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
        <?php echo $this->Form->end(); ?>		
    </div>
        <!-- Content ends here -->
<?php echo $this->element('footer'); ?>