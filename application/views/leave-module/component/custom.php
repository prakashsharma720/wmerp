<div class="offcanvas offcanvas-end" tabindex="-1" id="custom<?= $obj['id']; ?>">
    <!-- Header -->
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold"><?= $this->lang->line('customers_list') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Body -->
    <div class="offcanvas-body d-flex flex-column" style="height: calc(100vh - 160px);">
        <div class="flex-grow-1 overflow-auto">
            <div class="row">

                <!-- Section: Basic Details -->
                
                <div class="offcanvas-header ht-80 px-0 ">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
           basic Details               </h2>
            </div>
    </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('customer_type') ?>:</label>
                    <div><?= !empty($obj['customer_type']) ? $obj['customer_type'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('customer_name') ?>:</label>
                    <div><?= !empty($obj['customer_name']) ? $obj['customer_name'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('customer_code') ?>:</label>
                    <div><?= !empty($obj['customer_code']) ? $obj['customer_code'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('registration_date') ?>:</label>
                    <div><?= !empty($obj['reg_date']) ? $obj['reg_date'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('website') ?>:</label>
                    <div><?= !empty($obj['website']) ? $obj['website'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('vendor_code') ?>:</label>
                    <div><?= !empty($obj['vendor_code']) ? $obj['vendor_code'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('contact_person') ?>:</label>
                    <div><?= !empty($obj['prefix']) ? $obj['prefix'] . ' ' : '' ?><?= !empty($obj['contact_person']) ? $obj['contact_person'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('email') ?>:</label>
                    <div><?= !empty($obj['email']) ? $obj['email'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('mobile') ?>:</label>
                    <div><?= !empty($obj['mobile_no']) ? $obj['mobile_no'] : '-' ?></div>
                </div>

                <!-- Section: Address Details -->
                <!-- <div class="col-12 mt-4 mb-2">
                    <h5 class="fw-bold text-primary border-bottom pb-1"><?= $this->lang->line('address_details') ?></h5>
                </div> -->

                <div class="offcanvas-header ht-80 px-0 ">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
                     <?= $this->lang->line('address_details') ?>    </h2>
            </div>
    </div>
                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('country') ?>:</label>
                    <div><?= !empty($obj['country']) ? $obj['country'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('state') ?>:</label>
                    <div><?= !empty($obj['state']) ? $obj['state'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('city') ?>:</label>
                    <div><?= !empty($obj['city']) ? $obj['city'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('billing_address_1') ?>:</label>
                    <div><?= !empty($obj['billing_address1']) ? $obj['billing_address1'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('billing_address_2') ?>:</label>
                    <div><?= !empty($obj['billing_address2']) ? $obj['billing_address2'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('pincode') ?>:</label>
                    <div><?= !empty($obj['pincode']) ? $obj['pincode'] : '-' ?></div>
                </div>

                <!-- Section: Tax Details -->
                <div class="col-12 mt-4 mb-2 bg-light">
                    <h5 class="fw-bold text-black border-bottom pb-1"><?= $this->lang->line('tax_details') ?></h5>
                </div>

                
                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('gst_status') ?>:</label>
                    <div><?= !empty($obj['gst_status']) ? $obj['gst_status'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('gstin_urp') ?>:</label>
                    <div><?= !empty($obj['gstin_urp']) ? $obj['gstin_urp'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('pan') ?>:</label>
                    <div><?= !empty($obj['pan']) ? $obj['pan'] : '-' ?></div>
                </div>

                <!-- Section: Other Details -->
                <div class="col-12 mt-4 mb-2 bg-light">
                    <h5 class="fw-bold text-black border-bottom pb-1"><?= $this->lang->line('other_details') ?></h5>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('payment_terms') ?>:</label>
                    <div><?= !empty($obj['payment_terms']) ? $obj['payment_terms'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('buyer_item_code') ?>:</label>
                    <div><?= !empty($obj['buyer_item_code']) ? $obj['buyer_item_code'] : '-' ?></div>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="fw-bold"><?= $this->lang->line('destination') ?>:</label>
                    <div><?= !empty($obj['destination']) ? $obj['destination'] : '-' ?></div>
                </div>

            </div>
        </div>

        <!-- Sticky Footer -->
        <div class="px-4 pt-3 border-top bg-white">
            <a href="javascript:void(0);" class="btn btn-danger w-100" data-bs-dismiss="offcanvas"><?= $this->lang->line('close') ?? 'Close' ?></a>
        </div>
    </div>
</div>
