
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
                                                    <th>Payment date</th>
                                                    <th>Memono</th>
                                                    <th>Amount</th>
                                                    <th>Payment Id</th>
                                                   
                                                </tr>
                                            </thead>
                                            
                                        </table>
                                    </div>


  <script type="text/javascript">
    $(document).ready(function(){
     
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
                    "defaultContent": "<button class='btn btn-primary btn-xs'><span class='glyphicon glyphicon-pencil'></span></button>"
                } ]
                    
                });
    $('#csvDatas tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
        window.location.href = basepath+'feespayment/paymentEdit/' + data[ 7 ];
       // alert( data[0] +"'s salary is: "+ data[ 0 ] );
    } );
    $(".csvUplad").show();
    $("#loader").hide();           
    $(document).on('click','.csvUplad',function(){
         $(".csvUplad").hide();
         $("#loader").show();
    });
    
            
});
  </script>