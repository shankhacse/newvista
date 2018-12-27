<script src="<?php echo base_url(); ?>assets/js/adm_scripts/caste.js"></script>  

   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Registration  <?php echo $bodycontent['mode'];?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlockLarge">
              <div class="box-header with-border">
                <h3 class="box-title">Student Registration </h3>
                
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"registrationForm","name"=>"registrationForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                 
 

                  <div class="form-group">
                    <input type="hidden" name="studentID" id="studentID" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['studentEditdata']->id;}else{echo "0";}?>" />

                    <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />

                    
                  </div>
                   <p class="formSubTitle"><span class="glyphicon glyphicon-pencil"></span> Admission Info</p>
                   <div class="row">
                   <div class="col-md-12">

                          <div class="row">
                         <div class="col-md-8" style="#border: 1px solid blue;">

                           <div class="row">
                      <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="reg_no">Reg. No</label>
                          <input type="text" class="form-control forminputs removeerr" id="reg_no" name="reg_no" placeholder="Enter Registration No" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['studentEditdata']->reg_no; } ?>" />

                         
                         
                         
                        </div>
                      </div>
                       <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="form_sl_no">Form Sl No.</label>
                        <input type="text" class="form-control forminputs removeerr" id="form_sl_no" name="form_sl_no" placeholder="Enter Form Serial" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['studentEditdata']->name; } ?>" />
                        </div>
                      </div>

                       <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="form-group">
                <label>Date of Admission</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control pull-right datemask" id="dtadm" name="dtadm" type="text" value="<?php if($bodycontent['mode']=="EDIT"){echo date("d/m/Y",strtotime($bodycontent['studentEditdata']->admission_dt));}else{echo date('d/m/Y');}  ?>">
                  

                </div>
                <!-- /.input group -->
              </div>
              
                  </div>
                   
                    </div>

                     <div class="row">
                      <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="student_name">Student Name</label>
                          <input type="text" class="form-control forminputs removeerr" id="student_name" name="student_name" placeholder="Enter Student Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['studentEditdata']->name; } ?>" />

                        </div>
                      </div>

                          <div class="col-md-4 col-sm-12 col-xs-12">
                         <div class="form-group">
                            <label>Date of Birth</label>

                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input class="form-control pull-right datemask" id="studentdob" name="studentdob" type="text" value="<?php if($bodycontent['mode']=="EDIT"){echo date("d/m/Y",strtotime($bodycontent['studentEditdata']->date_of_birth));}?>" >
                            </div>
                          
                            <!-- /.input group -->
                          </div>
                          
                  </div>

                  <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="reg_no">Gender</label>
                         <select id="category" name="category" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0">Select</option> 
                          <?php 
                          if($bodycontent['genderList'])
                          {
                          foreach($bodycontent['genderList'] as $value)
                          { ?>
                            <option value="<?php echo $value->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['studentEditdata']->gender==$value->id){echo "selected";}else{echo "";} ?> ><?php echo $value->gender; ?></option>
                      <?php   }
                          }
                          ?>

                        </select>

                        </div>
                      </div>
                       
                   
                   
                    </div>

                    <div class="row">
                      <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="reg_no">Blood Group</label>
                         <select id="bloodgroup" name="bloodgroup" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0">Select</option> 
                          <?php 
                          if($bodycontent['bloodgroupList'])
                          {
                          foreach($bodycontent['bloodgroupList'] as $value)
                          { ?>
                            <option value="<?php echo $value->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['studentEditdata']->group==$value->id){echo "selected";}else{echo "";} ?> ><?php echo $value->group; ?></option>
                      <?php   }
                          }
                          ?>

                        </select>

                        </div>
                      </div>

                          <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="caste">Caste</label>
                         <select id="caste" name="caste" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0">Select</option> 
                          <?php 
                          if($bodycontent['casteList'])
                          {
                          foreach($bodycontent['casteList'] as $value)
                          { ?>
                            <option value="<?php echo $value->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['studentEditdata']->caste==$value->id){echo "selected";}else{echo "";} ?> ><?php echo $value->caste; ?></option>
                      <?php   }
                          }
                          ?>

                        </select>

                        </div>
                          
                  </div>

                  <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="religion">Religion</label>
                         <select id="religion" name="religion" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0">Select</option> 
                          <?php 
                          if($bodycontent['religionList'])
                          {
                          foreach($bodycontent['religionList'] as $value)
                          { ?>
                            <option value="<?php echo $value->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['studentEditdata']->religion==$value->id){echo "selected";}else{echo "";} ?> ><?php echo $value->religion; ?></option>
                      <?php   }
                          }
                          ?>

                        </select>

                        </div>
                      </div>
                       
                   
                   
                    </div>

                      


                    
                          </div>
                          <div class="col-md-4" style="#border: 1px solid green;">
                            <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="student_picture" style="width: 130px;height:160px;border: 2px solid green;margin-left:80px; ">
                              
                            </div>
                            

                        </div>
                        </div>

                          <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">

                           
                            <button class="btn btn-primary upload_pic">Upload Picture </button>

                        </div>
                        </div>


                    
                          </div>
                          </div>



                   </div>
                   </div>



                   <div class="row">
                       <div class="col-md-12">

                      <div class="row">
                      <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="reg_no">Father Name</label>
                         <input type="text" class="form-control forminputs removeerr" id="father_name" name="father_name" placeholder="Enter Father Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['studentEditdata']->father_name; } ?>" />


                        </div>
                      </div>

                        <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="reg_no">Father Contact No</label>
                        <input type="text" class="form-control forminputs removeerr" id="father_contact_no" name="father_contact_no" placeholder="Enter Father Contact " autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['studentEditdata']->father_contact_no; } ?>" />

                        </div>
                          
                        </div>

                  <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="reg_no">Father Occupation</label>
                         <select id="father_occupation" name="father_occupation" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0">Select</option> 
                          <?php 
                          if($bodycontent['occupationList'])
                          {
                          foreach($bodycontent['occupationList'] as $value)
                          { ?>
                            <option value="<?php echo $value->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['studentEditdata']->father_occupation_id==$value->id){echo "selected";}else{echo "";} ?> ><?php echo $value->occupation; ?></option>
                      <?php   }
                          }
                          ?>

                        </select>

                        </div>
                      </div>
            
              <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="reg_no">Father Income</label>
                        <input type="text" class="form-control forminputs removeerr" id="father_income" name="father_income" placeholder="Enter Father Income" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['studentEditdata']->fathers_income; } ?>" />

                        </div>
                          
                        </div>
                       
                   
                   
                    </div>



                     <div class="row">
                      <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="reg_no">Mother Name</label>
                         <input type="text" class="form-control forminputs removeerr" id="mother_name" name="mother_name" placeholder="Enter Mother Name" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['studentEditdata']->mother_name; } ?>" />


                        </div>
                      </div>

                        <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="reg_no">Mother Contact No</label>
                        <input type="text" class="form-control forminputs removeerr" id="mother_contact_no" name="mother_contact_no" placeholder="Enter Mother Contact " autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['studentEditdata']->mother_contact_no; } ?>" />

                        </div>
                          
                        </div>

                  <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="reg_no">Mother Occupation</label>
                         <select id="mother_occupation" name="mother_occupation" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0">Select</option> 
                          <?php 
                          if($bodycontent['occupationList'])
                          {
                          foreach($bodycontent['occupationList'] as $value)
                          { ?>
                            <option value="<?php echo $value->id; ?>" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['studentEditdata']->mother_occupation_id==$value->id){echo "selected";}else{echo "";} ?> ><?php echo $value->occupation; ?></option>
                      <?php   }
                          }
                          ?>

                        </select>

                        </div>
                      </div>
            
                      <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label for="reg_no">Mother Income</label>
                        <input type="text" class="form-control forminputs removeerr" id="mother_income" name="mother_income" placeholder="Enter Mother Income" autocomplete="off" value="<?php if($bodycontent['mode']=="EDIT"){echo $bodycontent['studentEditdata']->mother_income; } ?>" />

                        </div>
                          
                        </div>
                       
                   
                   
                    </div>




                       </div>
                   </div>

                  <p id="admmsg" class="form_error"></p>

                  <div class="btnDiv">
                      <button type="submit" class="btn btn-primary formBtn" id="cassavebtn"><?php echo $bodycontent['btnText']; ?></button>
                      <!-- <button type="button" class="btn btn-danger formBtn" onclick="window.location.href='<?php echo base_url();?>district'">Go to List</button> -->
					  
					           <span class="btn btn-primary formBtn loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> <?php echo $bodycontent['btnTextLoader']; ?></span>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="adm_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->

