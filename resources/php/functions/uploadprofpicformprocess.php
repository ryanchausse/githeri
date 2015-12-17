<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
include_once "./resources/php/functions/sqlconnectandselect.php";
session_start();
$username = dbSanitise($_SESSION["user_name"]);
    
$getuserid = "SELECT user_id FROM users WHERE user_name = '".$username."'";
$result = selectFromDB($getuserid);
while($row = mysqli_fetch_array($result)){
    $userid = $row["user_id"];
}
//PHP below is for image processing and is mostly not mine
    $valid_exts = array('jpeg', 'jpg', 'png', 'gif');
    $max_file_size = 1024 * 1024; #200kb
    $nw = $nh = 250; # image width & height

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if ( isset($_FILES['image']) ) {
        if (! $_FILES['image']['error'] && $_FILES['image']['size'] < $max_file_size) {
          # get file extension
          $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
          # file type validity
          if (in_array($ext, $valid_exts)) {
              $dir = './resources/images/users/' . $userid;
              //if dir doesnt exist, make it. If exists, erase current files in dir.
                if (!file_exists($dir) && !is_dir($dir)) {
                    mkdir($dir);
                }else{
                    $files = glob('./resources/images/users/' . $userid . '/*'); // get all file names
                    foreach($files as $file){ // iterate files
                      if(is_file($file))
                        unlink($file); // delete file
                    }
                }
              $path = './resources/images/users/' . $userid  . '/profilepic.' . $ext;
              $size = getimagesize($_FILES['image']['tmp_name']);
              # grab data form post request
              $x = (int) sanitisedata($_POST['x']);
              $y = (int) sanitisedata($_POST['y']);
              $w = (int) sanitisedata($_POST['w']) ? sanitisedata($_POST['w']) : $size[0];
              $h = (int) sanitisedata($_POST['h']) ? sanitisedata($_POST['h']) : $size[1];
              # read image binary data
              $data = file_get_contents($_FILES['image']['tmp_name']);
              # create v image form binary data
              $vImg = imagecreatefromstring($data);
              $dstImg = imagecreatetruecolor($nw, $nh);
              # copy image
              imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $nw, $nh, $w, $h);
              # save image
              imagejpeg($dstImg, $path);
              # clean memory
              imagedestroy($dstImg);
              //echo "<img src='$path' />";

            } else {
              echo 'unknown problem!';
            } 
        } else {
          echo 'file is too small or large';
        }
      } else {
        echo 'file not set';
      }
    } else {
      echo 'bad request!';
    }