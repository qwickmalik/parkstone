<?php
echo $this->element('header');
echo $this->Html->script('notification.js');
?>

<!-- Content starts here -->
<div id="content">
    <h2>Help</h2>
    <h3>Features</h3>

    <div id="clearer"></div>
    <table width="100%" align="left" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="left" valign="top">
                <ul>
                    <li><b>Reports: </b>All past records available with just a few clicks. In very few clicks, monitor the progress of your outlets, marketing executives, etc.</li>
                    <li><b>Security: </b>Password protection to ensure unauthorized access to your records. Different levels of access for users and audit trails have been put in place to ensure that records are not tampered with without approval.</li>
                    <li>Client capture and management: </b>Client details are captured once and stored, and can be made available in multiple sections of the application.</li>
                    <li><b>Stock management: </b>The application enables management of stocks and ties them with sales, thus eliminating the drudgery of managing suppliers, stocks, sales and the overall accounting activities separately.</li>
                    <li><b>Ordering, invoicing and payment: </b>The application  facilitates order placement, approval, delivery, invoicing and payment in accordance with the workflow of UCSL. It also enables handling of returned/repossessed goods and their resale.</li>
                    <li><b>Company Accounts: </b>A basic general accounting module has been incorporated to reduce the burden of managing goods sales with other financial activities such as operating costs; expenses on rent, salaries, utilities, etc; injection of additional capital in the form of owners equity, loans, etc.</li>
                    <li><b>Notification: </b>Customers can be contacted via auto-generated emails and SMS text messages at times stipulated by UCSL.</li>
                    <li><b>Accessibility: </b>The application runs over the internet and is therefore accessible anywhere in the world once there is internet access.</li>
                </ul>
            </td>
        </tr>
    </table>
   <h3>Frequently Asked Questions (FAQ)</h3>
   <p>Information coming soon</p>
</div>
<!-- Content ends here -->

<!-- Sidebar starts here -->
<div id="sidebar">
    <?php
    echo $this->element('logo');
    echo $this->element('sidebar_info');
    ?>
</div>
<!-- Sidebar starts here -->
<!-- Footer starts here -->
<?php echo $this->element('footer'); ?>
<!-- Footer starts here -->