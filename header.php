<!DOCTYPE html>  
<html>  
<head>  
    <title>Basic Site</title> 
    </head>
    <body>
    <h3>Welcome to my Site</h3>
    <ul>	
    <?php
    	foreach ($menu_main as $key => $value) {
    		echo "<li><p><strong><a href='pages/".$value["url"]."'>".$value["title"]."</a></strong></p>";
    		$num=count($sub_menu);
            if($num>0)
            {
                echo "<ul>";

            foreach ($sub_menu as $sub_value) {
    			if($sub_value["main_id"]==$value["id"])
    			{
    				echo "<li><p>".$sub_value["title"]."</p></li>";
    			}
    		}
            echo "</ul>";
    	}
        else
        {
            echo "</li>";
        }
    }
    ?>
    </ul>
    <a href="<?=site_url();?>/Hello/index">Index Page</a>
<?php
if (isset($msg)) {
	echo $msg;
} 
?>