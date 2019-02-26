$(window).on('load',function() {
    
    var basepath = $("#basepath").val();        
        var account_id=$('#account_id option:selected').val();
        $.ajax({
            type: "POST",
            url: basepath+'generalvoucher/getAccountGroup',
            data: {account_id:account_id},           
            success: function (result) {
                // console.log(result);
                if (result==1) {
                    $('#cheque_date').val("");
                    $('#cheque_no').prop( "disabled", true );
                    $('#cheque_date').prop( "disabled", true );
                }else{
                    
                    $('#cheque_no').prop( "disabled", false );
                    $('#cheque_date').prop( "disabled", false );
                }                
            }, 
            error: function (jqXHR, exception) {
                  var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                   // alert(msg);  
                }
            }); /*end ajax call*/
    
});/* window on load*/

$(document).ready(function(){   
    var basepath = $("#basepath").val();
    var divSerialNumber = 0;
    
    /* check account group is it bank or cash */
    $("#account_id").on('change',function(){      
        var account_id=$('#account_id option:selected').val();
        $.ajax({
            type: "POST",
            url: basepath+'generalvoucher/getAccountGroup',
            data: {account_id:account_id},           
            success: function (result) {
                // console.log(result);
                if (result==1) {
                    $('#cheque_date').val("");
                    $('#cheque_no').prop( "disabled", true );
                    $('#cheque_date').prop( "disabled", true );
                }else{
                    
                    $('#cheque_no').prop( "disabled", false );
                    $('#cheque_date').prop( "disabled", false );
                }                
            }, 
            error: function (jqXHR, exception) {
                  var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                   // alert(msg);  
                }
            }); /*end ajax call*/
    
    });

    $(document).on('change', "#Pay_Rc", function() {
        var paymentMode = $("#Pay_Rc option:selected").val();
          var amount = $("#amount").val();
        
            if(paymentMode=='RC'){
               $("#total_debit").val(amount);
                $("#total_credit").val('0');
            }
            else{
                  $("#total_debit").val('0');
                   $("#total_credit").val(amount);
            }
       
     });


     $('#amount').on('keyup',function() {           
        
        var amount  = $("#amount").val();
        var paymentmode = $("#Pay_Rc").val();
           if(paymentmode=='RC'){
               $("#total_debit").val(amount);
                $("#total_credit").val('0');
           }
           else{
                $("#total_debit").val('0');
                $("#total_credit").val(amount);
           }
            globalFunction();
     });

     $("#addnewDtlDiv").click(function() {
        var acctag = $("#Pay_Rc").val();
        var amount = $("#amount").val();
        
        var totalDebit = $("#total_debit").val();
        var Totalcredit = $("#total_credit").val();
        var differenceDebit=totalDebit-Totalcredit;
        var differenceCredit=Totalcredit-totalDebit;
        divSerialNumber = divSerialNumber + 1;
        
        var amountDetailId = "amountDtl_0_"+divSerialNumber;
        var debitcredit = "debitcredit_0_"+divSerialNumber;

        if (getVoucherMasterValidation()) {

            $.ajax({
                url: basepath + "generalvoucher/createDetails",
                type: 'post',
                data: {divSerialNumber: divSerialNumber,acctag:acctag,amount:amount},
                success: function(data) {
                 $(".groupvoucherDtl").show()
                 $(".groupvoucherDtl").append(data);
                    var tag = $("#"+debitcredit).val();
                    
                    if(tag=="Dr"){
                        if(differenceDebit>0){
                            $('#'+amountDetailId).val(0);
                        }else{
                             $('#'+amountDetailId).val(differenceCredit);
                        }
                     }
                     else{
                         if(differenceDebit>0){
                             $('#'+amountDetailId).val(differenceDebit);
                         }
                         else{
                             $('#'+amountDetailId).val(0);
                        }
                     }
                     $('.selectpicker').selectpicker();
                     getTotalDebit();
                     getTotalCredit();
                    
                }, 
                error: function (jqXHR, exception) {
                      var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                       console.log(msg);  
                    }
            });
            
        }
   });

   $(document).on('keyup', '.amountDtl', function () {
    globalFunction(); 
    });


   $(document).on('keyup', '#amount', function () {
    if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    } 
    $(document).on('keyup', '.amountDtl', function () {
        if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
            this.value = this.value.replace(/[^0-9\.]/g, '');
        }

    });

});

$(document).on('click', ".del", function() {
    var netId = $(this).attr('id');
    var detailIdarr = netId.split('_');
    var master_id = detailIdarr[1];
    var detail_id = detailIdarr[2];

    var div_identification_id = "#generalVoucher_"+master_id+"_"+detail_id;
    $(div_identification_id).empty();
      globalFunction();
 
});

    $("#generalVoucher").click(function(){
        // alert("");
        if(getVoucherMasterValidation())     
        {
            if(detailvalidation())
            {
                if(getDebitCreditEqualValidation())
                {
                    
                    var formDataserialize = $("#GeneralVoucherForm").serialize();
                    
                    $("#generalVoucher").css('display', 'none');
                    $("#loaderbtn").css('display', 'block');
                    $.ajax({
                        url: basepath + "generalvoucher/saveVoucherData",
                        type: 'post',
                        data: formDataserialize,
                        success: function(result) {        

                            if (result.msg_status == 200) {                            
                                $("#suceessmodal").modal({
                                    "backdrop": "static",
                                    "keyboard": true,
                                    "show": true
                                });
                                var addurl = basepath + "generalvoucher/general";
                                var listurl = basepath + "generalvoucher";
                                $("#responsemsg").text(result.msg_data);
                                $("#response_add_more").attr("href", addurl);
                                $("#response_list_view").attr("href", listurl);
            
                            }else {
                                $("#cas_response_msg").text(result.msg_data);
                            }

                            $("#loaderbtn").css('display', 'none');
                    
                            $("#generalVoucher").css({
                                "display": "block",
                                "margin": "0 auto"
                            });
                            
                        }, 
                        error: function (jqXHR, exception) {
                            var msg = '';
                                if (jqXHR.status === 0) {
                                    msg = 'Not connect.\n Verify Network.';
                                } else if (jqXHR.status == 404) {
                                    msg = 'Requested page not found. [404]';
                                } else if (jqXHR.status == 500) {
                                    msg = 'Internal Server Error [500].';
                                } else if (exception === 'parsererror') {
                                    msg = 'Requested JSON parse failed.';
                                } else if (exception === 'timeout') {
                                    msg = 'Time out error.';
                                } else if (exception === 'abort') {
                                    msg = 'Ajax request aborted.';
                                } else {
                                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                                }
                            console.log(msg);  
                        }
                    });
                }
            }
        }else{
            
        }
    });
    






});/* end of document ready */


function globalFunction(){
    getTotalDebit();
    getTotalCredit();
}


function getTotalDebit(){
    var totalDetailAmount=0;
    var totalDebitAmount =0;
    var debitAmt=0;
    
    var paymentmode=$("#Pay_Rc").val();
    if(paymentmode=="RC"){
         debitAmt=parseFloat($('#amount').val());
    }else{
        debitAmt=0;
    }
    
    //debitAmt=parseFloat($('#amount').val());
    
    totalDetailAmount=getTotalAmt().totalDebit;
    console.log('DetailAmount:'+totalDetailAmount);
    
    totalDebitAmount=parseFloat(debitAmt+totalDetailAmount);
    
     $("#total_debit").val(totalDebitAmount);
    
  

}

function getTotalCredit(){
    var totalDetailAmount=0;
    var totalCreditAmount =0;
    var creditAmt=0;
    
    var paymentmode=$("#Pay_Rc").val();
    if(paymentmode=="PY"){
         creditAmt=parseFloat($('#amount').val());
    }else{
        creditAmt=0;
    }
    
  //  creditAmt=parseFloat($('#amount').val());
    
    totalDetailAmount=getTotalAmt().totalCredit;
    console.log('TotalCreditAmount:'+totalDetailAmount);
    
    totalCreditAmount=parseFloat(creditAmt+totalDetailAmount);
    
     $("#total_credit").val(totalCreditAmount);
    
  

}

function getTotalAmt(){
    // var debitCreditAmt={}
     var debitCreditSum = {};
     var amount=0;
     var debitDtlTotal=0;
     var creditDtlTotal=0;
     var tag=0;
     var table= '#voucherDtl tr';
     $(table).each(
         function() {
           
           tag=$(this).find('.debitcredit option:selected').val();
           console.log("tag"+tag);
           if(tag=='Cr'){
               var amt = $(this).find('.amountDtl').val()||0;
               creditDtlTotal = creditDtlTotal + parseFloat(amt);
           }
           if(tag=='Dr'){
               var amt = $(this).find('.amountDtl').val()||0;
               debitDtlTotal = debitDtlTotal + parseFloat(amt);
           }
           if(tag==0){creditDtlTotal=0;debitDtlTotal=0;}
          
         }
         
       );
       
     debitCreditSum ={'totalCredit':creditDtlTotal,'totalDebit':debitDtlTotal};
       //console.log('debitCreditSum:'+debitCreditSum.totalCredit+"**"+debitCreditSum.totalDebit);
      
       return debitCreditSum;
 }

 function getVoucherMasterValidation(){
     var paidto_rcv = $("#paidto_rcv").val();
     var voucherDate = $("#voucher_date").val();
     var amount = $("#amount").val();
     var Pay_Rc = $("#Pay_Rc option:selected").val();
     var account_id = $("#account_id option:selected").val();

    $("#clsmsg").text("").css("dispaly", "none").removeClass("form_error");
    $("#voucher_date_div").removeClass('has-error');
    $("#paidto_rcv_div").removeClass('has-error');
    $("#Pay_Rc_div").removeClass('has-error');
    $("#account_id_div").removeClass('has-error');
    $("#amount_div").removeClass('has-error');    
    
    if(voucherDate==""){
         $("#voucher_date_div").addClass('has-error');
         $("#clsmsg")
                .text("Error : Enter Voucher Date !")
                .addClass("form_error")
                .css("display", "block");
         return false;
    }
    if(paidto_rcv==""){
         $("#paidto_rcv_div").addClass('has-error');
         $("#clsmsg")
                .text("Error : Enter Details Of Paid To/Received From!")
                .addClass("form_error")
                .css("display", "block");
         return false;
    }   
    if(Pay_Rc==""){
         $("#Pay_Rc_div").addClass('has-error');
         $("#clsmsg")
                .text("Error : Select Receipt/Payment !")
                .addClass("form_error")
                .css("display", "block");
         return false;
    }
    if(account_id==""){
         $("#account_id_div").addClass('has-error');
         $("#clsmsg")
                .text("Error : Select Bank/Cash !")
                .addClass("form_error")
                .css("display", "block");
         return false;
    }
    if(amount==""){
          $("#amount_div").addClass('has-error');
          $("#clsmsg")
                .text("Error : Enter Amount !")
                .addClass("form_error")
                .css("display", "block");
          return false;
    }
     
    return true;
     
 }


 function detailvalidation (){
    $('#totalDebitCreditDiv').removeClass("has-error");
    $("#clsmsg").text("").css("dispaly", "none").removeClass("form_error");
    if(!getDetailDbCrValidation()){
        $("#clsmsg")
                .text("Error : Select Account Type(Dr/Cr)")
                .addClass("form_error")
                .css("display", "block");
       return false;
    }
   
     if(!getDetailAccountHeadValidation()){
        $("#clsmsg")
                .text("Error : Select Account")
                .addClass("form_error")
                .css("display", "block");
       return false;
    }
    if(!getDetailAmountValidation()){
       $("#clsmsg")
                .text("Error : Enter Amount")
                .addClass("form_error")
                .css("display", "block"); 
       return false;
    }
    return true;
}

function getDebitCreditEqualValidation(){
    var totalDebit = $("#total_debit").val();
    var totalCredit = $("#total_credit").val();
    $('#totalDebitCreditDiv').removeClass("has-error");
    $("#clsmsg").text("").css("dispaly", "none").removeClass("form_error");
    if(totalDebit!=totalCredit){
        $('#totalDebitCreditDiv').addClass("has-error");
        $("#clsmsg")
                .text("Error : Total Debit & Credit Must be Equal")
                .addClass("form_error")
                .css("display", "block");
        return false;
    }
    else{
        return true;
    }
}

function getDetailDbCrValidation(){
    
    var selectedType;
    var flag=0;
     $('select[name^="debitcredit"]').each(function() {
         
        selectedType = $(this).val();
        var debitcredit = $(this).attr('id').split('_');
        var id=debitcredit[2]; 

       //console.log(selectedproduct);
       $('#debitcreditdiv_'+id).removeClass('has-error');
        if(selectedType=='0'){
            $('#debitcreditdiv_'+id).addClass('has-error');
            flag=1;
        }
        
    });
    if(flag==1){
        return false;
    }else{
            return true;  
    }
 }


function getDetailAccountHeadValidation(){
    //  alert("Hello");
      var accountHead;
      var flag=0;
       $('select[name^="acHead"]').each(function() {
           
          accountHead = $(this).val();
          var acHeadid = $(this).attr('id').split('_');
          var id=acHeadid[2];

         //console.log(selectedproduct);
         $('#acHeaddiv_'+id).removeClass('has-error');
          if(accountHead=='0'){
                $('#acHeaddiv_'+id).addClass('has-error');
                flag=1;
          }
          
      });
      if(flag==1){
          return false;
      }else{
            return true;  
      }
}

function getDetailAmountValidation(){
    var flag=0;
    //var amountDtl=0;
    $('input[name^="amountDtl"]').each(function() {
       
       //amountDtl = parseFloat(($(this).val() == ""||0? "" : $(this).val()));
        var amt = $(this).val() == ""||0? "" : $(this).val();
        var amountDtl = $(this).attr('id').split('_');
        var id=amountDtl[2];

     //console.log(selectedproduct);
      $('#amountDtldiv_'+id).removeClass('has-error');
      if(amt==""){
            $('#amountDtldiv_'+id).addClass('has-error');
            flag=1;
      }
      
  });
  if(flag==1){
      return false;
  }else{
          return true;  
  }
}