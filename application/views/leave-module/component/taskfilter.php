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
                        <label class="control-label"><?= $this->lang->line('search_by_project') ?></label>
                        <?php  echo form_dropdown('project_id', $projects,'required="required"') ?>
                    </div>
                   
                    <div class="col-md-4 col-sm-4 ">
                        
                        <label class="control-label"><?= $this->lang->line('search_by_employee_name') ?> </label>
                      <select name="employee_id" class="form-control select2">
    <option value=""><?= $this->lang->line('search_by_employee_name') ?></option>
    <?php if ($name): ?>
        <?php foreach ($name as $value) : ?>
            <?php $selected = ($value['id'] == $selectedEmployeeId) ? 'selected' : ''; ?>
            <option value="<?= $value['id'] ?>" <?= $selected ?>><?= $value['name'] ?></option>
        <?php endforeach; ?>
    <?php else: ?>
        <option value="">No result</option>
    <?php endif; ?>
</select>




                        <!--<select name="employee_id" class="form-control select2 ">-->
                            
                        <!--    <option value="">Select Employee Name</option>-->
                           
                        <!--    <?php if ($name): ?>-->
                        <!--    <?php foreach ($name as $value) : ?>-->
                            
                        <!--    <option value="<?= $value['id'] ?>" selected><?= $value['name'] ?></option>-->
                            
                        <!--    <?php   endforeach;  ?>-->
                        <!--    <?php else: ?>-->
                        <!--    <option value="">No result</option>-->
                        <!--    <?php endif; ?>-->
                        <!--</select>-->
                    </div>
                    
                    <div class="col-md-4 col-sm-4">
                        <label class="control-label"><?= $this->lang->line('search_by_status') ?> </label>
                        <select name="task_status" class="form-control select2">
                            <option value=""><?= $this->lang->line('search_by_status') ?></option>
                            <option value="In Process"> In Process</option>
                            <option value="On Hold"> On Hold</option>
                            <option value="Completed"> Completed</option>
                        </select>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <label class="control-label"> <?= $this->lang->line('from_date') ?></label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date"
                            class="form-control date-picker" placeholder="<?= $this->lang->line('dd_mm_yyyy') ?>" autocomplete="off"
                            autocomplete="off">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label class="control-label"> <?= $this->lang->line('upto_date') ?></label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date"
                            class="form-control date-picker" value="" placeholder="<?= $this->lang->line('dd_mm_yyyy') ?>" autocomplete="off"
                            autocomplete="off">
                    </div>
                    <div class="col-md-1 col-sm-1 ">
                        <label class="control-label" style="visibility: hidden;"> Grade</label>
                        <input type="submit" class="btn btn-xs btn-primary" value="Search" />
                    </div>
                    <div class="col-md-1 col-sm-1 ">
                        <label class="control-label" style="visibility: hidden;"> Grade</label>
                        <a href="<?php echo $data[0]?>" class="btn btn-danger"> <?= $this->lang->line('reset') ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>