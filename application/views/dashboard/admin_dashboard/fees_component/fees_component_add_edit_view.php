<script src="<?php echo base_url(); ?>assets/js/adm_scripts/feescomponent.js"></script>   

   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Fees Component  <?php echo $bodycontent['mode'];?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlock">
              <div class="box-header with-border">
                <h3 class="box-title">Fees Component </h3>
                 <a href="<?php echo base_url();?>feescomponent" class="link_tab"><span class="glyphicon glyphicon-list"></span> List</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"feesComponentForm","name"=>"feesComponentForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                 
 

                  <div class="form-group">
                    <input type="hidden" name="feesComID" id="feesComID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['feesComponentEditdata']->id;}else{echo "0";}?>" />

                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />

                    <label for="feesdesc">Fees Description</label>
                    <input type="text" class="form-control forminputs typeahead" id="fees_desc" name="fees_desc" placeholder="Enter Fees Description" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['feesComponentEditdata']->fees_desc;}?>" >
                  </div>

                    <div class="form-group">
                   

                    <label for="account">Account</label>
                    <input type="text" class="form-control forminputs typeahead" id="acconut" name="acconut" placeholder="Enter Account" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['feesComponentEditdata']->account_id;}?>" >
                  </div>

                  <p id="feescommsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="feescomavebtn"><?php echo $bodycontent['btnText']; ?></button>
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>district'">Go to List</button> -->
					  
					           <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="feescom_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

