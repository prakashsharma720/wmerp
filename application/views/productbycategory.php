        <option value=""> Select Product</option>
        <?php
         if ($products): ?> 
          <?php 
            foreach ($products as $value) : ?>
                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
            <?php   endforeach;  ?>
        <?php endif; ?>
