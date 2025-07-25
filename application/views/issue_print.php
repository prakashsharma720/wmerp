<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($items);exit;
//$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
       <div class="card-header no-print">
          <span class="card-title"><?php  echo $title; ?>
        </span>
          <div class="pull-right no-print">
              <button onclick="window.print()" class="btn btn-danger"><i class="fa fa-print"></i> <?= $this->lang->line('print')?></button>
          </div>
      </div> <!-- /.card-body -->
      <div class="card-body">
              <!-- title row -->
              <div class="row ">
                <div class="col-sm-4">
                  <img src="<?= base_url()?>/uploads/logo.png" height="120" width="300"/>
                </div>
               <div class="col-sm-4 ">
                <h4 style="padding-top: 20px;"> <?= $this->lang->line('company_name')?> </h4>
                </div>
                <div class="col-sm-4 ">
                <strong><u><?= $this->lang->line('company_details')?>:</u></strong><br>
                  <b><?= $this->lang->line('gstin')?> : </b>08AABFC2155P1ZA<br>
                  <b><?= $this->lang->line('pan')?> : </b> AABFC2155P<br>
                  <!-- <b>State : </b> Rajasthan <b>State Code :</b> 08<br> -->
                  <b> <?= $this->lang->line('address')?> : </b> <?= $this->lang->line('company_address')?>
                </div>
              </div>
              <br>
              <!-- Table row -->
                <div class="row">
                    <div class="col-12">
                      <table class="table">
                        <tbody>
                           <tr>
                            <th colspan="6"> <h4 style="text-align: center"><?= $this->lang->line('issue_slip')?> </h4></th>
                          </tr>
                          <tr>
            							<th colspan="1"><?=$this ->lang ->line('requisition_date')?> :</th>
                          <td colspan="2"> <?= $current['0']['date']?> </td>		
            						  <th colspan="1"><?= $this->lang->line('issue_date')?>:</th>
                          <td colspan="2"> <?= $current['0']['transaction_date']?> </td>
	       					<td colspan=""></td>
                          </tr>
                       	  <tr>
							               <th colspan="1"> <?= $this->lang->line('issue_slip_no')?> : </th>
                            <td colspan="2">
                              <?php 
                                  $inv_number=$current['0']['issue_slip_no'];
                                  if($inv_number<10){
                                    $inv_number1='IS000'.$inv_number;
                                  }
                                  else if(($inv_number>=10) && ($inv_number<=99)){
                                    $inv_number1='IS00'.$inv_number;
                                  }
                                  else if(($inv_number>=100) && ($inv_number<=999)){
                                    $inv_number1='IS0'.$inv_number;
                                  }
                                  else{
                                    $inv_number1='IS'.$inv_number;
                                  }
                                  echo $inv_number1; ?>     
                                </td>
                								<th colspan="1"><?= $this->lang->line('employee_name')?> :</th>
                							  <td colspan="2"> <?= $current['0']['ename']?> </td>
                							</tr>
                							<tr>
                							 <th colspan="1"><?= $this->lang->line('department')?> </th>
                                <td colspan="2"> <?= $current['0']['dept']?> </td>
                						    <th colspan="1"> <?= $this->lang->line('requisition_no')?> : </th>
                                <td colspan="2"> 
                                  <?php 
                                  $inv_number=$current['0']['requisition_no'];
                                  if($inv_number<10){
                                    $inv_number1='RS000'.$inv_number;
                                  }
                                  else if(($inv_number>=10) && ($inv_number<=99)){
                                    $inv_number1='RS00'.$inv_number;
                                  }
                                  else if(($inv_number>=100) && ($inv_number<=999)){
                                    $inv_number1='RS0'.$inv_number;
                                  }
                                  else{
                                    $inv_number1='RS'.$inv_number;
                                  }
                                  echo $inv_number1; ?>    
                                </td>
                					      <th> </th>
                                <td></td>
                							</tr>

              <div class="row col-md-12 ">
                <div class="table-responsive">
                  <table class="table table-bordered " id="maintable" >
                    <thead style="background-color: #e8e8e8;">
                    <tr>
                      <th> <?=$this ->lang ->line('sr_no')?>.</th>
                      <th> <?=$this ->lang ->line('material_description')?></th>
                      <th><?=$this ->lang ->line('units')?></th>
                      <th><?=$this ->lang ->line('requisition_qty')?></th>
                      <th><?=$this ->lang ->line('issue_qty')?></th>
                      <th><?=$this ->lang ->line('pending_qty')?></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i=1;foreach($current['0']['issue_details'] as $issue_details) { ?>
	                    <tr>
						
	                      <td><?= $i ?></td>
	                      <td><?= $issue_details['item']?> </td>
                        <td><?=$issue_details['unit'] ?></td>
	                      <td><?= $issue_details['req_qty']?> </td>
	                      <td><?= $issue_details['quantity']?> </td>
	                      <td><?= $issue_details['req_qty']-$issue_details['quantity']?> </td>
		                 </tr>
	                <?php $i++;} ?>
							<tr>
								<td colspan="3" style="text-align: right;"><b><?=$this ->lang ->line('total')?></b></td>
					             <td> <?= $current['0']['total_req_qty']?></td>

					             <td> <?= $current['0']['total_issue_qty']?></td>
			        			
					             <td> <?= $current['0']['total_pending_qty']?></td>
								 
							</tr>
							</tbody>
							</table>
				       
                 <div class="row ">
                <div class="col-sm-4 ">
                  <b> <?= $this->lang->line('declaration')?> : </b> <?= $this->lang->line('declaration_text')?>
                </div>
               <div class="col-sm-4 ">
               <!--  <h3 style="padding-top: 20px;"> Choudhary & Company </h3> -->
                </div>
                <div class="col-sm-4 ">
                <strong><u><?= $this->lang->line('for')?> <?= $this->lang->line('company_name')?>:</u></strong>
                <br></br><br></br>

                   <b>(<?= $this->lang->line('authorised_signatory') ?>)</b>
                </div>
              </div>
                <!-- /.col -->
              </div>
    		    </div>
    	 </div>
    </div>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    moneyFormat(x){
      //var x=3300000.00;
      x=x.toString();
      var lastThree = x.substring(x.length-3);
      var otherNumbers = x.substring(0,x.length-3);
      if(otherNumbers != '')
          lastThree = ',' + lastThree;
      var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
     // alert(res);
    }
    
  });
</script>
