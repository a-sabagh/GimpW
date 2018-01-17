<?php
function Watermark_positioned($image,$margin_right,$margin_bottom){
	//
	if (preg_match("/\.(png)$/", $image)) {
        $image_dest = imagecreatefrompng("inputGallery/{$image}");
    } else {
    	$image_dest = imagecreatefromjpeg("inputGallery/{$image}");
    }

	$image_src = imagecreatefrompng("inputWatermark/watermark.png");
	$image_dest_width = imagesx($image_dest);
	$image_dest_height = imagesy($image_dest);
	$image_src_width = imagesx($image_src);
	$image_src_height = imagesy($image_src);
	$dst_x = $margin_right;
	$dst_y = ($image_dest_height - $image_src_height) - $margin_bottom;
	imagecopy($image_dest , $image_src , $dst_x , $dst_y , 0 , 0 , $image_src_width , $image_src_height);
	$result = imagejpeg($image_dest , "outputGallery/{$image}");
	if($result){
	    echo "<b style='color:greenyellow'>Output OK</b><br>";
	}else{
	    echo "<b style='color:orangered'>Output ERROR!</b><br>";
	}
}

ini_set('memory_limit', '-1');
$i = 1;
$inputGallery_array = glob("inputGallery/*");
foreach ($inputGallery_array as $filename) {
	$sitename = str_replace("inputGallery/", "", $filename);
	$margin_right = 30;
	$margin_bottom = 30;
	Watermark_positioned($sitename,$margin_right,$margin_bottom);
}