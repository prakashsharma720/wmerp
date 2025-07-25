        <option value=""> Select Transporter</option>
        <?php
         if ($transporters): ?> 
          <?php 
            foreach ($transporters as $value) : ?>
                        <option value="<?= $value['id'] ?>"><?= $value['transporter_name'] ?></option>
            <?php   endforeach;  ?>
        <!-- <?php else: ?>
            <option value=""> No Supplier Found</option> -->
        <?php endif; ?>

		
		