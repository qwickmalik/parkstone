<?php
echo $this->Html->script('notification.js');
?>

<h3>SETTINGS: User Types</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
         <?php 
            echo $this->Form->create('Usertype', array("url" => array('controller' => 'Users', 'action' => 'userTypes', 'class' => 'basic-form'), "inputDefaults" => array('label'=> false,/*'div' => false*/))); 
            ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php 
                
                echo $this->Form->input('usertype', array("label" => "User Type"));
                echo $this->Form->hidden('id');
                
                ?>

            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php 
            echo '<p style="font-size: 18px; font-weight: bold; color: dodgerblue; margin-top: 20px;">User Permissions</p>';
            ?>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <?php
            echo '<p><b>Modules</b></p>';
            echo '<p style="margin-bottom: 4px;">Investors</p>';
            echo '<p style="margin-bottom: 4px;">Investments</p>';
            echo '<p style="margin-bottom: 4px;">Re-investments</p>';
            echo '<p style="margin-bottom: 4px;">Payments</p>';
            echo '<p style="margin-bottom: 4px;">Company Accounts</p>';
            echo '<p style="margin-bottom: 4px;">Reports</p>';
            echo '<p style="margin-bottom: 4px;">Settings</p>';
            ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <?php
            echo '<b>View</b>';
            echo $this->Form->input('view_investors', array('value' => 0, 'type' => 'checkbox'));
            echo $this->Form->input('view_investments', array('value' => 1, 'type' => 'checkbox'));
            echo $this->Form->input('view_reinvestments', array('value' => 1, 'type' => 'checkbox'));
            echo $this->Form->input('view_payments', array('value' => 1, 'type' => 'checkbox'));
            echo $this->Form->input('view_companyacc', array('value' => 1, 'type' => 'checkbox'));
            echo $this->Form->input('view_reports', array('value' => 1, 'type' => 'checkbox'));
            echo $this->Form->input('view_settings', array('value' => 1, 'type' => 'checkbox'));
            ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <?php
            echo '<b>Create/Edit</b>';
            echo $this->Form->input('cr_ed_investors', array('value' => 0, 'type' => 'checkbox'));
            echo $this->Form->input('cr_ed_investments', array('value' => 1, 'type' => 'checkbox'));
            echo $this->Form->input('cr_ed_reinvestments', array('value' => 1, 'type' => 'checkbox'));
            echo $this->Form->input('cr_ed_payments', array('value' => 1, 'type' => 'checkbox'));
            echo $this->Form->input('cr_ed_companyacc', array('value' => 1, 'type' => 'checkbox'));
            echo $this->Form->input('cr_ed_reports', array('value' => 1, 'type' => 'checkbox'));
            echo $this->Form->input('cr_ed_settings', array('value' => 1, 'type' => 'checkbox'));
            ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <?php
            echo '<b>Delete</b>';
            echo $this->Form->input('del_investors', array('value' => 0, 'type' => 'checkbox'));
            echo $this->Form->input('del_investments', array('value' => 1, 'type' => 'checkbox'));
            echo $this->Form->input('del_reinvestments', array('value' => 1, 'type' => 'checkbox'));
            echo $this->Form->input('del_payments', array('value' => 1, 'type' => 'checkbox'));
            echo $this->Form->input('del_companyacc', array('value' => 1, 'type' => 'checkbox'));
            echo $this->Form->input('del_reports', array('value' => 1, 'type' => 'checkbox'));
            echo $this->Form->input('del_settings', array('value' => 1, 'type' => 'checkbox'));
            ?>
            </div>

            
            </div>
        </div>
        <div class="row">
            <?php
            echo $this->Form->button('Save', array("type" => "submit", "class" => "btn btn-lg btn-success", 'style' => 'float: right;')); 
            ?>
        </div>
            
            
            <?php
            echo $this->Form->end();
            ?>
        
        
        
        

        <div id="clearer">
            <br /><br /><br />
        </div>

        <?php
        echo $this->Form->create('', array("url" => array('controller' => 'Users', 'action' => '#'), "inputDefaults" => array('label' => false, 'div' => false)));
        ?>

        <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
            <tr>
                <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('usertype', 'User Type'); ?></b></td>
<!--                                <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>-->
            </tr>
<?php foreach ($data as $each_item): ?>
                <tr>
                    <td width="50" align="left"><?php echo $each_item['Usertype']['id']; ?></td>
                    <td align="left" class="userTypeAnchor"><?php echo $this->Html->link($each_item['Usertype']['usertype'], "#", array("class" => $each_item['Usertype']['id'])); ?></td> <!-- Link to enable editing -->
    <!--                                <td align="left"><?php //echo $this->Html->link("Delete","/Users/delusertype/".$each_item['Usertype']['id']);  ?></td>-->
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
