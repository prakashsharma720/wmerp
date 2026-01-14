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
              <a href="<?= base_url()?>/Purchase_order/form_submit" class="btn btn-info">    <?= $this->lang->line('final_submit') ?></a>
              <a href="<?= base_url()?>/Purchase_order/edit/<?php print_r($current[0]['id']); ?>" class="btn btn-success">  <?= $this->lang->line('edit') ?></a>
          </div>
      </div> <!-- /.card-body -->
      <div class="card-body">
			  <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <img src="<?= base_url()?>/uploads/logo.png" height="120" width="300"/>
                </div>
               <div class="col-sm-4 invoice-col">
                <!--<h6 style="padding-top: 20px;"> STANDARD OPERATING PROCEDURE </h6>-->
                <h4 style="padding-top: 20px;"><?=$this ->lang ->line('purchase_order')?></h4>
                </div>
                <div class="col-sm-4 invoice-col">
                <strong><u><?= $this->lang->line('company_details') ?>:</u></strong><br>
                  <b><?= $this->lang->line('gstin') ?> : </b>08AABFC2155P1ZA<br>
                  <b><?= $this->lang->line('pan') ?> : </b> AABFC2155P<br>
                  <!-- <b>State : </b> Rajasthan <b>State Code :</b> 08<br> -->
                  <b> <?= $this->lang->line('address') ?> : </b> <?= $this->lang->line('company_address') ?>
                </div>
              </div>
              <br>
              <!-- Table row -->
                <div class="row">
                    <div class="col-12">
                      <table class="table">
                        <tbody>
                           <!--<tr>
                            <th colspan="6"> <h4 style="text-align: center">PURCHASE ORDER</h4></th>
                          </tr>-->
                          <tr>
                            <th rowspan="3" >  <?= $this->lang->line('from') ?> :  </th>
                            <td rowspan="3" colspan="2"> <?= $current['0']['supplier']?>,<br> <?= $current['0']['address']?> </td>
                            <th colspan="2"> <?= $this->lang->line('po_number') ?> : </th>
                            <td colspan="2"> 
                                  <?php 
                                  $inv_number=$current['0']['po_number'];
                                  if($inv_number<10){
                                  $inv_number1='CNC/A/000'.$inv_number;
                                  }
                                  else if(($inv_number>=10) && ($inv_number<=99)){
                                    $inv_number1='CNC/A/00'.$inv_number;
                                  }
                                  else if(($inv_number>=100) && ($inv_number<=999)){
                                    $inv_number1='CNC/A/0'.$inv_number;
                                  }
                                  else{
                                    $inv_number1='CNC/A/'.$inv_number;
                                  }
                                  echo $inv_number1; ?>
                                </td>
						              </tr>
                       	  <tr>
                            <th colspan="2"><?= $this->lang->line('dated') ?> :  </th>
                            <td> <?= $current['0']['transaction_date']?> </td>
              						</tr>
                           <tr>
                             <th colspan="2"><?= $this->lang->line('vendor_code') ?> : </th>
                            <td> 
                                <?php 
                                    $inv_number=$current['0']['vendor_code'];
                                    if($inv_number<10){
                                      $inv_number1='SUP000'.$inv_number;
                                      }
                                      else if(($inv_number>=10) && ($inv_number<=99)){
                                        $inv_number1='SUP00'.$inv_number;
                                      }
                                      else if(($inv_number>=100) && ($inv_number<=999)){
                                        $inv_number1='SUP0'.$inv_number;
                                      }
                                      else{
                                        $inv_number1='SUP'.$inv_number;
                                      }
                                      echo $inv_number1; 
                                  ?>     
                           </td>
                          </tr>
                          <tr>
                            <th> <?= $this->lang->line('contact_person') ?> : </th>
                            <td colspan="6"> <?= $current['0']['prefix'].' '.$current['0']['c_person']?>  </td>
                          </tr>
                           <tr>
                            <th> <?= $this->lang->line('contact_no') ?> : </th>
                            <td colspan="6"> <?= $current['0']['mobile_no']?> </td>
                          </tr>
                          <tr>
                            <th> <?= $this->lang->line('email_id') ?> : </th>
                            <td colspan="6"> <?= $current['0']['email']?> </td>
                          </tr>
                           <tr>
                            <th> <?= $this->lang->line('reference') ?>: </th>
                            <td colspan="6"> <?= $current['0']['reference_by']?> </td>
                          </tr>
                           <tr>
                           <td colspan="6">
                              <?= $this->lang->line('please_supply_items_note') ?>
                           </td>
                         </tr>
                  		  <tr>
                         
            						  <th> <?=$this ->lang ->line('sr_no')?>.</th>
            						  <th colspan="2"><label> <?=$this ->lang ->line('material_description')?> </label></th>
                          <!--<th>Requisition Quantity</th>-->
            						  <th><label> <?=$this ->lang ->line('quantity')?></label></th>
              						<th><?= $this->lang->line('item_price') ?></th>
              						<th><?= $this->lang->line('total_amount') ?></th>
						            </tr>
                  <?php $i=1;foreach($current['0']['po_details'] as $po_details) { ?>
	                    <tr>
						
	                      <td colspan="1"><?= $i ?></td>
	                      <td colspan="2"><?= $po_details['item'].' ('.$po_details['code'].')' ?> </td>
            							<td>
            								<?=$po_details['quantity'].' '.$po_details['unit'] ?>
            							</td>
            							<td>
            								<?=$po_details['rate']
            								 ?> &#8377;
            							</td>
            							<td>
            								<?=$po_details['amount'] ?> &#8377;
            							</td>
	                    </tr>
	                <?php $i++;} ?>
							<tr>
			        		<td colspan="3" style="text-align: right;"><b><?=$this ->lang ->line('total')?></b></td>
					             <td> <?= $current['0']['total_qty']?></td>
								  
								   <td> <?= $current['0']['total_amount']?> &#8377;</td>
							</tr>
            <tr>
                <td colspan="3" style="text-align: right;"><b> <?= $this->lang->line('less_discount') ?></b></td>
                   <?php if($current['0']['discount_amount']!='0.00'){ ?>
                      <td>-</td>
                      <td>-</td>
                      <td> <?= $current['0']['discount_amount']?> &#8377;</td>
                 <?php  } else { ?>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                 <?php } ?>
              </tr>
					         <tr>
			        			<td colspan="3" style="text-align: right;"><b><?= $this->lang->line('gst') ?></b></td>
					             <td> <?= $current['0']['gst_per']?> % </td>
								  <td> <?= $current['0']['gst_amount']?> &#8377;</td>
								   <td> <?= $current['0']['grand_total']?> &#8377;</td>
							</tr>
							  <tr>
              <th> <?= $this->lang->line('amount_in_words') ?></th>
              <td colspan="3"> <?php echo $amount_in_words; ?></td>
              <th><?= $this->lang->line('grand_total') ?></th>
              <td> <?= round($current['0']['grand_total'])?> &#8377;</td>
              </tr>
			        		</tbody>
							</table>
               <div class="row invoice-info">
                <div class="col-sm-12 invoice-col">
                   <b><?= $this->lang->line('terms_conditions') ?>:</b>
                <ul>
                  <li><?= $this->lang->line('payment_terms') ?></li>
                  <li><?= $this->lang->line('delivery_schedule') ?></li>
                  <li><?= $this->lang->line('billing_note') ?></li>
                  <li><?= $this->lang->line('po_on_invoice') ?></li>
                </ul>
                </div>
                <div class="col-sm-4 invoice-col">
                  <b> <?= $this->lang->line('prepared_by') ?> :</b>
                  <br></br>
                  <br></br>
                  <b> Purchase Dept.</b>
                </div>
                <div class="col-sm-4 invoice-col">
                  <b> <?= $this->lang->line('checked_by') ?> :</b>
                  <br></br>
                  <br></br>
                  <b> Accounts Dept.</b>
                </div>
                <div class="col-sm-4 invoice-col">
                  <b><?= $this->lang->line('approved_by') ?> :</b>
                  <br></br>
                  <br></br>
                  <b> Executive Director </b>
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
