<?php echo $this->element('header'); ?>

<!-- Content starts here -->
<div id="content">
    <h1>New Investment - Step 1</h1>
    
    <div id="clearer"></div>

    <?php echo $this->Form->create('Investment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'searchInvest4Invest'), "inputDefaults" => array('div' => false))); ?>
    <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">
        
        <tr>
            <td align="center" colspan="3" style="font-size: 18px; color: gray; font-weight: bold;">Find Investor</td>
        </tr>
        <tr>
            <td align="center" valign="middle" colspan="3">
                <?php
    echo $this->Form->input('search', array('size' => 70, 'class' => 'search', 'value' => (isset($int['Investor']['fullname']) ? $int['Investor']['fullname'] : '' ), 'name' => 'investor_search', 'id' => (isset($int['Investor']['id']) ? $int['Investor']['id'] : '' ), 'label' => false));
    
    ?>
     <input type="hidden" name="hid_cust" value="<?php (isset($int['Investor']['id']) ? $int['Investor']['id'] : '' ); ?>" />

              <?php  echo $this->Form->button('Search', array("type" => "submit", "id" => "search", "class" => "button_blue"));
                ?>
                &nbsp;
                <?php echo $this->Html->link('Proceed',"/Investments/newInvestment2/".(isset($int['Investor']['id']) ? $int['Investor']['id'] : '' ),array("class" => 'button_green')); ?>
                <span style="color: red;"></span>
            </td>
        </tr>
        <tr>
            <td align="left" valign="top" width="150">&nbsp;</td>
            <td align="left" valign="top" width="375"></td>
            <td align="left" valign="top" width="375"></td>
        </tr>
    </table>
<?php 
    echo $this->Form->end();
?>
<div id="clearer"></div>

<!--    <form id="order_list" action="#" method="post">-->
    <?php echo $this->Form->create('OrderList', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Orders', 'action' => '#'), "inputDefaults" => array('div' => false))); ?>
        <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
                <tr>
                      <td style="border-bottom: solid 2px dodgerblue;" align="left">
                          <b><?php echo $this->Paginator->sort('surname', 'Surname'); ?></b>
                      </td>
                    <td style="border-bottom: solid 2px dodgerblue" align="left">
                        <b><?php echo $this->Paginator->sort('other_names', 'Other Names'); ?></b>
                    </td>
                    <td style="border-bottom: solid 2px dodgerblue" width="200" align="left">
                        <b><?php echo $this->Paginator->sort('phone', 'Phone Number'); ?></b>
                    </td>
                    <td style="border-bottom: solid 2px dodgerblue" align="left">
                        <b><?php echo $this->Paginator->sort('email', 'Email'); ?></b>
                    </td>
                </tr>
                
                <?php 
                
        if(isset($investor)){
            foreach($investor as $each_item): ?>
                <tr>
                    <td align="left">
                        <?php echo $this->Html->link($each_item['Investor']['surname'],"/Investments/searchInvest4Invest/".$each_item['Investor']['id'],array("class" => $each_item['Investor']['id'])) ; ?>
                    </td>
                    <td align="left" class="orderAnchor">
                        <?php echo $this->Html->link($each_item['Investor']['other_names'],"/Investments/searchInvest4Invest/".$each_item['Investor']['id'],array("class" => $each_item['Investor']['id'])); ?>
                    </td> <!-- Link to enable editing -->
                    <td width="200" align="left">
                        <?php echo $each_item['Investor']['phone']; ?>
                    </td>
                    <td width="200" align="left">
                        <?php echo $each_item['Investor']['email']; ?>
                    </td>

                </tr>
                <?php endforeach;} ?>
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
    <?php 
        echo $this->Form->end();
    ?>

</div>
<!-- Content ends here -->

<!-- Footer starts here -->
<?php echo $this->element('footer'); ?>
<!-- Footer starts here -->
