            <?php 
            echo $this->element('header'); 
            echo $this->Html->script('notification.js');
 
//$shopCurrencyname = "Unknown";
//if ($this->Session->check('shopCurrencyname')) {
//    $shopCurrencyname = $this->Session->read('shopCurrencyname');
//    $shopCurrencyname = ucwords(strtolower($shopCurrencyname));
////    $shopCurrencyname = $this->Session->read('shopCurrencyname');
//} else {
//    $shopCurrencyname = "Unknown";
//    //$shopCurrencyname = ucwords(strtolower($shopCurrencyname));
//}
            ?>
            <!-- Content starts here -->
<h3>Exchange Rates</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

                    <?php echo $this->Form->create('ExchangeRate',array("url" => array('controller' => 'Settings', 'action' => 'exchangeRates')));?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <?php 
                                echo $this->Form->input('currency_id',array('default' => 0,'label' => 'Foreign Currency Name','empty' => '--Please Select--')); 
                                echo $this->Form->input('local_currency_name', ['value' => isset($curr['Currency']['currency_name']) ? $curr['Currency']['currency_name'] : '', 'disabled' => true]);
                                ?>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <?php 
                                echo $this->Form->input('foreign_currency',array('label' => 'Foreign Currency Value',));
                                echo $this->Form->input('local_currency',array('label' => 'Local Currency Value',)); 
                                echo $this->Form->hidden('id');
                                echo $this->Form->button('Save',array("type" => "submit","class" => "btn btn-lg btn-success", 'style' => 'float: right;'));
                                ?>
                            </div>
                        </div>
                        
                        
                    <?php echo $this->Form->end(); ?>
                        
                    </table>
                    <div id="clearer"></div>
                    
                     <?php 
                         //   echo $this->Form->create('',array("url" => array('controller' => 'Settings', 'action' => '#'),"inputDefaults" => array('label' => false,'div' => false)));
                        ?>
                    
                    <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
                            <tr>
                                <td style="border-bottom: solid 2px dodgerblue;" width="50" align="center"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
                                <td style="border-bottom: solid 2px dodgerblue" align="center"><b><?php echo $this->Paginator->sort('currency_name', 'Currency'); ?></b></td>
                                <td style="border-bottom: solid 2px dodgerblue" align="center"><b><?php echo $this->Paginator->sort('foreign_currency', 'Rate'); ?></b></td>
                                <td style="border-bottom: solid 2px dodgerblue;" align="center"><b><?php echo $this->Paginator->sort('local_currency', 'Local Cur. Rate'); ?></b></td>
                                <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></td>
                            </tr>
                           <?php if(isset($data)){
                             foreach($data as $each_item): ?>
                            <tr>
                                
                               
                                <td width="50" align="center" ><?php echo $each_item['ExchangeRate']['id']; ?></td> <!-- Link to enable editing -->
                                <td align="center" class="exAnchor"><?php echo $this->Html->link($each_item['Currency']['currency_name'],"#",array("class" => $each_item['ExchangeRate']['id']));?></td>
                                <td align="center"><?php echo $each_item['ExchangeRate']['foreign_currency']; ?></td>
                                <td align="center"><?php echo $each_item['ExchangeRate']['local_currency']; ?></td>
                                <td align="left"><?php echo $this->Form->input('',array("class" => "ex_del","id"=> $each_item['ExchangeRate']['id'], "type" => "button")); ?></td>
                            </tr>
                            <?php endforeach; } ?>
                            
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
                      // echo $this->Form->end();  ?>
                </div>
            <!-- Content ends here -->
               
                        <?php echo $this->element('footer'); ?>