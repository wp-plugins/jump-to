<div id="jumptoadv" class="dbx-group">
	<div class="dbx-box-wrapper">
		<fieldset id="jumpto" class="dbx-box">
			<div class="dbx-handle-wrapper">
				<h3 class="dbx-handle"><?php _e ('Jump To', 'jumpto') ?></h3>
			</div>
		
			<div class="dbx-content-wrapper">
				<div id="jumptostuff" class="dbx-content">
					<br/>
					<?php for ($x = 1; $x < $count + 1; $x++) : ?>
						Heading <?php echo $x ?>: <input style="width: 70%" type="text" name="jumpto[<?php echo $x ?>]" value="<?php if (isset ($existing[$x])) echo htmlspecialchars ($existing[$x]) ?>"/><br/>
					<?php endfor;?>
				</div>
			</div>
		
		</fieldset>
	
		<br/>
	</div>
</div>
