<script src="<?php echo base_url(); ?>assets/js/adm_scripts/fees_payment.js"></script>  
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/admin_style.css" />  


   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Fees Payment </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary formBlockLarge">
              <div class="box-header with-border">
                <h3 class="box-title">Edit Fees Payment</h3>
                 
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!--<form role="form" name="cityForm" id="cityForm"> -->
              <?php 
              $attr = array("id"=>"feesPayEditForm","name"=>"feesPayEditForm");
              echo form_open('',$attr); ?>
                <div class="box-body">
                  <div class="row">
                     
                   <div class="col-md-2">
                      <div class="form-group">
                          <label for="reg_no">Class</label>

                          <input type="text" class="form-control" name="classname" id="classname" value="<?php echo $bodycontent['studentinfo']->classname;?>" readonly/>
                      

                        </div>

                   </div>

                    <div class="col-md-2">

                      <div class="form-group">
                          <label for="reg_no">Section</label>

                          <input type="text" class="form-control" name="section" id="section" value="<?php echo $bodycontent['studentinfo']->section;?>" readonly />
                      

                        </div>
                      
                   </div>
 <input type="hidden" name="mode" id="mode" value="<?php echo $bodycontent['mode']; ?>" />
<input type="hidden" id="selected_month_ids" name="selected_month_ids" value="<?php echo $bodycontent['monthids_string'] ;?>"/>
                    <div class="col-md-3">
<input type="hidden" name="paymentID" id="paymentID" value="<?php echo $bodycontent['studentinfo']->payment_id;?>" />
                         <div class="form-group">
                          <label for="reg_no">Student</label>
<input type="hidden" class="form-control" name="studentid" id="studentid" value="<?php echo $bodycontent['studentinfo']->student_id;?>" readonly />
                          <input type="text" class="form-control" name="studentname" id="studentname" value="<?php echo $bodycontent['studentinfo']->student_name."   [Roll-".$bodycontent['studentinfo']->rollno."]";?>" readonly />
                        <!-- <div id="student_dropdown">
                         <select id="studentid" name="studentid" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0">Select</option> 
                         

                        </select>
                        </div> -->

                        </div>

                   </div>


                   <div class="col-md-3">

                     <div class="form-group">
                          <label for="reg_no">Month</label>
                          <select id="sel_month" name="sel_month[]" class="form-control selectpicker changmonthedit"  data-show-subtext="true" data-actions-box="true" data-live-search="true" multiple="multiple" >
                           
                        
                          <?php 
                          if($bodycontent['monthList'])
                          {
                          foreach($bodycontent['monthList'] as $value)
                          { ?>
                            <option value="<?php echo $value->id; ?>"  ><?php echo $value->month_code; ?></option>
                      <?php   }
                          }
                          ?>

                        </select>
                      

                        </div>
                   </div>

                   <div class="col-md-2">
                    <div class="form-group">

                   
                      <!-- <button class="btn btn-primary loaderbtn" id="loaderbtn" style="display:none;"><i class="fa fa-spinner rotating" aria-hidden="true"></i> Loading...</button> -->
                        
                     </div>
                   </div>

                 </div>
 
       

                  <p id="feepaymsg" class="form_error"></p>

                <section id="loadpaymentcomponent"> 
                  <center>
                    <button type="button" class="btn btn bg-maroon margin">Fees Details</button><br>
                    <table class="table table-bordered table-striped  nowrap" style="border-collapse: collapse !important;width: 70%;outline: 1px solid #77609e;">
                <thead>
                  <tr >
                    <th colspan="3"><b style="font-weight: bold;color: #202b80;">For months :</b>
                      <?php

                      foreach ($bodycontent['monthsname'] as  $key => $value) {
                        if ($key==0) {$spc=""; }else{$spc=", ";}
                        echo $spc.$value." ";
                      }
                      ?>
                    </th>
                  </tr>
                <tr style="background-color: #605ca8;color: #fff;">
                  <th style="width:10%;">Sl</th>
                  <th>Fees Description</th>
                  <th align="right">Amount</th>
                
                  
             
                </tr>
                </thead>
                <tbody>
                  
               
                <?php 
        
                  $i = 1;
                  $total_amount=0;

                    foreach ($bodycontent['fessComponentData'] as $fescomonent) {
                     $total_amount+=$fescomonent->sum_amount;
                   
                  ?>
                

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $fescomonent->fees_desc; ?></td>
            <td align="right"><?php echo $fescomonent->sum_amount; ?></td>

          </tr>
         
             <?php } ?>
             <tr style="font-weight: bold;"><td colspan="2" >Total amount</td><td align="right"><?php echo number_format($total_amount,2); ?></td></tr>
                </tbody>
               
              </table>
             
             </center>
              <div  style="margin-top:50px;margin-left: 139px; ">
  <div class="form-group row">
    
  <div class="col-sm-2 col-md-2 col-xs-12"> 
   <label for="pdate">Payment Date</label>  
   </div>
      <div class="col-sm-2 col-md-2 col-xs-12">
     
                    <input type="text"  class="form-control custom_frm_input datepicker"  name="payment_date" id="payment_date"  placeholder="" value="<?php echo date("d/m/Y", strtotime($bodycontent['studentinfo']->payment_date));?>" style="width: 204px;" />
        </div>
<div class="col-sm-2 col-md-2 col-xs-12"> </div>
        <div class="col-sm-2 col-md-2 col-xs-12">
        <label for="mode">Payment mode</label>  

               
        </div>
           <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                       
                         <select id="payment_mode" name="payment_mode" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['studentinfo']->payment_mode=="0"){echo "selected";}else{echo "";} ?>>Select</option> 
                         <option value="Cash" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['studentinfo']->payment_mode=="Cash"){echo "selected";}else{echo "";} ?>>Cash</option> 
                         <option value="Card" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['studentinfo']->payment_mode=="Card"){echo "selected";}else{echo "";} ?>>Card</option> 
                         <option value="Cheque" <?php if(($bodycontent['mode']=="EDIT") && $bodycontent['studentinfo']->payment_mode=="Cheque"){echo "selected";}else{echo "";} ?>>Cheque</option> 
                         

                        </select>

                        </div>
                      </div>
                    

      
    </div>
     <p id="paymentmsg" class="form_error" style="width: 776px;"></p> 
     <p id="payment_err_msg" class="form_error"></p>
    <div class="form-group row" style="margin-top:20px;" >

     
    </div>
 
              </div>
     <center>
 <button type="submit" class="btn btn-primary formBtn" id="paymentmstUpdate" style="display: inline-block;width:150px;">Update</button>  </center>
             </section>
                  
                </div>
                <!-- /.box-body -->

                <!-- <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div> -->
              <?php echo form_close(); ?>

              <div class="response_msg" id="feepay_response_msg">
               
              </div>

            
            </div>
            <!-- /.box -->      
      </div>
    </div>

    </section>
    <!-- /.content -->


    <!-- Modal -->
<div id="saveMsgModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
        <p id="save-msg-data"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location.reload();">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
    $(".datepicker").datepicker({format: 'dd/mm/yyyy'});
</script>            
    

