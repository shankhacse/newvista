$( document ).ready(function() {
    var basepath = $("#basepath").val();

  

  $(document).on('submit','#accountForm',function(e){
    e.preventDefault();    
    if(accountFormValidation())
    {        
    
        var formDataserialize = $("#accountForm").serialize();
        // alert(formDataserialize);
        // console.log(formDataserialize);
        var type = "POST"; //for creating new resource
        var urlpath = basepath + 'accounts/accountAddEdit';
        $("#cassavebtn").css('display', 'none');
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
                    var addurl = basepath + "accounts/account";
                    var listurl = basepath + "accounts/accountList";
                    $("#responsemsg").text(result.msg_data);
                    $("#response_add_more").attr("href", addurl);
                    $("#response_list_view").attr("href", listurl);

                } 
                else {
                    $("#cas_response_msg").text(result.msg_data);
                }
                
                $("#loaderbtn").css('display', 'none');
                
                $("#cassavebtn").css({
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

});


function accountFormValidation()
{
    if($('#account_name').val()=="")
    {
        $('#account_name_div').addClass('has-error');
        return false;
    }
    if($('#group_id option:selected').val()=="0")
    {
        $('#account_name_div').removeClass('has-error');
        $('#group_id_div').addClass('has-error');
        return false;
    }
    return true;

}