<?php echo $this->element('header'); ?>

            
<!-- Content starts here -->
<h3>SETTINGS: Tax Rates</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>
		
                    <?php echo $this->Form->create('Tax',array("url" => array('controller' => 'Settings', 'action' => 'taxesList'),"inputDefaults" => array('div' => false)));?>
                    
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                    <?php echo $this->Form->input('tax_name',array()); echo $this->Form->hidden('id'); ?>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                    <?php echo $this->Form->input('tax_rate',array()); ?>
                </div>
            </div>
            <?php echo $this->Form->button('Save',array("type" => "submit","id" =>"taxBtn","class" => "btn btn-md btn-success", 'style' => 'float: right;')); //check the parameters here ?>
            
            
                   <?php
                    echo $this->Form->end();
                   ?>
                    <div id="clearer"></div>
                    
                    <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
                            <tr>
                                  <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
                                <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('tax_name', 'Tax Name'); ?></b></td>
                                <td style="border-bottom: solid 2px dodgerblue" width="200" align="left"><b><?php echo $this->Paginator->sort('tax_rate', 'Tax Rate'); ?></b></td>
                                <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>
                            </tr>
                            <?php foreach($data as $each_item): ?>
                            <tr>
                                <td width="50" align="left"><?php echo $each_item['Tax']['id']; ?></td>
                                <td align="left" class="taxAnchor"><?php echo $this->Html->link($each_item['Tax']['tax_name'],"#",array("class" => $each_item['Tax']['id'])); ?></td> <!-- Link to enable editing -->
                                <td width="200" align="left"><?php echo $each_item['Tax']['tax_rate']; ?></td>
                                <td width="20" align="left"><input type="button" name="<?php echo $each_item['Tax']['id']; ?>" class="tax_del"/></td>
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
                                   echo $this->Paginator->first($this->Html->image('first.png', array('width'=>15, 'height'=>15, 'valign'=>'middle', 'alt'=>'First', 'title'=>'First')), array('escape' => false), null, null, array('class' => 'disabled'))."&nbsp;&nbsp;&nbsp;&nbsp;";
                                   echo $this->Paginator->prev($this->Html->image('prev.png', array('width'=>15, 'height'=>15, 'valign'=>'middle', 'alt'=>'Previous', 'title'=>'Previous')), array('escape' => false), null, null, array('class' => 'disabled'))."&nbsp;&nbsp;&nbsp;&nbsp;";
                                   echo $this->Paginator->numbers()."&nbsp;&nbsp;";
                                   echo $this->Paginator->next($this->Html->image('next.png', array('width'=>15, 'height'=>15, 'valign'=>'middle', 'alt'=>'Next', 'title'=>'Next')), array('escape' => false), null, null, array('class' => 'disabled'))."&nbsp;&nbsp;&nbsp;&nbsp;";
                                   echo $this->Paginator->last($this->Html->image('last.png', array('width'=>15, 'height'=>15, 'valign'=>'middle', 'alt'=>'Last', 'title'=>'Last')), array('escape' => false), null, null, array('class' => 'disabled'))."&nbsp;&nbsp;&nbsp;&nbsp;";
                                   //prints X of Y, where X is current page and Y is number of pages
                                   echo $this->Paginator->counter(array('format' => 'Page %page% of %pages%, showing %current% items out of %count% total'));  
                                   ?>
                                </td>
                            </tr>
                    </table>

                </div>
            <!-- Content ends here -->

<?php echo $this->element('footer'); ?>