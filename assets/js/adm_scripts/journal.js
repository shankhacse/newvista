$(document).ready(function(){
    var basepath = $("#basepath").val();

    $(document).on('keyup','#debit_amount',function(e){
        e.preventDefault(); 
        
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
        {                
            $('#debit_amount').val($('#debit_amount').val().replace(/[^\d.]/g, ''));
        } 
        var amount=$('#debit_amount').val();       
        $('#credit_amount').val(amount);
        $('#total_debit').val(amount);
        $('#total_credit').val(amount);
    });

    $(document).on('keyup','#credit_amount',function(e){
        e.preventDefault(); 
        
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
        {                
            $('#credit_amount').val($('#credit_amount').val().replace(/[^\d.]/g, ''));
        }
        var amount=$('#credit_amount').val();
        $('#debit_amount').val(amount);
        $('#total_debit').val(amount);
        $('#total_credit').val(amount);
    });


    $('#credit_ac, #debit_ac').change(function () {
        var credit_ac=$('#credit_ac option:selected').val();
        var debit_ac=$('#debit_ac option:selected').val();
        $("#clsmsg").text("").css("dispaly", "none").removeClass("form_error");
        $('#debit_ac_div').removeClass('has-error');
        $('#credit_ac_div').removeClass('has-error');
        if(credit_ac==debit_ac && credit_ac!="" && debit_ac!="")
        {
            $('#debit_ac_div').addClass('has-error');
            $('#credit_ac_div').addClass('has-error');
            $("#clsmsg")
                .text("Error : Debit and Credit Account Can not be same !")
                .addClass("form_error")
                .css("display", "block");
            return false;            
        }
        return true;        
     });


     $(document).on('submit','#JournalForm',function(e){
        e.preventDefault();    
        if(fromValidate())
        {        
        
            var formDataserialize = $("#JournalForm").serialize();
            // alert(formDataserialize);
            // console.log(formDataserialize);
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'journal/insertUpdate';
            $("#journalsavebtn").css('display', 'none');
                $("#loaderbtn").css('display', 'block');
    
            $.ajax({
                type: type,
                url: urlpath,
                data: formDataserialize,
                success: function(result) {
                    // alert(result.msg_status);
                    if (result.msg_status == 200) {
                            
                        $("#suceessmodal").modal({
                            "backdrop": "static",
                            "keyboard": true,
                            "show": true
                        });
                        var addurl = basepath + "journal/journal";
                        var listurl = basepath + "journal";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);
    
                    }else {
                        $("#cas_response_msg").text(result.msg_data);
                    }
                    
                    $("#loaderbtn").css('display', 'none');
                    
                    $("#journalsavebtn").css({
                        "display": "block",
                        "margin": "0 auto"
                    });
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });
            
            
        }
    
    });


});// document ready end

function fromValidate()
{    
    $("#clsmsg").text("").css("dispaly", "none").removeClass("form_error");
    $('#debit_ac_div').removeClass('has-error');
    $('#credit_ac_div').removeClass('has-error');
    $("#narration").removeClass('has-error');
    $('#debit_amount').removeClass('has-error');
    $('#credit_amount').removeClass('has-error');
    var credit_ac=$('#credit_ac option:selected').val();
    var debit_ac=$('#debit_ac option:selected').val();
    var credit_amount=$('#credit_amount').val();
    var debit_amount=$('#debit_amount').val();

    if ($("#voucher_date").val()=="") {
        $('#voucher_date_div').addClass('has-error');
        $("#clsmsg")
            .text("Error : Please Enter Voucher Date !")
            .addClass("form_error")
            .css("display", "block");
        return false ;
    }

    if ($("#narration").val()=="") {
        $('#div_narration').addClass('has-error');
        $("#clsmsg")
            .text("Error : Please Enter Narration !")
            .addClass("form_error")
            .css("display", "block");
        return false ;
    }  
    
    if (debit_amount=="") {
        $('#div_debit_amount').addClass('has-error');
        $("#clsmsg")
            .text("Error : Please Enter Debit Amount !")
            .addClass("form_error")
            .css("display", "block");
        return false ;
    }

    if (credit_amount=="") {
        $('#div_credit_amount').addClass('has-error');
        $("#clsmsg")
            .text("Error : Please Enter Credit Amount !")
            .addClass("form_error")
            .css("display", "block");
        return false ;
    }

    if ($('#debit_ac option:selected').val()=="") {
        $('#debit_ac_div').addClass('has-error');
        $("#clsmsg")
            .text("Error : Please Select a Debit Account !")
            .addClass("form_error")
            .css("display", "block");
        return false ;
    }
    if ($('#credit_ac option:selected').val()=="") {
        $('#credit_ac_div').addClass('has-error');
        $("#clsmsg")
            .text("Error : Please Select a Credit Account !")
            .addClass("form_error")
            .css("display", "block");
        return false ;
    }
    if(credit_ac==debit_ac && credit_ac!="" && debit_ac!="")
    {
        $('#debit_ac_div').addClass('has-error');
        $('#credit_ac_div').addClass('has-error');
        $("#clsmsg")
            .text("Error : Debit and Credit Account Can not be same !")
            .addClass("form_error")
            .css("display", "block");
        return false;            
    }
    
       
    
    return true;
}