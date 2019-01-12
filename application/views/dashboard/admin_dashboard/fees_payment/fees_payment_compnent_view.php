<hr>
<center><button type="button" class="btn btn bg-maroon margin">Fees Details</button><br>
<div class="datatalberes" >
  <input type="hidden" name="monthids" id="monthids" value="<?php echo $monthids_string; ?>" />
  <input type="hidden" name="studentid" id="studentid" value="<?php echo $studentid; ?>" />

   <input type="hidden" name="paymentID" id="paymentID" value="<?php if($mode=='EDIT'){echo $paymentID;}else{ echo "0";}?>" />
  
    <input type="hidden" name="mode" id="mode" value="<?php echo $mode; ?>" />

              <table class="table table-bordered table-striped  nowrap" style="border-collapse: collapse !important;width: 70%;outline: 1px solid #77609e;">
                <thead>
                  <tr >
                    <th colspan="3"><b style="font-weight: bold;color: #202b80;">For months :</b>
                      <?php

                      foreach ($monthsname as  $key => $value) {
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

                    foreach ($fessComponentData as $fescomonent) {
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

      <input type="hidden" name="total_pay_amount" id="total_pay_amount" value="<?php echo $total_amount;?>" />
              <?php
       $curr_dt = date('d/m/Y');     
?>

 <div  style="margin-top:50px;margin-left: 139px; ">
  <div class="form-group row">
    
  <div class="col-sm-2 col-md-2 col-xs-12"> 
   <label for="pdate">Payment Date</label>  
   </div>
      <div class="col-sm-2 col-md-2 col-xs-12">
     
                    <input type="text"  class="form-control custom_frm_input datepicker"  name="payment_date" id="payment_date"  placeholder="" value="<?php echo $curr_dt;?>" style="width: 204px;" />
        </div>
<div class="col-sm-2 col-md-2 col-xs-12"> </div>
        <div class="col-sm-2 col-md-2 col-xs-12">
        <label for="mode">Payment mode</label>  

               
        </div>
           <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                       
                         <select id="payment_mode" name="payment_mode" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
                         <option value="0">Select</option> 
                         <option value="Cash">Cash</option> 
                         <option value="Card">Card</option> 
                         <option value="Cheque">Cheque</option> 
                         

                        </select>

                        </div>
                      </div>
                    

      
    </div>
     <p id="paymentmsg" class="form_error" style="width: 776px;"></p> 
     <p id="payment_err_msg" class="form_error"></p>
    <div class="form-group row" style="margin-top:20px;" >

     
    </div>

              </div>
              <center> <div class="">
              <button type="submit" class="btn btn-primary formBtn" id="paymentSave" style="display: inline-block;width:150px;"><?php echo $btnText;?></button></center>
            </div>