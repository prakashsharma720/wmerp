<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page = current_url();
$data = explode('?', $current_page);

?>
<style>
    .control-label {
margin: 0.7rem
}
</style>
<div id="collapseOne" class="accordion-collapse collapse <?= $filtered_value ? 'show' : '' ?> page-header-collapse">
    <div class="accordion-body pb-2">
        <div class="card-body">
            <form method="get" id="filterForm">
                <div class="row">
                    <div class="col-md-4 col-sm-4 ">
                        <label class="control-label"> <?= $this->lang->line('search_by_category') ?></label>
                        <select name="category_name" class="form-control select2 suppliers">
                            <option value=""> <?= $this->lang->line('select_category') ?> </option>
                            <option
                                <?php if(!empty($filtered_value["category_name"])) { if($filtered_value['category_name']=='half') {echo "selected"; } } ?>
                                value="half"> <?= $this->lang->line('half') ?> </option>
                            <option
                                <?php if(!empty($filtered_value["category_name"])) { if($filtered_value['category_name']=='full') {echo "selected"; } } ?>
                                value="full"> <?= $this->lang->line('full') ?> </option>
                            <option
                                <?php if(!empty($filtered_value["category_name"])) { if($filtered_value['category_name']=='gatepass') {echo "selected"; } } ?>
                                value="gatepass"> <?= $this->lang->line('gatepass') ?> </option>
                        </select>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <label class="control-label"> <?= $this->lang->line('search_by_status') ?> </label>
                        <select name="leave_status" class="form-control select2">
                            <option value=""><?= $this->lang->line('select_status') ?></option>
                            <option
                                <?php if(!empty($filtered_value["leave_status"])) { if($filtered_value['leave_status']=='Pending') {echo "selected"; } } ?>
                                value="Pending"> <?= $this->lang->line('pending') ?> </option>
                            <option value="Approved"> <?= $this->lang->line('approved') ?> </option>
                            <option value="On Hold"> <?= $this->lang->line('hold') ?></option>
                            <option value="Rejected"> <?= $this->lang->line('rejected') ?></option>
                            <option value="Cancelled"> <?= $this->lang->line('cancel') ?></option>
                        </select>
                    </div>

                  <!-- From Date -->
                    <div class="col-lg-4 mb-4">
                        <label class="form-label"><?= $this->lang->line('from_date') ?></label>
                        <input type="text" id="issueDate" name="from_date" class="form-control date-picker"
                            placeholder="<?= $this->lang->line('from_date') ?>" data-date-format="dd-mm-yyyy" autocomplete="off"
                            value="<?= isset($filtered_value['from_date']) && !empty($filtered_value['from_date']) ? date('d-m-Y', strtotime($filtered_value['from_date'])) : '' ?>">
                </div>
                
                <!-- Upto Date -->
                <div class="col-lg-4 mb-4">
                    <label class="form-label"><?= $this->lang->line('upto_date') ?></label>
                    <input type="text" id="dueDate" name="upto_date" class="form-control date-picker" placeholder="<?= $this->lang->line('upto_date') ?>"
                        data-date-format="dd-mm-yyyy" autocomplete="off"
                        value="<?= isset($filtered_value['upto_date']) && !empty($filtered_value['upto_date']) ? date('d-m-Y', strtotime($filtered_value['upto_date'])) : '' ?>">
                </div>

                    <div class="col-md-1 col-sm-1 ">
                        <label class="control-label" style="visibility: hidden;">Grade</label>
                        <input type="submit" class="btn btn-xs btn-primary" value="<?= $this->lang->line('search') ?>" />
                    </div>
                    <div class="col-md-1 col-sm-1 ">
                        <label class="control-label" style="visibility: hidden;"> Grade</label>
                        <a href="<?php echo $data[0]?>" class="btn btn-danger">  <?= $this->lang->line('reset') ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>