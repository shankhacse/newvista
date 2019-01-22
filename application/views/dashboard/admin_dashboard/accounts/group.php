<script src="<?php echo base_url(); ?>assets/js/adm_scripts/accounts_group.js"></script>  
<?php
// print_r($bodycontent['test']);
?>
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Accounts  <?php echo $bodycontent['module'];?></li>
    </ol>
</section>

 <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary formBlock">
                <div class="box-header with-border">
                    <h3 class="box-title">Group </h3>
                    <!-- <a href="<?php echo base_url();?>caste" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a> -->
                </div>
                <div class="box-body">
                    <div>
                        <?php
                            //after submit message
                            if (isset($bodycontent['msg'])) {
                                echo $bodycontent['msg'];
                            }
                            
                        ?>
                    </div>
                    <form method="post" onsubmit="return groupFormValidation();" action="<?php echo base_url(); ?>accounts/GroupInsert">
                        <div id="group_description_div" class="form-group">                            
                            <label for="group_description">Group Description</label>
                            <input type="text" class="form-control" name="group_description" id="group_description"  placeholder="Group Description">
                        </div>
                        <div id="main_category_div" class="form-group">
                            <label class="radio-inline"><input type="radio" name="main_category" value="B" id="main_category1">Balance Sheet</label>
                            <label class="radio-inline"><input type="radio" name="main_category" value="P" id="main_category2">Profit & Loss</label>
                        </div>
                        <div class="form-group" id="div_sub_category1" style="display:none;">
                            <label class="radio-inline"><input type="radio" name="sub_category" value="A" id="sub_category" >Assets</label>
                            <label class="radio-inline"><input type="radio" name="sub_category" value="L" id="sub_category">Liability</label>
                        </div>
                        <div class="form-group" id="div_sub_category2" style="display:none;">
                            <label class="radio-inline"><input type="radio" name="sub_category" value="I" id="sub_category" >Income</label>
                            <label class="radio-inline"><input type="radio" name="sub_category" value="E" id="sub_category">Expenditure</label>
                        </div>
                        <div class="form-group">
                        <label class="checkbox-inline"><input type="checkbox" name="is_active" id="is_active" value="Y" checked>Active</label>
                        </div>
                        <div class="btnDiv">
                        <button type="submit"  name="submit" id="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->