<?php
function img_resize($target, $newcopy, $w, $h) {
    list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {
           $w = $h * $scale_ratio;
    } else {
           $h = $w / $scale_ratio;
    }
    $img = "";
	$ext = pathinfo($target,PATHINFO_EXTENSION);
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
      $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
      $img = imagecreatefrompng($target);
    } else { 
      $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    imagejpeg($tci, $newcopy, 84);
}

function isImageWithUpload($user,$target,$ts,$uploadedTo) {
			if ($ts) {$tofile = $user . "_". time() . "_orig";} else {$tofile = $user . "_orig";}
			if (!isset($uploadedTo) { $uploadedTo = "fileToUpload";}
			$target_dir = $target;
			$target_file = $target_dir . $tofile;
			$imageFileType = pathinfo($_FILES[$uploadedTo]["name"],PATHINFO_EXTENSION);
			$totalImgDir = $target_file . "." . $imageFileType;
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES[$uploadedTo]["tmp_name"]);
			if($check !== false and in_array(strtolower($imageFileType),array("gif","jpg","jpeg","png")) ) {
				if ($_FILES[$uploadedTo]["size"] > 10485760) {
					return array(false,"File is larger than 10MB");
				}
				if (move_uploaded_file($_FILES[$uploadedTo]["tmp_name"],$totalImgDir)) {
					return array(True,"File Successfully Uploaded!",$totalImgDir);
				} else {
					return array(False,"Error While Uploading File");
			} } else {
				return array(false,"This File Is Not A Photo (Of type JPG, PNG or Gif).");
			}
}
}

function generateAllSizesOfImage($origloc,$replTxt) {
	if (!isset($replTxt)) {
		$replTxt = "orig";
	} else if (strlen($replTxt) < 1) {
		$replTxt = "orig";
	}
	$newhires = str_replace($replTxt,"256",$origloc);
	img_resize($origloc,$newhires,256,256);
	$newmidres = str_replace($replTxt,"128",$origloc);
	$newlores = str_replace($replTxt,"64",$origloc);
	img_resize($origloc,$newmidres,128,128);
	img_resize($origloc,$newlores,64,64);
}