<?php


echo form_open("Hello/check_data");
echo form_input("name","","placeholder='Enter Full Name'");
echo form_input("mobile","","placeholder='Enter Contact Number'");
echo form_input("email","","placeholder='Enter Email'");
echo form_submit("submit","Add Data");

echo form_close();
echo validation_errors('<p>');
?>
</form>
<table>
<tr><td>Name</td><td>Contact</td><td>Email</td><td>Action</td><td>Upload Image</td></tr>
<?php foreach ($data as $index => $val) {
	?>

	<tr><td><a href="view_Detail/<?=$val->id?>"><?=$val->name?></a></td><td><?=$val->mobile?></td><td><?=$val->email?></td><td><?=anchor("Hello/edit/".$val->id,"Edit")?>&nbsp;<?=anchor("Hello/delete/".$val->id,"Delete Data")?></td>
	<td>
		<?=form_open_multipart("Hello/upload_image")?>
		<input type="hidden" name="id" value="<?=$val->id?>">
		<input type="file" name="file" size="20"><?=form_submit("submit","Upload")?>

	</td>
	</tr>

	<?php
} 
?>
</table>