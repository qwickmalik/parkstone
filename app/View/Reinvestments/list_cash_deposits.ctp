<?php
echo $this->Html->script('notification.js');
?>

<h3 style="color: red;">List Re-investor Cash Deposits</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>


        <?php echo $this->Form->create('ListCashDeposits', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'searchreinvestor4list'), "inputDefaults" => array('div' => false))); ?>
        
        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">

            <tr>
                <td align="center" colspan="3" ></td>
            </tr>
            <tr>
                <td align="center" valign="middle" colspan="3">
                    <div class="col-lg-4 col-md-6 col-sm-12" style="align: center; float: none;">
                        <?php //echo $this->Form->input('investmentproduct_id', array('label' => 'Investment Product', 'empty' => "--Please Select--", 'value' => (isset($investor['Investor']['investmentproduct_id']) ? $investor['Investor']['investmentproduct_id'] : '' )));
                    ?>
                        
                        
                        <p style="font-size: 18px; color: gray; font-weight: bold;">Find Re-Investor</p>
                        <?php
                        echo $this->Form->input('search', array('size' => 70, 'class' => 'search', 'value' => (isset($int['Reinvestor']['company_name']) ? $int['Reinvestor']['company_name'] : '' ), 'name' => 'investor_search', 'id' => (isset($int['Reinvestor']['id']) ? $int['Reinvestor']['id'] : '' ),
                            'label' => false));
                        ?>
                        <input type="hidden" name="hid_investor" value="<?php (isset($int['Reinvestor']['id']) ? $int['Reinvestor']['id'] : '' ); ?>" />

<?php echo $this->Form->button('Search', array("type" => "submit", "id" => "search", "class" => "btn btn-lg btn-success")); ?> &nbsp;

                        <span style="color: red;"></span>
                    </div>

                </td>
            </tr>
            <tr>
                <td align="left" valign="top" width="150">&nbsp;</td>
                <td align="left" valign="top" width="375"></td>
                <td align="left" valign="top" width="375"></td>
            </tr>
        </table>
        <?php
//        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

        <!--    <form id="order_list" action="#" method="post">-->
      <?php
//echo $this->Form->create('', array("url" => array('controller' => 'Reinvestments', 'action' => '#'), "inputDefaults" => array('label' => false, 'div' => false)));
?>

        <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
            <tr>
                <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left">
                    <b><?php echo $this->Paginator->sort('id', 'ID'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('company_name', 'Re-investor Company'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('currency_id', 'Currency'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue" align="left">
                    <b><?php echo $this->Paginator->sort('fixed_inv_amount', 'Fixed Inv. Amount'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('equity_inv_amount', 'Equity Inv. Amount'); ?></b>
                </td>
                <td align="left"><?php echo "Delete"; ?></td>
            </tr>
<?php foreach ($data as $each_item): ?>
                <tr>
                    <td width="50" align="left"><?php echo $each_item['ReinvestorDeposit']['id']; ?></td>
                    <td align="left" >
                        <?php echo $this->Html->link($each_item['Reinvestor']['company_name'], "/Reinvestments/editCashDeposit/" . $each_item['ReinvestorDeposit']['id'], array("class" => $each_item['ReinvestorDeposit']['id'])); ?>
                    </td> 
                    <td align="left"><?php echo $each_item['Currency']['currency_name']; ?></td>
                    <td align="left"><?php echo $each_item['ReinvestorDeposit']['fixed_inv_amount']; ?></td>
                    <td align="left"><?php echo $each_item['ReinvestorDeposit']['equity_inv_amount']; ?></td>
                    <td align="left"><?php echo $this->Html->link("Delete","/Reinvestments/delCashDeposit/".$each_item['ReinvestorDeposit']['id']);   ?></td>
                    
                </tr>
<?php endforeach; ?>
            <tr>
                <td colspan="5" align="right">
<?php
//  echo $this->Form->button('Delete',array("type" => "#","class" => "button_red"));           //check the parameters here
?><p>&nbsp;</p>
                </td>
            </tr>
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
<?php echo $this->Form->end(); ?>	

    </div>
    <!-- Content ends here -->
