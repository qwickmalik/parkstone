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
                        <div class="control-group">
                            <label class="control-label" for="">Audit Type</label>
                            <div class="controls">
                                <select name="AUDITTYPE" id="AUDITTYPE" required="required">
                                    <option value=''>-- Select Audit Type --</option>
                                    <?php foreach ($audit_type_record as $audit_type_records): ?>
                                        <option value="<?php echo $audit_type_records['Sysaudit']['AUDITTYPE']; ?>"><?php echo $audit_type_records['Sysaudit']['AUDITTYPE']; ?></option>
                                    <?php endforeach; ?> 

                                </select>
                                <span class="help-inline"><em  style="font-size:20px; color:#ff0000;">*</em></span>
                            </div>
                        </div> 

                        <!--Start Date -->
                        <div class="control-group">
                            <label class="control-label" for="">Start Date</label>
                            <div class="controls">
                                <div class="input-prepend input-append">
                                    <span class="add-on">Day</span>
                                    <input class="input-mini" id="STARTDAY" required="required" name="STARTDAY" type="text" placeholder="01"/>
                                    <span class="add-on">Month</span>
                                    <input class="input-mini" id="STARTMONTH" required="required" name="STARTMONTH" type="text" placeholder="01"/>
                                    <span class="add-on">Year</span>
                                    <input class="input-small" id="STARTYEAR" required="required" name="STARTYEAR" type="text" placeholder="2013"/>
                                    <span class="help-inline"><em  style="font-size:20px; color:#ff0000;">*</em></span>
                                </div>
                            </div>
                        </div>
                        <!--End Date -->
                        <div class="control-group">
                            <label class="control-label" for="">End Date</label>
                            <div class="controls">
                                <div class="input-prepend input-append">
                                    <span class="add-on">Day</span>
                                    <input class="input-mini" id="ENDDAY" required="required" name="ENDDAY" type="text" placeholder="01"/>
                                    <span class="add-on">Month</span>
                                    <input class="input-mini" id="ENDMONTH"required="required" name="ENDMONTH" type="text" placeholder="01"/>
                                    <span class="add-on">Year</span>
                                    <input class="input-small" id="ENDYEAR" required="required" name="ENDYEAR" type="text" placeholder="2013"/>
                                    <span class="help-inline"><em  style="font-size:20px; color:#ff0000;">*</em></span>
                                </div>
                            </div>
                        </div>
                        <!--Sytem User -->       
                       <!-- <div class="control-group">
                            <label class="control-label" for="">System User</label>
                            <div class="controls">
                                      
                                <select name="EHMIS_USER_ID" id="EHMIS_USER_ID">
                                    <option value="">-- Select User --</option>
                                    <?php // foreach ($staff_record_audit as $staff_record_audits): ?>
                                        <option value="<?php // echo $staff_record_audits["EhmisUser"]["ID"]; ?>"><?php // echo $staff_record_audits["EhmisUser"]["FIRSTNAME"]; ?></option>
                                    <?php // endforeach; ?>
                                </select>
                            </div>
                        </div>  -->  
                        </br></br></br></br>
                        <div class="control-group">
                            <div class="controls">
                                 <a class="btn btn-primary btn-inverse" href='<?php echo $this->Html->url('/Admin/system_settings',true); ?>' >Cancel</a>
                                 
                                <button type="submit" class="btn btn-primary" name="btn_review" formmethod="POST" formaction='<?php echo $this->Html->url('/Settings/create_audit_trail',true); ?>' >Review</button>
                                
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