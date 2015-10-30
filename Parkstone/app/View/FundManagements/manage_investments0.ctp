
<!-- Content starts here -->
<h3 style="color: red;">Manage Investments</h3>
<div class="boxed">
    <div class="inner">
        <div id="clearer"></div>

        <table border="0" width="100%" cellspacing="5" cellpadding="5" align="left">
            <tr>
                <td style="border-bottom: solid 2px dodgerblue" align="left"><b><?php echo "Company/Subsidiary" ?></b></td>
                <td style="border-bottom: solid 2px dodgerblue;" align="left"><b>Statements</b></td>
            </tr>
            <tr>
            <td><?php echo $this->Html->link('Parkstone Capital Limited', '/FundManagements/manageClientInvestments/1', array('escape' => false));?></td>
            <td><?php 
                echo $this->Html->link('Active Investments', '/FundManagements/statementActiveInv', array('escape' => false));
                echo "&nbsp;|&nbsp;";
                echo $this->Html->link('All Investments', '/FundManagements/statementAllInv', array('escape' => false));
            ?></td>
            </tr>
            <tr>
            <td><?php echo $this->Html->link('Subsidiary 1', '/FundManagements/manageClientInvestments', array('escape' => false));?></td>
            <td><?php 
                echo $this->Html->link('Active Investments', '/FundManagements/statementActiveInv', array('escape' => false));
                echo "&nbsp;|&nbsp;";
                echo $this->Html->link('All Investments', '/FundManagements/statementAllInv', array('escape' => false));
            ?></td>
            </tr>
            <tr>
            <td><?php echo $this->Html->link('Subsidiary 2', '/FundManagements/manageClientInvestments', array('escape' => false));?></td>
            <td><?php 
                echo $this->Html->link('Active Investments', '/FundManagements/statementActiveInv', array('escape' => false));
                echo "&nbsp;|&nbsp;";
                echo $this->Html->link('All Investments', '/FundManagements/statementAllInv', array('escape' => false));
            ?></td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <?php //echo $this->Form->end();
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    
                </td>
            </tr>

        </table>
        <div id="clearer"></div>


    </div>
    <!-- Content ends here -->
<?php echo $this->element('footer'); ?>