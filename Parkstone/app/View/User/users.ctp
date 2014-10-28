<?php
echo $this->Html->script('notification.js');
?>

<h3>SETTINGS: Users Setup</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        
        <?php echo $this->Form->create('User', array("url" => array('controller' => 'Users', 'action' => 'users'), "inputDefaults" => array('label' => false, 'div' => false))); ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                <?php
                echo $this->Form->input('username', array('label' => 'Username'));
                echo $this->Form->hidden('id');

                echo $this->Form->input('pass', array("label" => "Password", "type" => "password"));
                echo $this->Form->input('confirm_password', array("label" => "Confirm Password", "type" => "password"));
                ?>

            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php
                echo $this->Form->input('firstname', array('label' => 'First Name'));
                echo $this->Form->input('lastname', array('label' => 'Last Name'));
                echo $this->Form->input('email', array('label' => 'Email address'));
                echo $this->Form->input('userdepartment_id', array('label' => 'Department', 'empty' => '--Please Select--'));
                echo $this->Form->input('usertype_id', array('label' => 'User Type', 'empty' => '--Please Select--'));
                ?>
            </div>
            <?php echo $this->Form->button('Save', array("type" => "submit", "id" => "userBtn", "class" => "btn btn-lg btn-success", 'style' => 'float: right;')); //check the parameters here  ?>
            
        </div>
<?php echo $this->Form->end(); ?>

        <div id="clearer">
            <br /><br /><br />
        </div>

        <?php
        echo $this->Form->create('', array("url" => array('controller' => 'Users', 'action' => '#'), "inputDefaults" => array('label' => false, 'div' => false)));
        ?>

        <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
            <tr>
                <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('username', 'Username'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('firstname', 'First Name'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('lastname', 'Last Name'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('usertype', 'User Type'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;padding-left: 17px;padding-right: 17px;" align="center"><b><?php echo $this->Paginator->sort('email', 'Email'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>
            </tr>
            <?php foreach ($data as $each_item): ?>
                <tr>
                    <td width="50" align="left"><?php echo $each_item['User']['id']; ?></td>
                    <td align="left" class="userAnchor"><?php echo $this->Html->link($each_item['User']['username'], "#", array("class" => $each_item['User']['id'])); ?></td> <!-- Link to enable editing -->
                    <td align="left"><?php echo $each_item['User']['firstname']; ?></td>
                    <td align="left"><?php echo $each_item['User']['lastname']; ?></td>
                    <td align="left"><?php echo $each_item['Usertype']['usertype']; ?></td>
                    <td style="padding-left: 17px;padding-right: 17px;" align="center"><?php echo $each_item['User']['email']; ?></td>
                    <td align="left"><?php echo $this->Form->input('', array("class" => "user_del", "id" => $each_item['User']['id'], "type" => "button")); ?></td>
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