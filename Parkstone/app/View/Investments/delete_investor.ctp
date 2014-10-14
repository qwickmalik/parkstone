<?php
echo $this->element('header');
echo $this->Html->script('notification.js');

?>

<!-- Content starts here -->
<div id="content">
    <h1>Delete Investor</h1>
    <div id="content_menu">
        <?php // echo $this->element('topbar_investments'); ?>
    </div>
    
    <div id="clearer"></div>

    <?php echo $this->Form->create('Investor', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'searchInvestorforDel'), "inputDefaults" => array('div' => false))); ?>
    <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">
        
        <tr>
            <td align="center" colspan="3" style="color: red; font-weight: bold;">Please enter surname or first name</td>
        </tr>
        <tr>
            <td align="center" valign="top" colspan="3">
                <?php
                echo $this->Form->input('search', array('size'=> 70, 'class'=>'search','value' => (isset($int['Investor']['full_name']) ? $int['Investor']['full_name'] : '' ),'name' => 'investor_search', 'id'=> (isset($int['Investor']['id']) ? $int['Investor']['id'] : '' ),'label'=>false));?>
                <input type="hidden" name="hid_cust" value="<?php (isset($int['Investor']['id']) ? $int['Investor']['id'] : '' ); ?>" />
              <?php  echo $this->Form->button('Search', array("type" => "submit", "id" => "search", "class" => "button_blue"));
                ?>
            </td>
        </tr>
    </table>
<?php 
    echo $this->Form->end();
?>
<div id="clearer"></div>

<!--    <form id="order_list" action="#" method="post">-->
    <?php echo $this->Form->create('Investments', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Orders', 'action' => '#'), "inputDefaults" => array('div' => false))); ?>
        <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
                <tr>
                      <td style="border-bottom: solid 2px dodgerblue;" align="left">
                          <b><?php echo $this->Paginator->sort('surname', 'Surname'); ?></b>
                      </td>
                    <td style="border-bottom: solid 2px dodgerblue" align="left">
                        <b><?php echo $this->Paginator->sort('first_name', 'First Name'); ?></b>
                    </td>
                    <td style="border-bottom: solid 2px dodgerblue" width="200" align="left">
                        <b><?php echo $this->Paginator->sort('mobile_no', 'Mobile Number'); ?></b>
                    </td>
                    <td style="border-bottom: solid 2px dodgerblue" align="left">
                        <b><?php echo $this->Paginator->sort('work_place', 'Work Place'); ?></b>
                    </td>
                    <td style="border-bottom: solid 2px dodgerblue" align="left">
                        <b>Del</b>
                    </td>
                </tr>
                <?php foreach($investor as $each_item): ?>
                <tr>
                    <td align="left">
                        <?php echo $this->Html->link($each_item['Investor']['surname'],"/Investments/investorDetails/".$each_item['Investor']['id'],array("class" => $each_item['Investor']['id'])) ; ?>
                    </td>
                    <td align="left" class="custAnchor">
                        <?php echo $this->Html->link($each_item['Investor']['first_name'],"/Investments/investorDetails/".$each_item['Investor']['id'],array("class" => $each_item['Investor']['id'])); ?>
                    </td> <!-- Link to enable editing -->
                    <td width="200" align="left">
                        <?php echo $each_item['Investor']['mobile_no']; ?>
                    </td>
                    <td width="200" align="left">
                        <?php echo $each_item['Investor']['work_place']; ?>
                    </td>
                    <td width="20" align="left">
                    <?php echo $this->Html->link("Delete", "/Investments/delInvestor/" . $each_item['Investor']['id'], array("class" => $each_item['Investor']['id'], 'style' => 'color: Red;')); ?>
                    </td>

                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5" align="right">
                    
                    </td>
                </tr>
                <tr>
                    <td colspan="5" align="center">
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
                <tr>
                    <td colspan="5" align="right">
                        <?php
                //echo $this->Form->button('Delete', array("type" => "#", "class" => "button_red"));           //check the parameters here
                ?>
                    </td>
                </tr>
        </table>
    <?php 
        echo $this->Form->end();
    ?>
    <tr>
        <td colspan="5">
        </td>
    </tr>
</div>
<!-- Content ends here -->

<!-- Sidebar starts here -->
    <div id="sidebar">
         <?php 
         echo $this->element('logo');
         echo $this->element('sidebar_investments'); //Mini Dashboard
          ?>
    </div>
<!-- Sidebar starts here -->
<!-- Footer starts here -->
<?php echo $this->element('footer'); ?>
<!-- Footer starts here -->
