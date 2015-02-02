<?php
echo $this->Html->script('notification.js');
?>

<!-- Content starts here -->
<h3 style="color: red;">Investment Companies</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>
        
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="boxed">
                <?php echo $this->Form->create('Investee', array("url" => array('controller' => 'Reinvestments', 'action' => 'addInvestee'), "inputDefaults" => array()));
                ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php echo $this->Form->input('company_name', array('label' => 'Company Name')); ?>
                    </div>
                    
                    
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php 
                            echo "<b style='color: red;'>Contact Details</b>";
                            echo $this->Form->input('manager_name', array('label' => 'Manager'));
                            echo $this->Form->input('location', array());
                            echo $this->Form->input('postal_address', array());
                            echo $this->Form->input('postal_town_suburb', array('label' => 'Suburb'));
                            echo $this->Form->input('postal_city', array('label' => 'Town/City')); 
                            echo $this->Form->input('postal_country', array('label' => 'Country'));
                            echo $this->Form->input('telephone', array()); 
                            echo $this->Form->input('mobile', array());
                            echo $this->Form->input('email', array()); 
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <?php
                            echo "<b style='color: red;'>Investment Products</b>";
                            echo $this->Form->input('product1', array());
                            echo $this->Form->input('product2', array());
                            echo $this->Form->input('product3', array());
                            echo $this->Form->input('product4', array());
                            echo $this->Form->input('product5', array());
                            echo $this->Form->input('product6', array());
                            echo $this->Form->input('product7', array());
                            echo $this->Form->input('product8', array());
                            echo $this->Form->input('product9', array());
                            echo "<br /><br /><br />";
                            echo $this->Form->button('Save Details', array("type" => "submit", "class" => "btn btn-lg btn-success", "id" => "investee_submit")); //check the parameters here

                        ?>
                    </div>
                </div>
                
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
                <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('company_name', 'Investee Name'); ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>
            </tr>
<?php foreach ($data as $each_item): ?>
                <tr>
                    <td width="50" align="left"><?php echo $each_item['Investee']['id']; ?></td>
                    <td align="left" class="userTypeAnchor"><?php echo $this->Html->link($each_item['Investee']['company_name'], "#", array("class" => $each_item['Investee']['id'])); ?></td> 
                    <td align="left"><?php echo $this->Html->link("Delete","/Reinvestments/delInvestee/".$each_item['Investee']['id']);   ?></td>
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