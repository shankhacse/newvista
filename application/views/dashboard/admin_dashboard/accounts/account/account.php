<script src="<?php echo base_url(); ?>assets/js/adm_scripts/accounts_account.js"></script>  
<?php
if(isset($bodycontent['test']))
{
    print_r($bodycontent['test']);
}

?>
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Account  <?php echo $bodycontent['module'];?></li>
    </ol>
</section>

 <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary formBlock">
                <div class="box-header with-border">
                    <h3 class="box-title">Account </h3>
                    <a href="<?php echo base_url();?>accounts/accountList" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
                </div>
                <div class="box-body">                    
                    <form method="post" id="accountForm" >
                        <?php if($bodycontent['mode']=="EDIT"){
                            echo '<input type="hidden" name="account_id" id="account_id" value="'.$bodycontent["account_id"].'">';
                        }  ?>
                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode'];?>">
                        <div id="account_name_div" class="form-group">                            
                            <label for="account_name">Account *</label>
                            <input type="text" class="form-control" name="account_name" id="account_name" value="<?php if ($bodycontent['mode']=="EDIT"){ echo $bodycontent['account_name'];} ?>"  placeholder="Account" required>
                        </div>
                        <div id="group_id_div" class="form-group">                            
                            <label for="group_id">Group *</label>
                            <select class="form-control selectpicker" data-show-subtext="true" name="group_id" id="group_id" data-live-search="true" required>
                            <option  value="0">Select Group</option>
                            <?php foreach ($bodycontent['groupList'] as $value) { ?>
                                <option  value="<?php echo $value->id; ?>" data-tokens="<?php echo $value->group_description; ?>" 
                                <?php if ($bodycontent['mode']=="EDIT"){
                                    if ($bodycontent['group_id']==$value->id) {
                                        echo " selected";
                                    }
                                } ?>
                                ><?php echo $value->group_description; ?></option>   
                            <?php  }  ?>
                                
                                <!-- <option data-tokens="mustard">Burger, Shake and a Smile</option>
                                <option data-tokens="frosting">Sugar, Spice and all things nice</option> -->
                            </select>
                        </div>
                        <div id="opening_balance_div" class="form-group" >                            
                            <label for="opening_balance">Opening Balance</label>
                            <input type="number" class="form-control" name="opening_balance" id="opening_balance" value="<?php if ($bodycontent['mode']=="EDIT"){ echo $bodycontent['opening_balance'] ;} ?>"  placeholder="Account">
                        </div>
                        <div class="form-group">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="is_active" id="is_active" value="Y"  
                                <?php if ($bodycontent['mode']=="EDIT"){ 
                                    if($bodycontent['is_active']=="Y")
                                    {
                                        echo "checked";
                                    }
                                }else{ echo "checked"; }?> >
                                Active
                            </label>
                        </div>
                        <div class="btnDiv">
                        <button type="submit"  name="submit" id="cassavebtn" class="btn formBtn btn-primary"><?php echo $bodycontent['btnText'];?></button>
                        <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                        </div>
                    </form>
                    <div class="response_msg" id="cas_response_msg">
                        <!-- response modal -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->