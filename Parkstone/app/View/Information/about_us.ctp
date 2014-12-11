<?php
//echo $this->element('header');
echo $this->Html->script('notification.js');
?>

<!-- Content starts here -->
<div id="content">
    <h2>About Us</h2>

    <div id="clearer"></div>
    <table width="100%" align="left" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="left" valign="top">
                <p>
                    <b>QwickFusion</b> is a company based in Accra, Ghana, engaged in providing information technology (IT) services and solutions namely, 
                <ul>
                <li>software and website development</li>
                <li>web hosting</li>
                <li>domain name registration</li>
                </ul>
                to corporate and other organizations, as well as individuals, to help them meet the needs of operating in this new IT-driven globalized world. 
                </p>

                <h3>Contact Us</h3>
                <ul style="list-style: none;">
                    <li>P.O. Box OS 729, Osu, Accra, Ghana</li>
                    <li>+233-24-6335380</li>
                    <li>+233-24-3080560</li>
                    <li>www.qwickfusion.com</li>
                    <li>info@qwickfusion.net</li>
                </ul>
            </td>
        </tr>
    </table>
    

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