<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($items);exit;
//$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
       <div class="card-header no-print">
          <div class="pull-right no-print">
              <button onclick="window.print()" class="btn btn-danger"><i class="fa fa-print"></i> Print</button>
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
                <h3 style="padding-top: 20px;"> Choudhary & Company </h3>
                </div>
                <div class="col-sm-4 invoice-col">
                <strong><u>Company Details:</u></strong><br>
                  <b>GSTIN : </b>08AABFC2155P1ZA<br>
                  <b>PAN : </b> AABFC2155P<br>
                  <!-- <b>State : </b> Rajasthan <b>State Code :</b> 08<br> -->
                  <b> Address : </b> B-133, Mewar Industrial Area (MIA), Madri, Transport Nagar, Udaipur, Rajasthan 313003.
                </div>
              </div>
              <br>
              <!-- Table row -->
                <div class="row">
                    <div class="col-12">
                      <table class="table">
                        <tbody>
                           <tr>
                            <th colspan="6"> <h4 style="text-align: center">Customer's details : </h4></th>
                          </tr>
                            <tr>
                            <th> Registration Date : </th>
                            <td> <?= date('d-m-Y',strtotime($current['reg_date']))?> </td>
                             <th> Vendor Code : </th>
                            <td> <?= $current['vendor_code']?> </td>
                          </tr>
                          <tr>
                            <th> Customer Name : </th>
                            <td> <?= $current['customer_name'].' ('.$customer_code.')'?> </td>
                            <th> Contact Person : </th>
                            <td> <?= $current['prefix'].' '.$current['contact_person']?> </td>
                          </tr>
                          <tr>
                            <th> Email : </th>
                            <td> <?= $current['email']?> </td>
                            <th> Mobile Number : </th>
                            <td> <?= $current['mobile_no']?> </td>
                          </tr>                          <tr>
                            <th> PAN No : </th>
                            <td> <?= $current['pan_no']?> </td>
                            <th> GSTIN : </th>
                            <td> <?= $current['gst_no']?> </td>
                          </tr>
                          <tr>
                            <th> Website : </th>
                            <td> 
                              <?php if(!empty($current['website'])) { ?>
                              <?= $current['website']?>
                              <?php } else{ 
                                  echo "Not Available";
                                ?>
                              <?php } ?> 
                            </td>
                            <th> County : </th>
                            <td> <?= $current['country']?> </td>
                          </tr>
                          <tr>
                            <th> State : </th>
                            <td> <?= $current['state']?> </td>
                            <th> City : </th>
                            <td> <?= $current['city']?> </td>
                          </tr>
                           <tr>
                           
                          </tr>
                          
                           <tr>
                            <th>Shipping Address : </th>
                            <td> <?= $current['shipping_address']?>  </td>
							             <th>Billing Address : </th>
                            <td> <?= $current['billing_address']?>  </td>
                          </tr>
                         <tr><td colspan="4"> <br></td></tr>
                        </tbody>
                      </table>
                  </div>
                </div>
                 <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <b> Declaration : </b> We declare that this copy shows the actual information of this supplier and that all particulars are true and correct to the best of our knowledge.
                </div>
               <div class="col-sm-4 invoice-col">
               <!--  <h3 style="padding-top: 20px;"> Choudhary & Company </h3> -->
                </div>
                <div class="col-sm-4 invoice-col">
                <strong><u>For Choudhary & Company :</u></strong>
                <br></br><br></br>

                   <b>( Authorised Signatory)</b>
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
