<?php echo $this->element('header'); ?>
<?php

?>

<!-- Content starts here -->
<h3 style="color: red;">New Re-Investor</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        <?php echo $this->Form->create('Reinvestor', array("url" => array('controller' => 'Reinvestments', 'action' => 'addReinvestor'), "inputDefaults" => array()));
                ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
                echo $this->Form->input('company_name', array('value' => ($this->Session->check('newReinvestor.company_name') == true ? $this->Session->read('newReinvestor.company_name') : '' )));
                echo $this->Form->input('manager_name', array('value' => ($this->Session->check('newReinvestor.manager_name') == true ? $this->Session->read('newReinvestor.manager_name') : '' )));
                echo $this->Form->input('telephone', array('value' => ($this->Session->check('newReinvestor.telephone') == true ? $this->Session->read('newReinvestor.telephone') : '' )));
                echo $this->Form->input('mobile', array('maxlength' => 40,'value' => ($this->Session->check('newReinvestor.mobile') == true ? $this->Session->read('newReinvestor.mobile') : '' ) ));
                echo $this->Form->input('email',array('value' => ($this->Session->check('newReinvestor.email') == true ? $this->Session->read('newReinvestor.email') : '' )));
              
                ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
                echo $this->Form->input('location', array('value' => ($this->Session->check('newReinvestor.location') == true ? $this->Session->read('newReinvestor.location') : '' )));
                echo $this->Form->input('postal_address', array('value' => ($this->Session->check('newReinvestor.postal_address') == true ? $this->Session->read('newReinvestor.postal_address') : '' )));
                echo $this->Form->input('postal_city', ['label' => 'City','value' => ($this->Session->check('newReinvestor.postal_city') == true ? $this->Session->read('newReinvestor.postal_city') : '' )]);
                echo $this->Form->input('postal_country', ['label' => 'Country','value' => ($this->Session->check('newReinvestor.postal_country') == true ? $this->Session->read('newReinvestor.postal_country') : '' )]);
                echo $this->Form->button('Save Details', array("type" => "submit", "class" => "btn btn-lg btn-success", "id" => "reinvestor_submit", "style" => "float: right; ")); 
                ?>
            </div>
        </div>
        <?php
        echo $this->Form->end();
        ?>
               
<?php
echo $this->Form->create('', array("url" => array('controller' => 'Reinvestments', 'action' => '#'), "inputDefaults" => array('label' => false, 'div' => false)));
?>

        <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
            <tr>
                <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left">
                    <b><?php echo $this->Paginator->sort('id', 'ID'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('company_name', 'Re-investor Company'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('manager_name', 'Manager'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue" align="left">
                    <b><?php echo $this->Paginator->sort('telephone', 'Telephone No.'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('email', 'Email'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>
            </tr>
<?php foreach ($data as $each_item): ?>
                <tr>
                    <td width="50" align="left"><?php echo $each_item['Reinvestor']['id']; ?></td>
                    <td align="left" class="userTypeAnchor"><?php echo $this->Html->link($each_item['Reinvestor']['company_name'], "#", array("class" => $each_item['Reinvestor']['id'])); ?></td> 
                    <td align="left"><?php echo $each_item['Reinvestor']['manager_name']; ?></td>
                    <td align="left"><?php echo $each_item['Reinvestor']['telephone']; ?></td>
                    <td align="left"><?php echo $each_item['Reinvestor']['email']; ?></td>
                    <td align="left"><?php echo $this->Html->link("Delete","/Reinvestments/delReinvestor/".$each_item['Reinvestor']['id']);   ?></td>
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

        <!-- Content ends here -->
<?php echo $this->element('footer'); ?>