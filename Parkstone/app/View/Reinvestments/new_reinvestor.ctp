<?php
echo $this->Html->script('notification.js');
?>

<!-- Content starts here -->
<h3 style="color: red;">Reinvestor Companies</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12">
            <div class="boxed">
                <?php echo $this->Form->create('Reinvestor', array("url" => array('controller' => 'Reinvestments', 'action' => 'newReinvestor'), "inputDefaults" => array('label' => false, 'div' => false)));
                ?>

                <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
                    <tr>
                        <td align="right"><b>Company Name:</b></td>
                        <td><?php echo $this->Form->input('company_name', array("size" => 40)); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Manager:</b></td>
                        <td><?php echo $this->Form->input('manager_name', array("class" => "large", "size" => 40)); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Location:</b></td>
                        <td><?php echo $this->Form->input('location', array("class" => "large", "size" => 40)); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Postal Address:</b></td>
                        <td><?php echo $this->Form->input('postal_address', array("class" => "large", "size" => 40)); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Postal Town/Suburb:</b></td>
                        <td><?php echo $this->Form->input('postal_town_suburb', array("class" => "large", "size" => 40)); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Postal City:</b></td>
                        <td><?php echo $this->Form->input('postal_city', array("class" => "large", "size" => 40)); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Country:</b></td>
                        <td><?php echo $this->Form->input('postal_country', array("class" => "large", "size" => 40)); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Telephone:</b></td>
                        <td><?php echo $this->Form->input('telephone', array("class" => "large", "size" => 20)); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Mobile Phone:</b></td>
                        <td><?php echo $this->Form->input('mobile', array("class" => "large", 'maxlength' => 40, "size" => 40)); ?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Email Address:</b></td>
                        <td><?php echo $this->Form->input('email', array("class" => "large", "size" => 40)); ?></td>
                    </tr>
                    

                    <tr>
                        <td align="right">&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="right">&nbsp;</td>
                        <td>
<?php
echo $this->Form->button('Save Details', array("type" => "submit", "class" => "btn btn-lg btn-success", "id" => "reinvestor_submit")); //check the parameters here
?>
                        </td>
                    </tr>
                </table>
<?php
echo $this->Form->end();
?>
                <div id="clearer"></div>
            </div>
        </div>
<?php
echo $this->Form->create('', array("url" => array('controller' => 'Reinvestments', 'action' => '#'), "inputDefaults" => array('label' => false, 'div' => false)));
?>

        <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
            <tr>
                <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('company_name', 'Reinvestor Name'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>
            </tr>
<?php foreach ($data as $each_item): ?>
                <tr>
                    <td width="50" align="left"><?php echo $each_item['Reinvestor']['id']; ?></td>
                    <td align="left" class="userTypeAnchor"><?php echo $this->Html->link($each_item['Reinvestor']['company_name'], "#", array("class" => $each_item['Reinvestor']['id'])); ?></td> 
                    <td align="left"><?php echo $this->Html->link("Delete","/Reinvestments/delReinvestor/".$each_item['Reinvestor']['id']);   ?></td>
                </tr>
<?php endforeach; ?>
            <tr>
                <td colspan="3" align="right">
<?php
//  echo $this->Form->button('Delete',array("type" => "#","class" => "button_red"));           //check the parameters here
?>
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
<?php echo $this->Form->end(); ?>		

        <!-- Content ends here -->