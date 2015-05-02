<?php echo $this->element('header'); ?>


<h3 style="color: red;">Manage Processed Investments</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>


        <?php echo $this->Form->create('ListCashDeposits', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Reinvestments', 'action' => 'searchreinvestor4list'), "inputDefaults" => array('div' => false))); ?>
        
        <table border="0" width="100%" cellspacing="0" cellpadding="5" align="left">
            <tr>
                <td align="left" valign="top" colspan="3" ><p class="subtitle-blue">Step 2 - Fixed Investments - Select Action</p></td>
            </tr>
            <tr>
                <td align="center" colspan="3" ></td>
            </tr>
            <tr>
                <td align="center" valign="middle" colspan="3">
                    <div class="col-lg-4 col-md-6 col-sm-12" style="align: center; float: none;">
                        
                        <?php
                        echo $this->Form->input('company_name', array('label' => 'Company','empty' => '--Select Company--', 'default' => (isset($reinvestors['Reinvestor']['company_name']) ? $reinvestors['Reinvestor']['company_name'] : '' ),'disabled'));
                        
                        ?>
                        <span style="color: red;"></span>
                    </div>

                </td>
            </tr>
            
        </table>
        <?php
        echo $this->Form->end();
        ?>
        <div id="clearer"></div>

        <!--    <form id="order_list" action="#" method="post">-->
      <?php
echo $this->Form->create('', array("url" => array('controller' => 'Reinvestments', 'action' => '#'), "inputDefaults" => array()));
?>

        <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
            
            <tr>
                <td style="border-bottom: solid 2px dodgerblue;" width="50" align="left">
                    <b><?php echo $this->Paginator->sort('id', 'ID'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('investment_date', 'Investment Date'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('due_date', 'Due Date'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('currency_id', 'Currency'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('investment_amount', 'Amount Invested'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left">
                    <b><?php echo $this->Paginator->sort('interest_rate', 'Rate'); ?></b>
                </td>
                <td style="border-bottom: solid 2px dodgerblue; font-weight: bold;" align="left"><?php echo "Action"; ?></td>
            </tr>
            
            <?php foreach ($data as $each_item): ?>
                <tr>
                    <td width="50" align="left"><?php echo $each_item['Reinvestment']['id']; ?></td>
                    <td align="left"><?php echo $each_item['Reinvestment']['investment_date']; ?></td>
                    <td align="left"><?php echo $each_item['Reinvestment']['due_date']; ?></td>
                    <td align="left"><?php echo $each_item['Currency']['symbol']; ?></td>
                    <td align="left"><?php echo number_format( $each_item['Reinvestment']['investment_amount'], 2) ?></td>
                    <td align="left"><?php echo $each_item['Reinvestment']['interest_rate']; ?></td>
                    <td align="left">
                        <?php if($each_item['Reinvestment']['status'] == 'Invested' || 
                                $each_item['Reinvestment']['status']=='Rolled_over'
                                ){
                            echo $this->Html->link("Details","/Reinvestments/manageInvFixedDetails/".$each_item['Reinvestment']['id']);  
                            echo " | ";
                            echo $this->Html->link("Terminate","/Reinvestments/terminateFixedInvestment/".$each_item['Reinvestment']['id']."/".$each_item['Reinvestment']['reinvestor_id']);  
//                           
                        }elseif($each_item['Reinvestment']['status'] == 'Cancelled'){
                            echo $this->Html->link("Details","/Reinvestments/manageInvFixedDetails/".$each_item['Reinvestment']['id']);  
                            echo " | ";
                            echo $this->Html->link("Record Inv. Returns","/Reinvestments/payReinvestorFixed/".$each_item['Reinvestment']['id']); 
                        }elseif($each_item['Reinvestment']['status'] == 'Paid'){
                            echo $this->Html->link("Details","/Reinvestments/manageInvFixedDetails/".$each_item['Reinvestment']['id']);  
                      
                        }elseif($each_item['Reinvestment']['status'] == 'Matured' || $each_item['Reinvestment']['status'] == 'Part_payment'){
                           
                            echo $this->Html->link("Roll-over","/Reinvestments/rollover/".$each_item['Reinvestment']['id']."/".$each_item['Reinvestment']['reinvestor_id']);
                            //rolloverReinvestorFixed
                            echo " | ";
                            echo $this->Html->link("Record Inv. Returns","/Reinvestments/payReinvestorFixed/".$each_item['Reinvestment']['id']);  
                            }else{
                            echo $each_item['Reinvestment']['status'];
                        }
                        ?>
                    </td>
                    
                    
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

<?php echo $this->element('footer'); ?>