<?php echo $this->element('header'); ?>


<!-- Content starts here -->
<h3>SETTINGS: Equities List</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>



        <?php echo $this->Form->create('EquitiesList', array("url" => array('controller' => 'Settings', 'action' => 'equitiesList'), "inputDefaults" => array())); ?>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <?php
//                    echo $this->Form->input('equity_name', []);
//                    echo $this->Form->hidden('id');
                    
                    echo $this->Form->input('equity_name', ['label' => 'Equity Name*', 'value' => isset($equity['EquitiesList']['equity_name']) ? $equity['EquitiesList']['equity_name'] : '', 'required']);
                    echo $this->Form->hidden('id', ['value' => isset($equity['EquitiesList']['id']) ? $equity['EquitiesList']['id'] : '']);
                    echo $this->Form->hidden('created', array('type' => 'date', 'value' => isset($ex['EquitiesList']['created']) ? $ex['EquitiesList']['created'] : date('Y-m-d H:i:s')));
                    ?>
                
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <?php 
                
                echo $this->Form->input('equity_abbrev', ['label' => 'Equity Abbrev*', 'value' => isset($equity['EquitiesList']['equity_abbrev']) ? $equity['EquitiesList']['equity_abbrev'] : '', 'required']);
                ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <?php 
                
//                echo $this->Form->input('share_price', ['default' => 0.00]); 
                
                echo $this->Form->input('share_price', ['label' => 'Share Price*', 'value' => isset($equity['EquitiesList']['share_price']) ? $equity['EquitiesList']['share_price'] : 0.00, 'required']);
                echo $this->Form->button('Save', ["type" => "submit", "id" => "equityBtn", "class" => "btn btn-lg btn-success", "style" => "float: right;"]);
                ?>
            </div>
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

        
            <table  class="table table-striped">
                <tr>
                    <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></td>
                    <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('equity_name', 'Equity Name'); ?></b></td>
                    <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('equity_abbrev', 'Equity Abbreviation'); ?></b></td>
                    <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('share_price', 'Share Price'); ?></b></td>
                    <td style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Delete</b></td>
                </tr>
                <?php foreach ($data as $each_item): ?>
                    <tr>
                        <td width="50" align="left">
                            <?php echo $each_item['EquitiesList']['id']; ?>
                        </td>
                        <td align="left">
                            <?php
//                            echo $this->Html->link($each_item['EquitiesList']['equity_name'], "#", array("class" => $each_item['EquitiesList']['id']));
                            echo $this->Html->link($each_item['EquitiesList']['equity_name'], "/Settings/equitiesList/".$each_item['EquitiesList']['id']);
                            ?>
                        </td> 
                        <td align="left" >
                            <?php echo $each_item['EquitiesList']['equity_abbrev']; ?>
                        </td> 
                        <td align="left" >
                            <?php echo $each_item['EquitiesList']['share_price']; ?>
                        </td> 
                        <td width="20" align="left">
                            <?php echo $this->Html->link("Delete", "/Settings/delEquityName/" . $each_item['EquitiesList']['id']);
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
                <tr>
                    <td colspan="5" align="center">
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
        
    </div>
    </div>
    <!-- Content ends here -->
<?php echo $this->element('footer'); ?>