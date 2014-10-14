            <?php 
            echo $this->element('header');
            echo $this->Html->script('notification.js');
             
            ?>
            
            <!-- Content starts here -->
                <div id="content">
                    <h2>Settings: Zones</h2>
                    
                    <div id="clearer"></div>
                    <?php echo $this->Form->create('Zone',array("url" => array('controller' => 'Settings', 'action' => 'zones'),"inputDefaults" => array('label' => false,'div' => false)));?>
                    <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
                            
                            <tr>
                                <td><h3 align="right">Zone Name:</h3></td>
                                <td><?php echo $this->Form->input('zone',array("class" => "large","size" => 40));?></td>
                            </tr>
                            <tr>
                                <td><h3 align="right">City/Town:</h3></td>
                                <td><?php echo $this->Form->input('suburb',array("class" => "large","size" => 40));?></td>
                            </tr>
                          
                            <tr>
                                <td><h3 align="right">&nbsp;</h3></td>
                                <td >
                                    <?php echo $this->Form->button('Save',array("type" => "submit","class" => "button_green")); //check the parameters here ?>
                                </td>
                            </tr>
                    </table>
                   <?php
                    echo $this->Form->end();
                   ?>
                    <div id="clearer"></div>
                    
                    <form id="zones_list" action="#" method="post">
                    <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
                            <tr>
                               <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
                                <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('zone_name', 'Zone Name'); ?></b></td>
                                <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('zone_town', 'Zone Town'); ?></b></td>
                                <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>
                            </tr>
                            <?php foreach($data as $each_item): ?>
                            <tr>
                                <td width="50" align="left"><?php echo $each_item['Zone']['id']; ?></td>
                                <td align="left" class="zoneAnchor"><?php echo $this->Html->link($each_item['Zone']['zone'],"#",array("class" => $each_item['Zone']['id'])); ?></td> <!-- Link to enable editing -->
                                <td align="left" class="zoneAnchor"><?php echo $each_item['Zone']['suburb']; ?></td>
                                <td width="20" align="left"><?php echo $this->Html->link("Delete","/Settings/delzone/".$each_item['Zone']['id']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4" align="right"></td>
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
                    </form>
                </div>
            <!-- Content ends here -->
               
            <!-- Sidebar starts here -->
                 <div id="sidebar">
                     <?php 
                     echo $this->element('logo');
                     echo $this->element('settings_sidebar'); //Settings menu
                     
                      ?>
                </div>
            <!-- Sidebar starts here -->
            <!-- Footer starts here -->
                <?php echo $this->element('footer'); ?>
            <!-- Footer starts here -->