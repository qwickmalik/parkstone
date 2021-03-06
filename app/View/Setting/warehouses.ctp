<?php echo $this->element('header'); ?>

            <!-- Content starts here -->
                <div id="content">
                    <h2>Warehouses</h2>
                    
                    <div id="clearer"></div>
                    
                    <?php echo $this->Form->create('Warehouse',array("url" => array('controller' => 'Settings', 'action' => 'warehouses'),"inputDefaults" => array('label' => false,'div' => false)));?>
                    <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
                            
                            <tr>
                                <td><h3 align="right">Warehouse Name:</h3></td>
                                <td>
                                    <?php echo $this->Form->input('warehouse',array("class" => "large","size" => 40)); echo $this->Form->hidden('id'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><h3 align="right">Warehouse Address:</h3></td>
                                <td><?php echo $this->Form->input('address',array("class" => "large","size" => 40)); ?></td>
                            </tr>
                            <tr>
                                <td><h3 align="right">Warehouse Town:</h3></td>
                                <td><?php echo $this->Form->input('town',array("class" => "large","size" => 40)); ?></td>
                            </tr>
                           
                            <tr>
                                <td><h3 align="right">&nbsp;</h3></td>
                                <td>
                                    <?php echo $this->Form->button('Save',array("type" => "submit","id" => "whBtn","class" => "button_green"));  ?>
                                </td>
                            </tr>
                    </table>
                    <?php
                        echo $this->Form->end();
                    
                    ?>
                    <div id="clearer"></div>
                    
                    <form id="warehouses_list" action="#" method="post">
                    <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
                            <tr>
                               <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
                                <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('warehouse', 'Warehouse Name'); ?></b></td>
                                <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('town', 'Warehouse Town'); ?></b></td>
                                <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>
                            </tr>
                            <?php foreach($data as $each_item): ?>
                            <tr>
                                <td width="50" align="left"><?php echo $each_item['Warehouse']['id']; ?></td>
                                <td align="left" class="warehouseAnchor" ><?php echo $this->Html->link($each_item['Warehouse']['warehouse'],"#",array("class" => $each_item['Warehouse']['id'])); ?></td> <!-- Link to enable editing -->
                                <td align="left"><?php echo $each_item['Warehouse']['town']; ?></td>
                                <td width="20" align="left"><?php echo $this->Html->link("Delete","/Settings/delwarehouse/".$each_item['Warehouse']['id']); ?></td>
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
                                <td colspan="4" align="center">
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
                    </form>

                </div>
            <!-- Content ends here -->

<?php echo $this->element('footer'); ?>