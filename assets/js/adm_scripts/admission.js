$(document).ready(function(){
   
	var basepath = $("#basepath").val();
	    $( ".datepicker" ).datepicker({
       
       changeMonth: true,
       changeYear: true,
       format: 'dd/mm/yyyy'

    });
        //Datemask dd/mm/yyyy
    $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });

    $('.selectpicker').selectpicker({
    dropupAuto: false
	});


	  $(document).on('click', '.browse', function(){
      var file = $(this).parent().parent().parent().find('.file');
      file.trigger('click');
    });

      $(document).on('change', '.file', function(){
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    }); 

$('input[type="checkbox"][name="adr_check"]').change(function() {

	   var area = $("#present_area").val();
	   var town = $("#present_town").val();
	   var post_office = $("#present_po").val();
	   var police_station = $("#present_ps").val();
	   var pin_code = $("#present_pin").val();
	   var state = $("#present_state").val();
	   var district = $("#present_dist").val();
    	
    	if($(this).prop('checked')) {

            //alert("Checked Box Selected");
            $("#area").val(area);
            $("#town").val(town);
            $("#post_office").val(post_office);
            $("#police_station").val(police_station);
            $("#pin_code").val(pin_code);
            $("#state").val(state).change();
            $("#district").val(district).change();
        } else {

           // alert("Checked Box deselect");
            $("#area").val("");
            $("#town").val("");
            $("#post_office").val("");
            $("#police_station").val("");
            $("#pin_code").val("");
            $("#state").val('41').change();// 41:west bengal
            $("#district").val('0').change();

        }
 });

    /* submit admission form*/

 $(document).on('submit','#AdmissionForm',function(event)
    {
    	
        event.preventDefault();

        if(validateAdmission())
        {   
        
        if(1)
        {
        
            
          
            var formData = new FormData($(this)[0]);
            $("#admsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');
        

            //console.log(formData);
            
    
        $.ajax({
                type: "POST",
                url: basepath+'student/saveStudent',
                dataType: "json",
                processData: false,
                contentType: false, // "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {
                    
                    if (result.msg_status == 200) {
                            
                        $("#suceessmodal").modal({
                            "backdrop": "static",
                            "keyboard": true,
                            "show": true
                        });
                        var addurl = basepath + "student/addStudent";
                        var listurl = basepath + "student";
                        $("#responsemsg").text(result.msg_data);
                        $("#response_add_more").attr("href", addurl);
                        $("#response_list_view").attr("href", listurl);

                    } 
                    else {
                        $("#adm_response_msg").text(result.msg_data);
                    }
                    
                    $("#loaderbtn").css('display', 'none');
                    
                    $("#admsavebtn").css({
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
                   // alert(msg);  
                }
            }); /*end ajax call*/

          }  // end detail validation
        }   // end master validation
        
    });



 $("input[type='file']").on("change", function () {
 	var derault_profile_src = $("#derault_profile_src").val();

     if(this.files[0].size > 500000) {
       alert("Please upload file less than 500KB. Thanks!!");
       $(this).val('');
       $('#profile_img').attr('src',derault_profile_src);
     }else{
     	 readURL(this);
     }
    });

/* check registration no */
   $(document).on("keyup", "#reg_no", function() {
    var reg_no = $(this).val();

     var type = "POST"; //for creating new resource
     var urlpath = basepath + 'student/checkRegNo';
     $("#adm_info_error").text("").css("dispaly", "none").removeClass("form_error");
    	$.ajax({
                type: type,
                url: urlpath,
                data: {reg_no:reg_no},
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
					if (result.msg_status == 200) {
    
							$("#reg_no").css("background-color","#FFF");	
                    } 
					else {
                        
                                $("#reg_no").focus();
								$("#adm_info_error")
								.text("Error : Registration no already assigned!")
								.addClass("form_error")
						        .css("display", "block");
						         $("#reg_no").css("background-color","#FFD2D2");
                    }
					
                   
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });

    });


  /* check form sl no */


  /* check registration no */
   $(document).on("keyup", "#form_sl_no", function() {
    var form_sl_no = $(this).val();

     var type = "POST"; //for creating new resource
     var urlpath = basepath + 'student/checkFromSl';
     $("#adm_info_error").text("").css("dispaly", "none").removeClass("form_error");
    	$.ajax({
                type: type,
                url: urlpath,
                data: {form_sl_no:form_sl_no},
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
					if (result.msg_status == 200) {
    				 
    				 $("#form_sl_no").css("background-color","#FFF");

								
                    } 
					else {
                        		
                                $("#form_sl_no").focus();
								$("#adm_info_error")
								.text("Error : Form serial no already assigned!")
								.addClass("form_error")
						        .css("display", "block");
						        $("#form_sl_no").css("background-color","#FFD2D2");


                    }
					
                   
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });

    });


});// end of document ready



/* Preview Impage in Imagebox*/

function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();


    reader.onload = function(e) {
      $('#profile_img').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}


function validateAdmission()
{
    var reg_no = $("#reg_no").val();
    var form_sl_no = $("#form_sl_no").val();
    var admdt = $("#admdt").val();
    var student_name = $("#student_name").val();
    var studentdob = $("#studentdob").val();
    var gender = $("#gender").val();



    $("#admmsg").text("").css("dispaly", "none").removeClass("form_error");

    if(reg_no=="")
    {
        $("#reg_no").focus();
        $("#admmsg")
        .text("Error : Enter registration no!")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(form_sl_no=="")
    {
        $("#form_sl_no").focus();
        $("#admmsg")
        .text("Error : Enter form serial no!")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

     if(admdt=="")
    {
        $("#admdt").focus();
        $("#admmsg")
        .text("Error : Select Admission Date")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(student_name=="")
    {
        $("#student_name").focus();
        $("#admmsg")
        .text("Error : Enter student name")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(studentdob=="")
    {
        $("#studentdob").focus();
        $("#admmsg")
        .text("Error : Enter date of birth")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }

    if(gender=="0")
    {
        $("#gender").focus();
        $("#admmsg")
        .text("Error : Select gender")
        .addClass("form_error")
        .css("display", "block");
        return false;
    }
 
 
    //return true;
}