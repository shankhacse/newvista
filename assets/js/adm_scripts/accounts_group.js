$( document ).ready(function() {
   $('#main_category1').on('click',function(){
    $("#div_sub_category2").hide();
    $("#div_sub_category1").show();
   });
   $('#main_category2').on('click',function(){
    $("#div_sub_category1").hide();
    $("#div_sub_category2").show();
   });

});

function groupFormValidation()
{
   if($('#group_description').val()=="")
   {
    $("#group_description_div").addClass('has-error');
    $("#group_description").focus();
    return false;
   }
   if($("input[name='main_category']:checked").val() == null)
   {
    $("#main_category_div").addClass('has-error');
    $("#main_category1").focus();
    return false;
   }
   if($("#main_category1:checked").val() != null)
   {
        if($("#div_sub_category1 input[name='sub_category']:checked").val() == null)
        {
            $("#div_sub_category1").addClass('has-error');
            // $("input[name='sub_category']:checked").focus();
            return false;
        }
   }
   if($("#main_category2:checked").val() != null)
   {       
        if($("#div_sub_category2 input[name='sub_category']:checked").val() == null)
        {
            $("#div_sub_category2").addClass('has-error');
            // $("input[name='sub_category']:checked").focus();
            return false;
        }
   }
   return true;
}