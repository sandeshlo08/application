<?php
echo form_open("Hello/update_data");

foreach($inf as $key=>$val)
{
echo form_hidden("id","".$val["id"]."");
echo form_input("name","".$val["name"]."","placeholder='Enter Full Name'");
echo form_input("mobile","".$val["mobile"]."","placeholder='Enter Contact Number'");
echo form_input("email","".$val["email"]."","placeholder='Enter Email'");

}
echo form_submit("submit","Update");
echo form_close();
echo validation_errors('<p>');
?>    
</form>
