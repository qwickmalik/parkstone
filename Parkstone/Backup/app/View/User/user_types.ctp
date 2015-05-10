<?php echo $this->element('header'); ?>

<h3>SETTINGS: User Types</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        <?php
        echo $this->Form->create('Usertype', array("url" => array('controller' => 'Users', 'action' => 'userTypes', 'class' => 'basic-form'), "inputDefaults" => array('label' => false, /* 'div' => false */)));
        ?>
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <?php
                echo $this->Form->input('usertype', array("label" => "User Type"));
                echo $this->Form->hidden('id');
                ?>

            </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
<?php
echo '<p style="font-size: 18px; font-weight: bold; color: dodgerblue; margin-top: 20px;">User Permissions</p>';
?>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <?php
                echo '<p><b>Modules</b></p>';
                foreach ($modules as $module): 
               echo '<p style="margin-bottom: 4px;">'.$module["Module"]["module_name"].'</p>';
               endforeach; 
                ?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
<?php
echo '<b>View</b>';
    foreach ($modules as $view): 
    echo $this->Form->input('mod_view'.$view['Module']['id'], array('value' => (isset($privileges['UserPrivilege']['mod_view'])? $privileges['UserPrivilege']['mod_view']: ''), 'type' => 'checkbox'));

    endforeach;
//echo $this->Form->input('view_investors', array('value' => (isset($privileges['UserPrivilege']['mod_view'])), 'type' => 'checkbox'));
//echo $this->Form->input('view_investments', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('view_reinvestments', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('view_payments', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('view_companyacc', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('view_reports', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('view_settings', array('value' => 1, 'type' => 'checkbox'));
?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
<?php
echo '<b>Create</b>';
 foreach ($modules as $view): 
    echo $this->Form->input('mod_create'.$view['Module']['id'], array( 'type' => 'checkbox'));

    endforeach;
//echo $this->Form->input('cr_ed_investors', array('value' => 0, 'type' => 'checkbox'));
//echo $this->Form->input('cr_ed_investments', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('cr_ed_reinvestments', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('cr_ed_payments', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('cr_ed_companyacc', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('cr_ed_reports', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('cr_ed_settings', array('value' => 1, 'type' => 'checkbox'));
?>
                </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
<?php
echo '<b>Edit</b>';
foreach ($modules as $view): 
    echo $this->Form->input('mod_edit'.$view['Module']['id'], array( 'type' => 'checkbox'));

    endforeach;
//echo $this->Form->input('cr_ed_investors', array('value' => 0, 'type' => 'checkbox'));
//echo $this->Form->input('cr_ed_investments', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('cr_ed_reinvestments', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('cr_ed_payments', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('cr_ed_companyacc', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('cr_ed_reports', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('cr_ed_settings', array('value' => 1, 'type' => 'checkbox'));
?>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
<?php
echo '<b>Delete</b>';
foreach ($modules as $view): 
    echo $this->Form->input('mod_delete'.$view['Module']['id'], array( 'type' => 'checkbox'));

    endforeach;
//echo $this->Form->input('del_investors', array('value' => 0, 'type' => 'checkbox'));
//echo $this->Form->input('del_investments', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('del_reinvestments', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('del_payments', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('del_companyacc', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('del_reports', array('value' => 1, 'type' => 'checkbox'));
//echo $this->Form->input('del_settings', array('value' => 1, 'type' => 'checkbox'));
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
                <td style="border-bottom: solid 2px dodgerblue;" width="30" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('usertype', 'User Type'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="center"><b>Inv'rs</b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="center"><b>Inv'mts</b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="center"><b>Re-inv</b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="center"><b>Paymts</b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="center"><b>Comp. Acc.</b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="center"><b>Reports</b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="center"><b>Settings</b></td>
                <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Delete</b></td>
            </tr>
<?php if(isset($data)){ foreach ($data as $each_item): ?>
                <tr>
                    <td width="50" align="left"><?php echo $each_item['Usertype']['id']; ?></td>
                    <td align="left" class="userTypeAnchor"><?php echo $this->Html->link($each_item['Usertype']['usertype'], "#", array("class" => $each_item['Usertype']['id'])); ?></td> <!-- Link to enable editing -->
                
  <?php  if(isset($userprivi)){ foreach ($userprivi as $each_items):
       if($each_items['UserPrivilege']['usertype_id'] == $each_item['UserPrivilege']['usertype_id']){
                   $v = $c = $e = $d = '';
                      if($each_items['UserPrivilege']['mod_view'] == 1){ 
                       $v  = 'V'; 
                      } 
                        if($each_items['UserPrivilege']['mod_edit'] == 1){ 
                          $e = 'E';
                      }
                      if($each_items['UserPrivilege']['mod_create'] == 1){ 
                          $c = 'C';
                      }
                      if($each_items['UserPrivilege']['mod_delete'] == 1){ 
                          $d = 'D';
                      }
                            ?>
                    <td align="center" ><?php echo $v.' '.$c.$e.' '.$d; ?></td>
                    
  <?php } endforeach; } ?>
<!--                    <td align="center" ><?php // echo 'V,CE'; ?></td>
                    <td align="center" ><?php // echo 'V,CE,D'; ?></td>
                    <td align="center" ><?php // echo 'V,CE,D'; ?></td>
                    <td align="center" ><?php // echo 'V,CE,D'; ?></td>
                    <td align="center" ><?php // echo 'V'; ?></td>
                    <td align="center" ><?php // echo 'V'; ?></td>-->
                    <td align="left"><?php echo $this->Html->link("Delete","/Users/delusertype/".$each_item['Usertype']['id']);   ?></td>
                </tr>
<?php endforeach; } ?>
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
<?php echo $this->element('footer'); ?>