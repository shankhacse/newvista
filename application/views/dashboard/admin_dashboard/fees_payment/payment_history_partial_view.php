<style>
.modal-dialog {
    width: 80% !important;
}
.modal {
    overflow-y: auto !important;
}

</style>
<input type="hidden" name="from_date" id="from_date" value="<?php echo $from_date; ?>" />
<input type="hidden" name="to_date" id="to_date" value="<?php echo $to_date; ?>" />
<input type="hidden" name="acdm_class" id="acdm_class" value="<?php echo $acdm_class; ?>" />
<input type="hidden" name="acdm_section" id="acdm_section" value="<?php echo $acdm_section; ?>" />
<input type="hidden" name="studentid" id="studentid" value="<?php echo $studentid; ?>" />
<div class="table-responsive datatalberes" >
    <table class="table table-bordered table-hover" id="csvDatas">
        <thead style="background: #3c8dbc;color: #fff;">
            <tr>
                <th>Class</th>
                <th>Name</th>
                <th>Section</th>
                <th>Roll</th>
                <th>Receipt date</th>
                <th>Amount</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Action</th>                                                   
            </tr>
        </thead>                                            
    </table>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="titleText" class="modal-title"></h4>
      </div>
      <div class="modal-body" id="modalBody">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->

<!-- Modal  Due Payment-->
<div id="DuePaymentAddEdit" class="modal fade DuePaymentAddEdit" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="DuePaymentTitleText" class="modal-title"></h4>
      </div>
      <div class="modal-body" id="AddEditData">
       
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal Due Payment -->

  <script type="text/javascript">
    $(document).ready(function(){
    $('.selectpicker').selectpicker();
    var basepath = $("#basepath").val();
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    var acdm_class = $("#acdm_class").val();
    if (acdm_class=='') {acdm_class=0;}
    var acdm_section = $("#acdm_section").val();
    var studentid = $("#studentid").val();
   
    var table=$('#csvDatas').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": basepath + 'csvuploader/listCsvData/'+from_date+'/'+to_date+'/'+acdm_class+'/'+acdm_section+'/'+studentid,
                    "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent":"<button id='editData' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-pencil'></span></button>&nbsp;&nbsp;<button id='viewVoucher' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-file'></span></button>&nbsp;&nbsp;<button id='viewDuePayment' class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-check'></span></button>"
                    
                } ]
                    
                });
    $('#csvDatas tbody').on( 'click', '#editData', function () {
        var data = table.row( $(this).parents('tr') ).data();
        window.location.href = basepath+'feespayment/paymentEdit/' + data[ 8 ];
       // alert( data[0] +"'s salary is: "+ data[ 0 ] );
    } );
    $('#csvDatas tbody').on( 'click', '#viewVoucher', function () {
        var data = table.row( $(this).parents('tr') ).data();        
        // window.location.href = basepath+'feespayment/paymentEdit/' + data[ 6 ];
    //    alert( "payment id: "+data[6]);]
    var basepath = $("#basepath").val();  
    $.ajax({
            type: "POST",
            url: basepath+'feespayment/feespaymentouchermodal',
            data: {payment_id:data[8]},           
            success: function (result) {
                //  console.log(result);
                $("#titleText").html('Receipt Voucher'); 
                $("#modalBody").html(result); 
                $('#myModal').modal('show');            
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

    // check due payment
    $('#csvDatas tbody').on( 'click', '#viewDuePayment', function () {
        var data = table.row( $(this).parents('tr') ).data();  
        var basepath = $("#basepath").val();  
        $.ajax({
            type: "POST",
            url: basepath+'feespayment/checkDuePayment',
            data: {payment_id:data[8]},           
            success: function (result) {
                //  console.log(result);
                $("#titleText").html(result.title);
                $("#modalBody").html(result.modal); 
                // $("#modalBody").append("<div class='row' style='text-align: center;'><div class='col-md-12'><button  class='btn btn-primary btn-lg' data-toggle='modal' href='#DuePaymentAddEdit'  data-text='"+data[6]+"' id='payDue'>Pay Due</button></div></div>"); 
                $('#myModal').modal('show');            
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
    
    $(".csvUplad").show();
    $("#loader").hide();           
    $(document).on('click','.csvUplad',function(){
         $(".csvUplad").hide();
         $("#loader").show();
    });
            
});

  </script>