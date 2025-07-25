<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page = current_url();
$data = explode('?', $current_page);
//  echo $filtered_value['from_date'];exit;
$is_filter_applied = !empty(array_filter([
  @$filtered_value['transporter_id'],
  @$filtered_value['category_of_approval'],
  @$filtered_value['from_date'],
  @$filtered_value['upto_date']
]));

// if (!empty($generation_date)) {
//   $date = date('d-m-Y', strtotime($generation_date));
// } else {
//   $date = date('d-m-Y');
// }

?>
<div id="collapseOne" class="accordion-collapse collapse <?= $is_filter_applied ? 'show' : '' ?> page-header-collapse">
    <div class="accordion-body pb-2">
        <div class="card-body"></div>
            <form method="get" id="filterForm">
                <div class="row mb-2">
              <div class="col-md-4 col-sm-4 ">
                <label  class="control-label"><?=$this ->lang->line('name_of_transporter')?><span class="required">*</span></label>
                <select name="transporter_id" class="form-control select2 transporters" >
                    <option value="0"> <?=$this ->lang->line('select_transporter_name')?></option>
                    <?php
                         if ($all_transporters): ?> 
                          <?php 
                            foreach ($all_transporters as $value) : ?>
                              <?php 
                                  if ($value['id'] == $filtered_value['transporter_id']): ?>
                                      <option value="<?= $value['id'] ?>" selected><?= $value['transporter_name'] ?></option>
                                  <?php else: ?>
                                      <option value="<?= $value['id'] ?>"><?= $value['transporter_name'] ?></option>
                                  <?php endif;   ?>
                                   <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0"><?=$this ->lang->line('no_result')?></option>
                        <?php endif; ?>
                </select>
              </div>
               <div class="col-md-4 col-sm-4">
                    <label  class="control-label"><?=$this ->lang->line('category_of_approval')?></label>
                    <?php  $app_cat = array(
                       'No' => $this->lang->line('select_option'),
                          'A' => 'A',
                          'B' => 'B',
                          'c' => 'C'
                          );
                      echo form_dropdown('category_of_approval',$app_cat,$filtered_value['category_of_approval'])
                    ?>
                  </div>
              </div>
               <div class="row">
                  <div class="col-md-4 col-sm-4 ">
                      <label  class="control-label"><?=$this ->lang->line('from_date')?></label>
                        <input type="text" id="startDate" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control " value="<?= isset($filtered_value['from_date']) && !empty($filtered_value['from_date']) ? date('m/d/Y', strtotime($filtered_value['from_date'])) : '' ?>" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label  class="control-label"> <?=$this ->lang->line('upto_date')?></label>
                      <input type="text"  id="dueDate"  data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control " value="<?= isset($filtered_value['upto_date']) && !empty($filtered_value['upto_date']) ? date('m/d/Y', strtotime($filtered_value['upto_date'])) : '' ?>" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                </div>
               
                 <div class="col-md-4 col-sm-4 hstack gap-2 justify-content-start mt-4">
                    
                    <input type="submit" class="btn btn-primary" value="<?=$this ->lang->line('search')?>" /> 
                    <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
                    <a href="<?php echo $data[0]?>" class="btn btn-danger" > <?=$this ->lang->line('reset')?></a>
                  </div>
                </div>
            </form>
        </div>
    </div>
            