		<option value=""> Select Grade</option>
        <?php
         if ($grades): ?> 
          <?php 
            foreach ($grades as $value) : ?>
                <?php 
					if ($value['id'] == $grade_id): ?>
                        <option value="<?= $value['id'] ?>" selected><?= $value['grade'] ?></option>
                    <?php else: ?>
                        <option value="<?= $value['id'] ?>"><?= $value['grade'] ?></option>
                    <?php endif;   ?>
            <?php   endforeach;  ?>
        <?php else: ?>
            <option value=""><?=$this ->lang->line('no_result')?></option>
        <?php endif; ?>
   