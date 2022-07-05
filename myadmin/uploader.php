<?php

/*
$target_path = "/";

$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);

echo "Src=".$_FILES['uploadedfile']['tmp_name']." Dest=".$target_path."<br>";
echo print_r($_FILES['uploadedfile'])."<br><br>";

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    echo "The file ".  basename( $_FILES['uploadedfile']['name']).
    " has been uploaded";
} else{
    echo "There was an error uploading the file, please try again!";
}

*/


  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],"/home/velvet/www/www/grafix/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "/home/velvet/www/www/grafix/" . $_FILES["file"]["name"];
      }
    }


?>