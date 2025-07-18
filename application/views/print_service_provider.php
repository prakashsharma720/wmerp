<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($items);exit;
//$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
       <div class="card-header no-print">
          <div class="pull-right no-print">
              <button onclick="window.print()" class="btn btn-danger"><i class="fa fa-print"></i> <?= $this->lang->line('print') ?></button>
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
                <h3 style="padding-top: 20px;"> <?= $this->lang->line('company_name') ?> </h3>
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
                           <tr>
                            <th colspan="6"> <h4 style="text-align: center"><?= $this->lang->line('service_provider_personal_details') ?> : </h4></th>
                          </tr>
                            <tr>
                            <th> <?= $this->lang->line('service_provider_category') ?> : </th>
                            <td> <?= $current['category']?> </td>
                            <th> <?= $this->lang->line('reg_date') ?> : </th>
                            <td> <?= date('d-m-Y',strtotime($current['reg_date']))?> </td>
                          </tr>
                          <tr>
                            <th> <?= $this->lang->line('service_provider_name') ?> : </th>
                            <td> <?= $current['service_provider_name'].' ('.$service_provider_code.')'?> </td>
                            <th> <?= $this->lang->line('contact_person') ?> : </th>
                            <td> <?= $current['prefix'].' '.$current['contact_person']?> </td>
                          </tr>
                          <tr>
                            <th> <?= $this->lang->line('email') ?> : </th>
                            <td> <?= $current['email']?> </td>
                            <th><?= $this->lang->line('mobile_number') ?> : </th>
                            <td> <?= $current['mobile_no']?> </td>
                          </tr>
                          <tr>
                            <th> <?= $this->lang->line('website') ?> : </th>
                            <td> 
                              <?php if(!empty($current['website'])) { ?>
                              <?= $current['website']?>
                              <?php } else{ 
                                  echo "Not Available";
                                ?>
                              <?php } ?> 
                            </td>
                            <th> <?= $this->lang->line('category_of_approval') ?> : </th>
                            <td> <?= $current['category_of_approval']?> </td>
                          </tr>
                          <tr>
                            <th> <?= $this->lang->line('pan_no') ?> : </th>
                            <td> <?= $current['pan_no']?> </td>
                            <th> <?= $this->lang->line('gstin') ?> : </th>
                            <td> <?= $current['gst_no']?> </td>
                          </tr>
                          <tr>
                            <th> <?= $this->lang->line('tan_no') ?> : </th>
                            <td> <?= $current['tds']?> </td>
                            <th><?= $this->lang->line('country') ?> : </th>
                            <td> <?= $current['country']?> </td>
                          </tr>
                          <tr>
                            <th> <?= $this->lang->line('state') ?> : </th>
                            <td> <?= $current['state']?> </td>
                            <th> <?= $this->lang->line('city') ?> : </th>
                            <td> <?= $current['city']?> </td>
                          </tr>
                           <tr>
                            <th> <?= $this->lang->line('date_of_approval') ?> : </th>
                            <td> <?= date('d-m-Y',strtotime($current['date_of_approval']))?> </td>
                            <th> <?= $this->lang->line('next_evaluation_date') ?> : </th>
                            <td> <?= date('d-m-Y',strtotime($current['date_of_evalution']))?> </td>
                          </tr>
                          
                           <tr>
                            <th colspan=""> <?= $this->lang->line('address') ?>: </th>
                            <td colspan="4"> <?= $current['address']?>  </td>
                          </tr>
                            <tr>
                            <th colspan="4"> <h4 style="text-align: center"><?= $this->lang->line('service_provider_account_details') ?> : </h4> </th>
                          </tr>
                         <tr>
                            <th> <?= $this->lang->line('bank_name') ?> :</th>
                            <td> <?= $current['bank_name']?> </td>
                            <th> <?= $this->lang->line('branch') ?> : </th>
                            <td> <?= $current['branch_name']?> </td>
                          </tr>
                          <tr>
                            <th> <?= $this->lang->line('ifsc') ?> : </th>
                            <td> <?= $current['ifsc_code']?> </td>
                             <th> <?= $this->lang->line('account_number') ?> : </th>
                            <td> <?= $current['account_no']?> </td>
                          </tr>
                         <tr><td colspan="4"> <br></td></tr>
                        </tbody>
                      </table>
                  </div>
                </div>
                 <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <b> <?= $this->lang->line('declaration') ?> : </b> <?= $this->lang->line('declaration_text') ?>
                </div>
               <div class="col-sm-4 invoice-col">
               <!--  <h3 style="padding-top: 20px;"> Choudhary & Company </h3> -->
                </div>
                <div class="col-sm-4 invoice-col">
                <strong><u><?= $this->lang->line('for') ?><?= $this->lang->line('company_name') ?> :</u></strong>
                <br></br><br></br>

                   <b>( <?= $this->lang->line('authorised_signatory') ?>)</b>
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
