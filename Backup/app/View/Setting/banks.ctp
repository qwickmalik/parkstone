<?php echo $this->element('header'); ?>

<h3>SETTINGS: Banks</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <?php echo $this->Form->create('Bank', array("url" => array('controller' => 'Settings', 'action' => 'banks'))); ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                <?php
                echo $this->Form->input('bank_name', array("label" => "Bank Name*", "class" => "required"));
                echo $this->Form->hidden('id');
                echo $this->Form->hidden('create_date');

                echo $this->Form->button('Save', array("type" => "submit", "id" => "bankBtn", "class" => "btn btn-lg btn-success", 'style' => 'float: right;'));
                ?>
            </div>



        </div>
        <?php echo $this->Form->end(); ?>

        <div id="clearer">
            <br /><br /><br />
        </div>

        <?php
        echo $this->Form->create('', array("url" => array('controller' => 'Settings', 'action' => '#')));
        ?>

        <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
            <tr>
                <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('bank_name', 'Bank Name'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>
            </tr>
            <?php foreach ($data as $each_item): ?>
                <tr>
                    <td width="50" align="left"><?php echo $each_item['Bank']['id']; ?></td>
                    <td align="left" class="userAnchor"><?php echo $this->Html->link($each_item['Bank']['bank_name'], "#", array("class" => $each_item['Bank']['id'])); ?></td> <!-- Link to enable editing -->
                    <td align="left">
                        <?php
                        echo $this->Html->link("Delete", "/Settings/delBank/" . $each_item['Bank']['id'], array("class" => $each_item['Bank']['id']));
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="6" align="right">
                    <?php
//  echo $this->Form->button('Delete',array("type" => "#","class" => "button_red"));           //check the parameters here
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
        <?php echo $this->Form->end(); ?>
    </div>
    <!-- Content ends here -->
    <?php echo $this->element('footer'); ?>