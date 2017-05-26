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

function isImageWithUpload($user) {
			//File Must Be $_FILES['fileToUpload']
			$tofile = $user . "_". time() . "_orig";
			$target_dir = "pictures/profiles/";
			$target_file = $target_dir . $tofile;
			$imageFileType = pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION);
			$totalImgDir = $target_file . "." . $imageFileType;
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false and in_array(strtolower($imageFileType),array("gif","jpg","jpeg","png")) ) {
				if ($_FILES["fileToUpload"]["size"] > 10485760) {
					return array(false,"File is larger than 10MB");
				}
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$totalImgDir)) {
					return array(True,"File Successfully Uploaded!",$totalImgDir);
				} else {
					return array(False,"Error While Uploading File");
			} } else {
				return array(false,"This File Is Not A Photo (Of type JPG, PNG or Gif).");
			}
}
}

function generateAllSizesOfImage($origloc) {
	$newhires = str_replace("orig","256",$origloc);
	img_resize($origloc,$newhires,256,256);
	$newmidres = str_replace("orig","128",$origloc);
	$newlores = str_replace("orig","64",$origloc);
	img_resize($origloc,$newmidres,128,128);
	img_resize($origloc,$newlores,64,64);
}