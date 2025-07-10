  <?php if (!empty($HSN_data['hsn_code'])){ ?>
      
        <label  class="control-label">HSN Code</label>
        <input type="text"  name="hsn_code" class="form-control clear_hsn"  autocomplete="off" value="<?= $HSN_data['hsn_code']?>" readonly autofocus>
      <?php } ?> 