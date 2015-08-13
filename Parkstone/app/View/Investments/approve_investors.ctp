<?php echo $this->element('header'); ?>
<h3>Approve Investors</h3>
<div class="boxed">
	<div class="inner">
            <div id="clearer"></div>


    <?php  echo $this->Form->create('Investor', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => 'approveInvestors2'), "inputDefaults" => array('div' => false))); ?>
    

    <!--    <form id="order_list" action="#" method="post">-->
    <?php // echo $this->Form->create('InvestorList', array('enctype' => 'multipart/form-data', "url" => array('controller' => 'Investments', 'action' => '#'), "inputDefaults" => array('div' => false))); ?>
    <table border="0" width="100%" cellspacing="10" cellpadding="0" align="left">
        <tr>
            <td style="border-bottom: solid 2px dodgerblue;" align="left" width="300">
                <b><?php echo $this->Paginator->sort('comp_name', 'Company Name'); ?></b>
            </td>
           
            <td style="border-bottom: solid 2px dodgerblue;" width="300" align="left">
                <b><?php echo $this->Paginator->sort('surname', 'Name'); ?></b>
            </td>
            <td style="border-bottom: solid 2px dodgerblue" width="300" align="left">
                <b><?php echo $this->Paginator->sort('joint_surname', 'Joint Acc Name'); ?></b>
            </td>
            <td style="border-bottom: solid 2px dodgerblue;" width="300" align="left">
                <b><?php echo $this->Paginator->sort('in_trust_for', 'ITF'); ?></b>
            </td>
            <td style="border-bottom: solid 2px dodgerblue;" width="100" align="left">
                <b><?php echo $this->Paginator->sort('investor_type', 'Investor Type'); ?></b>
            </td>
            <td style="border-bottom: solid 2px dodgerblue" width="200" align="left">
                <b><?php echo $this->Paginator->sort('phone', 'Phone Number'); ?></b>
            </td>
            <td style="border-bottom: solid 2px dodgerblue" align="left">
                <b><?php echo $this->Paginator->sort('approved', 'Approved?'); ?></b>
            </td>

        </tr>
        <?php  
        if(isset($investor)){
        foreach ($investor as $each_item): ?>
            <tr>
                <td align="left" width="300">   <?php if(!empty($each_item['Investor']['comp_name'])){ echo $this->Html->link($each_item['Investor']['comp_name'], "/Investments/investorDetails/" . $each_item['Investor']['id'], array("class" => $each_item['Investor']['id']));;}else{echo 'N/A';}  ?>
                </td>
                <td align="left" width="300" >  
 <?php  if(!empty($each_item['Investor']['surname']) || !empty($each_item['Investor']['other_names'])){echo $this->Html->link($each_item['Investor']['surname'].' '.$each_item['Investor']['other_names'], "/Investments/investorDetails/" . $each_item['Investor']['id'], array("class" => $each_item['Investor']['id']));}else{echo 'N/A';} ?>
                </td>
                <td align="left" width="300" class="investorAnchor">
                    <?php if(!empty($each_item['Investor']['joint_other_names'])|| !empty($each_item['Investor']['joint_surname'])){echo $this->Html->link($each_item['Investor']['joint_surname'].' '.$each_item['Investor']['joint_other_names'], "/Investments/investorDetails/" . $each_item['Investor']['id'], array("class" => $each_item['Investor']['id']));}else{echo 'N/A';}  ?>
                </td> 
                <td align="left">
                    <?php if(!empty($each_item['Investor']['in_trust_for'])){echo $each_item['Investor']['in_trust_for'];}else{echo 'N/A';} ?>
                </td>
                <td align="left">
                    <?php echo $each_item['InvestorType']['investor_type']; ?>
                </td>
                <td width="200" align="left">
                    <?php echo $each_item['Investor']['phone']; ?>
                </td>
                <td width="200" align="left">
                    <?php 
//                    echo $each_item['Investor']['approved']; 
                    echo $this->Form->hidden('id', array('value' => $each_item['Investor']['id']));
                    
                    if($each_item['Investor']['approved']=='1'){$checked='checked'."','";}else{$checked='';}
                    echo $this->Form->input('approved'.$each_item['Investor']['id'], array( 'type' => 'checkbox',$checked. 'label' => false, 'hiddenField' => false));
                    
                    ?>
                    
                </td>
            </tr>
        <?php endforeach; }
        ?>
        <tr>
            <td colspan="7" align="right">
                <?php echo $this->Form->button('Submit', array("type" => "submit", "id" => "Submit", "class" => "btn btn-lg btn-success"));
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="7" align="center">
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
    
    <?php
    echo $this->Form->end();
    ?>
        </div>
<?php echo $this->element('footer'); ?>