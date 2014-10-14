            <?php 
            echo $this->element('header'); 
            echo $this->Html->script('notification.js');
            
            ?>
            
            <!-- Content starts here -->
                <div id="content">
                    <h2>Settings: Users Setup</h2>
                    <div id="clearer"></div>
                    <?php echo $this->Form->create('User',array("url" => array('controller' => 'Users', 'action' => 'users'),"inputDefaults" => array('label' => false,'div' => false)));?>
                    <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
                            <tr>
                                <td><h3 align="right">Username:</h3></td>
                                <td><?php echo $this->Form->input('username',array("class" => "large","size" => 20)); echo $this->Form->hidden('id'); ?></td>
                            </tr>
                            <tr>
                                <td><h3 align="right">Password:</h3></td>
                                <td><?php echo $this->Form->input('pass',array("class" => "large","size" => 20, "type" => "password")); ?></td>
                            </tr>
                            <tr>
                                <td><h3 align="right">Confirm Password:</h3></td>
                                <td><?php echo $this->Form->input('confirm_password',array("class" => "large","size" => 20, "type" => "password")); ?></td>
                            </tr>
                            <tr>
                                <td><h3 align="right">First Name:</h3></td>
                                <td><?php echo $this->Form->input('firstname',array("class" => "large","size" => 20)); ?></td>
                            </tr>
                            <tr>
                                <td><h3 align="right">Last Name:</h3></td>
                                <td><?php echo $this->Form->input('lastname',array("class" => "large","size" => 20)); ?></td>
                            </tr>
                            <tr>
                                <td><h3 align="right">E-mail:</h3></td>
                                <td><?php echo $this->Form->input('email',array("class" => "large","size" => 30)); ?></td>
                            </tr>
                             <tr>
                                <td width="120" align="right"><h3>Department:</h3></td>
                                <td><?php 
                                        echo $this->Form->input('userdepartment_id',array('empty' => '--Please Select--'));                                
                                ?></td>
                            </tr>
                            <tr>
                                <td><h3 align="right">User Type:</h3></td>
                                <td> <?php
                                    
                                        echo $this->Form->input('usertype_id',array('empty' => '--Please Select--'));                                
                                
                                    ?>
                                   
                                </td>
                            </tr>
                            <tr>
                                <td><h3 align="right">&nbsp;</h3></td>
                                <td>
                                    <?php echo $this->Form->button('Save',array("type" => "submit","id" => "userBtn","class" => "button_green")); //check the parameters here ?>
                                </td>
                            </tr>
                    </table>
                    <?php
                    echo $this->Form->end();
                    ?>
                    
                    <div id="clearer"></div>
                    
                     <?php 
                            echo $this->Form->create('',array("url" => array('controller' => 'Users', 'action' => '#'),"inputDefaults" => array('label' => false,'div' => false)));
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
                            <?php foreach($data as $each_item): ?>
                            <tr>
                                <td width="50" align="left"><?php echo $each_item['User']['id']; ?></td>
                                <td align="left" class="userAnchor"><?php echo $this->Html->link($each_item['User']['username'],"#",array("class" => $each_item['User']['id'])); ?></td> <!-- Link to enable editing -->
                                <td align="left"><?php echo $each_item['User']['firstname']; ?></td>
                                <td align="left"><?php echo $each_item['User']['lastname']; ?></td>
                                <td align="left"><?php echo $each_item['Usertype']['usertype']; ?></td>
                                 <td style="padding-left: 17px;padding-right: 17px;" align="center"><?php echo $each_item['User']['email']; ?></td>
                                <td align="left"><?php echo $this->Form->input('',array("class" => "user_del","id"=> $each_item['User']['id'], "type" => "button")); ?></td>
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
                             <?php
                       echo $this->Form->end();  ?>
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