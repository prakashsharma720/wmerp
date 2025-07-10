
	<?php 
		//print_r($menus);exit;
	foreach ($menus as $key => $menu) {
		
	?>
	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
	        <li class="nav-item has-treeview nav-link">
	            <a href="#" class="nav-link">
	             	<input type="checkbox" name="checkIds[]" value="<?php echo $menu->id ; ?>"> 
		              <p>
		                <?php echo $menu->menu_name; ?>
		                <i class="right fa fa-angle-left"></i>
		              </p>
	            </a>
	            <ul class="nav nav-treeview" style="padding-left: 30px;">
	           		<?php foreach ($menu->sub as $key => $submenu) {
					?>
		              <li class="nav-item">
		              	<a href="#" class="nav-link">
		                	<input type="checkbox" name="checkbtn" value="<?php echo $submenu->id ; ?>"> 
		                  	<p> <?php echo $submenu->menu_name ; ?></p>
		                 </a>
		                 <?php foreach ($submenu->sub as $key => $subsubmenu) {
								?>
		                 	<ul class="nav nav-treeview" style="padding-left: 30px;">
		                 		<li class="nav-item">
					              	<a href="#" class="nav-link">
					                	<input type="checkbox" name="checkbtn" value="<?php echo $subsubmenu->id ; ?>"> 
					                  	<p> <?php echo $subsubmenu->menu_name ; ?></p>
					                 </a>
					             </li>
		                 	</ul>
		                 	 <?php } ?>
		              </li>
		            
	        	<?php } ?>
				</ul>
	      	</li>

	    <?php } ?>
	</ul>

	<!-- <table class="table">
		<thead>
			<th> Check </th>
			<th> Module Name</th>
		</thead>
		<tbody>
			<tr>
				<td>
					<div class="form-group">
		                <label class="hover">
		                    <div class="icheckbox_minimal-blue  hover" >
		                    	<input type="checkbox" class="minimal" checked="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;" onClick="this.checked=!this.checked;"></ins>
		                    </div>
		                </label>
		            </div>
				</td>
				<td>
					<label> Dashboard</label>
				</td>
			</tr>
		</tbody>
	</table> -->
