<?php
// pre($bodycontent['journalList']);

?> 
<style>
#journalList td{
vertical-align: inherit;
}
</style>
   <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Journal List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Journal List</h3>&nbsp;
              <a href="<?php echo base_url();?>journal/journal" class="link_tab"><span class="glyphicon glyphicon-plus"></span> ADD</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="datatalberes" style="overflow-x:auto;">
              <table id="journalList" class="table table-bordered table-striped dataTables" style="border-collapse: collapse !important;">
                <thead>
                <tr>
                  <th style="width:10%;">Sl</th>
                  <th>Voucher Date</th>
                  <th>Voucher No.</th>
                  <th>Cheque No.</th>
                  <th>Cheque Date</th>
                  <th>Account Details</th> 
                  <th style="text-align:right;width:5%;">Action</th>
                </tr>
                </thead>
                <tbody>
               
              	<?php 
				          // print_r($bodycontent['journalList']);
              		$i = 1;
              		foreach ($bodycontent['journalList'] as $value) { 
              		
              		?>

					<tr>
						<td><?php echo $i++; ?></td>
            <td><?php echo $value['voucher_date']; ?></td>
            <td><?php echo $value['voucher_number']; ?></td>
            <td><?php echo $value['cheque_number']; ?></td>
            <td><?php echo $value['cheque_date']; ?></td>
            <td>
            <table class="table table-striped table-bordered">              
                <tr>
                  <th>A/C</th>
                  <th>Amount</th>
                  <th>D/C</th>
                </tr>
                <?php foreach ($value['voucher_ac_detail'] as $voucher_detail) {?>
                  <tr>
                    <td><?php echo $voucher_detail->account_name; ?></td>
                    <td><?php echo $voucher_detail->voucher_amount; ?></td>
                    <td><?php if($voucher_detail->is_debit=='Y'){ echo "D"; }else{ echo "C"; }?></td>
                  </tr>
               <?php } ?>
              
            </table>
            </td>
            <td align="center">            
							<a href="<?php echo base_url(); ?>journal/journal/<?php echo $value['id']; ?>" class="btn btn-primary btn-xs" data-title="Edit">
								<span class="glyphicon glyphicon-pencil"></span>
							</a>         
						</td>
					</tr>              			
              	<?php
              		}

              	?>
                </tbody>
               
              </table>

              </div>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->