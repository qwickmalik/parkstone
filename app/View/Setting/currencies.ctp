<?php echo $this->element('header'); ?>

<!-- Content starts here -->
<h3>Currencies</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        <?php echo $this->Form->create('Currency', array("url" => array('controller' => 'Settings', 'action' => 'currencies'), "inputDefaults" => array())); ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php
//                echo $this->Html->link('Back to Settings', "/Settings/", array('style' => 'float: left;', 'class' => 'btn btn-md btn-info'));
                ?>

            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
                echo $this->Form->input('currency_name', ['value' => isset($curr['Currency']['currency_name']) ? $curr['Currency']['currency_name'] : '']);

                echo $this->Form->hidden('id', ['value' => isset($curr['Currency']['id']) ? $curr['Currency']['id'] : '']);
                echo $this->Form->input('symbol', ['value' => isset($curr['Currency']['symbol']) ? $curr['Currency']['symbol'] : '']);
                ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              
                <?php
                echo $this->Form->radio('is_local', array("0" => "No", "1" => "Yes"), array('value' => isset($curr['Currency']['is_local']) ? $curr['Currency']['is_local'] : '', "label" => "Local Currency", 'class' => 'myradio'));

                echo $this->Form->button('Save', array("type" => "submit", "id" => "custCatBtn", "class" => "btn btn-lg btn-success", 'style' => 'float: right;'));
                ?>
            </div>

        </div>


        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

        <form id="customer_categories" action="#" method="post">
            <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
                <tr>
                    <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
                    <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('currency_name', 'Currency'); ?></b></td>
                    <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('symbol', 'Symbol'); ?></b></td>
                    <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>
                </tr>
                <?php foreach ($data as $each_item): ?>
                    <tr>
                        <td width="50" align="left"><?php echo $each_item['Currency']['id']; ?></td>
                        <td align="left" class="categoriesAnchor"><?php echo $this->Html->link($each_item['Currency']['currency_name'], "/Settings/currencies/" . $each_item['Currency']['id'], array("class" => $each_item['Currency']['id'])); ?></td>
                        <td align="left"><?php echo $each_item['Currency']['symbol']; ?></td>
                        <td width="20" align="left"><?php echo $this->Html->link("Delete", "/Settings/delCurrency/" . $each_item['Currency']['id'], array("class" => $each_item['Currency']['id'])); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" align="right">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
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
