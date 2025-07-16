     <?php if (!empty($suppliers)){ ?>
     <option value=""> Select Supplier</option>
     <?php 
            foreach ($suppliers as $value) : ?>
     <option value="<?= $value['id'] ?>"><?= $value['supplier_name'] ?></option>
     <?php   endforeach;  ?>

     <?php } ?>

     <?php if (!empty($transporters)): ?>
     <option value=""> Select Transporter</option>
     <?php 
            foreach ($transporters as $value) : ?>
     <option value="<?= $value['id'] ?>"><?= $value['transporter_name'] ?></option>
     <?php   endforeach;  ?>

     <?php endif; ?>


     <?php if (!empty($service_providers)): ?>
     <option value=""> Select Service Provider</option>
     <?php 
            foreach ($service_providers as $value) : ?>
     <option value="<?= $value['id'] ?>"><?= $value['service_provider_name'] ?></option>
     <?php   endforeach;  ?>
     <?php endif; ?>


     <?php if (!empty($suppliers_data)): ?>
     <div class="row col-md-12">
         <div class="col-md-3 col-sm-3">
             <label class="control-label"><?=$this ->lang ->line('supplier_type')?></label>
             <input type="text" class="form-control" value="<?= $suppliers_data['supplier_type']?>" readonly="readonly">
         </div>
         <div class="col-md-4 col-sm-4">
             <label class="control-label"> <?=$this ->lang ->line('contact_person')?></label>
             <input type="text" class="form-control" value="<?= $suppliers_data['contact_person']?>"
                 readonly="readonly">
         </div>
         <div class="col-md-5 col-sm-5">
             <label class="control-label"> <?=$this ->lang ->line('address')?> </label>
             <textarea class="form-control" readonly="readonly"> <?= $suppliers_data['address']?></textarea>
         </div>

     </div>
     <?php endif; ?>

     <?php if (!empty($service_providers_data)): ?>
     <div class="row col-md-12">
         <div class="col-md-3 col-sm-3">
             <label class="control-label"> <?=$this ->lang ->line('service_provider_type')?></label>
             <input type="text" class="form-control" value="<?= $service_providers_data['service_provider_type']?>"
                 readonly="readonly">
         </div>
         <div class="col-md-4 col-sm-4">
             <label class="control-label"> <?=$this ->lang ->line('contact_person')?></label>
             <input type="text" class="form-control" value="<?= $service_providers_data['contact_person']?>"
                 readonly="readonly">
         </div>
         <div class="col-md-5 col-sm-5">
             <label class="control-label"> <?=$this ->lang ->line('address')?> </label>
             <textarea class="form-control" readonly="readonly"> <?= $service_providers_data['address']?></textarea>
         </div>

     </div>
     <?php endif; ?>

     <?php if (!empty($transporters_data)): ?>
     <div class="row col-md-12">
         <div class="col-md-3 col-sm-3">
             <label class="control-label"><?=$this ->lang ->line('transporter_type')?></label>
             <input type="text" class="form-control" value="<?= $transporters_data['transporter_type']?>"
                 readonly="readonly">
         </div>
         <div class="col-md-4 col-sm-4">
             <label class="control-label"> <?=$this ->lang ->line('contact_person')?></label>
             <input type="text" class="form-control" value="<?= $transporters_data['contact_person']?>"
                 readonly="readonly">
         </div>
         <div class="col-md-5 col-sm-5">
             <label class="control-label"> <?=$this ->lang ->line('address')?></label>
             <textarea class="form-control" readonly="readonly"> <?= $transporters_data['address']?></textarea>
         </div>

     </div>
     <?php endif; ?>

     <?php if (!empty($customers_data['gst_no'])){ ?>
     <div class="col-md-4 col-sm-4 gst_no">
         <label class="control-label">Vender Service Tax Number</label>
         <input type="text" placeholder=" Vender Service Tax Number" name="vendor_service_tax_no"
             class="form-control clear_gst" value="<?= $customers_data['gst_no']?>" autocomplete="off" autofocus
             readonly="readonly">
     </div>
     <div class="col-md-4 col-sm-4 buyer_item_code">
         <label class="control-label">Buyer Item Code </label>
         <textarea class="form-control buyer_item_code1" rows="2" placeholder="Enter buyer item code"
             name="buyer_item_code"
             value="<?= $customers_data['buyer_item_code']?>"><?= $customers_data['buyer_item_code']?></textarea>
     </div>
     <div class="col-md-4 col-sm-4 destination">
         <label class="control-label"> <?=$this ->lang->line('destination')?></label>
         <textarea class="form-control destination1" rows="2" placeholder="<?=$this ->lang->line('enter_deatination_here')?>" name="destination"
             value="<?= $customers_data['destination']?>"><?= $customers_data['destination']?></textarea>
     </div>

     <?php } ?>

     <?php if (!empty($customers_data['customer_code'])){ ?>
     <fieldset class="shipping_details">
         <legend> Shipping Details </legend>
         <div class="row col-md-12 shipping_div">
             <div class="col-md-4 col-sm-4 shipping_gst_status">
                 <label class="control-label"> <?=$this ->lang->line('gst_registration_status')?> </label>
                 <div class="form-check">
                     <input class="form-check-input gst_status" type="radio" name="shipping_gst_status" value="Yes"
                         <?= $customers_data['shipping_gst_status'] == 'Yes' ? 'checked' : '' ?> readonly>
                     Yes</input>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <input class="form-check-input gst_status" type="radio" name="shipping_gst_status"
                         value="Un-registered Dealer"
                         <?= $customers_data['shipping_gst_status'] == 'Un-registered Dealer' ? 'checked' : '' ?> readonly>
                    <?=$this ->lang->line('unregistered_dealer')?> </input>
                 </div>
             </div>
             <div class="col-md-4 col-sm-4 shipping_gst_no">
                 <b><?=$this ->lang->line('gst_in')?></b><span>( Ex. : 08ABCDE1234K1AZ)</span>
                 <input type="text" placeholder="Ex. 08ABCDE12341AZ" name="shipping_gst_no"
                     class="form-control shipping_gst_no" value="<?= $customers_data['shipping_gst_no']?>"
                     autocomplete="off" maxlength="15" minlength="15">
             </div>
             <div class="col-md-4 col-sm-4 shipping_legal_name ">
                 <label class="control-label"> <?=$this ->lang->line('legal_name')?> </label>
                 <div class="form-check">
                     <input type="text" placeholder="<?=$this ->lang->line('enter_legal_name')?>" name="shipping_legal_name"
                         class="form-control shipping_legal_name" value="<?= $customers_data['shipping_legal_name']?>"
                         autofocus>
                 </div>
             </div>
             <div class="col-md-4 col-sm-4 saddress1 ">
                 <label class="control-label"> Shipping Address 1 </label>
                     <textarea type="text" placeholder="Enter Shipping Address 1" name="saddress1" class="form-control saddress1" 
                     value="<?= $customers_data['gst_no']?>" autofocus><?= $customers_data['saddress1']?></textarea>
             </div>
             <div class="col-md-4 col-sm-4  saddress2">
                 <label class="control-label">Shipping Address 2 </label>
                     <textarea type="text" placeholder="Enter Shipping Address 2" name="saddress2" class="form-control saddress2"
                      value="<?= $customers_data['gst_no']?>" autofocus> <?= $customers_data['saddress2']?></textarea>
             </div>
             <div class="col-md-4 col-sm-4 loc">
                 <label class="control-label"> LOC </label>
                     <input type="text" placeholder="Enter Location" name="loc" class="form-control loc"
                         value="<?= $customers_data['loc']?>" autofocus>
             </div>
             <div class="col-md-4 col-sm-4 ship_pincode ">
                 <label class="control-label"> Pin Code</label>
                 <input type="text" id="bpin" placeholder="Enter Pin Code" name="ship_pincode"
                     class="form-control ship_pincode " value="<?= $customers_data['ship_pincode']?>" autofocus
                     autocomplete="off">
             </div>
             <div class="col-md-4 col-sm-4 ship_state_code">
                 <label class="control-label"> State Code</label>
                 <input type="text" id="bpin" placeholder="Enter State Code" name="ship_state_code"
                     class="form-control ship_state_code " value="<?= $customers_data['ship_state_code']?>" autofocus
                     autocomplete="off">
             </div>
             <div class="col-md-4 col-sm-4 ship_destination ">
                 <label class="control-label "> Distance</label>
                 <input type="text" id="bpin" placeholder="Enter Distance" name="ship_destination"
                     class="form-control ship_destination" value="<?= $customers_data['ship_destination']?>" autofocus
                     autocomplete="off">
             </div>
         </div>
     </fieldset>
     <?php } ?>
 
     <?php if (!empty($transport_data['gst_no'])){ ?>
     <div class="row col-md-12">
         <div class="col-md-12 col-sm-12 transporter_div ">
             <label class="control-label"> Transport ID</label>
             <input type="text" placeholder=" Enter Transporter ID" name="transport_id"
                 class="form-control clear_transID" value="<?= $transport_data['gst_no']?>" />
         </div>
         
     </div>
   
     <?php } ?>