 
$(document).ready(function() {
      
        //Print sale tax register
         $("#showtrialbalancepdf").click(function(){
            var fromdate = $("#from_date").val();
            var todate = $("#to_date").val();
            $("#errormsg").text("").css("dispaly", "none").removeClass("form_error");
            $("#from_date_div").removeClass("has-error");
            $("#to_date_div").removeClass("has-error");

            if(fromdate==""){
                 $("#from_date_div").addClass("has-error");                    
                    $("#fees_desc").focus();
                    $("#errormsg")
                    .text("Error : Enter Fees Description")
                    .addClass("form_error")
                    .css("display", "block");
                 return false;
            }

             if(todate==""){
                 $("#to_date_div").addClass("has-error");                  
                  $("#errormsg")
                  .text("Error : Enter Fees Description")
                  .addClass("form_error")
                  .css("display", "block");
                 return false;
            }
            else{
                 $("#trialbalanceregister").submit();
            }
           
            
        });
        
        
});/* end of document ready */
        
 