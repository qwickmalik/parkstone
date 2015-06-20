<?php
echo $this->element('header');

$username = "Unknown";
if ($this->Session->check('userData')) {
    $username = $this->Session->read('userData');
    $username = ucwords(strtolower($username));
} else {
    $username = "Unknown";
    $username = ucwords(strtolower($username));
}
?>
<!-- Content starts here -->
<div id="content">
    <h2>Owners Equity</h2>
    <div class="boxed">
        <div class="inner">
            <div id="clearer"></div>
            <div id="content_menu">
        <?php
        $list = array(
            $this->Html->link($this->Html->image('plus.png') . 'Add New Financial Category', '/Settings/transactionCategories', array('escape' => false))
        );
        echo $this->Html->nestedList($list, $tag = 'ul');
        ?>
    </div>
    <div id="clearer"></div>
    <?php echo $this->Form->create('Transaction', array("url" => array('controller' => 'Accounting', 'action' => 'ownerEquity'), "inputDefaults" => array('div' => false,))); ?>
<div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <label>Transaction Date</label>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php
                    if (isset($ex['Transaction']['transaction_date'])) {

                        $dob_string = $ex['Transaction']['transaction_date'];
                        $month = date('m', strtotime($dob_string));
                        $day = date('d', strtotime($dob_string));
                        $Year = date('Y', strtotime($dob_string));
                    } else {

                        $month = date('m');
                        $day = date('d');
                        $Year = date('Y');
                    }
                    ?>
                    <input type="hidden" id="month" value="<?php echo $month; ?>"/>
                    <input type="hidden" id="day" value="<?php echo $day; ?>"/>
                    <input type="hidden" id="year" value="<?php echo $Year; ?>"/>
                    <?php echo $this->Form->day('transaction_date', array("selected" => $day)); ?>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php echo $this->Form->month('transaction_date', array("selected" => $month)); ?>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <?php echo $this->Form->year('transaction_date', 1950, date('Y'), array("selected" => $Year)); ?>
                </div>
                <script>
                    var day = $("#day").val();
                    var month = $("#month").val();
                    var year = $("#year").val();
                    $("#TransactionTransactionDateDay option[value=" + day + "]").attr('selected', true);
                    $("#TransactionTransactionDateMonth option[value=" + month + "]").attr('selected', true);
                    $("#TransactionTransactionDateYear option[value=" + year + "]").attr('selected', true);
                </script>
            </div>
            
            <?php
//            echo $this->Form->input('transaction_date', array('type' => 'date', 'value' => isset($ex['Transaction']['transaction_date']) ? date('d-m-Y',strtotime($ex['Transaction']['transaction_date'])) : date('d-m-Y'), 'dateFormat' => 'DMY', 'class' => 'form-control', 'div' => array('class' => 'form-inline')));
            echo $this->Form->hidden('id', ['value' => isset($ex['Transaction']['id']) ? $ex['Transaction']['id'] : '']);
            echo $this->Form->hidden('create_date', array('type' => 'date', 'value' => isset($ex['Transaction']['create_date']) ? $ex['Transaction']['create_date'] : date('Y-m-d H:i:s')));
            echo $this->Form->hidden('modified', array('type' => 'date', 'value' => date('Y-m-d H:i:s')));
            ?>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?php 
                    echo $this->Form->input('headid', array('label' => 'Accounting Head', 'options' => $headids, 'value' => 3, 'disabled' => true));
                    echo $this->Form->hidden('head_id', array('value' => 3));
        //             echo $this->Form->hidden('transaction_type', array('value' => 'Withdrawal'));
                ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?php
                    echo $this->Form->input('category_id', array('required', 'label' => 'Category*', 'empty' => '--Please Select--', 'value' => isset($ex['Transaction']['category_id']) ? $ex['Transaction']['category_id'] : ''));
                    
                    ?>
                    
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php
                    echo $this->Form->input('account_id', array('required', 'label' => 'Cash Account/Repository', 'empty' => '--Please Select--', 'value' => isset($ex['Transaction']['account_id']) ? $ex['Transaction']['account_id'] : ''));
                    ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?php 
                    echo $this->Form->input('amount', array('required', 'label' => 'Amount*', 'value' => isset($ex['Transaction']['amount']) ? $ex['Transaction']['amount'] : '')); 
                    echo $this->Form->hidden('old_amount', ['value' => isset($ex['Transaction']['amount']) ? $ex['Transaction']['amount'] : '']);
                    ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    
                    <fieldset>
                        <?php
                        $msg = 'Increase = Owner invests money into business. Decrease = Owner withdraws part of investment. NOTE: to pay dividends, please use the Assets and/or Liabilities submodules';
                        
                        echo $this->Form->input('effect', array(
                            'required',
                            'type' => 'radio', 
                            'options' => array("1" => "Increase", "0" => "Decrease"),
                            'hiddenField' => false, 
                            'legend' => false,
                            'before' => '<label>Effect on Asset Category</label>'.$this->Html->link($this->Html->image('help.png'), '#', array('rel'=>'tooltip', 'data-placement'=>'top', 'title'=>$msg, 'escape' => false)).'<br />',
                            'label' => array('class' => 'control-label',),
                            'value' => isset($ex['Transaction']['effect']) ? $ex['Transaction']['effect'] : '', 
                            'class' => 'myradio',
                            )); //check the parameters here
                        ?>
                        </fieldset>
                    
                    <?php
                    echo $this->Form->hidden('old_effect', array('value' => isset($ex['Transaction']['effect']) ? $ex['Transaction']['effect'] : '')); 
                    ?>
                </div>
            </div>
            
            
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <?php echo $this->Form->input('paymentmode_id', array('required', 'empty' => '--Please Select--','label' => 'Payment Mode', 'value' => isset($ex['Transaction']['paymentmode_id']) ? $ex['Transaction']['paymentmode_id'] : '')); ?> 
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <?php echo $this->Form->input('cheque_no', array('label' => 'Cheque No.', 'value' => isset($ex['Transaction']['cheque_no']) ? $ex['Transaction']['cheque_no'] : '')); ?> 
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <?php echo '<br /><br />'. $this->Form->input('cheque_cleared', array('type' => 'checkbox', 'checked' => isset($ex['Transaction']['cheque_cleared']) ? ($ex['Transaction']['cheque_cleared']>0 ? true : false) : false)); ?>
                </div>
            </div>
            <?php
            echo $this->Form->input('remarks', array('label' => 'Description', 'value' => isset($ex['Transaction']['remarks']) ? $ex['Transaction']['remarks'] : ''));
            ?>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?php echo $this->Form->input('paid_to', array('value' => isset($ex['Transaction']['paid_to']) ? $ex['Transaction']['paid_to'] : '')); ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?php echo $this->Form->input('preparedby', array('label' => 'Prepared By', 'value' => $username, 'disabled' => true));
            echo $this->Form->hidden('prepared_by', array('value' => $username));?>
                </div>
            </div>
            <?php
            echo $this->Form->button('Save', array("type" => "submit", "class" => "btn btn-md btn-success", 'style'=> 'float: right;')); 
            echo $this->Form->button('Clear', array("type" => "reset", "class" => "btn btn-md btn-default", 'style'=> 'float: right;'));
            ?>
        </div>
        
    </div>
    <?php $this->form->end(); ?>

<div id="clearer"></div>

    <table class="table table-striped">
        <tr>
            <th style="border-bottom: solid 2px dodgerblue;" width="50" align="left"><b><?php echo $this->Paginator->sort('id', 'ID'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('transaction_date', 'Trans. Date'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('head_id', 'Accounting Head'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('category_id', 'Trans. Category'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('account_id', 'Source Acc/Repository'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" width="60" align="right"><b><?php echo $this->Paginator->sort('amount', 'Amount'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" width="60" align="right"><b><?php echo $this->Paginator->sort('effect', 'Effect'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="right"><b><?php echo $this->Paginator->sort('cheque_no', 'Cheque No.'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('cheque_cleared', 'Cheque Cleared'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('remarks', 'Trans. Desc.'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('paid_to', 'Paid To'); ?></b></th>
            <th style="border-bottom: solid 2px dodgerblue;" align="left"><b><?php echo $this->Paginator->sort('prepared_by', 'Prepared By'); ?></b></th>
           <th style="border-bottom: solid 2px dodgerblue;" width="20" align="left"><b>Del</b></th>
        </tr>
        <?php
        foreach ($data as $each_item):
            ?>
            <tr>
                <td width="50" align="left"><?php echo $each_item['Transaction']['id']; ?></td>
                <td align="left"><?php echo $each_item['Transaction']['transaction_date']; ?></td>
                <td align="left"><?php echo $each_item['AccountingHead']['head_name']; ?></td>
                <td align="left"><?php echo $each_item['TransactionCategory']['category_name']; ?></td>
                <td align="left"><?php echo $each_item['CashAccount']['account_no']; ?></td>
                <td align="right"><?php echo $this->Html->link(number_format($each_item['Transaction']['amount'], 2, '.', ','), '/Accounting/ownerEquity/' . $each_item['Transaction']['id']); ?></td>
                <td align="left"><?php 
                    if($each_item['Transaction']['effect']==='1'){
                        echo '<span style="color: green;">Incr.</span>';
                    }elseif ($each_item['Transaction']['effect']==='0'){
                        echo '<span style="color: red;">Decr.</span>';
                    }else{
                        echo '';
                    }
                ?></td>
                <td align="left"><?php echo $each_item['Transaction']['cheque_no']; ?></td>
                <td align="left"><?php  
                    if(!empty($each_item['Transaction']['cheque_no'])){
                    echo $each_item['Transaction']['cheque_cleared']>0? '<span style="color: green;">Yes</span>': '<span style="color: red;">No</span>'; 
                    }
                ?></td>
                <td align="left"><?php echo $each_item['Transaction']['remarks']; ?></td>
                <td align="left"><?php echo $each_item['Transaction']['paid_to']; ?></td>
                <td align="left"><?php echo $each_item['Transaction']['prepared_by']; ?></td>
                <td align="left"><?php echo $this->Html->link('Del', '/Accounting/delOwnerEqity/' . $each_item['Transaction']['id'], array('confirm' => 'Are you sure you want to delete?')); ?></td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td colspan="13" align="right">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="13" align="center">
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
<!-- Content ends here -->
<!-- Footer starts here -->
<?php echo $this->element('footer'); ?>
<!-- Footer starts here -->

    <script lang="javascript">
        jQuery(document).ready(function ($) {
               function hide_chequeno() {
                var cashmode = $("#TransactionPaymentmodeId").val();
                if (cashmode == '2') {
                    $("#TransactionChequeNo").prop('disabled', false);
                    return false;
                }
                if (cashmode != '2' && cashmode != '4' ) {
                    $("#TransactionChequeNo").prop('disabled', true);
                    return false;
                }
            }





            //DISABLE CHEQUENO if CASH
            hide_chequeno();
            $("#TransactionPaymentmodeId").change(function () {
                hide_chequeno();
            });
            
            });
            
            
    </script>
 