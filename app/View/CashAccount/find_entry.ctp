<?php
echo $this->element('header');
echo $this->Html->script('notification.js');
echo $this->Html->script('jquery.printElement.js');

if ($this->Session->check('shopCurrency')) {
    $shopCurrency = $this->Session->read('shopCurrency');
} else {
    $shopCurrency = "";
}

if (isset($customer)) {
    $customer_name = $customer;
} else {
    $customer_name = "[customer]";
}

if (isset($start_date)) {
    $sdate = $start_date;
} else {
    $sdate = "[start_date]";
}

if (isset($end_date)) {
    $edate = $end_date;
} else {
    $edate = "[end_date]";
}
?>
<!-- Content starts here -->
<div id="content">
    <h2>Find Cash Entries</h2>
    <div id="clearer"></div>


    <table cellspacing="10" cellpadding="0" width="100%" border="0" style="background: #fafad2;">
        <?php echo $this->Form->create('CashAccount', array("url" => array('controller' => 'CashAccounts', 'action' => 'findEntry'))); ?>
<!--        <tr id="hidrow">
            
            <td colspan="2"><?php //
               // echo $this->Form->input('from', array('type' => 'date', 'dateFormat' => 'DMY', "class" => "large"));
                ?></td>

            <td colspan="3"><?php
              //  echo $this->Form->input('to', array('type' => 'date', 'dateFormat' => 'DMY', "class" => "large"));
                ?>
            </td>
            <td  align="left">
                <?php
             //   echo $this->Form->button('View', array("type" => "submit", "class" => "button_green"));
                ?> 
            </td>
        </tr>
        <?php //echo $this->Form->end(); ?>
        <tr>
            <td align="right">&nbsp;</td>
            <td align="right" colspan="5">

            </td>
        </tr>-->
                <tr>
                                    <th align="center">Start Date</th>
                                    <th align="center">End Date</th>
                                    <th align="center">&nbsp;</th>
                                    <th align="center">&nbsp;</th>
                                </tr>
                                <tr>
                                    <td align="center" valign="top">
                                        <?php 
                                            echo $this->Form->input('begin_date',array('type' => 'date','dateFormat' =>'DMY', 'label'=>false));                                
                                            ?>
                                    </td>
                                    <td align="center" valign="top">
                                        <?php 
                                            echo $this->Form->input('finish_date',array('type' => 'date','dateFormat' =>'DMY', 'label'=>false));                                
                                            ?>
                                    </td>
                                    <td align="center" valign="top">
                                        <input type="hidden" name="data[Setting][from]" id="dtFrom" />
                                    </td>
                                    <td align="right" valign="top">
                                        <?php
                                        echo $this->Form->button('View', array("type" => "submit", "class" => "button_green"));
                                        ?>
                                    </td>
                                </tr>
                                    
                                <?php echo $this->Form->end(); ?>
                                </table>
    <div id="clearer"></div>
             

    <form id="order_list" action="#" method="post">
        <table border="0" width="100%" cellspacing="10" id ="report_content" cellpadding="0" align="left">
            
   <tr>
                                <th style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></th>
                                <th style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo $this->Paginator->sort('expense_name', 'Account Heading'); ?></b></th>
                                <th style="border-bottom: solid 2px dodgerblue" width="120" align="left"><b><?php echo $this->Paginator->sort('expense_type', 'Account Type'); ?></b></th>
                                 <th style="border-bottom: solid 2px dodgerblue" width="80" align="left"><b><?php echo $this->Paginator->sort('zone', 'Zone'); ?></b></th>
                                <th style="border-bottom: solid 2px dodgerblue" width="60" align="left"><b><?php echo $this->Paginator->sort('amount', 'Amount'); ?></b></th>
                                <th style="border-bottom: solid 2px dodgerblue;" width="120" align="left"><b><?php echo $this->Paginator->sort('expense_date', 'Date'); ?></b></th>
                                
                                <th style="border-bottom: solid 2px dodgerblue;"  align="left"><b><?php echo $this->Paginator->sort('remarks', 'Description'); ?></b></th>
         
                            </tr>
                            <?php foreach($data as $each_item): 
                            
                            switch ($each_item['CashAccount']['expense_type']){
                              case 0:
                                  $expensename = "Expense";
                                  break;
                               case 1:
                                  $expensename = "New_Loans";
                                  break;
                               case 2:
                                  $expensename = "Owner_Investment";
                                  break;
                              case 3:
                                  $expensename = "Owner_Withdrawal";
                                  break;
                              case 4:
                                  $expensename = "Loan_Repayment";
                                  break;
                              case 5:
                                  $expensename = "Tax Payments";
                                  break;
                              case 6:
                                  $expensename = "Deposits";
                                  break;
                              case 7:
                                  $expensename = "Petty Cash Dispensation";
                            }
                            
                            ?>
                            <tr>
                                <td width="50" align="left"><?php echo $each_item['CashAccount']['id']; ?></td>
                                <td align="left"><a href="#"><?php echo $each_item['Expense']['payment_name']; ?></a></td> <!-- Link to enable editing -->
                              <td width="120" align="left"><?php echo $expensename ?></td>
                              
                              <td width="80" align="left"><?php echo $each_item['Zone']['zone']; ?></td>
                                <td width="60" align="left"><?php echo $each_item['CashAccount']['amount']; ?></td>
                                <td align="left"><?php echo $each_item['CashAccount']['expense_date']; ?></td>
                                <td  align="left"><?php echo $each_item['CashAccount']['remarks']; ?></td>
                                
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="7" align="right">
                                <?php
                                    //echo $this->Form->button('Delete',array("type" => "#","class" => "button_red"));           //check the parameters here
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


        <tr>
            <td align="right" valign="top" colspan="6">
                <p style="font-style: italic;">Accessed on <?php echo date('d-m-Y'); ?></p>
            </td>
        </tr>
        <tr>
            <td align="right" valign="top" colspan="6">
<?php
echo $this->Html->link('Print', "javascript:void(0)", array("class" => 'button_red', "id" => "print_report"));
?>
            </td>
        </tr>


    </table>
    <br></br><br></br>

</div>

<!-- Content ends here -->

<!-- Sidebar starts here -->
<div id="sidebar">
    <?php
    echo $this->element('logo');
    echo $this->element('sidebar_company_accounts'); //Accounts menu
   // echo $this->element('sidebar'); //Mini Dashboard
    ?>
</div>
<!-- Sidebar starts here -->
<!-- Footer starts here -->
<?php echo $this->element('footer'); ?>
<!-- Footer starts here -->
<script type="text/javascript">
    $(document).ready(function(){
        $("#print_report").click(function(event){
            event.preventDefault();
            $("#hidrow").hide();
            $("#reports_print").printElement();
            $("#hidrow").show();
        });
    });
    
    
</script>