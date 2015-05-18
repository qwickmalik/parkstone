<div class="row-fluid">
    <!-- block -->
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left"><?php echo $formTitle; ?></div>
            <?php echo $this->element('version'); ?>      

        </div>

        <?php if (isset($status_msg) && !empty($status_msg)) { ?>

            <div class="alert alert-info">
                <h4><i class="icon-ok"></i><?php echo $status_msg; ?></h4>

                <!-- <h4>
                   <i class="icon-ok"></i><?php echo $status_proceed; ?>
                 </h4>-->
            </div>
        <?php } ?>
        <div class="block-content collapse in">
            <div class="span12">
                <form class="form-horizontal" enctype="multipart/form-data" id="audit-trail">
                    <fieldset>
                        <legend>Provide Audit Details</legend>
                       
                            <div class="well">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Audit Type</th>
                                            <th>System User</th>
                                            <th>Event</th>
                                            <th>Date</th>
                                            <th style="width: 36px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php if (!empty($audit_search_record)) { ?>
                                        <?php foreach ($audit_search_record as $audit_search_records): ?>
                                            <tr>
                                                <td><?php echo $audit_search_records['Sysaudit']['AUDITTYPE']; ?></td>
                                                <td><?php echo $audit_search_records['EhmisUser']['FIRSTNAME'].' '.$audit_search_records['EhmisUser']['FIRSTNAME']; ?></td>
                                                <td><?php echo $audit_search_records['Sysaudit']['EVENT']; ?></td>
                                                <td><?php echo $audit_search_records['Sysaudit']['AUDITDATE']; ?></td>
                                                <!--<td>
                                                    <a href="#"><i class="icon-pencil"></i></a>
                                                    <a href="#myModal" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
                                                </td>
                                                -->
                                            </tr>
                                        <?php endforeach; ?>
                                             <?php } ?>   
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination">
                                 <table>
                                <tbody>
                       
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
                            </tbody>
                        </table>
<!--                                <ul>
                                    <li><a href="#">Prev</a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">Next</a></li>
                                </ul>-->
                            </div>
                         
        
                        </br></br></br></br>
                        <div class="control-group">
                            <div class="controls">
                                 <a class="btn btn-primary btn-inverse" href='<?php echo $this->Html->url('/Settings/create_audit_trail',true); ?>' >Back</a>
                                 
                            </div>
                        </div>
                    </fieldset>
                </form>


            </div>
        </div>
    </div>
    <!-- /block -->
</div>

<?php echo $this->Html->script("settings.js"); ?>
<style type="text/css">
    label.error{
        color: #B94A48;
        margin-top: 2px;
    }
</style>

<script type="text/javascript">

    jQuery(document).ready(function () {
        jQuery("#sidebar #admin_nav li#dashboard").removeClass("active");
        jQuery("#sidebar #admin_nav li#organisation").removeClass("active");
        jQuery("#sidebar #admin_nav li#create_staff").removeClass("active");
        jQuery("#sidebar #admin_nav li#create_dependant").removeClass("active");
        jQuery("#sidebar #admin_nav li#create_community").removeClass("active");
        jQuery("#sidebar #admin_nav li#system_settings").addClass("active");
        jQuery("#sidebar #admin_nav li#upload_staff").removeClass("active");
        jQuery("#sidebar #admin_nav li#upload_dependant").removeClass("active");
        jQuery("#sidebar #admin_nav li#staff_list").removeClass("active");
        jQuery("#sidebar #admin_nav li#dependant_list").removeClass("active");
        jQuery("#sidebar #admin_nav li#organisation_list").removeClass("active");

    });
</script>