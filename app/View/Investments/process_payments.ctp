<?php
echo $this->Html->script('notification.js');
echo $this->element('header');
?>

<!-- Content starts here -->
<h3>Process Payments</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>
		
  <?php echo $this->Form->create('Investment', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'searchInvest4mInvest'), "inputDefaults" => array('div' => false))); ?>
    <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">
        
        <tr>
            <td align="center" colspan="3" style="font-size: 18px; color: gray; font-weight: bold;">Find Investor</td>
        </tr>
        <tr>
			<td align="left" valign="top" >&nbsp;</td>
            <td align="center" valign="middle" width="375">
				
                <?php
    echo $this->Form->input('search', array('size' => 70, 'class' => 'search', 'value' => (isset($int['Investor']['fullname']) ? $int['Investor']['fullname'] : '' ), 'name' => 'investor_search', 'id' => (isset($int['Investor']['id']) ? $int['Investor']['id'] : '' ), 'label' => false));
    
    ?>
     <input type="hidden" name="hid_cust" value="<?php (isset($int['Investor']['id']) ? $int['Investor']['id'] : '' ); ?>" />
	<input type="hidden" name="conditions" value="payments" />	
              <?php  echo $this->Form->button('Search', array("type" => "submit", "id" => "search", "class" => "btn btn-lg btn-success"));
                ?>
                &nbsp;
                <?php 
					echo $this->Html->link('Proceed',"/Investments/manageClientInvestments/".(isset($int['Investor']['id']) ? $int['Investor']['id']."/".$int['Investor']['fullname'] : '' ),array("class" => 'btn btn-lg btn-primary')); 
				?>
                <span style="color: red;"></span>
            </td>
			<td align="left" valign="top" >&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top" width="375"></td>
            <td align="left" valign="top"></td>
        </tr>
    </table>
<?php 
    echo $this->Form->end();
?>
<div id="clearer"></div>
    <?php
//   echo $this->Form->create('Investment', array("url" => array('controller' => 'Investments', 'action' => '#'), "inputDefaults" => array('label' => false, 'div' => false)));
    ?>
    <table border="0" width="100%" cellspacing="5" cellpadding="5" align="left">
        <tr>
            <td style="border-bottom: solid 2px dodgerblue;" width="90" align="left"><b><?php  echo $this->Paginator->sort('id', 'ID'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php  echo $this->Paginator->sort('comp_name', 'Company Name'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php  echo $this->Paginator->sort('fullname', 'Investor Name'); ?></b></td>
            <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('phone', 'Phone No.'); ?></b></td>
             <td style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('email', 'Email'); ?></b></td>
              <td style="border-bottom: solid 2px dodgerblue;" align="left"><b>Statements</b></td>
        </tr>
        <?php if(isset($data)){ foreach ($data as $each_item) { ?>
            <tr>
                <td align="left"><?php  echo $each_item['Investor']['id']; ?></td>
                <td align="left"><?php echo $this->Html->link($each_item['Investor']['comp_name'], "/Investments/searchInvest4mInvest/". $each_item['Investor']['id']."/payments", array()); ?></td>  <!--Link to enable editing -->
                <td align="left"><?php echo $this->Html->link($each_item['Investor']['fullname'], "/Investments/searchInvest4mInvest/". $each_item['Investor']['id']."/payments", array()); ?></td>  <!--Link to enable editing -->
                <td align="left"><?php  echo $each_item['Investor']['phone']; ?></td>
                <td align="left"><?php  echo $each_item['Investor']['email']; ?></td>
<td align="left"><?php echo $this->Html->Link('Active Investments', '/Investments/statementActiveInv',array('escape'=>false));?> | <?php echo $this->Html->Link('All Investments', '/Investments/statementAllInv',array('escape'=>false));?></td>
            </tr>
        <?php  }} ?>

        <tr>
            <td colspan="6" align="right">
                <?php //echo $this->Form->end();
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="6" align="center">
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
    <div id="clearer"></div>


</div>
<!-- Content ends here -->