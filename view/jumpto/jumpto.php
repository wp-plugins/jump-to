<select name="page" onchange="document.location.href=this.options[selectedIndex].value">
<?php foreach ($meta AS $pos => $text) : ?>
	<option value="<?php echo $this->page_link ($pos) ?>"<?php if ($current == $pos) echo ' selected="selected"' ?>><?php echo $text ?> </option>
<?php endforeach; ?>
</select>